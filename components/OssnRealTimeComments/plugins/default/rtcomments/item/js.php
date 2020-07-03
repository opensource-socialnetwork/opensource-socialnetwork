<script>$(document).ready(function(){Ossn.commentTyping(<?php echo $params->guid;?>, 'post');});</script>
<div class="comments-realtime-status ctyping-post-<?php echo $params->guid;?>" data-type="post" data-guid="<?php echo $params->guid;?>" data-time="<?php echo time();?>">
	<div class="comments-item ctyping-c-item ctyping-hide">
    	<div class="ctyping-c-item-container">
    	<div class="row">
        	<div class="col-md-12">
           		 <div class="ctyping"> 
             		<span class="ctyping-circle ctyping-bouncing"></span> 
                	<span class="ctyping-circle ctyping-bouncing"></span> 
                    <span class="ctyping-circle ctyping-bouncing"></span>
                </div>
                <span class="ctyping-text"><?php echo ossn_print('rtcomments:typing');?></span>
        	</div>
    	</div>
        </div>
	</div>
</div>