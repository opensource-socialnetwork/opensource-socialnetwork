<?php
/**
 * Authentik OIDC callback.
 *
 * Verifies state, exchanges the code for tokens, validates the id_token,
 * and either logs the user in or auto-provisions a new OSSN account.
 *
 * User-matching policy:
 *   1. Match by `sub` (stable Authentik subject identifier) first — handles
 *      email changes upstream without losing the binding.
 *   2. If no sub-bound user exists, require email_verified = true before
 *      trusting the email at all. This blocks pre-creation attacks where an
 *      attacker controls an Authentik account with someone else's unverified email.
 *   3. If an unrelated local OSSN account already owns that email, refuse SSO
 *      rather than silently linking — never silently bind an external identity
 *      to a pre-existing local account.
 */

if (ossn_isLoggedin()) {
    redirect('home');
}

$state             = input('state');
$code              = input('code');
$expected_state    = OssnSession::getSession('authentik_state');
$expected_nonce    = OssnSession::getSession('authentik_nonce');
$expected_verifier = OssnSession::getSession('authentik_pkce_verifier');

OssnSession::unassign('authentik_state');
OssnSession::unassign('authentik_nonce');
OssnSession::unassign('authentik_pkce_verifier');

if (empty($state) || empty($code) || empty($expected_state) || !hash_equals($expected_state, $state)) {
    $remote = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
    error_log("OssnAuthentikLogin: state mismatch from {$remote}");
    ossn_trigger_message(ossn_print('authentik:state:mismatch'), 'error');
    redirect('login');
}

try {
    $client = new OssnAuthentikLogin();
    $tokens = $client->exchangeCode($code, $expected_verifier);
    $claims = $client->verifyIdToken($tokens->id_token, $expected_nonce);
} catch (Exception $e) {
    error_log('OssnAuthentikLogin callback: ' . $e->getMessage());
    ossn_trigger_message(ossn_print('authentik:login:error'), 'error');
    redirect('login');
}

// 1. Look up by sub first (the stable identifier).
$sub  = isset($claims->sub) ? $claims->sub : '';
$user = OssnAuthentikLogin::userBySub($sub);

if (!$user) {
    // 2. New SSO user — email must be present AND verified by the IdP.
    // Strict `=== true`: some federated IdPs serialize email_verified as a
    // string ("false"/"true"), and empty("false") is false — which would let
    // an unverified email through.
    $verified = isset($claims->email_verified) && $claims->email_verified === true;
    if (empty($claims->email) || !$verified) {
        ossn_trigger_message(ossn_print('authentik:no:verified:email'), 'error');
        redirect('login');
    }

    $email = strtolower($claims->email);
    $existing = ossn_user_by_email($email);

    // 3. Don't silently bind to a pre-existing local account.
    if ($existing) {
        error_log("OssnAuthentikLogin: SSO blocked, email {$email} owned by local account guid={$existing->guid}");
        ossn_trigger_message(ossn_print('authentik:account:exists'), 'error');
        redirect('login');
    }

    $user = ossn_authentik_login_provision_user($claims);
    if (!$user) {
        ossn_trigger_message(ossn_print('authentik:provision:failed'), 'error');
        redirect('login');
    }
}

// Strip secrets before assigning to session (mirrors OssnUser::Login).
unset($user->password);
unset($user->salt);

// Re-check that the account is validated — defensive against an admin
// having re-marked an SSO-linked user as pending between provisioning runs.
// OSSN's canonical check (OssnUser::Login, isUserVALIDATED): a user is
// validated when their `activation` column is empty/NULL.
if (!empty($user->activation)) {
    error_log("OssnAuthentikLogin: login denied, user guid={$user->guid} is not validated");
    ossn_trigger_message(ossn_print('authentik:login:error'), 'error');
    redirect('login');
}

// Fire OSSN's login hook chain BEFORE committing the session. Security
// plugins (brute-force lockout, IP/region blocks, MFA gates, ban lists,
// audit-log gatekeepers) listen on these — the SSO path must respect
// their veto, not bypass it.
$vars = array('user' => $user);
ossn_trigger_callback('user', 'before:login', $vars);
$allow = ossn_call_hook('user', 'login', $vars, true);
if ($allow === false) {
    error_log("OssnAuthentikLogin: login denied by hook for guid={$user->guid}");
    ossn_trigger_message(ossn_print('authentik:login:error'), 'error');
    redirect('login');
}

// Defeat session fixation: roll the session id at the auth boundary.
if (session_status() === PHP_SESSION_ACTIVE) {
    session_regenerate_id(true);
}

OssnSession::assign('OSSN_USER', $user);

// update_last_login reads ossn_loggedin_user(), so the session assign above
// must precede this call. Kept on a fresh OssnUser instance solely to access
// the inherited update() helper.
$lastlogin = new OssnUser();
$lastlogin->update_last_login();

ossn_trigger_callback('login', 'success', array('user' => $user));
redirect('home');

/**
 * Auto-create an OSSN user from Authentik claims. Stamps `authentik_sub`
 * so future SSO logins match by the stable identifier rather than email.
 */
function ossn_authentik_login_provision_user($claims) {
    $email = strtolower($claims->email);

    // OSSN's username minimum is configurable via hook (default 5). Honor it
    // so addUser() doesn't silently reject a too-short candidate.
    $min_len = (int) ossn_call_hook('user', 'minimum:username:length', null, 5);
    if ($min_len < 1) {
        $min_len = 5;
    }

    // Username: prefer preferred_username, fall back to email local part, then random.
    $candidate = '';
    if (!empty($claims->preferred_username)) {
        $candidate = preg_replace('/[^a-zA-Z0-9]/', '', $claims->preferred_username);
    }
    if (strlen($candidate) < $min_len) {
        $candidate = preg_replace('/[^a-zA-Z0-9]/', '', strstr($email, '@', true));
    }
    if (strlen($candidate) < $min_len) {
        $candidate = 'user' . substr(bin2hex(random_bytes(8)), 0, 12);
    }

    $username = $candidate;
    $suffix   = 1;
    while (ossn_user_by_username($username)) {
        $suffix++;
        $username = $candidate . $suffix;
        if ($suffix > 50) {
            $username = $candidate . substr(bin2hex(random_bytes(3)), 0, 6);
            break;
        }
    }

    list($first, $last) = ossn_authentik_login_split_name($claims, $username);

    $u                  = new OssnUser();
    $u->first_name      = $first;
    $u->last_name       = $last;
    $u->email           = $email;
    $u->username        = $username;
    $u->password        = bin2hex(random_bytes(16)); // never used; SSO is the only path
    $u->validated       = true;
    $u->sendactiviation = false;

    if (!$u->addUser()) {
        return false;
    }

    $created = ossn_user_by_email($email);
    if (!$created) {
        return false;
    }

    // Stamp the SSO subject identifier on the user — primary key for future logins.
    $entity              = new OssnEntities();
    $entity->type        = 'user';
    $entity->subtype     = 'authentik_sub';
    $entity->owner_guid  = $created->guid;
    $entity->value       = isset($claims->sub) ? $claims->sub : $email;
    $entity->add();

    return ossn_user_by_email($email);
}

/**
 * Best-effort first/last from OIDC claims:
 *   - given_name + family_name when both present
 *   - split `name` on whitespace if family_name missing
 *   - fall back to username + '-' as a last resort (OSSN requires non-empty last_name)
 */
function ossn_authentik_login_split_name($claims, $username) {
    $first = isset($claims->given_name)  ? trim($claims->given_name)  : '';
    $last  = isset($claims->family_name) ? trim($claims->family_name) : '';

    if ($first !== '' && $last !== '') {
        return array($first, $last);
    }

    $full = isset($claims->name) ? trim($claims->name) : '';
    if ($full !== '') {
        $parts = preg_split('/\s+/', $full);
        if ($first === '') {
            $first = array_shift($parts);
        }
        if ($last === '' && !empty($parts)) {
            $last = implode(' ', $parts);
        }
    }

    if ($first === '') {
        $first = $username;
    }
    if ($last === '') {
        $last = '-';
    }
    return array($first, $last);
}
