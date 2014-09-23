<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$sitename = ossn_site_settings('site_name');
if(isset($params['title'])){
$title = $params['title'].' : '.$sitename;
} else { 
$title = $sitename;
}
if(isset($params['contents'])){
$contents = $params['contents'];
} else { 
$contents = '';
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<?php echo ossn_fetch_extend_views('ossn/site/head'); ?>

<script>

<?php echo ossn_fetch_extend_views('ossn/js/head'); ?>

</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="<?php echo ossn_site_url(); ?>vendors/jquery/jquery.tokeninput.js"></script>

</head>

<body style="background:#edeff4;">
<div class="ossn-halt ossn-light"></div>
<div class="ossn-message-box"></div>
<div class="ossn-viewer" style="display:none"></div> 
<div class="ossn-system-messages">
     <?php
	 echo ossn_display_system_messages('site'); ?>
</div>
<?php if(!ossn_isLoggedin()){ ?>
<div class="ossn-header">
       <div class="inner">
             <a href="<?php echo ossn_site_url();?>"><div class="ossn-logo"></div></a>
            <?php echo  ossn_view_form('login', array('id' => 'ossn-header-login', 'action' => ossn_site_url('action/user/login'), 'method' => 'post'));?>

       </div>
</div>
<?php } else { ?>
 <div class="ossn-topbar">
    <div class="inner">
        <div class="logo-second"></div>
         <div class="ossn-search">
             <form action="<?php echo ossn_site_url("search");?>" method="get">
              <input type="text" name="q" placeholder="Search groups, friends and more"  onblur="if (this.value=='') { this.value='Search' }" onFocus="if (this.value=='Search') { this.value='' };"/>
             </form>
         </div>
         <div class="ossn-topbar-menu">
           <li>
           <a href="<?php echo ossn_site_url();?>u/<?php echo ossn_loggedin_user()->username;?>?ref=ossntb">
		   <img src="<?php echo ossn_site_url();?>avatar/<?php echo ossn_loggedin_user()->username;?>/smaller" height="19" width="19"/>
		   <span><?php echo ossn_loggedin_user()->first_name;?></span>           
           </a>
           </li>
                      <li>
                      <a href="<?php echo ossn_site_url();?>"><span><?php echo ossn_print('home');?></span></a>
                      </li>
                      
                     <?php echo ossn_view('components/OssnNotifications/page/topbar'); ?>

               <div class="ossn-topbar-dropdown-menu">
             <label class="ossn-topbar-dropdown-menu-button"><span class="arrow"></span></label>
               <ul class="ossn-topbar-dropdown-menu-content">
                 <li><a href="<?php echo ossn_site_url("u/".ossn_loggedin_user()->username."/edit");?>"><?php echo ossn_print('acount:settings');?></a></li>
                  <li><a href="<?PHP echo ossn_site_url();?>action/user/logout"><?php echo ossn_print('logout');?></a></li>
                </ul>
        
             </div> 
         </div>

    </div>
    <div class="ossn-notifications-box" style="height: 140px;">
       <div class="selected"></div>
       <div class="type-name"> <?php echo ossn_print('notifications');?> </div>
         <div class="metadata">
             <div style="height: 66px;"> 
                 <div class="ossn-loading ossn-notification-box-loading"></div>
             </div>
          <div class="bottom-all">
               <a href="#"><?php echo ossn_print('see:all');?></a>
          </div>
        </div>
    </div>
    
 </div>
 <div class="ossn-content-spacing"></div>
<?php } ?>

<div class="ossn-contents">
 <?php echo $contents; ?>
</div>
     <div class="ossn-footer">
        <div class="ossn-footer-inner">
         <div class="ossn-footer-copyrights">&copy; <a href="<?php echo ossn_site_url();?>"><?php echo $sitename;?></a> <?php echo date('Y'); ?></div>
         <div class="ossn-footer-menu">
          <?php echo ossn_view_menu('footer'); ?>
         </div>
        </div>
      </div>
<?php echo ossn_fetch_extend_views('ossn/page/footer'); ?>          
</body>
</html>
