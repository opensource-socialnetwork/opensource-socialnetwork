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
 $args = array(
		'instance' => (isset($params['instance']) ? $params['instance'] : ''),
		'view' => 'chat/message-item-send',
 );
 if(!isset($params['class'])){
		$params['class'] = ''; 
 }
?>
<div class="message-reciever" id="ossn-message-item-<?php echo $params['id'];?>">
    <div class="ossn-chat-text-data">
        <div class="text <?php echo $params['class'];?>">
            <div class="inner" title="<?php echo OssnChat::messageTime($params['time']); ?>">
            	<?php if(isset($params['deleted']) && $params['deleted']){ ?>
                	<span><i class="fa fa-times-circle"></i><?php echo ossn_print('ossnmessages:deleted');?></span>
                <?php } else { ?>
	                <span><?php echo ossn_call_hook('chat', 'message:smilify', $args, ossn_message_print($params['message'])); ?></span>
                <?php } ?>  
                <?php
				if($params['instance']->isAttachment()){
					switch($params['instance']->typeOfAttachment()){
							case 'image':
								echo ossn_plugin_view('output/url', array(
										'data-fancybox' => '',
										'href' => $params['instance']->attachmentURL(),
										'text' => ossn_plugin_view('output/image', array(
												'class' => 'img-responsive ossn-message-show-image-attachment',
												'src' => $params['instance']->attachmentURL(),											
										)),											  
								));
								break;
							case 'file':
								echo ossn_plugin_view('output/url', array(
										'href' => $params['instance']->attachmentURL(),
										'text' => $params['instance']->attachmentName(),
										'target' => '_blank',
										'class' => 'ossn-message-attachment',
								));				
								break;
					}
				}
				?>                                
            </div>
        </div>
    </div>
</div>
