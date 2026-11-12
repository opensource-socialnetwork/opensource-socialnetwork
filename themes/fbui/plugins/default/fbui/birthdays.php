<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OPENTEKNIK LLC, COMMERCIAL LICENSE
 * @license   OPENTEKNIK LLC, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link      http://www.opensource-socialnetwork.org/licence
 */

if (!ossn_isLoggedin() || !com_is_active('Birthdays')) {
    return;
}

$user = ossn_loggedin_user();
$birthdays = ossn_get_upcomming_birthdays($user);

if (!$birthdays) {
    return;
}

$current_date = date('m-d');
?>
<div class="fbui-birthdays-widget">
    <div class="fbui-birthdays-header">
        <?php echo ossn_print('birthdays'); ?>
    </div>

    <?php 
    foreach ($birthdays as $bday): 
        $formatted_date = str_replace('/', '-', $bday->birthdate);
        $item_md = date('m-d', strtotime($formatted_date));
        $is_today = ($item_md === $current_date);
        ?>
        <a class="fbui-birthday-item" href="<?php echo $bday->profileURL(); ?>">
            <div class="fbui-birthday-icon-wrapper">
                    <svg class="fbui-gift-svg" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="fb_box_body" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#2196F3"/>
                                <stop offset="100%" stop-color="#1E88E5"/>
                            </linearGradient>
                            <linearGradient id="fb_box_lid" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#4FC3F7"/>
                                <stop offset="100%" stop-color="#29B6F6"/>
                            </linearGradient>
                            <linearGradient id="fb_ribbon" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#FF5252"/>
                                <stop offset="100%" stop-color="#E91E63"/>
                            </linearGradient>
                        </defs>

                        <rect x="6" y="14" width="24" height="15" rx="3" fill="url(#fb_box_body)"/>
                        <rect x="4.5" y="9.5" width="27" height="5" rx="2" fill="url(#fb_box_lid)"/>
                        <rect x="15.5" y="9.5" width="5" height="19.5" fill="url(#fb_ribbon)"/>
                        <path d="M18 9.5C18 9.5 14.5 4 11 4C8.5 4 7 5.8 7 7.8C7 10.2 10.5 11 18 11.5V9.5Z" fill="url(#fb_ribbon)"/>
                        <path d="M18 9.5C18 9.5 21.5 4 25 4C27.5 4 29 5.8 29 7.8C29 10.2 25.5 11 18 11.5V9.5Z" fill="url(#fb_ribbon)"/>
                    </svg>
            </div>

            <div class="fbui-birthday-content">
                <?php if ($is_today): ?>
                    <?php echo ossn_print('birthdays:today', array($bday->fullname)); ?>
                <?php else: ?>
                    <b><?php echo $bday->fullname; ?></b>
                    <div class="fbui-birthday-subtext"><?php echo date('jS \of F', strtotime($formatted_date)); ?></div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>