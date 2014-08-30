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

$css = bframework_css_link('all');
if (empty($page['title'])) {
        $title = bframework_get_app('name');
} 
else {
$title = bframework_get_app('name') . " : " . $page['title'];
}
$meta_attr = array(
'BframeworkVersion' => bframework_get_version(),
'BframeworkRelease' => bframework_get_release(),
'ApplicationVersion' => bframework_get_app_version(),
'ApplicationRelease' => bframework_get_app_release(),
);
header("Content-type: text/html; charset=UTF-8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php echo bframework_meta(array('attr' => array('http-equiv' => "Content-Type", 'content' => "text/html; charset=utf-8"))); 
foreach($meta_attr as $s => $v){
echo bframework_meta(array('attr' => array('name' => $s, 'content' => $v)));
}
?>
<title><?php echo $title; ?></title>
<?php echo bframework_inc_css($css);?>
<?php echo $page['head']; ?>
</head>
<body> 
<div class="ossn-header">
      <div class="inner">
         <div class="logo-installation"></div>
      </div>
   </div>
 <div style="margin:0 auto; width:1000px;">
         <div class="ossn-default">
                         <div class="ossn-top">
                                <table border="0">
                                        <tr>
                                   <td>&nbsp;</td>
                                     <td>     <div class="buddyexpresss-search-box inline" style="margin-top: -50px;"></div></td>
                                  </tr>
                                </table>

</div>
<div id="ossn-page-menubar">
		<li><a href="#"><?php echo bframework_print("ossn:installation");?></a></li><li> <a href="#"> > </a></li><li><a href="#"><?php echo $title; ?></a></li></li>
        
        </div>
</div>
<div>
         <?php echo $page['header'];?>
		 <div>
         <?php 
		 echo ossn_installation_messages();?>  
		 <?php echo $page['body'];?>
		 </div>
		 
         <div>
            <div class="ossn-installation-footer">
                 <?php echo 'POWERED <a href="http://opensource-socialnetwork.org">OPEN SOURCE SOCIAL NETWORK</a>'; ?>  
            </div>

    		 </div>
</body>

</html>