    <div class="messages-inner">
    <?php
	  echo '<div class="ossn-notifications-all">';
      foreach($params['notifications'] as $not){
         echo $not;	
       }
      echo '</div>';
	  
	?>
    </div>
    <div class="bottom-all">
     <a href="#">See All</a>
    </div>