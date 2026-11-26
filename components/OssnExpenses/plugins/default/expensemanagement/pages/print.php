<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$query  = input('query');
$month  = isset($params['month']) ? str_pad((string) $params['month'], 2, '0', STR_PAD_LEFT) : date('m');
$year   = isset($params['year']) ? (string) $params['year'] : date('Y');
$em     = new OssnExpenses;
$list   = $em->getList(ossn_loggedin_user()->guid, (int) $month, (int) $year, $query);

$prices    = array();
$rows      = array();
$itemCount = 0;

if (!empty($list) && is_array($list)) {
    foreach ($list as $item) {
        $price_val = (float) $item->price;
        $prices[]  = $price_val;
        $itemCount++;

        if (!empty($item->year) && !empty($item->month) && !empty($item->day)) {
            $item_year  = str_pad((string) $item->year, 4, '0', STR_PAD_LEFT);
            $item_month = str_pad((string) $item->month, 2, '0', STR_PAD_LEFT);
            $item_day   = str_pad((string) $item->day, 2, '0', STR_PAD_LEFT);
            $item_date  = "{$item_year}-{$item_month}-{$item_day}";
        } else {
            $ts        = !empty($item->time_created) ? (int) $item->time_created : time();
            $item_date = date('Y-m-d', $ts);
        }

        $rows[] = array(
            'guid'  => $item->guid,
            'date'  => $item_date,
            'title' => $item->title,
            'price' => number_format($price_val, 2, '.', ''),
        );
    }

    // Sort chronologically by expense date ascending for the printed sheet
    usort($rows, function ($a, $b) {
        return strcmp($a['date'], $b['date']);
    });
}

$sumtotal = !empty($prices) ? array_sum($prices) : 0.0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ossn_print('em:print'); ?> - <?php echo "{$month}/{$year}"; ?></title>
    <style>
        @page {
            size: A4 portrait;
            margin: 14mm;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.45;
            color: #0f172a;
            background: #e2e8f0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Screen toolbar (hidden during print) */
        .print-toolbar {
            max-width: 210mm;
            margin: 16px auto 0;
            padding: 0 4px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .print-action-btn {
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.15);
            transition: background 0.15s ease;
        }

        .print-action-btn:hover {
            background: #334155;
        }

        /* A4 Sheet Container */
        .sheet {
            width: 210mm;
            min-height: 297mm;
            margin: 14px auto 24px;
            padding: 16mm 16mm 18mm;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
            border-radius: 4px;
            display: flex;
            flex-direction: column;
        }

        /* Sheet Header */
        .sheet-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 14px;
            margin-bottom: 18px;
            border-bottom: 2px solid #0f172a;
        }

        .sheet-title-block .title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            color: #0f172a;
            margin: 0;
        }

        .sheet-subtitle {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
        }

        .sheet-meta {
            text-align: right;
        }

        .sheet-period {
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 4px 12px;
            border-radius: 6px;
            font-variant-numeric: tabular-nums;
        }

        .sheet-count {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }

        /* Expense Table */
        .expense-print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .expense-print-table thead th {
            background: #f8fafc;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 10px 12px;
            border-top: 1px solid #cbd5e1;
            border-bottom: 1.5px solid #94a3b8;
            text-align: left;
        }

        .expense-print-table thead th.col-date {
            width: 18%;
        }

        .expense-print-table thead th.col-item {
            width: 60%;
        }

        .expense-print-table thead th.col-price {
            width: 22%;
            text-align: right;
        }

        .expense-print-table tbody tr {
            page-break-inside: avoid;
        }

        .expense-print-table tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        .expense-print-table tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
            vertical-align: top;
        }

        .expense-print-table tbody td.col-date {
            color: #475569;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .expense-print-table tbody td.col-price {
            text-align: right;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .expense-print-table tfoot tr td {
            padding: 12px;
            background: #f1f5f9;
            border-top: 2px solid #0f172a;
            border-bottom: 2px solid #0f172a;
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .expense-print-table tfoot td.col-price {
            text-align: right;
            font-size: 15px;
            font-variant-numeric: tabular-nums;
        }

        .empty-row {
            text-align: center;
            padding: 28px 12px !important;
            color: #64748b !important;
            font-style: italic;
        }

        /* Print Media Overrides */
        @media print {
            body {
                background: #ffffff;
            }

            .print-toolbar {
                display: none !important;
            }

            .sheet {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body class="A4">
    <div class="print-toolbar">
        <button type="button" class="print-action-btn" onclick="window.print();">
            <?php echo ossn_print('em:print:btn'); ?>
        </button>
    </div>

    <section class="sheet">
        <header class="sheet-header">
            <div class="sheet-title-block">
                <h1 class="title"><?php echo ossn_print('em:print'); ?></h1>
                <div class="sheet-subtitle"><?php echo ossn_print('em:itemslist'); ?></div>
            </div>
            <div class="sheet-meta">
                <div class="sheet-period"><?php echo "{$month}/{$year}"; ?></div>
                <div class="sheet-count"><?php echo ossn_print('em:items:count', array($itemCount)); ?></div>
            </div>
        </header>

        <table class="expense-print-table">
            <thead>
                <tr>
                    <th class="col-date"><?php echo ossn_print('em:date'); ?></th>
                    <th class="col-item"><?php echo ossn_print('em:itemname'); ?></th>
                    <th class="col-price"><?php echo ossn_print('em:price'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr class="expense-lists-item-<?php echo $row['guid']; ?>">
                            <td class="col-date"><?php echo $row['date']; ?></td>
                            <td class="col-item"><?php echo $row['title']; ?></td>
                            <td class="col-price"><?php echo $row['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-row"><?php echo ossn_print('em:empty:list'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><?php echo ossn_print('em:total'); ?></td>
                    <td class="col-price"><span class="total"><?php echo number_format($sumtotal, 2, '.', ''); ?></span></td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>
</html>