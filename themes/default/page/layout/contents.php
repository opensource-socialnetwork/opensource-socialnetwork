<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
if($params['background'] !== false){
echo '<style>body { background:#E9EAED; }</style>';
}
echo '<div class="ossn-layout-contents">';
echo $params['content'];
echo '</div>';
