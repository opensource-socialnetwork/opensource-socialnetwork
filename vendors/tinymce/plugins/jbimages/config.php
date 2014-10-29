<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/system/start.php');
$user = loggedin_default_identity();
$config['img_path'] = fud_site_url() . "/article/image/{$user['identity_id']}"; // Relative to domain name

$config['upload_path'] = fud_get_userdata("article/images/{$user['identity_id']}/"); // Physical path. [Usually works fine like this]
if (!is_dir($config['upload_path'])) {
    mkdir($config['upload_path'], 0755, true);
}
/*-------------------------------------------------------------------
| 
| Allowed image filetypes. Specifying something other, than image types will result in error. 
| 
| $config['allowed_types'] = 'gif|jpg|png';
| 
| -------------------------------------------------------------------*/


$config['allowed_types'] = 'gif|jpg|png';


/*-------------------------------------------------------------------
| 
| Maximum image file size in kilobytes. This value can't exceed value set in php.ini.
| Set to `0` if you want to use php.ini default:
| 
| $config['max_size'] = 0;
| 
| -------------------------------------------------------------------*/


$config['max_size'] = 0;


/*-------------------------------------------------------------------
| 
| Maximum image width. Set to `0` for no limit:
| 
| $config['max_width'] = 0;
| 
| -------------------------------------------------------------------*/


$config['max_width'] = 0;


/*-------------------------------------------------------------------
| 
| Maximum image height. Set to `0` for no limit:
| 
| $config['max_height'] = 0;
| 
| -------------------------------------------------------------------*/


$config['max_height'] = 0;


/*-------------------------------------------------------------------
| 
| Allow script to resize image that exceeds maximum width or maximum height (or both)
| If set to `TRUE`, image will be resized to fit maximum values (proportions are saved)
| If set to `FALSE`, user will recieve an error message.
| 
| $config['allow_resize'] = TRUE;
| 
| -------------------------------------------------------------------*/


$config['allow_resize'] = TRUE;


/*-------------------------------------------------------------------
| 
| Image name encryption
| If set to `TRUE`, image file name will be encrypted in something like 7fdd57742f0f7b02288feb62570c7813.jpg
| If set to `FALSE`, original filenames will be preserved
| 
| $config['encrypt_name'] = TRUE;
| 
| -------------------------------------------------------------------*/


$config['encrypt_name'] = TRUE;


/*-------------------------------------------------------------------
| 
| How to behave if 2 or more files with the same name are uploaded:
| `TRUE` - the entire file will be overwritten
| `FALSE` - a number will be added to the newly uploaded file name
| 
| -------------------------------------------------------------------*/


$config['overwrite'] = FALSE;


/*-------------------------------------------------------------------
| 
| Target upload folder relative to document root. Most likely, you will not need to change this setting.
| 
| -------------------------------------------------------------------*/


/*-------------------------------------------------------------------
| 
| THAT IS ALL. HAVE A NICE DAY! )))
| 
| -------------------------------------------------------------------*/
?>
