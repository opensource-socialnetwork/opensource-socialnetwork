<?php 
if($params['instance']->isAttachment()) {
		switch($params['instance']->typeOfAttachment()) {
			case 'image':
				echo ossn_plugin_view('output/url', array(
						'data-fancybox' => '',
						'href'          => $params['instance']->attachmentURL(),
						'text'          => ossn_plugin_view('output/image', array(
								'class' => 'img-responsive ossn-message-show-image-attachment',
								'src'   => $params['instance']->attachmentURL(),
						)),
				));
				break;
			case 'file':
				echo ossn_plugin_view('output/url', array(
						'href'   => $params['instance']->attachmentURL(),
						'text'   => $params['instance']->attachmentName(),
						'target' => '_blank',
						'class'  => 'ossn-message-attachment',
				));
				break;
		}
}