<?php
ossn_register_callback('ossn', 'init', 'fbui_bpage_init', 1001);

function fbui_bpage_init(){
		if(com_is_active('BusinessPage')){
			ossn_unregister_page('page');
			ossn_register_page('page', '_business_page_handler');	
		}
}
function _business_page_handler($pages) {
		ossn_load_external_js('places.min');
		switch ($pages[0]) {
		case 'view':
				if($page = get_business_page($pages[1])) {
						if(isset($page->username)){
								redirect_external($page->getURL());	
						}
						ossn_trigger_callback('page', 'load:businesspage:profile', array(
								'page' => $page,
						));

						ossn_unload_js('ossn.chat');
						ossn_unextend_view('ossn/page/footer', 'chat/chatbar');

						$title               = $page->title;
						$contents['content'] = ossn_plugin_view('bpage/pages/view', array(
								'page' => $page,
						));
						$content = ossn_set_page_layout('full', $contents);
						echo ossn_view_page($title, $content);
				} else {
						ossn_error_page();
				}
				break;
		case 'about':
				if($page = get_business_page($pages[1])) {
						$title               = $page->title;
						$contents['content'] = ossn_plugin_view('bpage/pages/about_page', array(
								'page' => $page,
						));
						$content = ossn_set_page_layout('contents', $contents);
						echo ossn_view_page($title, $content);
				} else {
						ossn_error_page();
				}
				break;
		case 'edit':
				if(ossn_isLoggedin() && $page = get_business_page($pages[1])) {
						if($page->owner_guid != ossn_loggedin_user()->guid){
								ossn_error_page();
						}
						$title               = $page->title;
						$contents['content'] = ossn_plugin_view('bpage/pages/edit', array(
								'page' => $page,
						));
						$content = ossn_set_page_layout('contents', $contents);
						echo ossn_view_page($title, $content);
				} else {
						ossn_error_page();
				}
				break;
		case 'all':
				$title               = ossn_print('bpage:list');
				$contents['content'] = ossn_plugin_view('bpage/pages/all');
				$content             = ossn_set_page_layout('newsfeed', $contents);
				echo ossn_view_page($title, $content);
				break;
		case 'add':
				$title               = ossn_print('bpage:add');
				$contents['content'] = ossn_plugin_view('bpage/pages/add');
				$content             = ossn_set_page_layout('newsfeed', $contents);
				echo ossn_view_page($title, $content);
				break;
		case 'liked':
				if(!ossn_isLoggedin()) {
						ossn_error_page();
				}
				$title               = ossn_print('bpage:likedpages');
				$contents['content'] = ossn_plugin_view('bpage/pages/liked');
				$content             = ossn_set_page_layout('newsfeed', $contents);
				echo ossn_view_page($title, $content);
				break;
		case 'mypages':
				if(!ossn_isLoggedin()) {
						ossn_error_page();
				}
				$title               = ossn_print('bpage:mypages');
				$contents['content'] = ossn_plugin_view('bpage/pages/mypages');
				$content             = ossn_set_page_layout('newsfeed', $contents);
				echo ossn_view_page($title, $content);
				break;
		case 'cover':
				if($pages[2] == 'default.jpg') {
						redirect('components/BusinessPage/images/transparent.png');
				}
				$file = ossn_get_file($pages[1]);
				if($file && $file->type == 'object' && $file->subtype == 'file:page:cover') {
						$file->output();
				} else {
						ossn_error_page();
				}
				break;
		case 'photo':
				if($pages[3] == 'default.jpg') {
						$size = $pages[2];
						redirect("components/BusinessPage/images/icon/{$size}_default.jpg");
				}
				$file = ossn_get_file($pages[1]);
				if($file && $file->type == 'object' && $file->subtype == 'file:page:photo') {
						$sizes = array(
								'small',
								'smaller',
								'larger',
						);
						$size = false;
						if(in_array($pages[2], $sizes)) {
								$size = $pages[2];
						}
						if((!$size && !$file->isCDN()) || $pages[2] == 'master') {
								$file->output();
						}
						if($size && !$file->isCDN()) {
								$parsed      = explode('/', $file->value);
								$file->value = "page/photo/{$size}_" . end($parsed);
								$file->output();
						}
						if($file->isCDN()) {
								$manifest = $file->getManifest();
								if(!empty($size)) {
										$size = "{$size}_";
								}
								$url = $manifest['url'] . "{$manifest['path']}{$size}" . $manifest['filename'];
								ob_flush();
								header("Location:{$url}");
								exit();
						}
				}
				break;
				default:
					ossn_error_page();
		}
}