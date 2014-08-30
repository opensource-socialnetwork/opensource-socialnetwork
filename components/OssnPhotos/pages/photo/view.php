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
$album = new OssnAlbums;
$image = $params['entity'];

$name = $album->GetAlbum($image->owner_guid)->album->title;
$img = str_replace('album/photos/', '', $image->value);
?>
<div class="ossn-photo-view">
   <h2> <?php echo $name;?></h2>
    <a href="#"> <?php echo ossn_print('back:to:album');?>  </a>
    <br />
   <table border="0" class="ossn-photo-viewer">
  <tr>
    <td class="image-block" style="text-align: center;width:465px;min-height:200px;">  
    <img src="<?php echo ossn_site_url("album/getphoto/").$image->owner_guid;?>/<?php echo $img;?>?size=view"  />
</td>
  </tr>
</table>

</div>
<br />
<br />
<div class="comments-likes" style="width:525px;">
    <?php
	 if(ossn_is_hook('post', 'likes:entity')){
	  $entity['entity_guid'] = $params['photo'];
	 echo ossn_call_hook('post', 'likes:entity', $entity); 
     }
	?>   
     <?php 
    if(ossn_is_hook('post', 'comments:entity')){
	  $entity['entity_guid'] = $params['photo'];
	 echo ossn_call_hook('post', 'comments:entity', $entity); 
     }
	?>
</div>