<?php  if(isset($params['params']) && isset($params['params']['entity'])){ ?>
<script>$(document).ready(function(){Ossn.commentTyping(<?php echo $params['params']['entity']->guid;?>, 'entity');});</script>
<div class="comments-realtime-status ctyping-entity-<?php echo $params['params']['entity']->guid;?>" data-type="entity" data-guid="<?php echo $params['params']['entity']->guid;?>" data-time="<?php echo time();?>">
	<div class="comments-item ctyping-c-item ctyping-hide">
    	<div class="ctyping-c-item-container">
    	<div class="row">
        	<div class="col-lg-12">
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
<?php } ?>