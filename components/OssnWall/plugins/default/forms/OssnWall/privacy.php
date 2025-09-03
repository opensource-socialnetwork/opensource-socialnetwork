<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright (C) OpenTeknik LLC
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
echo '<p>' . ossn_print('post:select:privacy') . '</p>';
echo ossn_plugin_view('input/privacy', array(
		'value' => OSSN_PUBLIC,											 
));
?>
<script>
$('#ossn-wall-privacy-container input[name="privacy"]').attr('checked', false);
$('#ossn-wall-privacy-container input[value=' + $('#ossn-wall-privacy').val() + ']').attr('checked', true);
</script>
