<?php
$list = OssnBlock::getBlocking();
?>
<p><?php echo ossn_print('ossn:profile:list:text');?></p>
<div class="ossn-block-lists">
	<?php 
	if($list){
			foreach($list as $relation){
					$item = ossn_user_by_guid($relation->relation_to);
					if(!$item){
						continue;	
					}
				?>
			    <li><span><?php echo $item->fullname;?> (<?php echo $item->username;?>)</span> <a href="<?php echo ossn_site_url("action/unblock/user?user={$item->guid}", true);?>"><?php echo ossn_print('user:unblock');?></a></li>
     <?php
			}
	}
	?>
</div>