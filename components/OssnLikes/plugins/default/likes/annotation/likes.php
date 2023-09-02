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
if(!isset($params['annotation_id']) || isset($params['annotation_id']) && empty($params['annotation_id'])){
	return;	
}
$datalikes   = ''; 
$OssnLikes	 = new OssnLikes;
$likes_total = $OssnLikes->CountLikes($params['annotation_id'], 'annotation');
$datalikes   = $likes_total;

if($datalikes  > 0){ 
	foreach($OssnLikes->__likes_get_all as $item){
			$last_three_icons[$item->subtype] = $item->subtype;
	}
	$last_three = array_slice($last_three_icons, -3);
?>
				<span class="ossn-likes-annotation-total">
					<?php
						// Show total likes
						echo ossn_plugin_view('output/url', array(
										'href' => 'javascript:void(0);', 
										'text' => $likes_total, 
										'onclick' => "Ossn.ViewLikes({$params['annotation_id']}, 'annotation')",
										'class' => "ossn-total-likes ossn-total-likes-{$params['annotation_id']}",
										'data-likes' => $datalikes,
						));
					?>
					</span>                    
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
<?php } ?>  