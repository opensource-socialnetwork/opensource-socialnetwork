<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$users = $params['users'];
if (!isset($params['icon_size'])) {
    $avatar_size = 'large';
} else {
    $avatar_size = $params['icon_size'];
}
$sizes = array('large', 'larger', 'small', 'topbar');
foreach ($users as $user) {
	if(isset($avatar_size) && in_array($avatar_size, $sizes)){
		$icon = $user->iconURL()->$avatar_size;
	}	 else {
		$icon = $user->iconURL()->small;
	}
    ?>
<div class="ossn-reactions-list-wholiked-item">
<div class="row">
	<div class="col-md-2 col-xs-3">
		<img src="<?php echo $icon; ?>"/>
	</div>
	<div class="col-md-10 col-xs-9">
		<div class="ossn-reactions-list-whoreacted-uinfo">
			<a class="userlink" href="<?php echo ossn_site_url(); ?>u/<?php echo $user->username; ?>"><?php echo $user->fullname; ?></a>
			<div class="ossn-reaction-list ossn-reactions-list-whoreacted">
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'like'){ ?>
				<li>
					<div class="emoji  emoji--like">
						<div class="emoji__hand">
							<div class="emoji__thumb"></div>
						</div>
					</div>
				</li>
				<?php } ?>        
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'love'){ ?>
				<li>
					<div class="emoji emoji--love">
						<div class="emoji__heart"></div>
					</div>
				</li>
				<?php } ?>
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'haha'){ ?>
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
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'yay'){ ?>
				<li>
					<div class="emoji  emoji--yay">
						<div class="emoji__face">
							<div class="emoji__eyebrows"></div>
							<div class="emoji__mouth"></div>
						</div>
					</div>
				</li>
				<?php } ?>
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'wow'){ ?>
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
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'sad'){ ?>
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
				<?php if(isset($user->__like_subtype) && $user->__like_subtype == 'angry'){ ?>
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
		</div>
	</div>
</div>    
</div>
	<?php } ?>
