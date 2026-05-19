//<script>
$(document).ready(function () {
    var $fileInput = $('#ossn_ads_file');
    var $dropzone = $('#ossn-ad-dropzone');
    var $previewWrapper = $('#ossn-ad-preview-wrapper');
    var $previewImg = $('#ossn-ad-preview-img');
    var $removeBtn = $('#ossn-ad-remove-file-btn');
    var $descInput = $('#ossn-ad-description-input');
    var $charCounter = $('#ossn-ad-desc-counter');
    var maxChars = 250;

    // --- Character Counter ---
    $descInput.on('input', function () {
        var remaining = maxChars - this.value.length;
        
        // Fully accurate: Leverages the native Ossn.Print system method
        $charCounter.text(Ossn.Print('ad:char:left', [remaining]));

        if (remaining <= 20) {
            $charCounter.css({
                'background-color': '#fff5f5',
                'color': '#c53030'
            });
        } else {
            $charCounter.css({
                'background-color': '#e2e8f0',
                'color': '#4a5568'
            });
        }
    });

    // --- Central File Processing & Verification Stream ---
    function processFile(file) {
        if (!file) return;

        // Strict mime-type image validation catch execution logic
        if (!file.type.match(/^image\//)) {
            $fileInput.val('');
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            $previewImg.attr('src', e.target.result);
            $previewWrapper.removeClass('hidden');
            $dropzone.addClass('hidden');
        };
        reader.readAsDataURL(file);
    }

    // --- Browser Manual Window Input Actions ---
    $fileInput.on('change', function () {
        if (this.files && this.files[0]) {
            processFile(this.files[0]);
        }
    });

    // --- Streamlined jQuery Drag & Drop Interaction Matrix ---
    $dropzone.on('dragenter dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $dropzone.addClass('drag-over');
    });

    $dropzone.on('dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $dropzone.removeClass('drag-over');
    });

    $dropzone.on('drop', function (e) {
        var dataTransfer = e.originalEvent.dataTransfer;
        if (dataTransfer && dataTransfer.files && dataTransfer.files[0]) {
            // Re-assign data values natively onto input node DOM tracking indices
            $fileInput[0].files = dataTransfer.files;
            processFile(dataTransfer.files[0]);
        }
    });

    // --- Interactive Visual Element Restructure ---
    $removeBtn.on('click', function (e) {
        e.preventDefault();
        $fileInput.val('');
        $previewImg.attr('src', '#');
        $previewWrapper.addClass('hidden');
        $dropzone.removeClass('hidden');
    });
}); // Cleanly terminates here. Extra trailing block removed.