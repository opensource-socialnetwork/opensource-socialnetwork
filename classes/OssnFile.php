<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
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
		public static function DeleteDir($path): bool {
				if(is_dir($path)) {
						$files = array_diff(scandir($path), array(
								'.',
								'..',
						));
						foreach($files as $file) {
								if(is_dir("{$path}/{$file}")) {
										self::DeleteDir("{$path}/{$file}");
								} else {
										unlink("{$path}/{$file}");
								}
						}
						return rmdir($path);
				}
				return false;
		}
		/**
		 * MaxSize
		 * Get server post max size size in bytes
		 *
		 * @return integer
		 */
		public function MaxSize(): int{
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
		 * UploadMaxSize
		 * Get server upload max size in bytes
		 * [E] Ossn::File MaxSize() add UploadMaxSize #2148
		 *
		 * @return integer
		 */
		public function getUploadMaxSize(): int{
				$val  = min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
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
		public function setFile($name): void {
				$this->showFileUploadError();
				//[E] Unknown offset on OssnFile #2240
				if(isset($_FILES[$name])) {
						if(isset($_FILES[$name]['type']) && ($_FILES[$name]['error'] == UPLOAD_ERR_OK && $_FILES[$name]['size'] !== 0)) {
								$file       = $_FILES[$name];
								$this->file = $file;
						} else {
								if(!$_FILES[$name]['error'] && $_FILES[$name]['size'] == 0) {
										$this->error = UPLOAD_ERR_EXTENSION;
								} else {
										$this->error = $_FILES[$name]['error'];
								}
						}
				}
		}

		/**
		 * Set a path for file where it need to upload
		 *
		 * @param string $path Path where file need to save
		 * @return void
		 */
		public function setPath($path): void {
				$this->path = $path;
		}
		/**
		 * Get file extension from its name
		 *
		 * @param string $file Full file name
		 * @return string|false
		 */
		public function getFileExtension($file): string | bool {
				if(isset($file)) {
						$extension = pathinfo($file, PATHINFO_EXTENSION);
						if($extension) {
								return strtolower($extension);
						}
				}
				return false;
		}
		/**
		 * Allowed file extensions
		 * Validate file extension before save
		 *
		 * @return array|null
		 */
		public function allowedFileExtensions(): array | null{
				//why hardcoded again?
				//[B] problem with extending allowed file types #2407
				//we can take keys from mimetypes
				$types = array_keys($this->mimeTypes());
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
		public function getFileUploadError($code): string {
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
		public function showFileUploadError(): void {
				if(empty($this->redirect)) {
						$this->redirect = REF;
				}
				//post size error
				//post_size < upload max size
				if(!empty($_SERVER['CONTENT_LENGTH']) && empty($_POST)){
						$this->error = UPLOAD_ERR_FORM_SIZE;
				}
				if(isset($this->file) && ($this->file['error'] !== UPLOAD_ERR_OK || $this->file['size'] == 0)) {
						ossn_trigger_message($this->getFileUploadError($this->file['error']), 'error');
						redirect($this->redirect);
				}
		}
		/**
		 * Set upload type
		 *
		 * @param string $type Type local/cdn
		 *
		 * @return void
		 */
		public function setStore(string $type = 'local'): void {
				if(($type != 'local' && $type != 'cdn') || empty($type)) {
						$type = 'local';
				}
				$this->file_store_type = $type;
		}
		/**
		 * Get store type
		 *
		 * @return string|bool
		 */
		public function getStore(): string | bool {
				if(isset($this->file_store_type)) {
						return $this->file_store_type;
				}
				return false;
		}
		/**
		 * setImageDim
		 * Set Image Resolution
		 *
		 * @param int    $maxwidth The desired width of the resized image
		 * @param int    $maxheight The desired height of the resized image
		 * @param bool   $square If it is true it will return a croped image based on w&h
		 *
		 * @return void
		 */
		public function setImageDim(int $width, int $height, bool $square = false): void {
				$this->image_config           = array();
				$this->image_config['width']  = $width;
				$this->image_config['height'] = $height;
				$this->image_config['square'] = $square;
		}
		/**
		 * Get Image settings

		 * @return boolean|array
		 */
		public function getImageDim(): array | bool {
				if((isset($this->image_config) && !empty($this->image_config['width'])) || !empty($this->image_config['height'])) {
						return $this->image_config;
				}
				return false;
		}
		/**
		 * Write a manifest file for CDN based files
		 *
		 * This contains the extra attributes like url, procider etc
		 *
		 * @param string $directory Directory Name
		 * @param string $filename File name
		 * @param array  $addedToCDN A data that need to be added to file
		 *
		 * @return boolean
		 */
		public function writeManifest($directory, $filename, array $addedToCDN): bool {
				if(is_dir($directory) && !empty($filename)) {
						unset($addedToCDN['success']);
						$manifest = json_encode($addedToCDN, JSON_PRETTY_PRINT);
						return file_put_contents($directory . $filename . '.cdn.manifest', $manifest);
				}
				return false;
		}
		/**
		 * addFile
		 * Add file to database
		 *
		 * @param integer $object->owner_guid Guid of owner , the file belongs to
		 * @param string $object->type Owner type,
		 * @param string $object->subtype  file type
		 *
		 * @return integer|boolean
		 */
		public function addFile(): int | bool {
				if(isset($this->file) && !empty($this->file) && !empty($this->owner_guid) && !empty($this->subtype) && !empty($this->type)) {
						$this->extensions = $this->allowedFileExtensions();
						$this->extension  = $this->getFileExtension($this->file['name']);
						//change user file extension to lower case #153
						$this->extension = strtolower($this->extension);

						if($this->typeAllowed()) {
								$this->newfilename = md5($this->file['name'] . bin2hex(random_bytes(5)) . time()) . '.' . $this->extension;
								$this->newfile     = $this->path . $this->newfilename;

								$dir_local_path = "{$this->type}/{$this->owner_guid}/{$this->path}";
								$this->dir      = ossn_get_userdata($dir_local_path);
								if(!is_dir($this->dir)) {
										mkdir($this->dir, 0755, true);
								}

								$this->subtype = "file:{$this->subtype}";
								$this->value   = $this->newfile;

								$storeType = $this->getStore();
								if(!$storeType) {
										$storeType = 'local';
								}
								if($storeType == 'cdn') {
										$this->value = "{$this->path}{$this->newfilename}.cdn.manifest";
								}
								if($storeType == 'cdn' && !ossn_is_hook('file', 'upload:cdn')) {
										//cdn exists but no hook
										return false;
								}
								$sizecheck = filesize($this->file['tmp_name']);
								//[E] Disallow to upload empty files #1976
								//Simpy check before adding
								if(!$sizecheck || ($sizecheck && empty($sizecheck))) {
										return false;
								}
								if($fileguid = $this->add()) {
										if($storeType == 'cdn') {
												$cdnOptions = array(
														'file'           => $this->file,
														'fileguid'       => $fileguid,
														'newfilename'    => $this->newfilename,
														'dir_local_path' => $dir_local_path,
														'physicalFile'   => true,
												);
												if(preg_match('/image/i', $this->file['type'])) {
														$cdnOptions['physicalFile'] = false;
														$cdnOptions['contents']     = $this->imageResize();
												}

												$addedToCDN = ossn_call_hook('file', 'upload:cdn', $cdnOptions, false);
												if(is_array($addedToCDN) && isset($addedToCDN['success'])) {
														$this->writeManifest($this->dir . '/', $this->newfilename, $addedToCDN);
														return $fileguid;
												}
										}
										if(preg_match('/image/i', $this->file['type'])) {
												$filecontents = $this->imageResize();
												file_put_contents("{$this->dir}{$this->newfilename}", $filecontents);
												return $fileguid;
										} elseif(copy($this->file['tmp_name'], "{$this->dir}{$this->newfilename}")) {
												return $fileguid;
										}
								}
						} else {
								$this->error = UPLOAD_ERR_EXTENSION;
						}
				}
				return false;
		}
		/**
		 * Resize images before adding to filestore
		 *
		 * @return mixed
		 */
		private function imageResize(): mixed {
				if(preg_match('/image/i', $this->file['type'])) {
						//fix rotation #918
						//[E] exif_read_data only for jpeg #1999
						if($this->file['type'] == 'image/jpeg') {
								$this->resetRotation($this->file['tmp_name']);
						}
						//Get Image upload settings
						$imageConfig = $this->getImageDim();
						if(!$imageConfig) {
								$this->setImageDim(1500, 1500, false); //w/h/s
								//get new settings
								$imageConfig = $this->getImageDim();
						}
						//allow devs to change default size , see #528
						$image_res = array(
								'width'  => $imageConfig['width'],
								'height' => $imageConfig['height'],
								'square' => $imageConfig['square'],
						);

						$image_res                  = ossn_call_hook('file', 'image:resolution', $this, $image_res);
						$cdnOptions['physicalFile'] = false;
						//compress image before save
						return ossn_resize_image($this->file['tmp_name'], $image_res['width'], $image_res['height'], $imageConfig['square']);
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
		 * getFiles
		 *
		 * @param string $params['subtype'] File type
		 * @param string $params['type'] user/object/message etc
		 * @param string $params['page_limit'] Files per page
		 * @param string $params['count'] true if you want to count only
		 *
		 * @return array|bool
		 */
		public function searchFiles(array $params = array()): array | bool | int {
				if(!isset($params['guid']) && !empty($params['guid'])) {
						if(!isset($params['subtype']) || empty($params['subtype'])) {
								return false;
						}
				}
				if(isset($params['subtype'])) {
						$params['subtype'] = "file:{$params['subtype']}";
				}
				$files = $this->searchEntities($params);
				if(isset($params['count']) && $params['count'] == true) {
						return $files;
				}
				if($files) {
						$result = array();
						foreach($files as $file) {
								$result[] = arrayObject($file, get_class($this));
						}
						return $result;
				}
				return false;
		}
		/**
		 * Set required file extension
		 *
		 * @param array $extension Uploaded file extension can be jpg, jpeg
		 *
		 * @return void
		 */
		public function setExtension(array $extension = array()): void {
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
		public function setMimeTypes(array $mimtypes = array()): void {
				$this->fileMimeTypes = $mimtypes;
		}
		/**
		 * Validate a uploaded file
		 *
		 * Make sure the file extension match also check mimetype
		 *
		 * @return boolean
		 */
		public function typeAllowed(): bool {
				if(!empty($this->file)) {
						$this->extensions = $this->allowedFileExtensions();
						$this->extension  = $this->getFileExtension($this->file['name']);
						$this->extension  = strtolower($this->extension);
						
						//[B] problem with extending allowed file types #2407
						if((isset($this->fileExtension) && in_array($this->extension, $this->fileExtension)) || (!isset($this->fileExtension) && in_array($this->extension, $this->extensions))) {
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
		public static function moveFiles($from, $to): bool {
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
								if(is_dir($from . $fname)) {
										self::moveFiles($from . $fname . DIRECTORY_SEPARATOR, $to . $fname . DIRECTORY_SEPARATOR);
								} elseif(is_file($from . $fname)) {
										rename($from . $fname, $to . $fname);
								}
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
		 * @return array|null
		 */
		public static function mimeTypes(): array | null{
				$mimetypes = array(
						'doc'  => array(
								'application/msword',
						),
						'docx' => array(
								'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						),
						'gif'  => array(
								'image/gif',
						),
						'jpeg' => array(
								'image/jpeg',
						),
						'jfif' => array(
								'image/jpeg',
						),
						'jpg'  => array(
								'image/jpeg',
						),
						'mp3'  => array(
								'audio/mpeg',
						),
						'mp4'  => array(
								'video/mp4',
						),
						'pdf'  => array(
								'application/pdf',
						),
						'png'  => array(
								'image/png',
						),
						'zip'  => array(
								'application/zip',
								'application/x-zip-compressed',
						),
						'webp' => array(
								'image/webp',
						),
				);
				return ossn_call_hook('file', 'mimetypes', false, $mimetypes);
		}
		/**
		 * Get a file
		 *
		 * @return boolean|object
		 */
		public function getFile(): object | bool {
				if(isset($this->guid)) {
						$file = $this->searchFiles(array(
								'guid' => $this->guid,
						));
						if($file && substr($file[0]->subtype, 0, 5) == 'file:') {
								return $file[0];
						}
				}
				return false;
		}
		/**
		 * Check if the file is CDN
		 *
		 * @return bool
		 */
		public function isCDN(): bool {
				if(str_ends_with($this->value, 'cdn.manifest')) {
						return true;
				}
				return false;
		}
		/**
		 * Get Manifest for CDN file
		 *
		 * @return array|bool
		 */
		public function getManifest(): array | bool {
				$path = $this->getPath();
				if(is_file($path)) {
						$file = file_get_contents($path);
						return json_decode($file, true);
				}
				return false;
		}
		/**
		 * Get a full file path in data root
		 *
		 * @return boolean|string
		 */
		public function getPath(): string | bool {
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
		public function isFile(): bool {
				if(isset($this->guid)) {
						$path = $this->getPath();
						return is_file($path);
				}
				return false;
		}
		/**
		 * Delete file
		 *
		 * @return boolean
		 */
		public function deleteFile(): bool {
				if(isset($this->guid)) {
						$path     = $this->getPath();
						$callback = array(
								'file' => $this,
						);
						ossn_trigger_callback('file', 'before:delete', $callback);

						if($this->deleteEntity() && $this->isFile()) {
								if(unlink($path)) {
										ossn_trigger_callback('file', 'deleted', $callback);
										return true;
								}
						}
				}
				return false;
		}
		/**
		 * Fix image rotation #981
		 *
		 * @return void
		 */
		public function resetRotation($filename): void {
				if(!is_file($filename)) {
						return;
				}
				if(function_exists('exif_read_data')) {
						$exif = exif_read_data($filename);
						if($exif && isset($exif['Orientation'])) {
								$orientation = $exif['Orientation'];
								$rotate      = false;
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
		/**
		 * Output the file to the browser
		 *
		 * @param string $Mime Mime type
		 *
		 * @return void
		 */
		public function output(string $Mime = ''): void {
				if($this->isFile()) {
						if($this->isCDN()) {
								$manifest = $this->getManifest();
								ob_flush();
								header('Cache-Control: max-age=86400'); //24 hours
								header('HTTP/1.1 301 Moved Permanently');
								header("Location: {$manifest['fullurl']}");
								exit();
						}
						$etag = $this->guid . $this->time_created;

						if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
								header('HTTP/1.1 304 Not Modified');
								exit();
						}

						$file      = $this->getPath();
						$filesize  = filesize($file);
						$type      = $this->getFileExtension($file);
						$MimeTypes = $this->mimeTypes();
						
						//[B] OssnFile:output doesn't recognize setMimeTypes by component #2331
						//restricted by component
						if(isset($this->fileMimeTypes) && is_array($this->fileMimeTypes)){
							$MimeTypes = $this->fileMimeTypes;
						}
						//not getting actual mimetype getting by extension type to avoid any vulnerability.
						if(isset($MimeTypes[$type][0])) {
								$MimeType = $MimeTypes[$type][0];
								if(isset($Mime) && !empty($Mime)) {
										$MimeType = $Mime;
								}
								//[E] Session locking issue #2343
								session_write_close();
								ob_flush();
								header("Content-type: {$MimeType}");
								header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime('+6 months')), true);
								header('Pragma: public');
								header('Cache-Control: public');
								header("Content-Length: {$filesize}");
								header('Last-Modified: ' . gmdate('D, d M Y H:i:s \G\M\T', $this->time_created));
								header("ETag: \"$etag\"");
								readfile($file);
						}
				}
		}
} //class