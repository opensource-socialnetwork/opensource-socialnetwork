<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */	
 $postcontrols = $params['menu'];	
?>
         <div class="ossn-wall-post-controls" onclick="Ossn.PostMenu(this);"> 
          <div class="drop-down-arrow"></div>
          <div class="post-menu">
            <div class="menu-links" >
                <?php  foreach($postcontrols as $menu){
					         foreach($menu as $text => $link){
							  $link = ossn_args($link);
							  ?>
                               <li> <a <?php echo $link;?>><?php echo $text;?></a></li>
               <?php         }
				}?>
             </div>
          </div>
         
         </div>