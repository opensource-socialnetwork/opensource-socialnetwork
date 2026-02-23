<?php
	if(!ossn_isLoggedin()){
		return;
	}
?>
<div class="sidebar">
      <div class="sidebar-contents">

           		 <?php
          			  if (ossn_is_hook('newsfeed', "sidebar:left")) {
                			$newsfeed_left = ossn_call_hook('newsfeed', "sidebar:left", NULL, array());
               				 echo implode('', $newsfeed_left);
            		}
           		 ?>                
      </div>
</div>