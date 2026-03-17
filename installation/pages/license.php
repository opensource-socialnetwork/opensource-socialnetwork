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
?>
<header class="content-header">
    <h1><?php echo ossn_installation_print('ossn:license:title'); ?></h1>
    <p><?php echo ossn_installation_print('ossn:license:desc'); ?></p>
</header>
<?php 
echo '<div id="ossnlicense" style="background: #f9f9f9; padding: 20px; border-radius: 3px; border: 2px dashed #eee;">';
echo nl2br(file_get_contents(dirname(dirname(dirname(__FILE__))) . '/LICENSE.md'));
echo "</div>";
echo '<a href="/installation/" class="installer-btn btn-cancel">Back</a>';
echo '<a href="' . ossn_installation_paths()->url . '?page=settings" class="ms-2 installer-btn btn-primary mt-2">'.ossn_installation_print('ossn:install:next').'</a>';
?>
<script type="module">
    import { marked } from 'https://cdn.jsdelivr.net/npm/marked@4.0.12/lib/marked.esm.min.js';

    const markdownContent = document.getElementById('ossnlicense').textContent;
    const htmlContent = marked(markdownContent);
    document.getElementById('ossnlicense').innerHTML = htmlContent;
</script>