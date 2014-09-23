<style>

.ossn-message-error {
background-color: #f2dede;
border-color: #eed3d7;
border:1px solid;
border-radius:2px;

color: #b94a48;
padding: 20px;
}
.ossn-message-success {
	background-color: #dff0d8;
	border-color: #d6e9c6;
	border:1px solid;
    border-radius:2px;

	color: #468847;	
	padding: 20px;

}
</style>

<div class="ossn-layout-admin">
  <div class="sidebar">
     <?php 
	 //		  ossn_trigger_message('Test', 'success', 'admin');
	 echo ossn_view_admin_sidemenu(); ?>
  </div> 
  <div class="contents">  
     <div class="ossn-admin-message" style="margin-bottom: 15px;">
          <?php 
		  echo ossn_display_system_messages('admin'); ?>
     </div>
     <div class="title"> <?php echo $params['title']; ?></div>
     <div class="content">
           <?php echo $params['contents']; ?>
     </div>
   </div>
</div>

