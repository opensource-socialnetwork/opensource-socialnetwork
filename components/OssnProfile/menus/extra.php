<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
?>
<div>
    <?php
    if (!empty($params['menu'])) {
        foreach ($params['menu'] as $menu) {
            foreach ($menu as $text => $link) {
                echo "<li><a href='{$link}'>{$text}</a></li>";
            }
        }
    }
    ?>
</div>