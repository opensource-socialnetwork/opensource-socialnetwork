<?php	
	$cats = business_page_categories();	
?>
<div class="business-page-about">
  	<p>
	<?php 
		if(!isset($params['full'])){
			echo strl($params['page']->description, 250);
		} else {
			echo $params['page']->description;			
		}
	?>
    </p>
	<div class="margin-top-10">
	<li class="type d-flex"><i class="fa-solid fa-building"></i><span><?php echo $cats[$params['page']->category];?></span></li>
    <?php if(isset($params['page']->phone)){  ?>
		<li class="phone d-flex"><i class="fa fa-phone-square"></i><span><?php echo $params['page']->phone;?></span></li>
    <?php } ?>
    <?php if(isset($params['page']->address)){  ?>
		<li class="address d-flex"><i class="fa fa-location-arrow"></i><span><?php echo $params['page']->address;?></span></li>
    <?php } ?>   
     <?php if(isset($params['page']->email)){  ?>
		<li class="email d-flex"> <i class="fa-solid fa-envelope"></i><span><a href="mailto:<?php echo $params['page']->email; ?>"><?php echo $params['page']->email; ?> </a></span> </li>    
	<?php } ?>       
    <?php
	if(isset($params['page']->website)){  
				$urlw = false;
				  if(filter_var($params['page']->website, FILTER_VALIDATE_URL)){
							$urlw = $params['page']->website;
				} elseif(strpos($params['page']->website, ".") !== false){
							$urlp = parse_url($params['page']->website);
							$count = count($urlp);
							if(isset($urlp['path']) && !empty($urlp['path']) && $count === 1){
								$urlw = "http://{$urlp['path']}/";
						}
				 }
				 $parse = parse_url($urlw);
				 if(!empty($urlw)){	
	
	?>
		<li class="website d-flex"><i class="fa fa-globe"></i><span><a href="<?php echo $urlw;?>"><?php echo $parse['host'];?></a></span></li>
    <?php } 
	}?>    
    </div>
</div>