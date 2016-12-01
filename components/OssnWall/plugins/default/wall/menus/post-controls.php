<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$postcontrols = $params['menu'];
if($postcontrols){
?>
<a id="dLabel" role="button" data-toggle="dropdown" class="btn" data-target="#">
	<i class="fa fa-sort-desc"></i>
</a>
<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
            <?php
                foreach ($postcontrols as $menu) {
                    foreach ($menu as $link) {
					 	$class = "post-control-".$link['name'];
					 	if(isset($link['class'])){
							$link['class'] = $class.' '.$link['class'];	
						} else {
							$link['class'] = $class;
						}						
						unset($link['name']);
						$link = ossn_plugin_view('output/url', $link);						
                        ?>
                        <li><?php echo $link; ?></li>
                    <?php
                    }
                }
            ?>
    </ul>
<?php 
}
