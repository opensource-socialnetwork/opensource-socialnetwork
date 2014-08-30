<?php
$params['controls'] = (isset($params['controls'])) ? $params['controls']: '' ;
?>
<style>
.ossn-layout-module {
 border: 1px solid #D3D6DB;
 background:#fff;
 min-height:300px;
 margin-top:20px;
 border-radius:3px;
}
.ossn-layout-module .module-title {
	background:#F6F7F8;
	padding: 18px;	
    border-bottom: 1px solid #D3D6DB;
}
.ossn-layout-module .module-title .controls{
	float:right;
}
.ossn-layout-module .module-contents {
 padding:10px;	
}
.ossn-layout-module .module-title .title{
 font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
 font-size: 20px;
 font-weight: bold;
 height: 24px;
 line-height: 1;
 margin: 0 12px 5px;
}
</style>
<?php 
 if(isset($params['module_width'])){
	 $style = 'style="width:'.$params["module_width"].'"'; 
 } else { $style = ''; }
?><br />
<br />
<div class="ossn-layout-module" <?php echo $style;?>>
  <div class="module-title">
       <a class="title" href="#"><?php echo $params['title'];?></a>
     <div class="controls">
          <?php echo $params['controls'];?>
     </div>
  </div>
  <div class="module-contents">
   <?php echo $params['content'];?>
  </div>
</div>

<br />
<br />
<br />
<br />
