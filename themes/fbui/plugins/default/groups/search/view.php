<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if ($params['groups']) {
    echo "<div class='fbui-group-search-container'>";
    foreach ($params['groups'] as $group) {
        $owner = ossn_user_by_guid($group->owner_guid);
        $cover_url = $group->coverURL();
        
        // Check if group has a custom cover/photo, otherwise we fallback to a clean icon representation
        $has_cover = !empty($cover_url) && strpos($cover_url, 'search_group.png') === false;
        
        // Get total member count using getMembers(true)
        $members_count = $group->getMembers(true);
        
        // Determine group type (Public / Closed)
        $group_type = ($group->access == OSSN_PUBLIC) ? ossn_print('public') : ossn_print('closed');
        ?>
        
        <div class="fbui-group-search-card">
            <div class="fbui-group-search-left">
                <div class="fbui-group-search-thumb">
                    <?php if ($has_cover) { ?>
                        <img src="<?php echo $cover_url; ?>" alt="<?php echo htmlspecialchars($group->title); ?>" />
                    <?php } else { ?>
                        <div class="fbui-group-default-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    <?php } ?>
                </div>
                <div class="fbui-group-search-info">
                    <a class="fbui-group-search-title" href="<?php echo ossn_site_url(); ?>group/<?php echo $group->guid; ?>">
                        <?php echo htmlspecialchars($group->title); ?>
                    </a>
                    <div class="fbui-group-search-meta">
                        <span><?php echo ucfirst($group_type); ?></span> &middot; 
                        <span><?php echo $members_count; ?> <?php echo ossn_print('members'); ?></span>
                    </div>
                </div>
            </div>
            <div class="fbui-group-search-right">
                <a href="<?php echo ossn_site_url(); ?>group/<?php echo $group->guid; ?>" class="fbui-group-action-btn">
                    <?php echo ossn_print('fbui:search:group:visit'); ?>
                </a>
            </div>
        </div>

    <?php
    }
    echo "</div>";
}
?>
<script>
$(document).ready(function() {
    $('.fbui-group-search-container').closest('.newsfeed-middle').removeClass('ossn-page-contents');
});
</script>