<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
echo '<div class="comments-likes">';
if (ossn_is_hook('post', 'likes:entity')) {
    $entity['entity_guid'] = $params['entity_guid'];
    echo ossn_call_hook('post', 'likes:entity', $entity);
}
if (ossn_is_hook('post', 'comments:entity')) {
    $entity['entity_guid'] = $params['entity_guid'];
    echo ossn_call_hook('post', 'comments:entity', $entity);
}
echo '</div>';