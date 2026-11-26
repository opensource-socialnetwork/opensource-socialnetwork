//<script>
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$(document).ready(function() {
    function buildMetaHtml(priority, dueDate) {
        var html = '';
        if (priority === 'high') {
            html += '<span class="ossntodos-pill ossntodos-pill-high"><span class="ossntodos-dot"></span>' + Ossn.Print('ossntodos:priority:high') + '</span>';
        } else if (priority === 'low') {
            html += '<span class="ossntodos-pill ossntodos-pill-low"><span class="ossntodos-dot"></span>' + Ossn.Print('ossntodos:priority:low') + '</span>';
        }
        if (dueDate) {
            html += '<span class="ossntodos-due"><i class="fa fa-calendar"></i> ' + dueDate + '</span>';
        }
        return html;
    }

    function buildItemHtml(res) {
        var safeDesc = res.description || '';
        var descHtml = safeDesc ? '<p class="ossntodos-item-desc mb-0">' + safeDesc.replace(/\n/g, '<br>') + '</p>' : '';

        return '<div class="ossntodos-item" data-guid="' + res.guid + '" data-status="pending" data-priority="' + res.priority + '" data-due="' + (res.due_date || '') + '">' +
            '<div class="ossntodos-raw-title d-none">' + res.title + '</div>' +
            '<div class="ossntodos-raw-desc d-none">' + safeDesc + '</div>' +
            '<label class="ossntodos-check-wrap" for="todo-' + res.guid + '">' +
            '<input class="ossntodos-toggle" type="checkbox" value="' + res.guid + '" id="todo-' + res.guid + '">' +
            '<span class="ossntodos-checkmark"><i class="fa fa-check"></i></span>' +
            '</label>' +
            '<div class="ossntodos-item-body">' +
            '<div class="ossntodos-item-text">' +
            '<span class="ossntodos-item-title">' + res.title + '</span>' + descHtml +
            '</div>' +
            '<div class="ossntodos-meta">' + buildMetaHtml(res.priority, res.due_date) + '</div>' +
            '</div>' +
            '<div class="ossntodos-item-actions">' +
            '<button type="button" class="ossntodos-action-btn ossntodos-edit-btn" data-guid="' + res.guid + '" title="' + Ossn.Print('ossntodos:edit') + '"><i class="fa fa-edit"></i></button>' +
            '<button type="button" class="ossntodos-action-btn ossntodos-delete" data-guid="' + res.guid + '" title="Delete"><i class="fa fa-trash"></i></button>' +
            '</div>' +
            '</div>';
    }

    function syncCounters() {
        var total = $('#ossntodos-list .ossntodos-item').length;
        var pending = $('#ossntodos-list .ossntodos-item[data-status="pending"]').length;
        var completed = $('#ossntodos-list .ossntodos-item[data-status="completed"]').length;

        $('#ossntodos-pending-stat').text(pending);
        $('#ossntodos-completed-stat').text(completed);

        if (total > 0) {
            $('#ossntodos-delete-all').removeClass('d-none');
        } else {
            $('#ossntodos-delete-all').addClass('d-none');
        }

        var $badge = $('.ossntodos-nav-badge');
        if (pending > 0) {
            if ($badge.length) {
                $badge.text(pending);
            } else {
                $('.menu-section-item-todos a').append(' <span class="badge bg-primary rounded-pill ms-1 ossntodos-nav-badge">' + pending + '</span>');
            }
        } else {
            $badge.remove();
        }

        if (total === 0) {
            $('#ossntodos-list').html(
                '<div class="ossntodos-empty" id="ossntodos-empty">' +
                '<div class="ossntodos-empty-icon"><i class="fa fa-check-circle"></i></div>' +
                '<p class="mb-0">' + Ossn.Print('ossntodos:empty') + '</p>' +
                '</div>'
            );
        }
    }

    // Toggle note field in composer
    $(document).on('click', '.ossntodos-note-toggle', function() {
        $(this).toggleClass('active');
        $('.ossntodos-composer-note').toggleClass('d-none');
        if (!$('.ossntodos-composer-note').hasClass('d-none')) {
            $('.ossntodos-composer-note textarea').focus();
        }
    });

    // Add task via Ossn.ajaxRequest
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/todos/add',
        form: '#ossntodos-add-form',
        beforeSend: function() {
            $('#ossntodos-add-form .ossntodos-submit-btn').prop('disabled', true);
        },
        callback: function(res) {
            $('#ossntodos-add-form .ossntodos-submit-btn').prop('disabled', false);
            if (res && res.status === 'success') {
                $('#ossntodos-empty').remove();
                $('#ossntodos-list').prepend(buildItemHtml(res));
                $('#ossntodos-add-form')[0].reset();
                $('.ossntodos-composer-note').addClass('d-none');
                $('.ossntodos-note-toggle').removeClass('active');
                syncCounters();
            }
        }
    });

    // Toggle complete status
    $(document).on('change', '.ossntodos-toggle', function() {
        var $cb = $(this);
        var guid = $cb.val();
        var $item = $cb.closest('.ossntodos-item');
        Ossn.PostRequest({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/todos/toggle'),
            params: '&guid=' + guid,
            callback: function(res) {
                if (res && res.status === 'success') {
                    if (res.is_completed === '1') {
                        $item.addClass('is-completed').attr('data-status', 'completed');
                    } else {
                        $item.removeClass('is-completed').attr('data-status', 'pending');
                    }
                    syncCounters();
                }
            }
        });
    });

    // Open inline edit
    $(document).on('click', '.ossntodos-edit-btn', function(e) {
        e.preventDefault();
        var $item = $(this).closest('.ossntodos-item');
        if ($item.find('.ossntodos-inline-edit').length) {
            return;
        }
        var guid = $item.data('guid');
        var title = $item.find('.ossntodos-raw-title').text();
        var desc = $item.find('.ossntodos-raw-desc').text();
        var priority = $item.attr('data-priority') || 'normal';
        var due = $item.attr('data-due') || '';

        $item.find('.ossntodos-item-body, .ossntodos-item-actions').hide();

        var $editor = $('<div class="ossntodos-inline-edit">' +
            '<input type="text" class="ossntodos-input ossntodos-edit-title" style="padding-left:14px !important;">' +
            '<textarea rows="2" class="ossntodos-textarea ossntodos-edit-desc"></textarea>' +
            '<div class="ossntodos-inline-edit-row">' +
            '<select class="ossntodos-select ossntodos-edit-priority">' +
            '<option value="normal">' + Ossn.Print('ossntodos:priority:normal') + '</option>' +
            '<option value="high">' + Ossn.Print('ossntodos:priority:high') + '</option>' +
            '<option value="low">' + Ossn.Print('ossntodos:priority:low') + '</option>' +
            '</select>' +
            '<input type="date" class="ossntodos-date ossntodos-edit-due">' +
            '<button type="button" class="ossntodos-submit-btn ossntodos-edit-save">' + Ossn.Print('ossntodos:save') + '</button>' +
            '<button type="button" class="ossntodos-edit-cancel">' + Ossn.Print('ossntodos:cancel') + '</button>' +
            '</div>' +
            '</div>');

        $editor.find('.ossntodos-edit-title').val(title);
        $editor.find('.ossntodos-edit-desc').attr('placeholder', Ossn.Print('ossntodos:note:placeholder')).val(desc);
        $editor.find('.ossntodos-edit-priority').val(priority);
        $editor.find('.ossntodos-edit-due').val(due);
        $editor.find('.ossntodos-edit-save').attr('data-guid', guid);

        $item.append($editor);
    });

    // Cancel inline edit
    $(document).on('click', '.ossntodos-edit-cancel', function(e) {
        e.preventDefault();
        var $item = $(this).closest('.ossntodos-item');
        $item.find('.ossntodos-inline-edit').remove();
        $item.find('.ossntodos-item-body, .ossntodos-item-actions').show();
    });

    // Save inline edit
    $(document).on('click', '.ossntodos-edit-save', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var guid = $btn.attr('data-guid');
        var $item = $btn.closest('.ossntodos-item');
        var title = $item.find('.ossntodos-edit-title').val();
        var desc = $item.find('.ossntodos-edit-desc').val();
        var priority = $item.find('.ossntodos-edit-priority').val();
        var due = $item.find('.ossntodos-edit-due').val();

        $btn.prop('disabled', true);
        Ossn.PostRequest({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/todos/edit'),
            params: '&guid=' + guid +
                '&title=' + encodeURIComponent(title) +
                '&description=' + encodeURIComponent(desc) +
                '&priority=' + encodeURIComponent(priority) +
                '&due_date=' + encodeURIComponent(due),
            callback: function(res) {
                $btn.prop('disabled', false);
                if (res && res.status === 'success') {
                    var safeDesc = res.description || '';
                    $item.attr('data-priority', res.priority)
                         .attr('data-due', res.due_date || '');
                    $item.find('.ossntodos-raw-title').html(res.title);
                    $item.find('.ossntodos-raw-desc').html(safeDesc);

                    var descHtml = safeDesc ? '<p class="ossntodos-item-desc mb-0">' + safeDesc.replace(/\n/g, '<br>') + '</p>' : '';
                    $item.find('.ossntodos-item-text').html('<span class="ossntodos-item-title">' + res.title + '</span>' + descHtml);
                    $item.find('.ossntodos-meta').html(buildMetaHtml(res.priority, res.due_date));

                    $item.find('.ossntodos-inline-edit').remove();
                    $item.find('.ossntodos-item-body, .ossntodos-item-actions').show();
                }
            }
        });
    });

    // Delete single task
    $(document).on('click', '.ossntodos-delete', function() {
        var $btn = $(this);
        var guid = $btn.data('guid');
        var $item = $btn.closest('.ossntodos-item');
        Ossn.PostRequest({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/todos/delete'),
            params: '&guid=' + guid,
            callback: function(res) {
                if (res && res.status === 'success') {
                    $item.fadeOut(180, function() {
                        $(this).remove();
                        syncCounters();
                    });
                }
            }
        });
    });

    // Delete all tasks
    $(document).on('click', '#ossntodos-delete-all', function() {
        if (!confirm(Ossn.Print('ossntodos:delete:all:confirm'))) {
            return;
        }
        var $btn = $(this);
        $btn.prop('disabled', true);
        Ossn.PostRequest({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/todos/delete_all'),
            callback: function(res) {
                $btn.prop('disabled', false);
                if (res && res.status === 'success') {
                    $('#ossntodos-list .ossntodos-item').remove();
                    syncCounters();
                }
            }
        });
    });

    // Filter tabs (All / Pending / Completed)
    $('.ossntodos-filter').on('click', function() {
        $('.ossntodos-filter').removeClass('active');
        $(this).addClass('active');
        var filter = $(this).data('filter');
        $('.ossntodos-item').each(function() {
            var status = $(this).attr('data-status');
            if (filter === 'all' || status === filter) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Client-side instant sort
    $('#ossntodos-sort').on('change', function() {
        var mode = $(this).val();
        var $list = $('#ossntodos-list');
        var $items = $list.children('.ossntodos-item').get();
        var weights = { high: 1, normal: 2, low: 3 };

        $items.sort(function(a, b) {
            var $a = $(a), $b = $(b);
            if (mode === 'oldest') {
                return parseInt($a.data('guid'), 10) - parseInt($b.data('guid'), 10);
            } else if (mode === 'priority') {
                var wa = weights[$a.attr('data-priority')] || 2;
                var wb = weights[$b.attr('data-priority')] || 2;
                return wa - wb;
            } else if (mode === 'due_date') {
                var da = $a.attr('data-due') || '9999-12-31';
                var db = $b.attr('data-due') || '9999-12-31';
                return da.localeCompare(db);
            }
            return parseInt($b.data('guid'), 10) - parseInt($a.data('guid'), 10);
        });

        $.each($items, function(_, el) {
            $list.append(el);
        });
    });
});