<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
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
	} else {
		$icon = $user->iconURL()->small;
	}
	?>
	<div class="ossn-reactions-list-wholiked-item">
		<div class="row">
			<div class="col-lg-2 col-3">
				<img class="user-icon-<?php echo $avatar_size;?>" src="<?php echo $icon; ?>"/>
			</div>
			<div class="col-lg-10 col-9">
				<div class="ossn-reactions-list-whoreacted-uinfo">
					<a class="userlink" href="<?php echo ossn_site_url(); ?>u/<?php echo $user->username; ?>"><?php echo $user->fullname; ?></a>
					<div class="ossn-reaction-list ossn-reactions-list-whoreacted">
						<?php 
						if(isset($user->__like_subtype)){
							switch($user->__like_subtype){
								case 'like':
						?>
									<li>
										<div class="emoji  emoji--like">
											<div class="emoji__hand">
												<div class="emoji__thumb"></div>
											</div>
										</div>
									</li>
						<?php
									break;
								case 'dislike':
						?>
									<li>
										<div class="emoji  emoji--dislike">
											<div class="emoji__hand">
												<div class="emoji__thumb"></div>
											</div>
										</div>
									</li>
						<?php
									break;
								case 'love':
						?>
									<li>
										<div class="emoji emoji--love">
											<div class="emoji__heart"></div>
										</div>
									</li>
						<?php
									break;
								case 'haha':
						?>
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
						<?php
									break;
								case 'yay':
						?>
									<li>
										<div class="emoji  emoji--yay">
											<div class="emoji__face">
												<div class="emoji__eyebrows"></div>
												<div class="emoji__mouth"></div>
											</div>
										</div>
									</li>
						<?php
									break;
								case 'wow':
						?>
									<li>
										<div class="emoji  emoji--wow">
											<div class="emoji__face">
												<div class="emoji__eyebrows"></div>
												<div class="emoji__eyes"></div>
												<div class="emoji__mouth"></div>
											</div>
										</div>
									</li>
						<?php
									break;
								case 'sad':
						?>
									<li>
										<div class="emoji  emoji--sad">
											<div class="emoji__face">
												<div class="emoji__eyebrows"></div>
												<div class="emoji__eyes"></div>
												<div class="emoji__mouth"></div>
											</div>
										</div>
									</li>
						<?php
									break;
								case 'angry':
						?>
									<li>
										<div class="emoji  emoji--angry">
											<div class="emoji__face">
												<div class="emoji__eyebrows"></div>
												<div class="emoji__eyes"></div>
												<div class="emoji__mouth"></div>
											</div>
										</div>
									</li>
						<?php
									break;
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>    
	</div>
<?php
} ?>
