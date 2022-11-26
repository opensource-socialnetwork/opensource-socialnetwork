<nav class="navbar navbar-expand-lg navbar-default navbar-admin-second" role="navigation">
    <div class="container">
   			 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" >
     			 <i class="fa fa-bars"></i>
   			 </button>
        		<div class="collapse navbar-collapse" id="navbarNav">
            		<ul class="nav navbar-nav">
            			<?php
							foreach ($params['menu'] as $key => $links) {
   								 if (count($links) > 1) {
      								  $menu_parent = '<li class="nav-item dropdown">
									  <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">'
									  	. ossn_print($key) . 
									   '</a>
									  <ul class="dropdown-menu multi-level">';
       									foreach ($links as $item) {
												 $class = "menu-topbar-admin-" . $item['name']; 
												 if(isset($item['class'])) { 
												 		$item['class'] = $class . ' ' . $item['class']; 
												  } else { 
												  		$item['class'] = $class; 
												  } 
												 unset($item['name']);
												 unset($item['parent']);
												 $item['class'] = 'dropdown-item '.$item['class'];
												 $link = ossn_plugin_view('output/url', $item);
           										 $menu_parent .= '<li>'.$link.'</li>';
        								}
      									$menu_parent .= '</ul></li>';
        								echo $menu_parent;
    							 } else {

      							 	foreach ($links as $item) {
										$class = "menu-topbar-admin-" . $item['name']; 
										if(isset($item['class'])) { 
												 $item['class'] = $class . ' ' . $item['class']; 
										} else { 
												  $item['class'] = $class; 
										} 
										unset($item['name']);										
										$item['class'] = 'nav-link '.$item['class'];
										$link = ossn_plugin_view('output/url', $item);										
            							$menu = '<li class="nav-item">'.$link.'</li>';
        						 	}
        						 	echo $menu;
    					 	 	}
							}
						?>
            		</ul>
            		<ul class="nav navbar-nav ms-auto">
						 <?php echo ossn_view_admin_sidemenu(); ?>
           		 	</ul>                    
        		</div>
    		</div>
</nav>
