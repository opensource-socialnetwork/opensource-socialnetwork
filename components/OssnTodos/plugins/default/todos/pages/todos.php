<?php
$todos = new OssnTodos();
$items = $todos->getUserTodos(ossn_loggedin_user()->guid, 'all', 'newest');
$total_count = $items ? count($items) : 0;
$pending_count = $todos->getPendingCount(ossn_loggedin_user()->guid);
$completed_count = $total_count - $pending_count;
?>
<div class="ossntodos-wrapper">
    <div class="ossntodos-card">
        <!-- Header -->
        <div class="ossntodos-header">
            <div class="ossntodos-title-group">
                <div class="ossntodos-icon-box">
                    <i class="fa fa-check"></i>
                </div>
                <div>
                    <h4 class="ossntodos-heading mb-0"><?php echo ossn_print('ossntodos:title'); ?></h4>
                    <span class="ossntodos-subtitle">
                        <span id="ossntodos-pending-stat"><?php echo $pending_count; ?></span> <?php echo strtolower(ossn_print('ossntodos:filter:pending')); ?> &bull;
                        <span id="ossntodos-completed-stat"><?php echo $completed_count; ?></span> <?php echo strtolower(ossn_print('ossntodos:filter:completed')); ?>
                    </span>
                </div>
            </div>

            <div class="d-flex align-items-center flex-wrap gap-2">
				<button type="button" id="ossntodos-delete-all" class="ossntodos-delete-all-btn <?php echo ($total_count === 0) ? 'd-none' : ''; ?>">
        			<i class="fa fa-trash me-1"></i><?php echo ossn_print('ossntodos:delete:all'); ?>
    			</button>            
                <select id="ossntodos-sort" class="ossntodos-select ossntodos-sort-select">
                    <option value="newest"><?php echo ossn_print('ossntodos:sort:newest'); ?></option>
                    <option value="oldest"><?php echo ossn_print('ossntodos:sort:oldest'); ?></option>
                    <option value="due_date"><?php echo ossn_print('ossntodos:sort:due'); ?></option>
                    <option value="priority"><?php echo ossn_print('ossntodos:sort:priority'); ?></option>
                </select>

                <div class="ossntodos-tabs" role="group">
                    <button type="button" class="ossntodos-tab active ossntodos-filter" data-filter="all">
                        <?php echo ossn_print('ossntodos:filter:all'); ?>
                    </button>
                    <button type="button" class="ossntodos-tab ossntodos-filter" data-filter="pending">
                        <?php echo ossn_print('ossntodos:filter:pending'); ?>
                    </button>
                    <button type="button" class="ossntodos-tab ossntodos-filter" data-filter="completed">
                        <?php echo ossn_print('ossntodos:filter:completed'); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Add Composer -->
        <?php
        echo ossn_view_form('todos/add', array(
            'id' => 'ossntodos-add-form',
            'class' => 'ossntodos-composer',
            'action' => ossn_site_url('action/todos/add'),
            'component' => 'OssnTodos',
        ));
        ?>

        <!-- Task List -->
        <div class="ossntodos-list" id="ossntodos-list">
            <?php if ($items): ?>
                <?php foreach ($items as $item): ?>
                    <?php $done = ($item->is_completed == '1'); ?>
                    <div class="ossntodos-item <?php echo $done ? 'is-completed' : ''; ?>"
                         data-guid="<?php echo $item->guid; ?>"
                         data-status="<?php echo $done ? 'completed' : 'pending'; ?>"
                         data-priority="<?php echo $item->priority; ?>"
                         data-due="<?php echo $item->due_date; ?>"
                         data-title="<?php echo $item->title; ?>"
                         data-description="<?php echo $item->description; ?>">
                        <label class="ossntodos-check-wrap" for="todo-<?php echo $item->guid; ?>">
                            <input class="ossntodos-toggle" type="checkbox" value="<?php echo $item->guid; ?>" id="todo-<?php echo $item->guid; ?>" <?php echo $done ? 'checked' : ''; ?>>
                            <span class="ossntodos-checkmark"><i class="fa fa-check"></i></span>
                        </label>

                        <div class="ossntodos-item-body">
                            <div class="ossntodos-item-text">
                                <span class="ossntodos-item-title"><?php echo $item->title; ?></span>
                                <?php if (!empty($item->description)): ?>
                                    <p class="ossntodos-item-desc mb-0"><?php echo nl2br($item->description); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="ossntodos-meta">
                                <?php if ($item->priority === 'high'): ?>
                                    <span class="ossntodos-pill ossntodos-pill-high">
                                        <span class="ossntodos-dot"></span><?php echo ossn_print('ossntodos:priority:high'); ?>
                                    </span>
                                <?php elseif ($item->priority === 'low'): ?>
                                    <span class="ossntodos-pill ossntodos-pill-low">
                                        <span class="ossntodos-dot"></span><?php echo ossn_print('ossntodos:priority:low'); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (!empty($item->due_date)): ?>
                                    <span class="ossntodos-due">
                                        <i class="fa fa-calendar"></i> <?php echo $item->due_date; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="ossntodos-item-actions">
                            <button type="button" class="ossntodos-action-btn ossntodos-edit-btn" data-guid="<?php echo $item->guid; ?>" title="<?php echo ossn_print('ossntodos:edit'); ?>">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="ossntodos-action-btn ossntodos-delete" data-guid="<?php echo $item->guid; ?>" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="ossntodos-empty" id="ossntodos-empty">
                    <div class="ossntodos-empty-icon"><i class="fa fa-check-circle"></i></div>
                    <p class="mb-0"><?php echo ossn_print('ossntodos:empty'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>