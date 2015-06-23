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
?>
<div class="row margin-bottom-10 margin-top-10">
    <a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=terms"); ?>"
       class="btn btn-primary">
        <?php echo ossn_print('site:terms'); ?></a>
    <a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=about"); ?>"
       class="btn btn-primary">
        <?php echo ossn_print('site:about'); ?></a>
    <a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=privacy"); ?>"
       class="btn btn-primary">
        <?php echo ossn_print('site:privacy'); ?></a>
</div>
<?php
$settings = input('settings');
if (empty($settings)) {
    $settings = 'terms';
}
switch ($settings) {
    case 'terms':
        $params = array(
            'action' => ossn_site_url() . 'action/sitepage/edit/terms',
            'component' => 'OssnSitePages',
        );
        echo ossn_view_form('terms', $params, false);
        break;
    case 'about':
        $params = array(
            'action' => ossn_site_url() . 'action/sitepage/edit/about',
            'component' => 'OssnSitePages',
        );
        echo ossn_view_form('about', $params, false);
        break;
    default:
    case 'privacy':
        $params = array(
            'action' => ossn_site_url() . 'action/sitepage/edit/privacy',
            'component' => 'OssnSitePages',
        );
        echo ossn_view_form('privacy', $params, false);
        break;
    default:
        break;

}
?>
