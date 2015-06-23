<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$OssnLikes = new OssnLikes;
$OssnComments = new OssnComments;
$object = $params['entity_guid'];
$count = $OssnLikes->CountLikes($object, 'entity');
?>
<?php if (ossn_isLoggedIn()) { ?>
    <div class="like_share  comments-like-comment-links">
        <div id="ossn-like-<?php echo $object; ?>" class="button-container">
            <?php if (!$OssnLikes->isLiked($object, ossn_loggedin_user()->guid, 'entity')) {
                $link['onclick'] = "Ossn.EntityLike({$object});";
                $link['href'] = 'javascript::;';
                $link['text'] = ossn_print('ossn:like');
                echo ossn_plugin_view('output/url', $link);

            } else {
                $user_liked = true;
                $link['onclick'] = "Ossn.EntityUnlike({$object});";
                $link['href'] = 'javascript::;';
                $link['text'] = ossn_print('ossn:unlike');
                echo ossn_plugin_view('output/url', $link);

            } ?>
        </div>
        <span class="dot-comments">.</span> <a href="#comment-box-<?php echo $object; ?>"><?php echo ossn_print('comment:comment'); ?></a>
        <?php if ($OssnComments->countComments($object, 'entity') > 5) { ?>
            <span class="dot-comments">.</span> <a href="#"><?php echo ossn_print('comment:view:all'); ?></a>
        <?php } ?>
    </div>
<?php } /* Likes and comments don't show for nonlogged in users */ ?>

<?php if ($OssnLikes->CountLikes($object, 'entity')) { ?>
    <div class="like_share">
        <div class="ossn-like-icon"></div>
        <?php if ($user_liked == true && $count == 1) { ?>
            <?php echo ossn_print("ossn:liked:you"); ?>
        <?php
        } elseif ($user_liked == true && $count > 1) {
            $count = $count - 1;
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewLikes({$object}, 'entity');";
            $link['href'] = '#';
            $link['text'] = ossn_print("ossn:like:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:like:you:and:this", array($link));
        } elseif (!$user_liked) {
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewLikes({$object}, 'entity');";
            $link['href'] = '#';
            $link['text'] = ossn_print("ossn:like:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:like:this", array($link));
        }?>
    </div>
<?php } ?>
