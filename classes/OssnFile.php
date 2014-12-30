<?php

/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnFile extends OssnEntities {
    /**
     * DeleteDir
     * Delete the directories including files
     *
     * @param (path)  path of directory
     *
     * @return void (void)
     */
    public static function DeleteDir($path) {
        if (is_dir($path)) {
			$files = array_diff(scandir($path), array('.', '..'));
			foreach ($files as $file) {
				if (is_dir("{$path}/{$file}")) {
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
        $val = ini_get('post_max_size');
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
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
     * @param (name) Name of file
     * @return void;
     */
    public function setFile($name) {
		$this->showFileUploadError();
		if (isset($_FILES[$name]['type'])) {
            $file = $_FILES[$name];
            $this->file = $file;
        }
    }

    /**
     * Set a path for file where it need to upload
     *
     * @param (path) Path where file need to save
     * @return void;
     */
    public function setPath($path) {
        $this->path = $path;
    }
    /**
     * Get file extension from its name
     *
     * @param string $file Full file name
     * @return string;
     */	
	public function getFileExtension($file){
		if(isset($file)){
			$extension = pathinfo($file, PATHINFO_EXTENSION);
			if($extension){
				return $extension;
			}
		}
		return false;
	}
    /**
     * Allowed file extensions
     * Validate file extension before save
     *
     * @return (bool)
     */
	 public function allowedFileExtensions(){
		 $types = array(
           			 'zip', 'doc', 'docx', 'mp4', 'mp3', 'pdf', 'zip', 'jpg', 'png', 'gif', 'jpeg',	
					);
		 return ossn_call_hook('file', 'allowed:extensions', null, $types);
	 }
    /**
	 * getFileUploadError
     * Print user friendly file upload error
     *
	 * @param (int) $code Error code 
	 *
     * @return string
     */	 
	 public function getFileUploadError($code){
			switch ($code) {
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
     * @param    string $this->redirect Custom url for redirect
     * @param    string $this->context site or admin
     *
     * @return void
     */	 
	 public function showFileUploadError(){
		if(empty($this->redirect)){
			$this->redirect = REF;
		}
		if(isset($this->file) && $this->file['error'] !== UPLOAD_ERR_OK){
			ossn_trigger_message($this->getFileUploadError($this->file['error']), 'error');
            redirect($this->redirect);	
		}
		 
	 }
	/**
     * addFile
     * Add file to database
     *
     * @param    (object)->owner_guid  guid of owner , the file belongs to
     * @param    (object)->type  owner type,
     * @param    (object)->subtype  file type
     *
     * @return (bool)
     */
    public function addFile() {
        if (isset($this->file) && !empty($this->file) && !empty($this->owner_guid) 
			&& !empty($this->subtype) && !empty($this->type)) {
			
		$this->extensions = $this->allowedFileExtensions();
		$this->extension = $this->getFileExtension($this->file['name']);
		//change user file extension to lower case #153
		$this->extension  = strtolower($this->extension);
		
        if(in_array($this->extension, $this->extensions)){
			
			$this->newfilename = md5($this->file['name'] . rand() . time()) . '.' . $this->extension;
        	$this->newfile = $this->path . $this->newfilename;
			
        	$this->dir = ossn_get_userdata("{$this->type}/{$this->owner_guid}/{$this->path}");
        	if (!is_dir(ossn_get_userdata($this->dir))) {
         			mkdir($this->dir, 0755, true);
        	}

       		$this->subtype = "file:{$this->subtype}";
        	$this->value = $this->newfile;
			
        	if ($this->add()) {
				 $filecontents = file_get_contents($this->file['tmp_name']);
				 if (preg_match('/image/i', $this->file['type'])) {
					 //compress image before save
					$filecontents =  ossn_resize_image($this->file['tmp_name'], 2048, 2048);
				 }
           		 file_put_contents("{$this->dir}{$this->newfilename}", $filecontents);
            	 return true;
        	}
		}
		}
		return false;
    }
	
    /**
     * MimeTypeImages
     * Get Image MimeTypes
     *
     * @return array (array);
     */
    private function MimeTypeImages() {
        return array(
            'image/jpeg' => 'jpeg',
            'image/pjpeg' => 'jpeg',
            'image/png' => 'png',
            'image/x-png' => 'png',
            'image/gif' => 'gif'
        );
    } 
    /**
     * getFiles
     * Get owner files
     *
     * @param   (object)->owner_guid  guid of owner , the file belongs to
     * @param   (object)->type  owner type
     * @param   (object)->subtype  file type
     *
     * @return (object)
     */
    public function getFiles() {
        if (!empty($this->type) && !empty($this->owner_guid) && !empty($this->subtype)) {
            $this->filetype = "file:{$this->subtype}";
            $this->subtype = preg_replace('/file:file:/i', 'file:', $this->filetype);
            $this->order_by = 'guid DESC';
            return arrayObject($this->get_entities(), get_class($this));
        }
    }

    /**
     * Get file by id
     *
     * @param  (object)->file_id id of file in database
     * @param   (object)->type  owner type
     * @param   (object)->subtype file type
     *
     * @return (object)
     */
    public function fetchFile() {
        $this->entity_guid = $this->file_id;
        $file = $this->get_entity();
        return $file;
    }

}//class
