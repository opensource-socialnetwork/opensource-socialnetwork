<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
if($params['background'] !== false){
echo '<style>body { background:#FDFDFD; }</style>';
}
echo '<div class="ossn-layout-contents">';
echo $params['content'];
echo '</div>';
