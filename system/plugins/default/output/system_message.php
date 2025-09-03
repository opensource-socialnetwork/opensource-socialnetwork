<?php
	$toastId = "ossn-system-message-item-".time().rand();
?>
<div id="<?php echo $toastId;?>" class="toast align-items-center text-bg-<?php echo $params['type'];?> border-0 mt-2 mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="10000">
	<div class="d-flex">
        <div class="toast-body"><?php echo $params['message'];?></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
	</div>
</div>        
<script>
  $(function () {
    var $toastEl = $('#<?php echo $toastId; ?>');
    if ($toastEl.length) {
      var toast = new bootstrap.Toast($toastEl[0]);
      toast.show();

      $toastEl.on('hidden.bs.toast', function () {
        $(this).remove(); //remove toast element after it hides
      });
    }
  });
</script>