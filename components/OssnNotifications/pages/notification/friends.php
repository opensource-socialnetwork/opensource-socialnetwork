    <div class="messages-inner">
    <div class="notification-friends">
    <?php
      foreach($params['friends'] as $users){
	    $baseurl = ossn_site_url();
		$url = $baseurl.'u/'.$users->username;
		$img = "<img src='{$baseurl}/avatar/{$users->username}/small' />";
		$messages[] = "<li id='notification-friend-item-{$users->guid}'>
		              <div class='ossn-notifications-friends-inner'>
		                <div class='image'>{$img}</div> 
		                <div class='notfi-meta'>
		                
						<a href='{$url}' class='user'>{$users->fullname}</a>
						  <div style='float:right;' id='ossn-nfriends-{$users->guid}'>
						  <script>
						  Ossn.AddFriend($users->guid); 
						  Ossn.removeFriendRequset($users->guid);
						  </script>
						  <form id='add-friend-{$users->guid}'>
                           <input class='button-blue-light' type='submit' value='Confirm' />
						   </form>
						   	<form id='remove-friend-{$users->guid}'>
						   <input class='button-grey-light' type='submit' value='Cancel' />
						   </form>

                           </div>
  
						</div>
						</div>
						</li>";	
	  }
	  echo implode('', $messages);
	?>
    </div>
    </div>
    <div class="bottom-all">
     <a href="#">See All</a>
    </div>