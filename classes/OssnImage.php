<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) ENGR. SYED ARSALAN HUSSAIN SHAH
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 *
 * Image Resize Library https://github.com/gumlet/php-image-resize
 * License licenses/gumlet/php-image-resize/MIT.txt
 */

class OssnImage {
		const CROPTOP             = 1;
		const CROPCENTRE          = 2;
		const CROPCENTER          = 2;
		const CROPBOTTOM          = 3;
		const CROPLEFT            = 4;
		const CROPRIGHT           = 5;
		const CROPTOPCENTER       = 6;
		const IMG_FLIP_HORIZONTAL = 0;
		const IMG_FLIP_VERTICAL   = 1;
		const IMG_FLIP_BOTH       = 2;

		public $quality_jpg       = 85;
		public $quality_webp      = 85;
		public $quality_png       = 6;
		public $quality_truecolor = true;
		public $gamma_correct     = true;

		public $interlace = 1;

		public $source_type;

		protected $source_image;

		protected $original_w;
		protected $original_h;

		protected $dest_x = 0;
		protected $dest_y = 0;

		protected $source_x;
		protected $source_y;

		protected $dest_w;
		protected $dest_h;

		protected $source_w;
		protected $source_h;

		protected $source_info;

		protected $filters = array();

		/**
		 * Create instance from a strng
		 *
		 * @param string $image_data
		 * @return ImageResize
		 * @throws Exception
		 */
		public static function createFromString($image_data){
				if(empty($image_data) || $image_data === null){
						throw new Exception('image_data must not be empty');
				}
				$resize = new self('data://application/octet-stream;base64,' . base64_encode($image_data));
				return $resize;
		}

		/**
		 * Add filter function for use right before save image to file.
		 *
		 * @param callable $filter
		 * @return $this
		 */
		public function addFilter(callable $filter){
				$this->filters[] = $filter;
				return $this;
		}

		/**
		 * Apply filters.
		 *
		 * @param $image resource an image resource identifier
		 * @param $filterType filter type and default value is IMG_FILTER_NEGATE
		 */
		protected function applyFilter($image, $filterType = IMG_FILTER_NEGATE){
				foreach ($this->filters as $function){
						$function($image, $filterType);
				}
		}

		/**
		 * Loads image source and its properties to the instanciated object
		 *
		 * @param string $filename
		 * @return ImageResize
		 * @throws Exception
		 */
		public function __construct($filename){
				if(!defined('IMAGETYPE_WEBP')){
						define('IMAGETYPE_WEBP', 18);
				}
				if($filename === null || empty($filename) || (substr($filename, 0, 5) !== 'data:' && !is_file($filename))){
						throw new Exception('File does not exist');
				}

				$finfo     = finfo_open(FILEINFO_MIME_TYPE);
				$checkWebp = false;
				if(strstr(finfo_file($finfo, $filename), 'image') === false){
						if(version_compare(PHP_VERSION, '7.0.0', '<=') && strstr(file_get_contents($filename), 'WEBPVP8') !== false){
								$checkWebp         = true;
								$this->source_type = IMAGETYPE_WEBP;
						} else {
								throw new Exception('Unsupported file type');
						}
				} elseif(strstr(finfo_file($finfo, $filename), 'image/webp') !== false){
						$checkWebp         = true;
						$this->source_type = IMAGETYPE_WEBP;
				}

				if(!($image_info = getimagesize($filename, $this->source_info))){
						$image_info = getimagesize($filename);
				}

				if(!$checkWebp){
						if(!$image_info){
								throw new Exception('Could not read file');
						}

						$this->original_w  = $image_info[0];
						$this->original_h  = $image_info[1];
						$this->source_type = $image_info[2];
				}

				switch($this->source_type){
				case IMAGETYPE_GIF:
						$this->source_image = imagecreatefromgif($filename);
						break;

				case IMAGETYPE_JPEG:
						$this->source_image = $this->imageCreateJpegfromExif($filename);

						// set new width and height for image, maybe it has changed
						$this->original_w = imagesx($this->source_image);
						$this->original_h = imagesy($this->source_image);

						break;

				case IMAGETYPE_PNG:
						$this->source_image = imagecreatefrompng($filename);
						break;

				case IMAGETYPE_WEBP:
						$this->source_image = imagecreatefromwebp($filename);
						$this->original_w   = imagesx($this->source_image);
						$this->original_h   = imagesy($this->source_image);

						break;

				default:
						throw new Exception('Unsupported image type');
				}

				if(!$this->source_image){
						throw new Exception('Could not load image');
				}

				return $this->resize($this->getSourceWidth(), $this->getSourceHeight());
		}

		// http://stackoverflow.com/a/28819866
		public function imageCreateJpegfromExif($filename){
				$img = imagecreatefromjpeg($filename);

				if(!function_exists('exif_read_data') || !isset($this->source_info['APP1']) || strpos($this->source_info['APP1'], 'Exif') !== 0){
						return $img;
				}

				try {
						$exif = @exif_read_data($filename);
				} catch (Exception $e){
						$exif = null;
				}

				if(!$exif || !isset($exif['Orientation'])){
						return $img;
				}

				$orientation = $exif['Orientation'];

				if($orientation === 6 || $orientation === 5){
						$img = imagerotate($img, 270, null);
				} elseif($orientation === 3 || $orientation === 4){
						$img = imagerotate($img, 180, null);
				} elseif($orientation === 8 || $orientation === 7){
						$img = imagerotate($img, 90, null);
				}

				if($orientation === 5 || $orientation === 4 || $orientation === 7){
						if(function_exists('imageflip')){
								imageflip($img, IMG_FLIP_HORIZONTAL);
						} else {
								$this->imageFlip($img, IMG_FLIP_HORIZONTAL);
						}
				}

				return $img;
		}

		/**
		 * Saves new image
		 *
		 * @param string $filename
		 * @param integer $image_type
		 * @param integer $quality
		 * @param integer $permissions
		 * @param boolean $exact_size
		 * @return static
		 */
		public function save($filename, $image_type = null, $quality = null, $permissions = null, $exact_size = false){
				$image_type = $image_type ?: $this->source_type;
				$quality    = is_numeric($quality) ? (int) abs($quality) : null;

				switch($image_type){
				case IMAGETYPE_GIF:
						if(!empty($exact_size) && is_array($exact_size)){
								$dest_image = imagecreatetruecolor($exact_size[0], $exact_size[1]);
						} else {
								$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
						}

						$background = imagecolorallocatealpha($dest_image, 255, 255, 255, 1);
						imagecolortransparent($dest_image, $background);
						imagefill($dest_image, 0, 0, $background);
						imagesavealpha($dest_image, true);
						break;

				case IMAGETYPE_JPEG:
						if(!empty($exact_size) && is_array($exact_size)){
								$dest_image = imagecreatetruecolor($exact_size[0], $exact_size[1]);
								$background = imagecolorallocate($dest_image, 255, 255, 255);
								imagefilledrectangle($dest_image, 0, 0, $exact_size[0], $exact_size[1], $background);
						} else {
								$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
								$background = imagecolorallocate($dest_image, 255, 255, 255);
								imagefilledrectangle($dest_image, 0, 0, $this->getDestWidth(), $this->getDestHeight(), $background);
						}
						break;

				case IMAGETYPE_WEBP:
						if(version_compare(PHP_VERSION, '5.5.0', '<')){
								throw new Exception('For WebP support PHP >= 5.5.0 is required');
						}
						if(!empty($exact_size) && is_array($exact_size)){
								$dest_image = imagecreatetruecolor($exact_size[0], $exact_size[1]);
								$background = imagecolorallocate($dest_image, 255, 255, 255);
								imagefilledrectangle($dest_image, 0, 0, $exact_size[0], $exact_size[1], $background);
						} else {
								$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
								$background = imagecolorallocate($dest_image, 255, 255, 255);
								imagefilledrectangle($dest_image, 0, 0, $this->getDestWidth(), $this->getDestHeight(), $background);
						}

						imagealphablending($dest_image, false);
						imagesavealpha($dest_image, true);

						break;

				case IMAGETYPE_PNG:
						if(!$this->quality_truecolor || !imageistruecolor($this->source_image)){
								if(!empty($exact_size) && is_array($exact_size)){
										$dest_image = imagecreate($exact_size[0], $exact_size[1]);
								} else {
										$dest_image = imagecreate($this->getDestWidth(), $this->getDestHeight());
								}
						} else {
								if(!empty($exact_size) && is_array($exact_size)){
										$dest_image = imagecreatetruecolor($exact_size[0], $exact_size[1]);
								} else {
										$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
								}
						}

						imagealphablending($dest_image, false);
						imagesavealpha($dest_image, true);

						$background = imagecolorallocatealpha($dest_image, 255, 255, 255, 127);
						imagecolortransparent($dest_image, $background);
						imagefill($dest_image, 0, 0, $background);
						break;
				}

				imageinterlace($dest_image, $this->interlace);

				if($this->gamma_correct){
						imagegammacorrect($this->source_image, 2.2, 1.0);
				}

				if(!empty($exact_size) && is_array($exact_size)){
						if($this->getSourceHeight() < $this->getSourceWidth()){
								$this->dest_x = 0;
								$this->dest_y = ($exact_size[1] - $this->getDestHeight()) / 2;
						}
						if($this->getSourceHeight() > $this->getSourceWidth()){
								$this->dest_x = ($exact_size[0] - $this->getDestWidth()) / 2;
								$this->dest_y = 0;
						}
				}

				imagecopyresampled(
						$dest_image,
						$this->source_image,
						$this->dest_x,
						$this->dest_y,
						$this->source_x,
						$this->source_y,
						$this->getDestWidth(),
						$this->getDestHeight(),
						$this->source_w,
						$this->source_h
				);

				if($this->gamma_correct){
						imagegammacorrect($dest_image, 1.0, 2.2);
				}

				$this->applyFilter($dest_image);

				switch($image_type){
				case IMAGETYPE_GIF:
						imagegif($dest_image, $filename);
						break;

				case IMAGETYPE_JPEG:
						if($quality === null || $quality > 100){
								$quality = $this->quality_jpg;
						}

						imagejpeg($dest_image, $filename, $quality);
						break;

				case IMAGETYPE_WEBP:
						if(version_compare(PHP_VERSION, '5.5.0', '<')){
								throw new Exception('For WebP support PHP >= 5.5.0 is required');
						}
						if($quality === null){
								$quality = $this->quality_webp;
						}

						imagewebp($dest_image, $filename, $quality);
						break;

				case IMAGETYPE_PNG:
						if($quality === null || $quality > 9){
								$quality = $this->quality_png;
						}

						imagepng($dest_image, $filename, $quality);
						break;
				}

				if($permissions){
						chmod($filename, $permissions);
				}

				imagedestroy($dest_image);

				return $this;
		}

		/**
		 * Convert the image to string
		 *
		 * @param int $image_type
		 * @param int $quality
		 * @return string
		 */
		public function getImageAsString($image_type = null, $quality = null){
				$string_temp = tempnam(sys_get_temp_dir(), '');

				$this->save($string_temp, $image_type, $quality);

				$string = file_get_contents($string_temp);

				unlink($string_temp);

				return $string;
		}

		/**
		 * Convert the image to string with the current settings
		 *
		 * @return string
		 */
		public function __toString(){
				return $this->getImageAsString();
		}

		/**
		 * Outputs image to browser
		 * @param string $image_type
		 * @param integer $quality
		 */
		public function output($image_type = null, $quality = null){
				$image_type = $image_type ?: $this->source_type;

				header('Content-Type: ' . image_type_to_mime_type($image_type));

				$this->save(null, $image_type, $quality);
		}

		/**
		 * Resizes image according to the given short side (short side proportional)
		 *
		 * @param integer $max_short
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resizeToShortSide($max_short, $allow_enlarge = false){
				if($this->getSourceHeight() < $this->getSourceWidth()){
						$ratio = $max_short / $this->getSourceHeight();
						$long  = $this->getSourceWidth() * $ratio;

						$this->resize($long, $max_short, $allow_enlarge);
				} else {
						$ratio = $max_short / $this->getSourceWidth();
						$long  = $this->getSourceHeight() * $ratio;

						$this->resize($max_short, $long, $allow_enlarge);
				}

				return $this;
		}

		/**
		 * Resizes image according to the given long side (short side proportional)
		 *
		 * @param integer $max_long
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resizeToLongSide($max_long, $allow_enlarge = false){
				if($this->getSourceHeight() > $this->getSourceWidth()){
						$ratio = $max_long / $this->getSourceHeight();
						$short = $this->getSourceWidth() * $ratio;

						$this->resize($short, $max_long, $allow_enlarge);
				} else {
						$ratio = $max_long / $this->getSourceWidth();
						$short = $this->getSourceHeight() * $ratio;

						$this->resize($max_long, $short, $allow_enlarge);
				}

				return $this;
		}

		/**
		 * Resizes image according to the given height (width proportional)
		 *
		 * @param integer $height
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resizeToHeight($height, $allow_enlarge = false){
				$ratio = $height / $this->getSourceHeight();
				$width = $this->getSourceWidth() * $ratio;

				$this->resize($width, $height, $allow_enlarge);

				return $this;
		}

		/**
		 * Resizes image according to the given width (height proportional)
		 *
		 * @param integer $width
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resizeToWidth($width, $allow_enlarge = false){
				$ratio  = $width / $this->getSourceWidth();
				$height = $this->getSourceHeight() * $ratio;

				$this->resize($width, $height, $allow_enlarge);

				return $this;
		}

		/**
		 * Resizes image to best fit inside the given dimensions
		 *
		 * @param integer $max_width
		 * @param integer $max_height
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resizeToBestFit($max_width, $max_height, $allow_enlarge = false){
				if($this->getSourceWidth() <= $max_width && $this->getSourceHeight() <= $max_height && $allow_enlarge === false){
						return $this;
				}

				$ratio  = $this->getSourceHeight() / $this->getSourceWidth();
				$width  = $max_width;
				$height = $width * $ratio;

				if($height > $max_height){
						$height = $max_height;
						$width  = (int) round($height / $ratio);
				}

				return $this->resize($width, $height, $allow_enlarge);
		}

		/**
		 * Resizes image according to given scale (proportionally)
		 *
		 * @param integer|float $scale
		 * @return static
		 */
		public function scale($scale){
				$width  = ($this->getSourceWidth() * $scale) / 100;
				$height = ($this->getSourceHeight() * $scale) / 100;

				$this->resize($width, $height, true);

				return $this;
		}

		/**
		 * Resizes image according to the given width and height
		 *
		 * @param integer $width
		 * @param integer $height
		 * @param boolean $allow_enlarge
		 * @return static
		 */
		public function resize($width, $height, $allow_enlarge = false){
				if(!$allow_enlarge){
						// if the user hasn't explicitly allowed enlarging,
						// but either of the dimensions are larger then the original,
						// then just use original dimensions - this logic may need rethinking

						if($width > $this->getSourceWidth() || $height > $this->getSourceHeight()){
								$width  = $this->getSourceWidth();
								$height = $this->getSourceHeight();
						}
				}

				$this->source_x = 0;
				$this->source_y = 0;

				$this->dest_w = $width;
				$this->dest_h = $height;

				$this->source_w = $this->getSourceWidth();
				$this->source_h = $this->getSourceHeight();

				return $this;
		}

		/**
		 * Crops image according to the given width, height and crop position
		 *
		 * @param integer $width
		 * @param integer $height
		 * @param boolean $allow_enlarge
		 * @param integer $position
		 * @return static
		 */
		public function crop($width, $height, $allow_enlarge = false, $position = self::CROPCENTER){
				if(!$allow_enlarge){
						// this logic is slightly different to resize(),
						// it will only reset dimensions to the original
						// if that particular dimenstion is larger

						if($width > $this->getSourceWidth()){
								$width = $this->getSourceWidth();
						}

						if($height > $this->getSourceHeight()){
								$height = $this->getSourceHeight();
						}
				}

				$ratio_source = $this->getSourceWidth() / $this->getSourceHeight();
				$ratio_dest   = $width / $height;

				if($ratio_dest < $ratio_source){
						$this->resizeToHeight($height, $allow_enlarge);

						$excess_width = (($this->getDestWidth() - $width) / $this->getDestWidth()) * $this->getSourceWidth();

						$this->source_w = $this->getSourceWidth() - $excess_width;
						$this->source_x = $this->getCropPosition($excess_width, $position);

						$this->dest_w = $width;
				} else {
						$this->resizeToWidth($width, $allow_enlarge);

						$excess_height = (($this->getDestHeight() - $height) / $this->getDestHeight()) * $this->getSourceHeight();

						$this->source_h = $this->getSourceHeight() - $excess_height;
						$this->source_y = $this->getCropPosition($excess_height, $position);

						$this->dest_h = $height;
				}

				return $this;
		}

		/**
		 * Crops image according to the given width, height, x and y
		 *
		 * @param integer $width
		 * @param integer $height
		 * @param integer $x
		 * @param integer $y
		 * @return static
		 */
		public function freecrop($width, $height, $x = false, $y = false){
				if($x === false || $y === false){
						return $this->crop($width, $height);
				}
				$this->source_x = $x;
				$this->source_y = $y;
				if($width > $this->getSourceWidth() - $x){
						$this->source_w = $this->getSourceWidth() - $x;
				} else {
						$this->source_w = $width;
				}

				if($height > $this->getSourceHeight() - $y){
						$this->source_h = $this->getSourceHeight() - $y;
				} else {
						$this->source_h = $height;
				}

				$this->dest_w = $width;
				$this->dest_h = $height;

				return $this;
		}

		/**
		 * Gets source width
		 *
		 * @return integer
		 */
		public function getSourceWidth(){
				return $this->original_w;
		}

		/**
		 * Gets source height
		 *
		 * @return integer
		 */
		public function getSourceHeight(){
				return $this->original_h;
		}

		/**
		 * Gets width of the destination image
		 *
		 * @return integer
		 */
		public function getDestWidth(){
				return $this->dest_w;
		}

		/**
		 * Gets height of the destination image
		 * @return integer
		 */
		public function getDestHeight(){
				return $this->dest_h;
		}

		/**
		 * Gets crop position (X or Y) according to the given position
		 *
		 * @param integer $expectedSize
		 * @param integer $position
		 * @return float|integer
		 */
		protected function getCropPosition($expectedSize, $position = self::CROPCENTER){
				$size = 0;
				switch($position){
				case self::CROPBOTTOM:
				case self::CROPRIGHT:
						$size = $expectedSize;
						break;
				case self::CROPCENTER:
				case self::CROPCENTRE:
						$size = $expectedSize / 2;
						break;
				case self::CROPTOPCENTER:
						$size = $expectedSize / 4;
						break;
				}
				return $size;
		}

		/**
		 *  Flips an image using a given mode if PHP version is lower than 5.5
		 *
		 * @param  resource $image
		 * @param  integer  $mode
		 * @return null
		 */
		public function imageFlip($image, $mode){
				switch($mode){
				case self::IMG_FLIP_HORIZONTAL:
						$max_x      = imagesx($image) - 1;
						$half_x     = $max_x / 2;
						$sy         = imagesy($image);
						$temp_image = imageistruecolor($image) ? imagecreatetruecolor(1, $sy) : imagecreate(1, $sy);
						for($x = 0; $x < $half_x; ++$x){
								imagecopy($temp_image, $image, 0, 0, $x, 0, 1, $sy);
								imagecopy($image, $image, $x, 0, $max_x - $x, 0, 1, $sy);
								imagecopy($image, $temp_image, $max_x - $x, 0, 0, 0, 1, $sy);
						}
						break;
				case self::IMG_FLIP_VERTICAL:
						$sx         = imagesx($image);
						$max_y      = imagesy($image) - 1;
						$half_y     = $max_y / 2;
						$temp_image = imageistruecolor($image) ? imagecreatetruecolor($sx, 1) : imagecreate($sx, 1);
						for($y = 0; $y < $half_y; ++$y){
								imagecopy($temp_image, $image, 0, 0, 0, $y, $sx, 1);
								imagecopy($image, $image, 0, $y, 0, $max_y - $y, $sx, 1);
								imagecopy($image, $temp_image, 0, $max_y - $y, 0, 0, $sx, 1);
						}
						break;
				case self::IMG_FLIP_BOTH:
						$sx         = imagesx($image);
						$sy         = imagesy($image);
						$temp_image = imagerotate($image, 180, 0);
						imagecopy($image, $temp_image, 0, 0, 0, 0, $sx, $sy);
						break;
				default:
						return null;
				}
				imagedestroy($temp_image);
		}

		/**
		 * Enable or not the gamma color correction on the image, enabled by default
		 *
		 * @param bool $enable
		 * @return static
		 */
		public function gamma($enable = true){
				$this->gamma_correct = $enable;

				return $this;
		}
}