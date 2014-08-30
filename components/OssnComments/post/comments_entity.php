<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
$object = $params['entity_guid'];

$OssnComments = new OssnComments;
$OssnLikes = new OssnLikes;

$comments  = $OssnComments->GetComments($object, 'entity');
if(is_object($comments)){
     echo "<div class='ossn-comments-list-{$object}'>";
     $count = 0;
     foreach($comments as $comment){  
          if($count <= 5){
             $data['comment'] = get_object_vars($comment);
             echo ossn_view('components/OssnComments/templates/comment', $data);
           }
           $count++;
     }
     echo '</div>';
}
echo  '<div class="poster-image">';
echo '<img src="'.ossn_site_url().'avatar/'.ossn_loggedin_user()->username.'/smaller" />';
echo   '</div>';
echo  '<script>  Ossn.EntityComment('.$object.'); </script>';
echo ossn_view_form('entity/comment_add', array(
							   'action' => ossn_site_url().'action/post/comment',
							   'component' => 'OssnComments',
							   'id' => "comment-container-{$object}", 
							   'class' => 'comment-container',
							   'autocomplete' => 'off',
							   'params' => array('object' => $object)
							    ), false);


