<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   OPENTEKNIK  LLC, COMMERCIAL LICENSE, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link      https://www.opensource-socialnetwork.org/
 */
 ?>
<div class="row bpage-bottom">
	<div class="col-md-4 d-none d-lg-block">
		<div class="business-page-right-bottom">
        	<?php 
				echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('bpage:about'),
						'contents' => ossn_plugin_view('bpage/pages/about', $params),
				));
				?>
			<?php
			if(class_exists('OssnAds')){
				$ads = new OssnAds();
				$ads = $ads->getByPlacement('global');
				echo ossn_plugin_view('ads/page/view_small', array(
						'ads' => $ads,											   
				));
			}
			?>
		</div>
	</div>
	<div class="col-md-8">
		<?php
		   if(ossn_isLoggedin()){
				if($params['page']->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate()){
					echo '<div class="ossn-wall-container">';
					echo ossn_view_form('bpage/wall/container', array(
							'action' => ossn_site_url() . 'action/wall/post/bpage',
							'params' => $params,
							'id' => 'ossn-wall-form',
					));
					echo '</div>';
				}
			}
			echo '<div class="user-activity">';
					$wall  = new OssnWall;
					$posts = $wall->GetPostByOwner($params['page']->guid, 'businesspage');
					$count = $wall->GetPostByOwner($params['page']->guid, 'businesspage', true);
			if($posts) {
				foreach($posts as $post) {
					$vars = ossn_wallpost_to_item($post);
					if(!empty($vars) && is_array($vars)){ 
						echo ossn_wall_view_template($vars);
					}
				}
				echo ossn_view_pagination($count);
			}
			echo "</div>";
			?>
	</div>    
</div>