<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnComments extends OssnAnnotation {
		/**
		 * Get a comment type from object
		 *
		 * @return string;
		 */
		public static function getType($object) {
				$type = array(
						"comments:post" => 'post',
						"comments:entity" => 'entity'
				);
				return $type[$object];
		}
		
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
		public function PostComment($subject_id, $guid, $comment, $type = 'post') {
				if(empty($subject_id) || empty($guid)) {
						return false;
				}
				$cancomment = false;
				if(!empty($comment)) {
						$cancomment = true;
				}
				if(!empty($this->comment_image)) {
						$cancomment = true;
				}
				$this->subject_guid = $subject_id;
				$this->owner_guid   = $guid;
				$this->type         = "comments:{$type}";
				$this->value        = $comment;
				if($cancomment && $this->addAnnotation()) {
						if(isset($this->comment_image)) {
								$image                = base64_decode($this->comment_image);
								$file                 = ossn_string_decrypt(base64_decode($image));
								$file_path            = rtrim(ossn_validate_filepath($file), '/');
								$_FILES['attachment'] = array(
										'name' => $file_path,
										'tmp_name' => $file_path,
										'type' => 'image/jpeg',
										'size' => filesize($file_path),
										'error' => UPLOAD_ERR_OK
								);
								$file                 = new OssnFile;
								$file->type           = 'annotation';
								$file->subtype        = 'comment:photo';
								$file->setFile('attachment');
								$file->setPath('comment/photo/');
								$file->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'gif'
								));
								$file->owner_guid = $this->getAnnotationId();
								if($file->owner_guid !== 0) {
										$file->addFile();
										unlink($file_path);
										unset($_FILES['attachment']);
								}
						}
						$params                 = array();
						$params['id']           = $this->getAnnotationId();
						$params['value']        = $comment;
						$params['subject_guid'] = $subject_id;
						$params['owner_guid']   = $owner_guid;
						ossn_trigger_callback('comment', 'created', $params);
						return $this->getAnnotationId();
				}
				return false;
		}
		
		/**
		 * Get Comment
		 *
		 * @params $id: Comment Id
		 *
		 * @return object;
		 */
		public function GetComment($id) {
				if(empty($id)){
					return false;
				}
				$res_array = $this->searchAnnotation(array(
						'annotation_id' => $id,
						'offset' => input('comments_offset', '', 1),
				));
				return $res_array[0];
		}
		
		/**
		 * Count Total Comments on Subject
		 *
		 * @params $subject_id: Subject id
		 *         $type: Comments type
		 *
		 * @return int;
		 */
		public function countComments($subject_id, $type = 'post') {
				$this->subject_guid = $subject_id;
				$this->type         = "comments:{$type}";
				$this->count        = true;
				$this->order_by     = 'a.id ASC';
				$comments           = $this->getAnnotationBySubject();
				if(!empty($comments)) {
						return $comments;
				}
		}
		
		/**
		 * Get Comments
		 *
		 * @params $subject_id: Id of item on which users comment
		 *         $type: Post or Entity
		 *
		 * @return object;
		 */
		public function GetComments($subject, $type = 'post') {
				$vars                 = array();
				$vars['subject_guid'] = $subject;
				$vars['type']         = "comments:{$type}";
				$vars['order_by']     = 'a.id DESC';
				$vars['limit']        = $this->limit;
				if(!isset($this->page_limit) || $this->page_limit === false) {
					$vars['page_limit'] = false;
				}
				else {
					$vars['page_limit'] = $this->page_limit;
				}
				$comments = $this->searchAnnotation($vars);
				if(!empty($comments)) {
						return array_reverse($comments);
				}
		}
		
		/**
		 * Delete All Comments by Subject id
		 *
		 * @params $subject: Subject id
		 *
		 * @return bool
		 */
		public function commentsDeleteAll($subject, $type = 'comments:post') {
				if($this->annon_delete_by_subject($subject, $type)) {
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
		public function deleteComment($comment) {
				if($this->deleteAnnotation($comment)) {
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
		public function getCommentId() {
				return $this->getAnnotationId();
		}
		
} //class
