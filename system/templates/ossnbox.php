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
if(!isset($params['button'])){
 $params['button'] = 'Save';	
}
?>
  <div class="title">
     <?php echo $params['title'];?>
     <div class="close-box" onclick="Ossn.MessageBoxClose();">X</div>
  </div>
  <div class="contents">
   <div style="width:446px;">
      <div style="width:100%;margin:auto;">
    <?php echo $params['contents'];?>
       </div>
    </div>
  </div>
  <?php if($params['control'] !== false){ ?>
        <div class="control">
    <div class="controls">
     <?php if($params['callback'] !== false){ ?>
      <a href="javascript::;" onclick="Ossn.Clk('<?php echo $params['callback'];?>');" class='button-blue-light'><?php echo $params['button'];?></a> 
     <?php } ?> 
      <a href="javascript::;" onclick="Ossn.MessageBoxClose();" class='button-grey-light'>Cancel</a> 
    </div> 
  </div>

  <?php } ?>