<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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
				if(isset($_FILES[$name]['type'])) {
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
				if(isset($this->file) && $this->file['error'] !== UPLOAD_ERR_OK) {
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
								if(!is_dir(ossn_get_userdata($this->dir))) {
										mkdir($this->dir, 0755, true);
								}
								
								$this->subtype = "file:{$this->subtype}";
								$this->value   = $this->newfile;
								
								if($this->add()) {
										$filecontents = file_get_contents($this->file['tmp_name']);
										if(preg_match('/image/i', $this->file['type'])) {
												//compress image before save
												$filecontents = ossn_resize_image($this->file['tmp_name'], 2048, 2048);
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
		 * @return array
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
						return arrayObject($this->get_entities(), get_class($this));
				}
		}
		
		/**
		 * Get file by id
		 *
		 * @param integer $object->file_id guid of file in database
		 * @param string  $object->type Owner type
		 * @param string  $object->subtype file type
		 *
		 * @return object
		 */
		public function fetchFile() {
				$this->entity_guid = $this->file_id;
				$file              = $this->get_entity();
				return $file;
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
										$mimetypes                   = array();
										$mimetypes[$this->extension] = $this->fileMimeTypes;
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
		 * This file contains most commonly used MIME types
		 * according to file extension names.
		 * Its content is generated from the apache http mime.types file.
		 * http://svn.apache.org/viewvc/httpd/httpd/trunk/docs/conf/mime.types?view=markup
		 * This file has been placed in the public domain for unlimited redistribution.
		 *
		 * @return array 
		 */
		public static function mimeTypes() {
				$mimetypes = array(
						'3dml' => array(
								'text/vnd.in3d.3dml'
						),
						'3ds' => array(
								'image/x-3ds'
						),
						'3g2' => array(
								'video/3gpp2'
						),
						'3gp' => array(
								'video/3gpp'
						),
						'7z' => array(
								'application/x-7z-compressed'
						),
						'aab' => array(
								'application/x-authorware-bin'
						),
						'aac' => array(
								'audio/x-aac'
						),
						'aam' => array(
								'application/x-authorware-map'
						),
						'aas' => array(
								'application/x-authorware-seg'
						),
						'abw' => array(
								'application/x-abiword'
						),
						'ac' => array(
								'application/pkix-attr-cert'
						),
						'acc' => array(
								'application/vnd.americandynamics.acc'
						),
						'ace' => array(
								'application/x-ace-compressed'
						),
						'acu' => array(
								'application/vnd.acucobol'
						),
						'acutc' => array(
								'application/vnd.acucorp'
						),
						'adp' => array(
								'audio/adpcm'
						),
						'aep' => array(
								'application/vnd.audiograph'
						),
						'afm' => array(
								'application/x-font-type1'
						),
						'afp' => array(
								'application/vnd.ibm.modcap'
						),
						'ahead' => array(
								'application/vnd.ahead.space'
						),
						'ai' => array(
								'application/postscript'
						),
						'aif' => array(
								'audio/x-aiff'
						),
						'aifc' => array(
								'audio/x-aiff'
						),
						'aiff' => array(
								'audio/x-aiff'
						),
						'air' => array(
								'application/vnd.adobe.air-application-installer-package+zip'
						),
						'ait' => array(
								'application/vnd.dvb.ait'
						),
						'ami' => array(
								'application/vnd.amiga.ami'
						),
						'apk' => array(
								'application/vnd.android.package-archive'
						),
						'appcache' => array(
								'text/cache-manifest'
						),
						'application' => array(
								'application/x-ms-application'
						),
						'apr' => array(
								'application/vnd.lotus-approach'
						),
						'arc' => array(
								'application/x-freearc'
						),
						'asc' => array(
								'application/pgp-signature'
						),
						'asf' => array(
								'video/x-ms-asf'
						),
						'asm' => array(
								'text/x-asm'
						),
						'aso' => array(
								'application/vnd.accpac.simply.aso'
						),
						'asx' => array(
								'video/x-ms-asf'
						),
						'atc' => array(
								'application/vnd.acucorp'
						),
						'atom' => array(
								'application/atom+xml'
						),
						'atomcat' => array(
								'application/atomcat+xml'
						),
						'atomsvc' => array(
								'application/atomsvc+xml'
						),
						'atx' => array(
								'application/vnd.antix.game-component'
						),
						'au' => array(
								'audio/basic'
						),
						'avi' => array(
								'video/x-msvideo'
						),
						'aw' => array(
								'application/applixware'
						),
						'azf' => array(
								'application/vnd.airzip.filesecure.azf'
						),
						'azs' => array(
								'application/vnd.airzip.filesecure.azs'
						),
						'azw' => array(
								'application/vnd.amazon.ebook'
						),
						'bat' => array(
								'application/x-msdownload'
						),
						'bcpio' => array(
								'application/x-bcpio'
						),
						'bdf' => array(
								'application/x-font-bdf'
						),
						'bdm' => array(
								'application/vnd.syncml.dm+wbxml'
						),
						'bed' => array(
								'application/vnd.realvnc.bed'
						),
						'bh2' => array(
								'application/vnd.fujitsu.oasysprs'
						),
						'bin' => array(
								'application/octet-stream'
						),
						'blb' => array(
								'application/x-blorb'
						),
						'blorb' => array(
								'application/x-blorb'
						),
						'bmi' => array(
								'application/vnd.bmi'
						),
						'bmp' => array(
								'image/bmp'
						),
						'book' => array(
								'application/vnd.framemaker'
						),
						'box' => array(
								'application/vnd.previewsystems.box'
						),
						'boz' => array(
								'application/x-bzip2'
						),
						'bpk' => array(
								'application/octet-stream'
						),
						'btif' => array(
								'image/prs.btif'
						),
						'bz' => array(
								'application/x-bzip'
						),
						'bz2' => array(
								'application/x-bzip2'
						),
						'c' => array(
								'text/x-c'
						),
						'c11amc' => array(
								'application/vnd.cluetrust.cartomobile-config'
						),
						'c11amz' => array(
								'application/vnd.cluetrust.cartomobile-config-pkg'
						),
						'c4d' => array(
								'application/vnd.clonk.c4group'
						),
						'c4f' => array(
								'application/vnd.clonk.c4group'
						),
						'c4g' => array(
								'application/vnd.clonk.c4group'
						),
						'c4p' => array(
								'application/vnd.clonk.c4group'
						),
						'c4u' => array(
								'application/vnd.clonk.c4group'
						),
						'cab' => array(
								'application/vnd.ms-cab-compressed'
						),
						'caf' => array(
								'audio/x-caf'
						),
						'cap' => array(
								'application/vnd.tcpdump.pcap'
						),
						'car' => array(
								'application/vnd.curl.car'
						),
						'cat' => array(
								'application/vnd.ms-pki.seccat'
						),
						'cb7' => array(
								'application/x-cbr'
						),
						'cba' => array(
								'application/x-cbr'
						),
						'cbr' => array(
								'application/x-cbr'
						),
						'cbt' => array(
								'application/x-cbr'
						),
						'cbz' => array(
								'application/x-cbr'
						),
						'cc' => array(
								'text/x-c'
						),
						'cct' => array(
								'application/x-director'
						),
						'ccxml' => array(
								'application/ccxml+xml'
						),
						'cdbcmsg' => array(
								'application/vnd.contact.cmsg'
						),
						'cdf' => array(
								'application/x-netcdf'
						),
						'cdkey' => array(
								'application/vnd.mediastation.cdkey'
						),
						'cdmia' => array(
								'application/cdmi-capability'
						),
						'cdmic' => array(
								'application/cdmi-container'
						),
						'cdmid' => array(
								'application/cdmi-domain'
						),
						'cdmio' => array(
								'application/cdmi-object'
						),
						'cdmiq' => array(
								'application/cdmi-queue'
						),
						'cdx' => array(
								'chemical/x-cdx'
						),
						'cdxml' => array(
								'application/vnd.chemdraw+xml'
						),
						'cdy' => array(
								'application/vnd.cinderella'
						),
						'cer' => array(
								'application/pkix-cert'
						),
						'cfs' => array(
								'application/x-cfs-compressed'
						),
						'cgm' => array(
								'image/cgm'
						),
						'chat' => array(
								'application/x-chat'
						),
						'chm' => array(
								'application/vnd.ms-htmlhelp'
						),
						'chrt' => array(
								'application/vnd.kde.kchart'
						),
						'cif' => array(
								'chemical/x-cif'
						),
						'cii' => array(
								'application/vnd.anser-web-certificate-issue-initiation'
						),
						'cil' => array(
								'application/vnd.ms-artgalry'
						),
						'cla' => array(
								'application/vnd.claymore'
						),
						'class' => array(
								'application/java-vm'
						),
						'clkk' => array(
								'application/vnd.crick.clicker.keyboard'
						),
						'clkp' => array(
								'application/vnd.crick.clicker.palette'
						),
						'clkt' => array(
								'application/vnd.crick.clicker.template'
						),
						'clkw' => array(
								'application/vnd.crick.clicker.wordbank'
						),
						'clkx' => array(
								'application/vnd.crick.clicker'
						),
						'clp' => array(
								'application/x-msclip'
						),
						'cmc' => array(
								'application/vnd.cosmocaller'
						),
						'cmdf' => array(
								'chemical/x-cmdf'
						),
						'cml' => array(
								'chemical/x-cml'
						),
						'cmp' => array(
								'application/vnd.yellowriver-custom-menu'
						),
						'cmx' => array(
								'image/x-cmx'
						),
						'cod' => array(
								'application/vnd.rim.cod'
						),
						'com' => array(
								'application/x-msdownload'
						),
						'conf' => array(
								'text/plain'
						),
						'cpio' => array(
								'application/x-cpio'
						),
						'cpp' => array(
								'text/x-c'
						),
						'cpt' => array(
								'application/mac-compactpro'
						),
						'crd' => array(
								'application/x-mscardfile'
						),
						'crl' => array(
								'application/pkix-crl'
						),
						'crt' => array(
								'application/x-x509-ca-cert'
						),
						'cryptonote' => array(
								'application/vnd.rig.cryptonote'
						),
						'csh' => array(
								'application/x-csh'
						),
						'csml' => array(
								'chemical/x-csml'
						),
						'csp' => array(
								'application/vnd.commonspace'
						),
						'css' => array(
								'text/css'
						),
						'cst' => array(
								'application/x-director'
						),
						'csv' => array(
								'text/csv'
						),
						'cu' => array(
								'application/cu-seeme'
						),
						'curl' => array(
								'text/vnd.curl'
						),
						'cww' => array(
								'application/prs.cww'
						),
						'cxt' => array(
								'application/x-director'
						),
						'cxx' => array(
								'text/x-c'
						),
						'dae' => array(
								'model/vnd.collada+xml'
						),
						'daf' => array(
								'application/vnd.mobius.daf'
						),
						'dart' => array(
								'application/vnd.dart'
						),
						'dataless' => array(
								'application/vnd.fdsn.seed'
						),
						'davmount' => array(
								'application/davmount+xml'
						),
						'dbk' => array(
								'application/docbook+xml'
						),
						'dcr' => array(
								'application/x-director'
						),
						'dcurl' => array(
								'text/vnd.curl.dcurl'
						),
						'dd2' => array(
								'application/vnd.oma.dd2+xml'
						),
						'ddd' => array(
								'application/vnd.fujixerox.ddd'
						),
						'deb' => array(
								'application/x-debian-package'
						),
						'def' => array(
								'text/plain'
						),
						'deploy' => array(
								'application/octet-stream'
						),
						'der' => array(
								'application/x-x509-ca-cert'
						),
						'dfac' => array(
								'application/vnd.dreamfactory'
						),
						'dgc' => array(
								'application/x-dgc-compressed'
						),
						'dic' => array(
								'text/x-c'
						),
						'dir' => array(
								'application/x-director'
						),
						'dis' => array(
								'application/vnd.mobius.dis'
						),
						'dist' => array(
								'application/octet-stream'
						),
						'distz' => array(
								'application/octet-stream'
						),
						'djv' => array(
								'image/vnd.djvu'
						),
						'djvu' => array(
								'image/vnd.djvu'
						),
						'dll' => array(
								'application/x-msdownload'
						),
						'dmg' => array(
								'application/x-apple-diskimage'
						),
						'dmp' => array(
								'application/vnd.tcpdump.pcap'
						),
						'dms' => array(
								'application/octet-stream'
						),
						'dna' => array(
								'application/vnd.dna'
						),
						'doc' => array(
								'application/msword'
						),
						'docm' => array(
								'application/vnd.ms-word.document.macroenabled.12'
						),
						'docx' => array(
								'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
						),
						'dot' => array(
								'application/msword'
						),
						'dotm' => array(
								'application/vnd.ms-word.template.macroenabled.12'
						),
						'dotx' => array(
								'application/vnd.openxmlformats-officedocument.wordprocessingml.template'
						),
						'dp' => array(
								'application/vnd.osgi.dp'
						),
						'dpg' => array(
								'application/vnd.dpgraph'
						),
						'dra' => array(
								'audio/vnd.dra'
						),
						'dsc' => array(
								'text/prs.lines.tag'
						),
						'dssc' => array(
								'application/dssc+der'
						),
						'dtb' => array(
								'application/x-dtbook+xml'
						),
						'dtd' => array(
								'application/xml-dtd'
						),
						'dts' => array(
								'audio/vnd.dts'
						),
						'dtshd' => array(
								'audio/vnd.dts.hd'
						),
						'dump' => array(
								'application/octet-stream'
						),
						'dvb' => array(
								'video/vnd.dvb.file'
						),
						'dvi' => array(
								'application/x-dvi'
						),
						'dwf' => array(
								'model/vnd.dwf'
						),
						'dwg' => array(
								'image/vnd.dwg'
						),
						'dxf' => array(
								'image/vnd.dxf'
						),
						'dxp' => array(
								'application/vnd.spotfire.dxp'
						),
						'dxr' => array(
								'application/x-director'
						),
						'ecelp4800' => array(
								'audio/vnd.nuera.ecelp4800'
						),
						'ecelp7470' => array(
								'audio/vnd.nuera.ecelp7470'
						),
						'ecelp9600' => array(
								'audio/vnd.nuera.ecelp9600'
						),
						'ecma' => array(
								'application/ecmascript'
						),
						'edm' => array(
								'application/vnd.novadigm.edm'
						),
						'edx' => array(
								'application/vnd.novadigm.edx'
						),
						'efif' => array(
								'application/vnd.picsel'
						),
						'ei6' => array(
								'application/vnd.pg.osasli'
						),
						'elc' => array(
								'application/octet-stream'
						),
						'emf' => array(
								'application/x-msmetafile'
						),
						'eml' => array(
								'message/rfc822'
						),
						'emma' => array(
								'application/emma+xml'
						),
						'emz' => array(
								'application/x-msmetafile'
						),
						'eol' => array(
								'audio/vnd.digital-winds'
						),
						'eot' => array(
								'application/vnd.ms-fontobject'
						),
						'eps' => array(
								'application/postscript'
						),
						'epub' => array(
								'application/epub+zip'
						),
						'es3' => array(
								'application/vnd.eszigno3+xml'
						),
						'esa' => array(
								'application/vnd.osgi.subsystem'
						),
						'esf' => array(
								'application/vnd.epson.esf'
						),
						'et3' => array(
								'application/vnd.eszigno3+xml'
						),
						'etx' => array(
								'text/x-setext'
						),
						'eva' => array(
								'application/x-eva'
						),
						'evy' => array(
								'application/x-envoy'
						),
						'exe' => array(
								'application/x-msdownload'
						),
						'exi' => array(
								'application/exi'
						),
						'ext' => array(
								'application/vnd.novadigm.ext'
						),
						'ez' => array(
								'application/andrew-inset'
						),
						'ez2' => array(
								'application/vnd.ezpix-album'
						),
						'ez3' => array(
								'application/vnd.ezpix-package'
						),
						'f' => array(
								'text/x-fortran'
						),
						'f4v' => array(
								'video/x-f4v'
						),
						'f77' => array(
								'text/x-fortran'
						),
						'f90' => array(
								'text/x-fortran'
						),
						'fbs' => array(
								'image/vnd.fastbidsheet'
						),
						'fcdt' => array(
								'application/vnd.adobe.formscentral.fcdt'
						),
						'fcs' => array(
								'application/vnd.isac.fcs'
						),
						'fdf' => array(
								'application/vnd.fdf'
						),
						'fe_launch' => array(
								'application/vnd.denovo.fcselayout-link'
						),
						'fg5' => array(
								'application/vnd.fujitsu.oasysgp'
						),
						'fgd' => array(
								'application/x-director'
						),
						'fh' => array(
								'image/x-freehand'
						),
						'fh4' => array(
								'image/x-freehand'
						),
						'fh5' => array(
								'image/x-freehand'
						),
						'fh7' => array(
								'image/x-freehand'
						),
						'fhc' => array(
								'image/x-freehand'
						),
						'fig' => array(
								'application/x-xfig'
						),
						'flac' => array(
								'audio/x-flac'
						),
						'fli' => array(
								'video/x-fli'
						),
						'flo' => array(
								'application/vnd.micrografx.flo'
						),
						'flv' => array(
								'video/x-flv'
						),
						'flw' => array(
								'application/vnd.kde.kivio'
						),
						'flx' => array(
								'text/vnd.fmi.flexstor'
						),
						'fly' => array(
								'text/vnd.fly'
						),
						'fm' => array(
								'application/vnd.framemaker'
						),
						'fnc' => array(
								'application/vnd.frogans.fnc'
						),
						'for' => array(
								'text/x-fortran'
						),
						'fpx' => array(
								'image/vnd.fpx'
						),
						'frame' => array(
								'application/vnd.framemaker'
						),
						'fsc' => array(
								'application/vnd.fsc.weblaunch'
						),
						'fst' => array(
								'image/vnd.fst'
						),
						'ftc' => array(
								'application/vnd.fluxtime.clip'
						),
						'fti' => array(
								'application/vnd.anser-web-funds-transfer-initiation'
						),
						'fvt' => array(
								'video/vnd.fvt'
						),
						'fxp' => array(
								'application/vnd.adobe.fxp'
						),
						'fxpl' => array(
								'application/vnd.adobe.fxp'
						),
						'fzs' => array(
								'application/vnd.fuzzysheet'
						),
						'g2w' => array(
								'application/vnd.geoplan'
						),
						'g3' => array(
								'image/g3fax'
						),
						'g3w' => array(
								'application/vnd.geospace'
						),
						'gac' => array(
								'application/vnd.groove-account'
						),
						'gam' => array(
								'application/x-tads'
						),
						'gbr' => array(
								'application/rpki-ghostbusters'
						),
						'gca' => array(
								'application/x-gca-compressed'
						),
						'gdl' => array(
								'model/vnd.gdl'
						),
						'geo' => array(
								'application/vnd.dynageo'
						),
						'gex' => array(
								'application/vnd.geometry-explorer'
						),
						'ggb' => array(
								'application/vnd.geogebra.file'
						),
						'ggt' => array(
								'application/vnd.geogebra.tool'
						),
						'ghf' => array(
								'application/vnd.groove-help'
						),
						'gif' => array(
								'image/gif'
						),
						'gim' => array(
								'application/vnd.groove-identity-message'
						),
						'gml' => array(
								'application/gml+xml'
						),
						'gmx' => array(
								'application/vnd.gmx'
						),
						'gnumeric' => array(
								
								'application/x-gnumeric'
						),
						'gph' => array(
								'application/vnd.flographit'
						),
						'gpx' => array(
								'application/gpx+xml'
						),
						'gqf' => array(
								'application/vnd.grafeq'
						),
						'gqs' => array(
								'application/vnd.grafeq'
						),
						'gram' => array(
								'application/srgs'
						),
						'gramps' => array(
								'application/x-gramps-xml'
						),
						'gre' => array(
								'application/vnd.geometry-explorer'
						),
						'grv' => array(
								'application/vnd.groove-injector'
						),
						'grxml' => array(
								'application/srgs+xml'
						),
						'gsf' => array(
								'application/x-font-ghostscript'
						),
						'gtar' => array(
								'application/x-gtar'
						),
						'gtm' => array(
								'application/vnd.groove-tool-message'
						),
						'gtw' => array(
								'model/vnd.gtw'
						),
						'gv' => array(
								'text/vnd.graphviz'
						),
						'gxf' => array(
								'application/gxf'
						),
						'gxt' => array(
								'application/vnd.geonext'
						),
						'h' => array(
								'text/x-c'
						),
						'h261' => array(
								'video/h261'
						),
						'h263' => array(
								'video/h263'
						),
						'h264' => array(
								'video/h264'
						),
						'hal' => array(
								'application/vnd.hal+xml'
						),
						'hbci' => array(
								'application/vnd.hbci'
						),
						'hdf' => array(
								'application/x-hdf'
						),
						'hh' => array(
								'text/x-c'
						),
						'hlp' => array(
								'application/winhlp'
						),
						'hpgl' => array(
								'application/vnd.hp-hpgl'
						),
						'hpid' => array(
								'application/vnd.hp-hpid'
						),
						'hps' => array(
								'application/vnd.hp-hps'
						),
						'hqx' => array(
								'application/mac-binhex40'
						),
						'htke' => array(
								'application/vnd.kenameaapp'
						),
						'htm' => array(
								'text/html'
						),
						'html' => array(
								'text/html'
						),
						'hvd' => array(
								'application/vnd.yamaha.hv-dic'
						),
						'hvp' => array(
								'application/vnd.yamaha.hv-voice'
						),
						'hvs' => array(
								'application/vnd.yamaha.hv-script'
						),
						'i2g' => array(
								'application/vnd.intergeo'
						),
						'icc' => array(
								'application/vnd.iccprofile'
						),
						'ice' => array(
								'x-conference/x-cooltalk'
						),
						'icm' => array(
								'application/vnd.iccprofile'
						),
						'ico' => array(
								'image/x-icon'
						),
						'ics' => array(
								'text/calendar'
						),
						'ief' => array(
								'image/ief'
						),
						'ifb' => array(
								'text/calendar'
						),
						'ifm' => array(
								'application/vnd.shana.informed.formdata'
						),
						'iges' => array(
								'model/iges'
						),
						'igl' => array(
								'application/vnd.igloader'
						),
						'igm' => array(
								'application/vnd.insors.igm'
						),
						'igs' => array(
								'model/iges'
						),
						'igx' => array(
								'application/vnd.micrografx.igx'
						),
						'iif' => array(
								'application/vnd.shana.informed.interchange'
						),
						'imp' => array(
								'application/vnd.accpac.simply.imp'
						),
						'ims' => array(
								'application/vnd.ms-ims'
						),
						'in' => array(
								'text/plain'
						),
						'ink' => array(
								'application/inkml+xml'
						),
						'inkml' => array(
								'application/inkml+xml'
						),
						'install' => array(
								'application/x-install-instructions'
						),
						'iota' => array(
								'application/vnd.astraea-software.iota'
						),
						'ipfix' => array(
								'application/ipfix'
						),
						'ipk' => array(
								'application/vnd.shana.informed.package'
						),
						'irm' => array(
								'application/vnd.ibm.rights-management'
						),
						'irp' => array(
								'application/vnd.irepository.package+xml'
						),
						'iso' => array(
								'application/x-iso9660-image'
						),
						'itp' => array(
								'application/vnd.shana.informed.formtemplate'
						),
						'ivp' => array(
								'application/vnd.immervision-ivp'
						),
						'ivu' => array(
								'application/vnd.immervision-ivu'
						),
						'jad' => array(
								'text/vnd.sun.j2me.app-descriptor'
						),
						'jam' => array(
								'application/vnd.jam'
						),
						'jar' => array(
								'application/java-archive'
						),
						'java' => array(
								'text/x-java-source'
						),
						'jisp' => array(
								'application/vnd.jisp'
						),
						'jlt' => array(
								'application/vnd.hp-jlyt'
						),
						'jnlp' => array(
								'application/x-java-jnlp-file'
						),
						'joda' => array(
								'application/vnd.joost.joda-archive'
						),
						'jpe' => array(
								'image/jpeg'
						),
						'jpeg' => array(
								'image/jpeg'
						),
						'jpg' => array(
								'image/jpeg'
						),
						'jpgm' => array(
								'video/jpm'
						),
						'jpgv' => array(
								'video/jpeg'
						),
						'jpm' => array(
								'video/jpm'
						),
						'js' => array(
								'application/javascript'
						),
						'json' => array(
								'application/json'
						),
						'jsonml' => array(
								'application/jsonml+json'
						),
						'kar' => array(
								'audio/midi'
						),
						'karbon' => array(
								'application/vnd.kde.karbon'
						),
						'kfo' => array(
								'application/vnd.kde.kformula'
						),
						'kia' => array(
								'application/vnd.kidspiration'
						),
						'kml' => array(
								'application/vnd.google-earth.kml+xml'
						),
						'kmz' => array(
								'application/vnd.google-earth.kmz'
						),
						'kne' => array(
								'application/vnd.kinar'
						),
						'knp' => array(
								'application/vnd.kinar'
						),
						'kon' => array(
								'application/vnd.kde.kontour'
						),
						'kpr' => array(
								'application/vnd.kde.kpresenter'
						),
						'kpt' => array(
								'application/vnd.kde.kpresenter'
						),
						'kpxx' => array(
								'application/vnd.ds-keypoint'
						),
						'ksp' => array(
								'application/vnd.kde.kspread'
						),
						'ktr' => array(
								'application/vnd.kahootz'
						),
						'ktx' => array(
								'image/ktx'
						),
						'ktz' => array(
								'application/vnd.kahootz'
						),
						'kwd' => array(
								'application/vnd.kde.kword'
						),
						'kwt' => array(
								'application/vnd.kde.kword'
						),
						'lasxml' => array(
								'application/vnd.las.las+xml'
						),
						'latex' => array(
								'application/x-latex'
						),
						'lbd' => array(
								'application/vnd.llamagraphics.life-balance.desktop'
						),
						'lbe' => array(
								'application/vnd.llamagraphics.life-balance.exchange+xml'
						),
						'les' => array(
								'application/vnd.hhe.lesson-player'
						),
						'lha' => array(
								'application/x-lzh-compressed'
						),
						'link66' => array(
								'application/vnd.route66.link66+xml'
						),
						'list' => array(
								'text/plain'
						),
						'list3820' => array(
								'application/vnd.ibm.modcap'
						),
						'listafp' => array(
								'application/vnd.ibm.modcap'
						),
						'lnk' => array(
								'application/x-ms-shortcut'
						),
						'log' => array(
								'text/plain'
						),
						'lostxml' => array(
								'application/lost+xml'
						),
						'lrf' => array(
								'application/octet-stream'
						),
						'lrm' => array(
								'application/vnd.ms-lrm'
						),
						'ltf' => array(
								'application/vnd.frogans.ltf'
						),
						'lvp' => array(
								'audio/vnd.lucent.voice'
						),
						'lwp' => array(
								'application/vnd.lotus-wordpro'
						),
						'lzh' => array(
								'application/x-lzh-compressed'
						),
						'm13' => array(
								'application/x-msmediaview'
						),
						'm14' => array(
								'application/x-msmediaview'
						),
						'm1v' => array(
								'video/mpeg'
						),
						'm21' => array(
								'application/mp21'
						),
						'm2a' => array(
								'audio/mpeg'
						),
						'm2v' => array(
								'video/mpeg'
						),
						'm3a' => array(
								'audio/mpeg'
						),
						'm3u' => array(
								'audio/x-mpegurl'
						),
						'm3u8' => array(
								'application/vnd.apple.mpegurl'
						),
						'm4u' => array(
								'video/vnd.mpegurl'
						),
						'm4v' => array(
								'video/x-m4v'
						),
						'ma' => array(
								'application/mathematica'
						),
						'mads' => array(
								'application/mads+xml'
						),
						'mag' => array(
								'application/vnd.ecowin.chart'
						),
						'maker' => array(
								'application/vnd.framemaker'
						),
						'man' => array(
								'text/troff'
						),
						'mar' => array(
								'application/octet-stream'
						),
						'mathml' => array(
								'application/mathml+xml'
						),
						'mb' => array(
								'application/mathematica'
						),
						'mbk' => array(
								'application/vnd.mobius.mbk'
						),
						'mbox' => array(
								'application/mbox'
						),
						'mc1' => array(
								'application/vnd.medcalcdata'
						),
						'mcd' => array(
								'application/vnd.mcd'
						),
						'mcurl' => array(
								'text/vnd.curl.mcurl'
						),
						'mdb' => array(
								'application/x-msaccess'
						),
						'mdi' => array(
								'image/vnd.ms-modi'
						),
						'me' => array(
								'text/troff'
						),
						'mesh' => array(
								'model/mesh'
						),
						'meta4' => array(
								'application/metalink4+xml'
						),
						'metalink' => array(
								'application/metalink+xml'
						),
						'mets' => array(
								'application/mets+xml'
						),
						'mfm' => array(
								'application/vnd.mfmp'
						),
						'mft' => array(
								'application/rpki-manifest'
						),
						'mgp' => array(
								'application/vnd.osgeo.mapguide.package'
						),
						'mgz' => array(
								'application/vnd.proteus.magazine'
						),
						'mid' => array(
								'audio/midi'
						),
						'midi' => array(
								'audio/midi'
						),
						'mie' => array(
								'application/x-mie'
						),
						'mif' => array(
								'application/vnd.mif'
						),
						'mime' => array(
								'message/rfc822'
						),
						'mj2' => array(
								'video/mj2'
						),
						'mjp2' => array(
								'video/mj2'
						),
						'mk3d' => array(
								'video/x-matroska'
						),
						'mka' => array(
								'audio/x-matroska'
						),
						'mks' => array(
								'video/x-matroska'
						),
						'mkv' => array(
								'video/x-matroska'
						),
						'mlp' => array(
								'application/vnd.dolby.mlp'
						),
						'mmd' => array(
								'application/vnd.chipnuts.karaoke-mmd'
						),
						'mmf' => array(
								'application/vnd.smaf'
						),
						'mmr' => array(
								'image/vnd.fujixerox.edmics-mmr'
						),
						'mng' => array(
								'video/x-mng'
						),
						'mny' => array(
								'application/x-msmoney'
						),
						'mobi' => array(
								'application/x-mobipocket-ebook'
						),
						'mods' => array(
								'application/mods+xml'
						),
						'mov' => array(
								'video/quicktime'
						),
						'movie' => array(
								'video/x-sgi-movie'
						),
						'mp2' => array(
								'audio/mpeg'
						),
						'mp21' => array(
								'application/mp21'
						),
						'mp2a' => array(
								'audio/mpeg'
						),
						'mp3' => array(
								'audio/mpeg'
						),
						'mp4' => array(
								'video/mp4'
						),
						'mp4a' => array(
								'audio/mp4'
						),
						'mp4s' => array(
								'application/mp4'
						),
						'mp4v' => array(
								'video/mp4'
						),
						'mpc' => array(
								'application/vnd.mophun.certificate'
						),
						'mpe' => array(
								'video/mpeg'
						),
						'mpeg' => array(
								'video/mpeg'
						),
						'mpg' => array(
								'video/mpeg'
						),
						'mpg4' => array(
								'video/mp4'
						),
						'mpga' => array(
								'audio/mpeg'
						),
						'mpkg' => array(
								'application/vnd.apple.installer+xml'
						),
						'mpm' => array(
								'application/vnd.blueice.multipass'
						),
						'mpn' => array(
								'application/vnd.mophun.application'
						),
						'mpp' => array(
								'application/vnd.ms-project'
						),
						'mpt' => array(
								'application/vnd.ms-project'
						),
						'mpy' => array(
								'application/vnd.ibm.minipay'
						),
						'mqy' => array(
								'application/vnd.mobius.mqy'
						),
						'mrc' => array(
								'application/marc'
						),
						'mrcx' => array(
								'application/marcxml+xml'
						),
						'ms' => array(
								'text/troff'
						),
						'mscml' => array(
								'application/mediaservercontrol+xml'
						),
						'mseed' => array(
								'application/vnd.fdsn.mseed'
						),
						'mseq' => array(
								'application/vnd.mseq'
						),
						'msf' => array(
								'application/vnd.epson.msf'
						),
						'msh' => array(
								'model/mesh'
						),
						'msi' => array(
								'application/x-msdownload'
						),
						'msl' => array(
								'application/vnd.mobius.msl'
						),
						'msty' => array(
								'application/vnd.muvee.style'
						),
						'mts' => array(
								'model/vnd.mts'
						),
						'mus' => array(
								'application/vnd.musician'
						),
						'musicxml' => array(
								'application/vnd.recordare.musicxml+xml'
						),
						'mvb' => array(
								'application/x-msmediaview'
						),
						'mwf' => array(
								'application/vnd.mfer'
						),
						'mxf' => array(
								'application/mxf'
						),
						'mxl' => array(
								'application/vnd.recordare.musicxml'
						),
						'mxml' => array(
								'application/xv+xml'
						),
						'mxs' => array(
								'application/vnd.triscape.mxs'
						),
						'mxu' => array(
								'video/vnd.mpegurl'
						),
						'n-gage' => array(
								'application/vnd.nokia.n-gage.symbian.install'
						),
						'n3' => array(
								'text/n3'
						),
						'nb' => array(
								'application/mathematica'
						),
						'nbp' => array(
								'application/vnd.wolfram.player'
						),
						'nc' => array(
								'application/x-netcdf'
						),
						'ncx' => array(
								'application/x-dtbncx+xml'
						),
						'nfo' => array(
								'text/x-nfo'
						),
						'ngdat' => array(
								'application/vnd.nokia.n-gage.data'
						),
						'nitf' => array(
								'application/vnd.nitf'
						),
						'nlu' => array(
								'application/vnd.neurolanguage.nlu'
						),
						'nml' => array(
								'application/vnd.enliven'
						),
						'nnd' => array(
								'application/vnd.noblenet-directory'
						),
						'nns' => array(
								'application/vnd.noblenet-sealer'
						),
						'nnw' => array(
								'application/vnd.noblenet-web'
						),
						'npx' => array(
								'image/vnd.net-fpx'
						),
						'nsc' => array(
								'application/x-conference'
						),
						'nsf' => array(
								'application/vnd.lotus-notes'
						),
						'ntf' => array(
								'application/vnd.nitf'
						),
						'nzb' => array(
								'application/x-nzb'
						),
						'oa2' => array(
								'application/vnd.fujitsu.oasys2'
						),
						'oa3' => array(
								'application/vnd.fujitsu.oasys3'
						),
						'oas' => array(
								'application/vnd.fujitsu.oasys'
						),
						'obd' => array(
								'application/x-msbinder'
						),
						'obj' => array(
								'application/x-tgif'
						),
						'oda' => array(
								'application/oda'
						),
						'odb' => array(
								'application/vnd.oasis.opendocument.database'
						),
						'odc' => array(
								'application/vnd.oasis.opendocument.chart'
						),
						'odf' => array(
								'application/vnd.oasis.opendocument.formula'
						),
						'odft' => array(
								'application/vnd.oasis.opendocument.formula-template'
						),
						'odg' => array(
								'application/vnd.oasis.opendocument.graphics'
						),
						'odi' => array(
								'application/vnd.oasis.opendocument.image'
						),
						'odm' => array(
								'application/vnd.oasis.opendocument.text-master'
						),
						'odp' => array(
								'application/vnd.oasis.opendocument.presentation'
						),
						'ods' => array(
								'application/vnd.oasis.opendocument.spreadsheet'
						),
						'odt' => array(
								'application/vnd.oasis.opendocument.text'
						),
						'oga' => array(
								'audio/ogg'
						),
						'ogg' => array(
								'audio/ogg'
						),
						'ogv' => array(
								'video/ogg'
						),
						'ogx' => array(
								'application/ogg'
						),
						'omdoc' => array(
								'application/omdoc+xml'
						),
						'onepkg' => array(
								'application/onenote'
						),
						'onetmp' => array(
								'application/onenote'
						),
						'onetoc' => array(
								'application/onenote'
						),
						'onetoc2' => array(
								'application/onenote'
						),
						'opf' => array(
								'application/oebps-package+xml'
						),
						'opml' => array(
								'text/x-opml'
						),
						'oprc' => array(
								'application/vnd.palm'
						),
						'org' => array(
								'application/vnd.lotus-organizer'
						),
						'osf' => array(
								'application/vnd.yamaha.openscoreformat'
						),
						'osfpvg' => array(
								'application/vnd.yamaha.openscoreformat.osfpvg+xml'
						),
						'otc' => array(
								'application/vnd.oasis.opendocument.chart-template'
						),
						'otf' => array(
								'application/x-font-otf'
						),
						'otg' => array(
								'application/vnd.oasis.opendocument.graphics-template'
						),
						'oth' => array(
								'application/vnd.oasis.opendocument.text-web'
						),
						'oti' => array(
								'application/vnd.oasis.opendocument.image-template'
						),
						'otp' => array(
								'application/vnd.oasis.opendocument.presentation-template'
						),
						'ots' => array(
								'application/vnd.oasis.opendocument.spreadsheet-template'
						),
						'ott' => array(
								'application/vnd.oasis.opendocument.text-template'
						),
						'oxps' => array(
								'application/oxps'
						),
						'oxt' => array(
								'application/vnd.openofficeorg.extension'
						),
						'p' => array(
								'text/x-pascal'
						),
						'p10' => array(
								'application/pkcs10'
						),
						'p12' => array(
								'application/x-pkcs12'
						),
						'p7b' => array(
								'application/x-pkcs7-certificates'
						),
						'p7c' => array(
								'application/pkcs7-mime'
						),
						'p7m' => array(
								'application/pkcs7-mime'
						),
						'p7r' => array(
								'application/x-pkcs7-certreqresp'
						),
						'p7s' => array(
								'application/pkcs7-signature'
						),
						'p8' => array(
								'application/pkcs8'
						),
						'pas' => array(
								'text/x-pascal'
						),
						'paw' => array(
								'application/vnd.pawaafile'
						),
						'pbd' => array(
								'application/vnd.powerbuilder6'
						),
						'pbm' => array(
								'image/x-portable-bitmap'
						),
						'pcap' => array(
								'application/vnd.tcpdump.pcap'
						),
						'pcf' => array(
								'application/x-font-pcf'
						),
						'pcl' => array(
								'application/vnd.hp-pcl'
						),
						'pclxl' => array(
								'application/vnd.hp-pclxl'
						),
						'pct' => array(
								'image/x-pict'
						),
						'pcurl' => array(
								'application/vnd.curl.pcurl'
						),
						'pcx' => array(
								'image/x-pcx'
						),
						'pdb' => array(
								'application/vnd.palm'
						),
						'pdf' => array(
								'application/pdf'
						),
						'pfa' => array(
								'application/x-font-type1'
						),
						'pfb' => array(
								'application/x-font-type1'
						),
						'pfm' => array(
								'application/x-font-type1'
						),
						'pfr' => array(
								'application/font-tdpfr'
						),
						'pfx' => array(
								'application/x-pkcs12'
						),
						'pgm' => array(
								'image/x-portable-graymap'
						),
						'pgn' => array(
								'application/x-chess-pgn'
						),
						'pgp' => array(
								'application/pgp-encrypted'
						),
						'pic' => array(
								'image/x-pict'
						),
						'pkg' => array(
								'application/octet-stream'
						),
						'pki' => array(
								'application/pkixcmp'
						),
						'pkipath' => array(
								'application/pkix-pkipath'
						),
						'plb' => array(
								'application/vnd.3gpp.pic-bw-large'
						),
						'plc' => array(
								'application/vnd.mobius.plc'
						),
						'plf' => array(
								'application/vnd.pocketlearn'
						),
						'pls' => array(
								'application/pls+xml'
						),
						'pml' => array(
								'application/vnd.ctc-posml'
						),
						'png' => array(
								'image/png'
						),
						'pnm' => array(
								'image/x-portable-anymap'
						),
						'portpkg' => array(
								'application/vnd.macports.portpkg'
						),
						'pot' => array(
								'application/vnd.ms-powerpoint'
						),
						'potm' => array(
								'application/vnd.ms-powerpoint.template.macroenabled.12'
						),
						'potx' => array(
								'application/vnd.openxmlformats-officedocument.presentationml.template'
						),
						'ppam' => array(
								'application/vnd.ms-powerpoint.addin.macroenabled.12'
						),
						'ppd' => array(
								'application/vnd.cups-ppd'
						),
						'ppm' => array(
								'image/x-portable-pixmap'
						),
						'pps' => array(
								'application/vnd.ms-powerpoint'
						),
						'ppsm' => array(
								'application/vnd.ms-powerpoint.slideshow.macroenabled.12'
						),
						'ppsx' => array(
								'application/vnd.openxmlformats-officedocument.presentationml.slideshow'
						),
						'ppt' => array(
								'application/vnd.ms-powerpoint'
						),
						'pptm' => array(
								'application/vnd.ms-powerpoint.presentation.macroenabled.12'
						),
						'pptx' => array(
								'application/vnd.openxmlformats-officedocument.presentationml.presentation'
						),
						'pqa' => array(
								'application/vnd.palm'
						),
						'prc' => array(
								'application/x-mobipocket-ebook'
						),
						'pre' => array(
								'application/vnd.lotus-freelance'
						),
						'prf' => array(
								'application/pics-rules'
						),
						'ps' => array(
								'application/postscript'
						),
						'psb' => array(
								'application/vnd.3gpp.pic-bw-small'
						),
						'psd' => array(
								'image/vnd.adobe.photoshop'
						),
						'psf' => array(
								'application/x-font-linux-psf'
						),
						'pskcxml' => array(
								'application/pskc+xml'
						),
						'ptid' => array(
								'application/vnd.pvi.ptid1'
						),
						'pub' => array(
								'application/x-mspublisher'
						),
						'pvb' => array(
								'application/vnd.3gpp.pic-bw-var'
						),
						'pwn' => array(
								'application/vnd.3m.post-it-notes'
						),
						'pya' => array(
								'audio/vnd.ms-playready.media.pya'
						),
						'pyv' => array(
								'video/vnd.ms-playready.media.pyv'
						),
						'qam' => array(
								'application/vnd.epson.quickanime'
						),
						'qbo' => array(
								'application/vnd.intu.qbo'
						),
						'qfx' => array(
								'application/vnd.intu.qfx'
						),
						'qps' => array(
								'application/vnd.publishare-delta-tree'
						),
						'qt' => array(
								'video/quicktime'
						),
						'qwd' => array(
								'application/vnd.quark.quarkxpress'
								
						),
						'qwt' => array(
								'application/vnd.quark.quarkxpress'
						),
						'qxb' => array(
								'application/vnd.quark.quarkxpress'
						),
						'qxd' => array(
								'application/vnd.quark.quarkxpress'
						),
						'qxl' => array(
								'application/vnd.quark.quarkxpress'
						),
						'qxt' => array(
								'application/vnd.quark.quarkxpress'
						),
						'ra' => array(
								'audio/x-pn-realaudio'
						),
						'ram' => array(
								'audio/x-pn-realaudio'
						),
						'rar' => array(
								'application/x-rar-compressed'
						),
						'ras' => array(
								'image/x-cmu-raster'
						),
						'rcprofile' => array(
								'application/vnd.ipunplugged.rcprofile'
						),
						'rdf' => array(
								'application/rdf+xml'
						),
						'rdz' => array(
								'application/vnd.data-vision.rdz'
						),
						'rep' => array(
								'application/vnd.businessobjects'
						),
						'res' => array(
								'application/x-dtbresource+xml'
						),
						'rgb' => array(
								'image/x-rgb'
						),
						'rif' => array(
								'application/reginfo+xml'
						),
						'rip' => array(
								'audio/vnd.rip'
						),
						'ris' => array(
								'application/x-research-info-systems'
						),
						'rl' => array(
								'application/resource-lists+xml'
						),
						'rlc' => array(
								'image/vnd.fujixerox.edmics-rlc'
						),
						'rld' => array(
								'application/resource-lists-diff+xml'
						),
						'rm' => array(
								'application/vnd.rn-realmedia'
						),
						'rmi' => array(
								'audio/midi'
						),
						'rmp' => array(
								'audio/x-pn-realaudio-plugin'
						),
						'rms' => array(
								'application/vnd.jcp.javame.midlet-rms'
						),
						'rmvb' => array(
								'application/vnd.rn-realmedia-vbr'
						),
						'rnc' => array(
								'application/relax-ng-compact-syntax'
						),
						'roa' => array(
								'application/rpki-roa'
						),
						'roff' => array(
								'text/troff'
						),
						'rp9' => array(
								'application/vnd.cloanto.rp9'
						),
						'rpss' => array(
								'application/vnd.nokia.radio-presets'
						),
						'rpst' => array(
								'application/vnd.nokia.radio-preset'
						),
						'rq' => array(
								'application/sparql-query'
						),
						'rs' => array(
								'application/rls-services+xml'
						),
						'rsd' => array(
								'application/rsd+xml'
						),
						'rss' => array(
								'application/rss+xml'
						),
						'rtf' => array(
								'application/rtf'
						),
						'rtx' => array(
								'text/richtext'
						),
						's' => array(
								'text/x-asm'
						),
						's3m' => array(
								'audio/s3m'
						),
						'saf' => array(
								'application/vnd.yamaha.smaf-audio'
						),
						'sbml' => array(
								'application/sbml+xml'
						),
						'sc' => array(
								'application/vnd.ibm.secure-container'
						),
						'scd' => array(
								'application/x-msschedule'
						),
						'scm' => array(
								'application/vnd.lotus-screencam'
						),
						'scq' => array(
								'application/scvp-cv-request'
						),
						'scs' => array(
								'application/scvp-cv-response'
						),
						'scurl' => array(
								'text/vnd.curl.scurl'
						),
						'sda' => array(
								'application/vnd.stardivision.draw'
						),
						'sdc' => array(
								'application/vnd.stardivision.calc'
						),
						'sdd' => array(
								'application/vnd.stardivision.impress'
						),
						'sdkd' => array(
								'application/vnd.solent.sdkm+xml'
						),
						'sdkm' => array(
								'application/vnd.solent.sdkm+xml'
						),
						'sdp' => array(
								'application/sdp'
						),
						'sdw' => array(
								'application/vnd.stardivision.writer'
						),
						'see' => array(
								'application/vnd.seemail'
						),
						'seed' => array(
								'application/vnd.fdsn.seed'
						),
						'sema' => array(
								'application/vnd.sema'
						),
						'semd' => array(
								'application/vnd.semd'
						),
						'semf' => array(
								'application/vnd.semf'
						),
						'ser' => array(
								'application/java-serialized-object'
						),
						'setpay' => array(
								'application/set-payment-initiation'
						),
						'setreg' => array(
								'application/set-registration-initiation'
						),
						'sfd-hdstx' => array(
								'application/vnd.hydrostatix.sof-data'
						),
						'sfs' => array(
								'application/vnd.spotfire.sfs'
						),
						'sfv' => array(
								'text/x-sfv'
						),
						'sgi' => array(
								'image/sgi'
						),
						'sgl' => array(
								'application/vnd.stardivision.writer-global'
						),
						'sgm' => array(
								'text/sgml'
						),
						'sgml' => array(
								'text/sgml'
						),
						'sh' => array(
								'application/x-sh'
						),
						'shar' => array(
								'application/x-shar'
						),
						'shf' => array(
								'application/shf+xml'
						),
						'sid' => array(
								'image/x-mrsid-image'
						),
						'sig' => array(
								'application/pgp-signature'
						),
						'sil' => array(
								'audio/silk'
						),
						'silo' => array(
								'model/mesh'
						),
						'sis' => array(
								'application/vnd.symbian.install'
						),
						'sisx' => array(
								'application/vnd.symbian.install'
						),
						'sit' => array(
								'application/x-stuffit'
						),
						'sitx' => array(
								'application/x-stuffitx'
						),
						'skd' => array(
								'application/vnd.koan'
						),
						'skm' => array(
								'application/vnd.koan'
						),
						'skp' => array(
								'application/vnd.koan'
						),
						'skt' => array(
								'application/vnd.koan'
						),
						'sldm' => array(
								'application/vnd.ms-powerpoint.slide.macroenabled.12'
						),
						'sldx' => array(
								'application/vnd.openxmlformats-officedocument.presentationml.slide'
						),
						'slt' => array(
								'application/vnd.epson.salt'
						),
						'sm' => array(
								'application/vnd.stepmania.stepchart'
						),
						'smf' => array(
								'application/vnd.stardivision.math'
						),
						'smi' => array(
								'application/smil+xml'
						),
						'smil' => array(
								'application/smil+xml'
						),
						'smv' => array(
								'video/x-smv'
						),
						'smzip' => array(
								'application/vnd.stepmania.package'
						),
						'snd' => array(
								'audio/basic'
						),
						'snf' => array(
								'application/x-font-snf'
						),
						'so' => array(
								'application/octet-stream'
						),
						'spc' => array(
								'application/x-pkcs7-certificates'
						),
						'spf' => array(
								'application/vnd.yamaha.smaf-phrase'
						),
						'spl' => array(
								'application/x-futuresplash'
						),
						'spot' => array(
								'text/vnd.in3d.spot'
						),
						'spp' => array(
								'application/scvp-vp-response'
						),
						'spq' => array(
								'application/scvp-vp-request'
						),
						'spx' => array(
								'audio/ogg'
						),
						'sql' => array(
								'application/x-sql'
						),
						'src' => array(
								'application/x-wais-source'
						),
						'srt' => array(
								'application/x-subrip'
						),
						'sru' => array(
								'application/sru+xml'
						),
						'srx' => array(
								'application/sparql-results+xml'
						),
						'ssdl' => array(
								'application/ssdl+xml'
						),
						'sse' => array(
								'application/vnd.kodak-descriptor'
						),
						'ssf' => array(
								'application/vnd.epson.ssf'
						),
						'ssml' => array(
								'application/ssml+xml'
						),
						'st' => array(
								'application/vnd.sailingtracker.track'
						),
						'stc' => array(
								'application/vnd.sun.xml.calc.template'
						),
						'std' => array(
								'application/vnd.sun.xml.draw.template'
						),
						'stf' => array(
								'application/vnd.wt.stf'
						),
						'sti' => array(
								'application/vnd.sun.xml.impress.template'
						),
						'stk' => array(
								'application/hyperstudio'
						),
						'stl' => array(
								'application/vnd.ms-pki.stl'
						),
						'str' => array(
								'application/vnd.pg.format'
						),
						'stw' => array(
								'application/vnd.sun.xml.writer.template'
						),
						'sub' => array(
								'text/vnd.dvb.subtitle'
						),
						'sus' => array(
								'application/vnd.sus-calendar'
						),
						'susp' => array(
								'application/vnd.sus-calendar'
						),
						'sv4cpio' => array(
								'application/x-sv4cpio'
						),
						'sv4crc' => array(
								'application/x-sv4crc'
						),
						'svc' => array(
								'application/vnd.dvb.service'
						),
						'svd' => array(
								'application/vnd.svd'
						),
						'svg' => array(
								'image/svg+xml'
						),
						'svgz' => array(
								'image/svg+xml'
						),
						'swa' => array(
								'application/x-director'
						),
						'swf' => array(
								'application/x-shockwave-flash'
						),
						'swi' => array(
								'application/vnd.aristanetworks.swi'
						),
						'sxc' => array(
								'application/vnd.sun.xml.calc'
						),
						'sxd' => array(
								'application/vnd.sun.xml.draw'
						),
						'sxg' => array(
								'application/vnd.sun.xml.writer.global'
						),
						'sxi' => array(
								'application/vnd.sun.xml.impress'
						),
						'sxm' => array(
								'application/vnd.sun.xml.math'
						),
						'sxw' => array(
								'application/vnd.sun.xml.writer'
						),
						't' => array(
								'text/troff'
						),
						't3' => array(
								'application/x-t3vm-image'
						),
						'taglet' => array(
								'application/vnd.mynfc'
						),
						'tao' => array(
								'application/vnd.tao.intent-module-archive'
						),
						'tar' => array(
								'application/x-tar'
						),
						'tcap' => array(
								'application/vnd.3gpp2.tcap'
						),
						'tcl' => array(
								'application/x-tcl'
						),
						'teacher' => array(
								'application/vnd.smart.teacher'
						),
						'tei' => array(
								'application/tei+xml'
						),
						'teicorpus' => array(
								'application/tei+xml'
						),
						'tex' => array(
								'application/x-tex'
						),
						'texi' => array(
								'application/x-texinfo'
						),
						'texinfo' => array(
								'application/x-texinfo'
						),
						'text' => array(
								'text/plain'
						),
						'tfi' => array(
								'application/thraud+xml'
						),
						'tfm' => array(
								'application/x-tex-tfm'
						),
						'tga' => array(
								'image/x-tga'
						),
						'thmx' => array(
								'application/vnd.ms-officetheme'
						),
						'tif' => array(
								'image/tiff'
						),
						'tiff' => array(
								'image/tiff'
						),
						'tmo' => array(
								'application/vnd.tmobile-livetv'
						),
						'torrent' => array(
								'application/x-bittorrent'
						),
						'tpl' => array(
								'application/vnd.groove-tool-template'
						),
						'tpt' => array(
								'application/vnd.trid.tpt'
						),
						'tr' => array(
								'text/troff'
						),
						'tra' => array(
								'application/vnd.trueapp'
						),
						'trm' => array(
								'application/x-msterminal'
						),
						'tsd' => array(
								'application/timestamped-data'
						),
						'tsv' => array(
								'text/tab-separated-values'
						),
						'ttc' => array(
								'application/x-font-ttf'
						),
						'ttf' => array(
								'application/x-font-ttf'
						),
						'ttl' => array(
								'text/turtle'
						),
						'twd' => array(
								'application/vnd.simtech-mindmapper'
						),
						'twds' => array(
								'application/vnd.simtech-mindmapper'
						),
						'txd' => array(
								'application/vnd.genomatix.tuxedo'
						),
						'txf' => array(
								'application/vnd.mobius.txf'
						),
						'txt' => array(
								'text/plain'
						),
						'u32' => array(
								'application/x-authorware-bin'
						),
						'udeb' => array(
								'application/x-debian-package'
						),
						'ufd' => array(
								'application/vnd.ufdl'
						),
						'ufdl' => array(
								'application/vnd.ufdl'
						),
						'ulx' => array(
								'application/x-glulx'
						),
						'umj' => array(
								'application/vnd.umajin'
						),
						'unityweb' => array(
								'application/vnd.unity'
						),
						'uoml' => array(
								'application/vnd.uoml+xml'
						),
						'uri' => array(
								'text/uri-list'
						),
						'uris' => array(
								'text/uri-list'
						),
						'urls' => array(
								'text/uri-list'
						),
						'ustar' => array(
								'application/x-ustar'
						),
						'utz' => array(
								'application/vnd.uiq.theme'
						),
						'uu' => array(
								'text/x-uuencode'
						),
						'uva' => array(
								'audio/vnd.dece.audio'
						),
						'uvd' => array(
								'application/vnd.dece.data'
						),
						'uvf' => array(
								'application/vnd.dece.data'
						),
						'uvg' => array(
								'image/vnd.dece.graphic'
						),
						'uvh' => array(
								'video/vnd.dece.hd'
						),
						'uvi' => array(
								'image/vnd.dece.graphic'
						),
						'uvm' => array(
								'video/vnd.dece.mobile'
						),
						'uvp' => array(
								'video/vnd.dece.pd'
						),
						'uvs' => array(
								'video/vnd.dece.sd'
						),
						'uvt' => array(
								'application/vnd.dece.ttml+xml'
						),
						'uvu' => array(
								'video/vnd.uvvu.mp4'
						),
						'uvv' => array(
								'video/vnd.dece.video'
						),
						'uvva' => array(
								'audio/vnd.dece.audio'
						),
						'uvvd' => array(
								'application/vnd.dece.data'
						),
						'uvvf' => array(
								'application/vnd.dece.data'
						),
						'uvvg' => array(
								'image/vnd.dece.graphic'
						),
						'uvvh' => array(
								'video/vnd.dece.hd'
						),
						'uvvi' => array(
								'image/vnd.dece.graphic'
						),
						'uvvm' => array(
								'video/vnd.dece.mobile'
						),
						'uvvp' => array(
								'video/vnd.dece.pd'
						),
						'uvvs' => array(
								'video/vnd.dece.sd'
						),
						'uvvt' => array(
								'application/vnd.dece.ttml+xml'
						),
						'uvvu' => array(
								'video/vnd.uvvu.mp4'
						),
						'uvvv' => array(
								'video/vnd.dece.video'
						),
						'uvvx' => array(
								'application/vnd.dece.unspecified'
						),
						'uvvz' => array(
								'application/vnd.dece.zip'
						),
						'uvx' => array(
								'application/vnd.dece.unspecified'
						),
						'uvz' => array(
								'application/vnd.dece.zip'
						),
						'vcard' => array(
								'text/vcard'
						),
						'vcd' => array(
								'application/x-cdlink'
						),
						'vcf' => array(
								'text/x-vcard'
						),
						'vcg' => array(
								'application/vnd.groove-vcard'
						),
						'vcs' => array(
								'text/x-vcalendar'
						),
						'vcx' => array(
								'application/vnd.vcx'
						),
						'vis' => array(
								'application/vnd.visionary'
						),
						'viv' => array(
								'video/vnd.vivo'
						),
						'vob' => array(
								'video/x-ms-vob'
						),
						'vor' => array(
								'application/vnd.stardivision.writer'
						),
						'vox' => array(
								'application/x-authorware-bin'
						),
						'vrml' => array(
								'model/vrml'
						),
						'vsd' => array(
								'application/vnd.visio'
						),
						'vsf' => array(
								'application/vnd.vsf'
						),
						'vss' => array(
								'application/vnd.visio'
						),
						'vst' => array(
								'application/vnd.visio'
						),
						'vsw' => array(
								'application/vnd.visio'
						),
						'vtu' => array(
								'model/vnd.vtu'
						),
						'vxml' => array(
								'application/voicexml+xml'
						),
						'w3d' => array(
								'application/x-director'
						),
						'wad' => array(
								'application/x-doom'
						),
						'wav' => array(
								'audio/x-wav'
						),
						'wax' => array(
								'audio/x-ms-wax'
						),
						'wbmp' => array(
								'image/vnd.wap.wbmp'
						),
						'wbs' => array(
								'application/vnd.criticaltools.wbs+xml'
						),
						'wbxml' => array(
								'application/vnd.wap.wbxml'
						),
						'wcm' => array(
								'application/vnd.ms-works'
						),
						'wdb' => array(
								'application/vnd.ms-works'
						),
						'wdp' => array(
								'image/vnd.ms-photo'
						),
						'weba' => array(
								'audio/webm'
						),
						'webm' => array(
								'video/webm'
						),
						'webp' => array(
								'image/webp'
						),
						'wg' => array(
								'application/vnd.pmi.widget'
						),
						'wgt' => array(
								'application/widget'
						),
						'wks' => array(
								'application/vnd.ms-works'
						),
						'wm' => array(
								'video/x-ms-wm'
						),
						'wma' => array(
								'audio/x-ms-wma'
						),
						'wmd' => array(
								'application/x-ms-wmd'
						),
						'wmf' => array(
								'application/x-msmetafile'
						),
						'wml' => array(
								'text/vnd.wap.wml'
						),
						'wmlc' => array(
								'application/vnd.wap.wmlc'
						),
						'wmls' => array(
								'text/vnd.wap.wmlscript'
						),
						'wmlsc' => array(
								'application/vnd.wap.wmlscriptc'
						),
						'wmv' => array(
								'video/x-ms-wmv'
						),
						'wmx' => array(
								'video/x-ms-wmx'
						),
						'wmz' => array(
								'application/x-msmetafile'
						),
						'woff' => array(
								'application/font-woff'
						),
						'wpd' => array(
								'application/vnd.wordperfect'
						),
						'wpl' => array(
								'application/vnd.ms-wpl'
						),
						'wps' => array(
								'application/vnd.ms-works'
						),
						'wqd' => array(
								'application/vnd.wqd'
						),
						'wri' => array(
								'application/x-mswrite'
						),
						'wrl' => array(
								'model/vrml'
						),
						'wsdl' => array(
								'application/wsdl+xml'
						),
						'wspolicy' => array(
								'application/wspolicy+xml'
						),
						'wtb' => array(
								'application/vnd.webturbo'
						),
						'wvx' => array(
								'video/x-ms-wvx'
						),
						'x32' => array(
								'application/x-authorware-bin'
						),
						'x3d' => array(
								'model/x3d+xml'
						),
						'x3db' => array(
								'model/x3d+binary'
						),
						'x3dbz' => array(
								'model/x3d+binary'
						),
						'x3dv' => array(
								'model/x3d+vrml'
						),
						'x3dvz' => array(
								'model/x3d+vrml'
						),
						'x3dz' => array(
								'model/x3d+xml'
						),
						'xaml' => array(
								'application/xaml+xml'
						),
						'xap' => array(
								'application/x-silverlight-app'
						),
						'xar' => array(
								'application/vnd.xara'
						),
						'xbap' => array(
								'application/x-ms-xbap'
						),
						'xbd' => array(
								'application/vnd.fujixerox.docuworks.binder'
						),
						'xbm' => array(
								'image/x-xbitmap'
						),
						'xdf' => array(
								'application/xcap-diff+xml'
						),
						'xdm' => array(
								'application/vnd.syncml.dm+xml'
						),
						'xdp' => array(
								'application/vnd.adobe.xdp+xml'
						),
						'xdssc' => array(
								'application/dssc+xml'
						),
						'xdw' => array(
								'application/vnd.fujixerox.docuworks'
						),
						'xenc' => array(
								'application/xenc+xml'
						),
						'xer' => array(
								'application/patch-ops-error+xml'
						),
						'xfdf' => array(
								'application/vnd.adobe.xfdf'
						),
						'xfdl' => array(
								'application/vnd.xfdl'
						),
						'xht' => array(
								'application/xhtml+xml'
						),
						'xhtml' => array(
								'application/xhtml+xml'
						),
						'xhvml' => array(
								'application/xv+xml'
						),
						'xif' => array(
								'image/vnd.xiff'
						),
						'xla' => array(
								'application/vnd.ms-excel'
						),
						'xlam' => array(
								'application/vnd.ms-excel.addin.macroenabled.12'
						),
						'xlc' => array(
								'application/vnd.ms-excel'
						),
						'xlf' => array(
								'application/x-xliff+xml'
						),
						'xlm' => array(
								'application/vnd.ms-excel'
						),
						'xls' => array(
								'application/vnd.ms-excel'
						),
						'xlsb' => array(
								'application/vnd.ms-excel.sheet.binary.macroenabled.12'
						),
						'xlsm' => array(
								'application/vnd.ms-excel.sheet.macroenabled.12'
						),
						'xlsx' => array(
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
						),
						'xlt' => array(
								'application/vnd.ms-excel'
						),
						'xltm' => array(
								'application/vnd.ms-excel.template.macroenabled.12'
						),
						'xltx' => array(
								'application/vnd.openxmlformats-officedocument.spreadsheetml.template'
						),
						'xlw' => array(
								'application/vnd.ms-excel'
						),
						'xm' => array(
								'audio/xm'
						),
						'xml' => array(
								'application/xml'
						),
						'xo' => array(
								'application/vnd.olpc-sugar'
						),
						'xop' => array(
								'application/xop+xml'
						),
						'xpi' => array(
								'application/x-xpinstall'
						),
						'xpl' => array(
								'application/xproc+xml'
						),
						'xpm' => array(
								'image/x-xpixmap'
						),
						'xpr' => array(
								'application/vnd.is-xpr'
						),
						'xps' => array(
								'application/vnd.ms-xpsdocument'
						),
						'xpw' => array(
								'application/vnd.intercon.formnet'
						),
						'xpx' => array(
								'application/vnd.intercon.formnet'
						),
						'xsl' => array(
								'application/xml'
						),
						'xslt' => array(
								'application/xslt+xml'
						),
						'xsm' => array(
								'application/vnd.syncml+xml'
						),
						'xspf' => array(
								'application/xspf+xml'
						),
						'xul' => array(
								'application/vnd.mozilla.xul+xml'
						),
						'xvm' => array(
								'application/xv+xml'
						),
						'xvml' => array(
								'application/xv+xml'
						),
						'xwd' => array(
								'image/x-xwindowdump'
						),
						'xyz' => array(
								'chemical/x-xyz'
						),
						'xz' => array(
								'application/x-xz'
						),
						'yang' => array(
								'application/yang'
						),
						'yin' => array(
								'application/yin+xml'
						),
						'z1' => array(
								'application/x-zmachine'
						),
						'z2' => array(
								'application/x-zmachine'
						),
						'z3' => array(
								'application/x-zmachine'
						),
						'z4' => array(
								'application/x-zmachine'
						),
						'z5' => array(
								'application/x-zmachine'
						),
						'z6' => array(
								'application/x-zmachine'
						),
						'z7' => array(
								'application/x-zmachine'
						),
						'z8' => array(
								'application/x-zmachine'
						),
						'zaz' => array(
								'application/vnd.zzazz.deck+xml'
						),
						'zip' => array(
								'application/zip'
						),
						'zir' => array(
								'application/vnd.zul'
						),
						'zirz' => array(
								'application/vnd.zul'
						),
						'zmm' => array(
								'application/vnd.handheld-entertainment+xml'
						)
				);
				return ossn_call_hook('file', 'mimetypes', false, $mimetypes);
		}
} //class
