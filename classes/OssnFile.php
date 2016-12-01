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
class OssnFile extends OssnEntities {
		/**
		 * DeleteDir
		 * Delete the directories including files
		 *
		 * @param string $path path of directory
		 *
		 * @return boolean
		 */
		public static function DeleteDir($path) {
				if(is_dir($path)) {
						$files = array_diff(scandir($path), array(
								'.',
								'..'
						));
						foreach($files as $file) {
								if(is_dir("{$path}/{$file}")) {
										self::DeleteDir("{$path}/{$file}");
								} else {
										unlink("{$path}/{$file}");
								}
						}
				}
				return rmdir($path);
		}
		
		/**
		 * MaxSize
		 * Get server post max size
		 *
		 * @return float;
		 */
		public function MaxSize() {
				$val  = ini_get('post_max_size');
				$val  = trim($val);
				$last = strtolower($val[strlen($val) - 1]);
				switch($last) {
						case 'g':
								$val *= 1024;
						case 'm':
								$val *= 1024;
						case 'k':
								$val *= 1024;
				}
				return $val;
		}
		
		/**
		 * setFile
		 * Set a required file in memory
		 *
		 * @param string $name
		 * @return void
		 */
		public function setFile($name) {
				$this->showFileUploadError();
				if(isset($_FILES[$name]['type']) && ($_FILES[$name]['error'] == UPLOAD_ERR_OK && $_FILES[$name]['size'] !== 0)) {
						$file       = $_FILES[$name];
						$this->file = $file;
				}
		}
		
		/**
		 * Set a path for file where it need to upload
		 *
		 * @param string $path Path where file need to save
		 * @return void
		 */
		public function setPath($path) {
				$this->path = $path;
		}
		/**
		 * Get file extension from its name
		 *
		 * @param string $file Full file name
		 * @return string|false
		 */
		public function getFileExtension($file) {
				if(isset($file)) {
						$extension = pathinfo($file, PATHINFO_EXTENSION);
						if($extension) {
								return $extension;
						}
				}
				return false;
		}
		/**
		 * Allowed file extensions
		 * Validate file extension before save
		 *
		 * @return boolean
		 */
		public function allowedFileExtensions() {
				$types = array(
						'zip',
						'doc',
						'docx',
						'mp4',
						'mp3',
						'pdf',
						'zip',
						'jpg',
						'png',
						'gif',
						'jpeg'
				);
				return ossn_call_hook('file', 'allowed:extensions', null, $types);
		}
		/**
		 * getFileUploadError
		 * Print user friendly file upload error
		 *
		 * @param integer $code Error code 
		 *
		 * @return string
		 */
		public function getFileUploadError($code) {
				switch($code) {
						case UPLOAD_ERR_OK:
								return '';
						
						case UPLOAD_ERR_INI_SIZE:
								$key = 'ini_size';
								break;
						
						case UPLOAD_ERR_FORM_SIZE:
								$key = 'form_size';
								break;
						
						case UPLOAD_ERR_PARTIAL:
								$key = 'partial';
								break;
						
						case UPLOAD_ERR_NO_FILE:
								$key = 'no_file';
								break;
						
						case UPLOAD_ERR_NO_TMP_DIR:
								$key = 'no_tmp_dir';
								break;
						
						case UPLOAD_ERR_CANT_WRITE:
								$key = 'cant_write';
								break;
						
						case UPLOAD_ERR_EXTENSION:
								$key = 'extension';
								break;
						
						default:
								$key = 'unknown';
								break;
				}
				return ossn_print("upload:file:error:$key");
		}
		/**
		 * showFileUploadError
		 * Show file upload errors
		 *
		 * @return void
		 */
		public function showFileUploadError() {
				if(empty($this->redirect)) {
						$this->redirect = REF;
				}
				if(isset($this->file) && ($this->file['error'] !== UPLOAD_ERR_OK || $this->file['size'] == 0)) {
						ossn_trigger_message($this->getFileUploadError($this->file['error']), 'error');
						redirect($this->redirect);
				}
				
		}
		/**
		 * addFile
		 * Add file to database
		 *
		 * @param integer $object->owner_guid Guid of owner , the file belongs to
		 * @param string $object->type Owner type,
		 * @param string $object->subtype  file type
		 *
		 * @return boolean
		 */
		public function addFile() {
				if(isset($this->file) && !empty($this->file) && !empty($this->owner_guid) && !empty($this->subtype) && !empty($this->type)) {
						
						$this->extensions = $this->allowedFileExtensions();
						$this->extension  = $this->getFileExtension($this->file['name']);
						//change user file extension to lower case #153
						$this->extension  = strtolower($this->extension);
						
						if($this->typeAllowed()) {
								
								$this->newfilename = md5($this->file['name'] . rand() . time()) . '.' . $this->extension;
								$this->newfile     = $this->path . $this->newfilename;
								
								$this->dir = ossn_get_userdata("{$this->type}/{$this->owner_guid}/{$this->path}");
								if(!is_dir($this->dir)) {
										mkdir($this->dir, 0755, true);
								}
								
								$this->subtype = "file:{$this->subtype}";
								$this->value   = $this->newfile;
								
								if($this->add()) {
										$filecontents = file_get_contents($this->file['tmp_name']);
										if(preg_match('/image/i', $this->file['type'])) {
												//fix rotation #918
												$this->resetRotation($this->file['tmp_name']);
												
												//allow devs to change default size , see #528
												$image_res = array(
														'width' => 2048,
														'height' => 2048
												);
												$image_res = ossn_call_hook('file', 'image:resolution', $this, $image_res);
												
												//compress image before save
												$filecontents = ossn_resize_image($this->file['tmp_name'], $image_res['width'], $image_res['height']);
										}
										file_put_contents("{$this->dir}{$this->newfilename}", $filecontents);
										return $this->AddedEntityGuid();
								}
						}
				}
				return false;
		}
		/**
		 * getFiles
		 * Get owner files
		 *
		 * @param integer $object->owner_guid Guid of owner , the file belongs to
		 * @param string  $object->type Owner type
		 * @param string  $object->subtype File type
		 *
		 * @return object
		 */
		public function getFiles() {
				if(!empty($this->type) && !empty($this->owner_guid) && !empty($this->subtype)) {
						$this->filetype = "file:{$this->subtype}";
						$this->subtype  = preg_replace('/file:file:/i', 'file:', $this->filetype);
						$this->order_by = 'guid DESC';
						
						$files = $this->get_entities();
						if($files) {
								foreach($files as $file) {
										$file        = (array) $file;
										$datafiles[] = arrayObject($file, get_class($this));
								}
								return arrayObject($datafiles, get_class($this));
						}
				}
				return false;
		}
		
		/**
		 * Get file by id
		 *
		 * @param integer $object->file_id guid of file in database
		 * @param string  $object->type Owner type
		 * @param string  $object->subtype file type
		 *
		 * @note will be removed in v5. use getFile() instead
		 *
		 * @return object
		 */
		public function fetchFile() {
				$this->guid = $this->file_id;
				return $this->getFile();
		}
		/**
		 * Set required file extension
		 * 
		 * @param array $extension Uploaded file extension can be jpg, jpeg
		 *
		 * @return void
		 */
		public function setExtension(array $extension = array()) {
				$this->fileExtension = $extension;
		}
		/**
		 * Set required file mimetype
		 * If not set, it will try to match mimetype with pre-defined mime type
		 * 
		 * @param array $mimtypes Mimetypes that are allowed
		 *
		 * @return void
		 */
		public function setMimeTypes(array $mimtypes = array()) {
				$this->fileMimeTypes = $mimtypes;
		}
		/**
		 * Validate a uploaded file
		 * 
		 * Make sure the file extension match also check mimetype
		 *
		 * @return boolean
		 */
		public function typeAllowed() {
				if(!empty($this->file) && !empty($this->fileExtension)) {
						
						$this->extensions = $this->allowedFileExtensions();
						$this->extension  = $this->getFileExtension($this->file['name']);
						$this->extension  = strtolower($this->extension);
						if(in_array($this->extension, $this->fileExtension)) {
								$mimetypes = $this->mimeTypes();
								if(!empty($this->fileMimeTypes) && is_array($this->fileMimeTypes)) {
										$mimetypes = array();
										$mimetypes = $this->fileMimeTypes;
								}
								if(isset($mimetypes[$this->extension]) && in_array($this->file['type'], $mimetypes[$this->extension])) {
										return true;
								}
						}
				}
				return false;
		}
		/**
		 * moveFiles
		 * Move files from one directory to another
		 *
		 * @param string $from Complete directory path from where you want to move files.
		 * @param string $to  Complete directory path where you want to move files.
		 *
		 * @return boolean
		 */
		public static function moveFiles($from, $to) {
				if(!is_dir($from)) {
						return false;
				}
				if(!is_dir($to)) {
						mkdir($to, 0755, true);
				}
				if(!is_dir($to)) {
						return false;
				}
				$files = scandir($from);
				foreach($files as $fname) {
						if($fname != '.' && $fname != '..') {
								rename($from . $fname, $to . $fname);
						}
				}
				self::DeleteDir($from);
				return true;
		}
		/**
		 * MIME types.
		 *
		 * This function contains most commonly used MIME types in Ossn
		 * 
		 * You can find mimtypes on the url below:
		 * http://svn.apache.org/viewvc/httpd/httpd/trunk/docs/conf/mime.types?view=markup
		 *
		 * Extra mimetypes has been removed in Ossn v3.1. You can add a hook to extends mimetypes
		 *
		 * @return array 
		 */
		public static function mimeTypes() {
				$mimetypes = array(
						'doc' => array(
								'application/msword'
						),
						'docx' => array(
								'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
						),
						'gif' => array(
								'image/gif'
						),
						'jpeg' => array(
								'image/jpeg'
						),
						'jpg' => array(
								'image/jpeg'
						),
						'mp3' => array(
								'audio/mpeg'
						),
						'mp4' => array(
								'video/mp4'
						),
						'pdf' => array(
								'application/pdf'
						),
						'png' => array(
								'image/png'
						),
						'zip' => array(
								'application/zip'
						)
						
				);
				return ossn_call_hook('file', 'mimetypes', false, $mimetypes);
		}
		/**
		 * Get file
		 * 
		 * @return object
		 */
		public function getFile() {
				if(isset($this->guid)) {
						$this->entity_guid = $this->guid;
						$entity            = $this->get_entity();
						if($entity && substr($entity->subtype, 0, 5) == 'file:') {
								return $entity;
						}
				}
				return false;
		}
		
		/**
		 * Get a full file path in data root
		 *
		 * @return string
		 */
		public function getPath() {
				if(isset($this->guid)) {
						$path = ossn_get_userdata("{$this->type}/{$this->owner_guid}/{$this->value}");
						return $path;
				}
				return false;
		}
		/**
		 * Check if file exists or not
		 *
		 * @return boolean
		 */
		public function isFile() {
				if(isset($this->guid)) {
						$path = $this->getPath();
						return is_file($path);
				}
				return false;
		}
		/**
		 * Fix image rotation #981
		 * 
		 * @return void
		 */
		public function resetRotation($filename) {
				if(!is_file($filename)) {
						return false;
				}
				if(function_exists('exif_read_data')) {
						$exif = exif_read_data($filename);
						if($exif && isset($exif['Orientation'])) {
								$orientation = $exif['Orientation'];
								$rotate = false;
								if($orientation != 1) {
										$img = imagecreatefromjpeg($filename);
										switch($orientation) {
												case 3:
														$rotate = 180;
														break;
												case 6:
														$rotate = 270;
														break;
												case 8:
														$rotate = 90;
														break;
										}
										if($rotate) {
												$img = imagerotate($img, $rotate, 0);
												imagejpeg($img, $filename, 90);
										}
								}
						}
				}
		}
} //class
