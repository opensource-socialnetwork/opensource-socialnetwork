//<script>
$(document).ready(function() {
    var cYear = (new Date).getFullYear();
    var alldays = Ossn.Print('datepicker:days');
    var shortdays = alldays.split(",");
    var allmonths = Ossn.Print('datepicker:months');
    var shortmonths = allmonths.split(",");

    var datepick_args = {
        changeMonth: false,
        changeYear: false,
        dateFormat: 'dd/mm/yy',
        startDate: new Date($('.expense').attr('data-year'), $('.expense').attr('data-month') - 1, '01'),
        endDate: new Date($('.expense').attr('data-year'), $('.expense').attr('data-month') - 1, '31'),
        hideIfNoPrevNext: true,
    };
    if (Ossn.isLangString('datepicker:days')) {
        datepick_args['dayNamesMin'] = shortdays;
    }
    if (Ossn.isLangString('datepicker:months')) {
        datepick_args['monthNamesShort'] = shortmonths;
    }
    $("input[name='expnesedate']").datepicker(datepick_args);
    $("input[name='expnesedate']").datepicker('setDate', new Date());

    $('body').on('click', '.expense .remove-item', function() {
        var $count = $('.expense-form-item').length;
        if ($count > 1) {
            $('.expense-form-item:last').remove();
        }

        $count = $('.expense-form-item').length;
        if ($count === 1) {
            $('.expense .remove-item').addClass('hidden');
        }
    });

    $('body').on('click', '.expense .add-item', function() {
        var $html = '<div class="row expense-form-item">' +
            '<div class="col-md-6">' +
                '<div class="input-icon-wrapper item-icon">' +
                    '<input type="text" class="expense-input" name="items[]" placeholder="' + Ossn.Print('em:itemname') + '" />' +
                '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<div class="input-icon-wrapper price-icon">' +
                    '<input type="number" class="expense-input" name="price[]" step="0.01" placeholder="' + Ossn.Print('em:price') + '" />' +
                '</div>' +
            '</div>' +
        '</div>';

        $('.remove-item').removeClass('hidden');
        $('.expense .items-enter').append($html);
    });

    $('body').on('click', '.expense-item-delete', function(e) {
        e.preventDefault();
        var $url = $(this).attr('href');
        var $guid = $(this).attr('data-guid');
        var $row = $('.expense-lists-item-' + $guid);

        Ossn.PostRequest({
            url: $url,
            action: false,
            beforeSend: function() {
                $row.find('.ossn-loading').remove();
                $row.find('.expense-item-delete').hide();
                $row.find('.em-item-meta, .buttons').append('<div class="ossn-loading"></div>');
            },
            callback: function(callback) {
                if (callback == 1) {
                    var $ammount = parseFloat($row.find('.ammount').text()) || 0;
                    var $currentTotal = parseFloat($('.expense-list-container .total').text()) || 0;
                    var $ammount_new = Math.max(0, $currentTotal - $ammount);

                    $row.fadeOut('slow', function() {
                        $(this).remove();
                    });
                    $('.expense-list-container .total').text($ammount_new.toFixed(2));
                }
                if (callback == 0) {
                    $row.find('.ossn-loading').remove();
                    $row.find('.expense-item-delete').show();
                }
            }
        });
    });

    $('body').on('click', '.expense-search-list', function(e) {
        e.preventDefault();
        $('#expense-search').submit();
    });

    $('body').on('change', '.expense select[name="year"]', function() {
        $('#expense-select-year').submit();
    });

    $('body').on('click', '.expense-month', function() {
        if (!$(this).hasClass('expense-month-faded')) {
            Ossn.redirect('expensemanagement/view/' + $(this).attr('data-month') + '/' + $(this).attr('data-year'));
        }
    });
});