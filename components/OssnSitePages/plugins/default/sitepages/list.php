<?php
$list  = new OssnSitePages();
$all   = $list->getAll();
$count = $list->getAll(array(
		'count' => true,
));
if($all) {
		echo '<table class="mt-3 table table-striped">';
		foreach ($all as $page) {
			?>
  <tr>
    <td><?php echo $page->page_prefix;?></td>
    <td><?php echo ossn_print($page->language);?></td>
    <td><a class="badge bg-success" target="_blank" href="<?php echo ossn_site_url("administrator/component/OssnSitePages?page={$page->page_prefix}&language={$page->language}");?>"><?php echo ossn_print('sitepages:edit');?></a> <a class="badge bg-danger ms-2" href="<?php echo ossn_site_url("action/sitepage/delete?guid={$page->guid}", true);?>"><?php echo ossn_print('sitepages:delete');?></a></td>
  </tr>
        <?php
		}
		echo '</table>';
}