<div class="navbar navbar-default navbar-admin-second" role="navigation">
    <div class="container">
   		<div class="row">
    		<div class="col-12">
            	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
               		<span class="sr-only">Toggle navigation</span>
               		<span class="icon-bar"></span>
               		<span class="icon-bar"></span>
              		<span class="icon-bar"></span>
           		 </button>
        		<div class="collapse navbar-collapse" id="navigationbar">
            		<ul class="nav navbar-nav navbar-right">
						 <?php echo ossn_view_admin_sidemenu(); ?>
           		 	</ul>
            		<ul class="nav navbar-nav">
            			<?php
							foreach ($params['menu'] as $key => $links) {
   								 if (count($links) > 1) {
									  unset($links[0]);
      								  $menu_parent = '<li>
									  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'
									  	. ossn_print($key) . 
									   '<i class="fa fa-sort-desc"></i></a>
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
												 $item['text'] = ossn_print($item['text']);
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
										$item['text'] = ossn_print($item['text']);
										$link = ossn_plugin_view('output/url', $item);										
            							$menu = '<li>'.$link.'</li>';
        						 	}
        						 	echo $menu;
    					 	 	}
							}
						?>
            		</ul>
        		</div>
    		</div>
    	</div>
    </div>
</div>