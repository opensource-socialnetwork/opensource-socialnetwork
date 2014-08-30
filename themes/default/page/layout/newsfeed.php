<style>
body { background:#E9EAED; }
.ossn-layout-newsfeed {
  width: 970px;
  margin: 0 auto;
}
.ossn-layout-newsfeed .coloum-left {
width: 160px;
float:left;
display: inline-table;
}
.ossn-layout-newsfeed .coloum-middle {
width: 525px;
display: inline-table;
margin-left: 6px;
margin-right: 6px;
}
.ossn-layout-newsfeed .coloum-right {
width: 254px;
display: inline-table;

background: #FFF;
border: 1px solid;
border-color: #E5E6E9 #DFE0E4 #D0D1D5;
-webkit-border-radius: 3px;
float:right;
}
.ossn-layout-newsfeed .ossn-inner {
 width: 960px;
}

</style>
<div class="ossn-layout-newsfeed">
<div class="ossn-inner">
      <div class="coloum-left">
   &nbsp;
   <?php 
   if(ossn_is_hook('newsfeed', "left")){
	$newsfeed_left = ossn_call_hook('newsfeed', "left", NULL, array());
	echo implode('', $newsfeed_left);
   }
   ?>

      </div>  
      <div class="coloum-middle">
             <?php echo $params['content']; ?>
  
      </div>
      <div class="coloum-right">
           <div style="padding:12px;min-height:300px;"> 
              <?php echo ossn_view('components/OssnAds/page/view');?>
           </div>
      </div>
</div>
</div>