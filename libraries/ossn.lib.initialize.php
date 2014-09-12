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
 
ossn_register_language('en', ossn_route()->locale.'ossn.en.php');
ossn_load_locales();
/**
 * Initialize the css library
 *
 * @return void
 */ 
function ossn_initialize(){
$url = ossn_site_url();

$icon = ossn_site_url('components/OssnWall/images/news-feed.png');
ossn_register_sections_menu('newsfeed', array(
								   'text' => ossn_print('news:feed'), 
								   'url' => "{$url}home", 
								   'section' => 'links',
								   'icon' => $icon
								   ));		
ossn_extend_view('ossn/js/head', 'javascripts/head');
//actions
ossn_register_action('user/login', ossn_route()->actions.'user/login.php');
ossn_register_action('user/register', ossn_route()->actions.'user/register.php');
ossn_register_action('user/logout', ossn_route()->actions.'user/logout.php');

ossn_register_action('friend/add', ossn_route()->actions.'friend/add.php');
ossn_register_action('friend/remove', ossn_route()->actions.'friend/remove.php');

ossn_register_page('index', 'ossn_index_pagehandler');
ossn_register_page('home', 'ossn_user_pagehandler');
ossn_register_page('login', 'ossn_user_pagehandler');
ossn_register_page('registered', 'ossn_user_pagehandler');

ossn_add_hook('newsfeed', "left", 'newfeed_menu_handler');	
}
/**
 * Add left menu to newsfeed page
 *
 * @return menu
 */ 
function newfeed_menu_handler($hook, $type, $return){
	$return[] = ossn_view_sections_menu('newsfeed');
	return $return;
}
/**
* Register basic pages
* @pages: 
*       home, 
*   	login, 
*       registered
*
* @return bool
*/
function ossn_user_pagehandler($home, $handler){
	switch($handler){		
    case 'home':
	if(!ossn_isLoggedin()){
		ossn_error_page();
	}
      $title = ossn_print('news:feed');
	  if(com_is_active('OssnWall')){
	   $contents['content'] = ossn_view('components/OssnWall/pages/wall');
	  }
      $content = ossn_set_page_layout('newsfeed', $contents);
      echo ossn_view_page($title, $content);
    break;
	
    case 'login':
	  $title = ossn_print('site:login');
	  $contents['content'] = ossn_view('pages/contents/user/login');
      $content = ossn_set_page_layout('startup', $contents);
      echo ossn_view_page($title, $content);
    break;	
    
	case 'registered':
	  $title = ossn_print('account:registered');
	  $contents['content'] = ossn_view('pages/contents/user/registered');
      $content = ossn_set_page_layout('startup', $contents);
      echo ossn_view_page($title, $content);
    break;
	
	default:
        ossn_error_page();
    break;

	}	
}
/**
* Register site index page
* @pages: 
*       index or home, 
*
* @return bool
*/
function ossn_index_pagehandler($index){
    if(ossn_isLoggedin()){
	 redirect('home');	
    }	
    $page = $index[0];
    if(empty($page)){
		$page = 'home';
	}
	switch($page){		
    case 'home':
      echo ossn_view('pages/index');
    break;
	
	default:
         ossn_error_page();
    break;

	}	
}

ossn_register_callback('ossn', 'init', 'ossn_initialize');
