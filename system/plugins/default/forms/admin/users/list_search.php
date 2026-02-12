<?php
$search     = input('search_users');
?>
<div class="margin-top-10">
    <div class="ossn-admin-users-search-actions-header">
        
        <div class="ossn-admin-search-pro-line">
            <form method="post" action="">
                <input type="text" name="search_users" value="<?php echo $search;?>" placeholder="<?php echo ossn_print('search'); ?>..." autocomplete="off" />
                <button type="submit" class="btn-search-trigger">
                   <i class="fa-solid fa-magnifying-glass me-0"></i>
                </button>
            </form>
        </div>
        <a href="<?php echo ossn_site_url("administrator/adduser"); ?>" class="btn-pro-black-add">
            <i class="fa-solid fa-plus"></i>
            <?php echo ossn_print('add'); ?>
        </a>

    </div>
</div>