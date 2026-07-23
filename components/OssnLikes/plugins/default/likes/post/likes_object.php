<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$OssnLikes = new OssnLikes;

$object = $params['object_guid'];;
$count = $OssnLikes->CountLikes($object, 'object');

$user_liked = '';
if (ossn_isLoggedIn()) { 
            $user_liked = $OssnLikes->isLiked($object, ossn_loggedin_user()->guid, 'object');
}
//don't show the bar if user liked it and its only one like means only loggedin user liked it
//[E] Update likes counter even if count=1 and only current user=liked#2620
//if($user_liked == true && $count == 1){
	//return;	
//}
/* Likes and comments don't show for nonlogged in users */ 
if ($count) {
    $reaction_counts = [];
    foreach ($OssnLikes->__likes_get_all as $item) {
        $type = $item->subtype;
        if (!isset($reaction_counts[$type])) {
            $reaction_counts[$type] = 0;
        }
        $reaction_counts[$type]++;
    }

    arsort($reaction_counts);
    // Slice the associative array FIRST, preserving the top 3 keys, then extract them
    $top_three_associative = array_slice($reaction_counts, 0, 3, true);
    $last_three = array_flip(array_keys($top_three_associative));
	?>
    <div class="like-share" onclick="Ossn.ViewLikes(<?php echo $object;?>, 'object');">
<div class="ossn-reaction-list">
	<?php if(isset($last_three['like'])){ ?>
	<li>
		<div class="emoji  emoji--like">
			<div class="emoji__hand">
				<div class="emoji__thumb"></div>
			</div>
		</div>
	</li>
	<?php } ?>  
	<?php if(isset($last_three['dislike'])){ ?>
	<li>
		<div class="emoji  emoji--dislike">
			<div class="emoji__hand">
				<div class="emoji__thumb"></div>
			</div>
		</div>
	</li>
	<?php } ?>            
	<?php if(isset($last_three['love'])){ ?>
	<li>
		<div class="emoji emoji--love">
			<div class="emoji__heart"></div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['haha'])){ ?>
	<li>
		<div class="emoji  emoji--haha">
			<div class="emoji__face">
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth">
					<div class="emoji__tongue"></div>
				</div>
			</div>
		</div>
	</li>
	<?php } ?> 
	<?php if(isset($last_three['yay'])){ ?>        
	<li>
		<div class="emoji  emoji--yay">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['wow'])){ ?>
	<li>
		<div class="emoji  emoji--wow">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['sad'])){ ?>
	<li>
		<div class="emoji  emoji--sad">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['angry'])){ ?>
	<li>
		<div class="emoji  emoji--angry">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
</div>
    	<span class="ossn-reaction-title-wholiked">
      <?php if ($count) {
            $link['href'] = 'javascript:void(0);';
            $link['text'] = $count;
            echo ossn_plugin_view('output/url', $link);
        } ?>
        </span>
    </div>
<?php } ?>

