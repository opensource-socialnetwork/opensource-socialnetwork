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
class OssnComments extends OssnAnnotation {
   /**
	* Post Comment
	*
	* @params $subject_id: Id of item on which user comment
	*         $guid: User id
	*         $comment: Comment
	*         $type: Post or Entity
	*
	* @return bool;
	*/	
	public function PostComment($subject_id, $guid, $comment, $type = 'post'){
        $this->subject_guid = $subject_id;
        $this->owner_guid = $guid;
        $this->type = "comments:{$type}";
        $this->value = $comment;
        if($this->addAnnotation()){
            return true;
		}
        return false; 
	}
   /**
	* Get Comments
	*
	* @params $subject_id: Id of item on which users comment
	*         $type: Post or Entity
	*
	* @return object;
	*/		
    public function GetComments($subject, $type = 'post'){
        $this->subject_guid = $subject;
        $this->type = "comments:{$type}";
		$this->order_by = 'id ASC';
        $comments = $this->getAnnotationBySubject();
        if(!empty($comments)){
            return $comments;
		}
	}
   /**
	* Get Comment
	*
	* @params $id: Comment Id
	*
	* @return object;
	*/	
	public function GetComment($id){
	  $this->annotation_id = $id;
	  return $this->getAnnotationById();
	}
   /**
	* Count Total Comments on Subject
	*
	* @params $subject_id: Subject id
	*         $type: Comments type
	*
	* @return int;
	*/		
	public function countComments($subject_id, $type = 'post'){
		return count(get_object_vars($this->GetComments($subject_id, $type)));
	}
   /**
	* Delete All Comments by Subject id
	*
	* @params $subject: Subject id
	*
	* @return bool
	*/			
	public function commentsDeleteAll($subject){
	   if($this->annon_delete_by_subject($subject, 'comments:post')){
		 return true;   
	   }
	 return false;  
	}
   /**
	* Delete Comment
	*
	* @params $comment: Comment id
	*
	* @return bool
	*/			
	public function deleteComment($comment){
	   if($this->deleteAnnotation($comment)){
		  $params['comment'] = $comment;
		  ossn_trigger_callback('comment', 'delete', $params);
		  return true;   
	   }
	   return false;
	}
   /**
	* Get newly created comment id
	*
	* @return int
	*/		
	public function getCommentId(){
	  return $this->getAnnotationId();	
	}
	
	/** 
	* Get a comment type from object
	*
	* @return string;
	*/
	public static function getType($object){
	   $type = array(
	          "comments:post" => 'post',
			  "comments:entity" => 'entity'
			  );
	   return $type[$object];
	}

}//class