<style>
body { background:#fff;}
.ossn-layout-media {
  width: 990px;
  margin: 0 auto;
}
.ossn-layout-media .content{
   display:inline-table;
   width:736px;
}
.ossn-layout-media .sidebar {
 display:inline-table;
 width:240px;
 margin-left:11px;
}


</style>
<div class="ossn-layout-media"><br />
 <div class="content">  
   <?php echo $params['content']; ?>
  </div>
  <div class="sidebar">
               <?php echo ossn_view('components/OssnAds/page/view');?>
  </div> 
</div>