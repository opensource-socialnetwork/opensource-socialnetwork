<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$query     = input('query');
$year      = isset($params['year']) ? $params['year'] : date('Y');
$month     = isset($params['month']) ? $params['month'] : date('m');
$em        = new OssnExpenses;
$list      = $em->getList(ossn_loggedin_user()->guid, $month, $year, $query);

$grouped_items = [];
$prices        = [];
$itemCount     = 0;

if (!empty($list) && is_array($list)) {
    foreach ($list as $item) {
        $price_val = (float) $item->price;
        $prices[]  = $price_val;
        $itemCount++;

        $ts = !empty($item->time_created) ? (int) $item->time_created : time();

        if (!empty($item->year) && !empty($item->month) && !empty($item->day)) {
            $item_year  = str_pad((string) $item->year, 4, '0', STR_PAD_LEFT);
            $item_month = str_pad((string) $item->month, 2, '0', STR_PAD_LEFT);
            $item_day   = str_pad((string) $item->day, 2, '0', STR_PAD_LEFT);
            $date_key   = "{$item_year}-{$item_month}-{$item_day}";
        } else {
            $date_key = date('Y-m-d', $ts);
        }

        if (!isset($grouped_items[$date_key])) {
            $grouped_items[$date_key] = [
                'subtotal' => 0.0,
                'items'    => [],
            ];
        }

        $grouped_items[$date_key]['subtotal'] += $price_val;
        $grouped_items[$date_key]['items'][]   = [
            'item' => $item,
            'time' => date('H:i', $ts),
        ];
    }

    krsort($grouped_items);
}

$sumtotal = !empty($prices) ? array_sum($prices) : 0.0;
?>

<div class="expense em-add-page" data-year="<?php echo $year; ?>" data-month="<?php echo $month; ?>">
    <div class="em-workspace">
        <!-- Left Column: Add Form + Search -->
        <div class="em-left-pane">
            <?php
            echo ossn_view_form('expensemanagement/add', array(
                'action' => ossn_site_url('action/expense/management/add'),
            ));
            ?>

            <div class="expense-tools-container">
                <div class="ossn-widget">
                    <div class="widget-heading">
                        <span><i class="fa fa-cogs"></i><?php echo ossn_print('em:tools'); ?></span>
                    </div>
                    <div class="widget-contents">
                        <form method="post" class="ossn-form em-search-form" id="expense-search">
                            <div class="em-search-group">
                                <input
                                    type="text"
                                    id="expense-search-input"
                                    name="query"
                                    value="<?php echo $query; ?>"
                                    placeholder="<?php echo ossn_print('em:search:placeholder'); ?>"
                                />
                                <a href="javascript:void(0);" class="expense-search-list" title="<?php echo ossn_print('em:search:btn'); ?>">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Date-Grouped Expense List -->
        <div class="em-right-pane">
            <div class="expense-list-container">
                <div class="ossn-widget">
                    <div class="widget-heading">
                        <span><i class="fa fa-bars"></i><?php echo ossn_print('em:itemslist'); ?></span>
                        <div class="em-heading-actions">
                            <span class="em-count-pill"><?php echo ossn_print('em:items:count', array($itemCount)); ?></span>
                            <a
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-success btn-sm em-print-btn"
                                href="<?php echo ossn_site_url("expensemanagement/print/{$month}/{$year}"); ?>"
                            >
                                <i class="fa fa-print"></i>
                                <span><?php echo ossn_print('em:print:btn'); ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="widget-contents">
                        <?php if (!empty($grouped_items)): ?>
                            <div class="em-groups">
                                <?php foreach ($grouped_items as $date_key => $group): ?>
                                    <div class="em-date-group">
                                        <div class="em-date-header">
                                            <span class="em-date-label">
                                                <i class="fa fa-calendar-o"></i>
                                                <span><?php echo $date_key; ?></span>
                                            </span>
                                            <span class="em-date-subtotal">
                                                <?php echo ossn_print('em:total'); ?><?php echo number_format($group['subtotal'], 2, '.', ''); ?>
                                            </span>
                                        </div>
                                        <div class="em-group-items">
                                            <?php foreach ($group['items'] as $entry): ?>
                                                <?php $item = $entry['item']; ?>
                                                <div class="em-item-row expense-lists-item-<?php echo $item->guid; ?>">
                                                    <div class="em-item-main">
                                                        <span class="em-item-title"><?php echo $item->title; ?></span>
                                                        <span class="em-item-time"><?php echo $entry['time']; ?></span>
                                                    </div>
                                                    <div class="em-item-meta">
                                                        <span class="ammount"><?php echo $item->price; ?></span>
                                                        <a
                                                            href="<?php echo ossn_site_url("action/expense/management/delete?guid={$item->guid}", true); ?>"
                                                            data-guid="<?php echo $item->guid; ?>"
                                                            class="badge bg-danger text-white expense-item-delete"
                                                            title="<?php echo ossn_print('em:delete:item'); ?>"
                                                        >&minus;</a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="em-empty-state">
                                <?php echo ossn_print('em:empty:list'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="em-grand-total">
                            <span><?php echo ossn_print('em:itemslist'); ?></span>
                            <span><?php echo ossn_print('em:total'); ?><span class="total"><?php echo number_format($sumtotal, 2, '.', ''); ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>