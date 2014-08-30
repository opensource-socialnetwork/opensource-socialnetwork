<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
/*
* Core Contact us form
*/ 

?>
<script type="text/javascript" src="<?php echo bframework_get_core_url(); ?>js.js?bframework_corejs=jquery/jquery-1.6.4.min"></script>
<script type="text/javascript">
$(function(){$('#contactus').submit(function(e){e.preventDefault();var form = $(this);var post_url = form.attr('action');var post_data = form.serialize();$('#loader', form).html('<img src="<?php echo bframework_get_core_url();?>media/loaders/ajax-loader.gif" /> Please Wait...');$.ajax({type: 'POST',url: post_url,data: post_data,success: function(msg) {$(form).fadeOut(500, function(){form.html(msg).fadeIn();});}});});});
</script>
    <div>
	<?php echo  bframework_view_label(array(
	             'attributes' => array('for' => 'name'),
				 'name' => bframework_core_print('bframework:form:name')
				 )); ?>
<br />
           <?php echo bframework_view_input(array(
	                         'name' => 'name',
		                     'type' => 'text',
							 'placeholder' => bframework_core_print('bframework:form:name'),
							 'id' => 'email',
		)); ?>
</div>

    <div>
	<?php echo  bframework_view_label(array(
	             'attributes' => array('for' => 'email'),
				 'name' => bframework_core_print('bframework:form:email')
				 )); ?>
<br />
       <?php echo bframework_view_input(array(
	                         'name' => 'email',
		                     'type' => 'text',
							 'placeholder' => bframework_core_print('bframework:form:email'),
							 'id' => 'email',
		)); ?>


</div>

	<div>
		<?php echo  bframework_view_label(array(
	             'attributes' => array('for' => 'mesage'),
				 'name' => bframework_core_print('bframework:form:message')
				 )); ?>
	  <br/>
         <?php echo bframework_view_textarea(array(
		                       'name'=> 'message',
							   'id' => 'message',
							   'cols' => '40', 
							   'rows' => '8',
							   'placeholder' => bframework_core_print('bframework:form:message'),

          ));?>
</div>

	<div id="loader">
        <?php echo bframework_view_input(array(
		                     'type' => 'submit',
							 'value' => bframework_core_print('bframework:form:submit')
		)); ?>

    </div>
