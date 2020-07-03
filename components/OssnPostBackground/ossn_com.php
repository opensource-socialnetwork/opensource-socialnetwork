<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('PostBackground', ossn_route()->com . 'OssnPostBackground/');
define('__PostBackground_List__', array(
		array(
				'name' => 'pbg1',
				'url' => ossn_site_url('components/OssnPostBackground/images/1.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg2',
				'url' => ossn_site_url('components/OssnPostBackground/images/2.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg3',
				'url' => ossn_site_url('components/OssnPostBackground/images/3.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg4',
				'url' => ossn_site_url('components/OssnPostBackground/images/4.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg5',
				'url' => ossn_site_url('components/OssnPostBackground/images/5.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg6',
				'url' => ossn_site_url('components/OssnPostBackground/images/6.jpg'),
				'color_hex' => '#fff',
		),
		array(
				'name' => 'pbg7',
				'url' => ossn_site_url('components/OssnPostBackground/images/7.jpg'),
				'color_hex' => '#333',
		),
		array(
				'name' => 'pbg8',
				'url' => ossn_site_url('components/OssnPostBackground/images/8.jpg'),
				'color_hex' => '#333',
		),
		array(
				'name' => 'pbg9',
				'url' => ossn_site_url('components/OssnPostBackground/images/9.jpg'),
				'color_hex' => '#333',
		),
		array(
				'name' => 'pbg10',
				'url' => ossn_site_url('components/OssnPostBackground/images/10.jpg'),
				'color_hex' => '#333',
		),
		array(
				'name' => 'pbg11',
				'url' => ossn_site_url('components/OssnPostBackground/images/11.jpg'),
				'color_hex' => '#333',
		)
));
ossn_register_class(array(
		'PostBackground' => PostBackground . 'classes/PostBackground.php'
));
function postbg_init() {
		ossn_extend_view('js/opensource.socialnetwork', 'postbg/js');
		ossn_extend_view('css/ossn.default', 'postbg/css');
		
		$post_background = array(
				'name' => 'postbg_selector',
				'text' => '<i class="fa fa-paint-brush"></i>',
				'href' => 'javascript:void(0);'
		);
		
		ossn_register_menu_item('wall/container/controls/home', $post_background);
		ossn_register_menu_item('wall/container/controls/user', $post_background);
		ossn_register_menu_item('wall/container/controls/group', $post_background);
		
		ossn_extend_view('wall/templates/wall/user/item', 'postbg/item');
		ossn_extend_view('wall/templates/wall/group/item', 'postbg/item');
		ossn_extend_view('wall/templates/wall/businesspage/item', 'postbg/item');		
		
		ossn_register_callback('wall', 'post:created', 'postbg_wall_created');
}
function postbg_wall_created($callback, $type, $params) {
		$PostBackground = new PostBackground;
		$PostBackground->setBackground($params);
}
ossn_register_callback('ossn', 'init', 'postbg_init');