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
$expense       = new OssnExpenses;
$year          = input('year', '', date('Y'));
$user_guid     = ossn_loggedin_user()->guid;
$current_month = date('m');
$current_year  = date('Y');

$months_map = [
    '01' => 'jan', '02' => 'feb', '03' => 'mar', '04' => 'apr',
    '05' => 'may', '06' => 'jun', '07' => 'jul', '08' => 'aug',
    '09' => 'sep', '10' => 'oct', '11' => 'nov', '12' => 'dec',
];

$monthly_data  = [];
$chart_labels  = [];
$chart_values  = [];
$annual_total  = 0.0;
$highest_month = [
    'name'      => ossn_print('em:none'),
    'amount'    => 0.0,
    'formatted' => number_format(0, 2),
];
$active_months = 0;

foreach ($months_map as $num => $key) {
    $status      = $expense->getMonthStatus($user_guid, $num, $year);
    $raw_total   = $expense->getTotal($user_guid, $num, $year);
    $label       = ossn_print("em:month:{$key}");
    $numeric_val = (float) preg_replace('/[^0-9.-]/', '', (string) $raw_total);

    $is_current = ($current_month === $num && (string) $year === (string) $current_year);
    $is_faded   = (!$status && !$is_current);

    if ($numeric_val > 0) {
        $annual_total += $numeric_val;
        $active_months++;

        if ($numeric_val > $highest_month['amount']) {
            $highest_month = [
                'name'      => $label,
                'amount'    => $numeric_val,
                'formatted' => $raw_total,
            ];
        }
    }

    $chart_labels[] = $label;
    $chart_values[] = $numeric_val;

    $monthly_data[] = [
        'num'        => $num,
        'label'      => $label,
        'total'      => $raw_total,
        'is_faded'   => $is_faded,
        'is_current' => $is_current,
    ];
}

$monthly_avg     = $active_months > 0 ? ($annual_total / $active_months) : 0.0;
$safe_year       = ($year);
$safe_peak_month = ($highest_month['name']);

$annual_sub_text = ossn_print('em:annual:sub', array($active_months));
$peak_sub_text   = ossn_print('em:highest:spend:sub', array('<strong>' . $safe_peak_month . '</strong>'));
$dataset_label   = ossn_print('em:chart:dataset', array($safe_year));
$tooltip_prefix  = ossn_print('em:chart:tooltip:total');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="expense em-dashboard">
    <div class="em-header-bar">
        <h2 class="em-header-title">
            <span class="em-header-icon"><i class="fa fa-pie-chart"></i></span>
            <span><?php echo ossn_print('em:dashboard:title'); ?> &mdash; <?php echo $safe_year; ?></span>
        </h2>

        <form method="post" id="expense-select-year" class="ossn-form em-year-form">
            <label for="em-year-select"><?php echo ossn_print('em:year'); ?></label>
            <?php
            echo ossn_plugin_view('input/dropdown', array(
                'id'      => 'em-year-select',
                'name'    => 'year',
                'value'   => (int) $year,
                'options' => $expense->getYears($user_guid),
            ));
            ?>
        </form>
    </div>

    <div class="em-kpi-grid">
        <div class="em-kpi-card">
            <div class="em-kpi-label"><?php echo ossn_print('em:annual:total'); ?> (<?php echo $safe_year; ?>)</div>
            <div class="em-kpi-value"><?php echo number_format($annual_total, 2); ?></div>
            <div class="em-kpi-sub"><?php echo $annual_sub_text; ?></div>
        </div>

        <div class="em-kpi-card is-success">
            <div class="em-kpi-label"><?php echo ossn_print('em:monthly:avg'); ?></div>
            <div class="em-kpi-value"><?php echo number_format($monthly_avg, 2); ?></div>
            <div class="em-kpi-sub"><?php echo ossn_print('em:monthly:avg:sub'); ?></div>
        </div>

        <div class="em-kpi-card is-warning">
            <div class="em-kpi-label"><?php echo ossn_print('em:highest:spend'); ?></div>
            <div class="em-kpi-value"><?php echo ($highest_month['formatted']); ?></div>
            <div class="em-kpi-sub"><?php echo $peak_sub_text; ?></div>
        </div>
    </div>

    <div class="em-card">
        <div class="em-card-header">
            <div class="em-card-heading-left">
                <i class="fa fa-bar-chart"></i>
                <span><?php echo ossn_print('em:chart:title'); ?> (<?php echo $safe_year; ?>)</span>
            </div>
        </div>
        <div class="em-chart-wrapper">
            <canvas id="ossnExpenseChart"></canvas>
        </div>
    </div>

    <div class="em-card">
        <div class="em-card-header">
            <div class="em-card-heading-left">
                <i class="fa fa-calendar"></i>
                <span><?php echo ossn_print('em:breakdown:title'); ?></span>
            </div>
        </div>
        <div class="em-months-grid">
            <?php foreach ($monthly_data as $m): ?>
                <?php
                $classes = 'expense-month';
                if ($m['is_faded']) {
                    $classes .= ' expense-month-faded';
                }
                if ($m['is_current']) {
                    $classes .= ' is-current';
                }
                ?>
                <div class="<?php echo $classes; ?>" data-year="<?php echo $safe_year; ?>" data-month="<?php echo ($m['num']); ?>">
                    <div class="em-month-top">
                        <span class="expense-month-title"><?php echo ($m['label']); ?></span>
                        <?php if ($m['is_current']): ?>
                            <span class="em-badge-current"><?php echo ossn_print('em:badge:current'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="expense-month-total"><?php echo ($m['total']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('ossnExpenseChart');
    if (!canvas || typeof Chart === 'undefined') return;

    var labels        = <?php echo json_encode($chart_labels, JSON_UNESCAPED_UNICODE); ?>;
    var values        = <?php echo json_encode($chart_values); ?>;
    var datasetLabel  = <?php echo json_encode($dataset_label, JSON_UNESCAPED_UNICODE); ?>;
    var tooltipPrefix = <?php echo json_encode($tooltip_prefix, JSON_UNESCAPED_UNICODE); ?>;

    var ctx = canvas.getContext('2d');
    var barGradient = ctx.createLinearGradient(0, 0, 0, 280);
    barGradient.addColorStop(0, 'rgba(37, 99, 235, 0.9)');
    barGradient.addColorStop(1, 'rgba(59, 130, 246, 0.35)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: datasetLabel,
                data: values,
                backgroundColor: barGradient,
                hoverBackgroundColor: 'rgba(29, 78, 216, 0.95)',
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 44
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#f8fafc',
                    bodyColor: '#e2e8f0',
                    padding: 12,
                    cornerRadius: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            var formatted = Number(context.parsed.y || 0).toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            return tooltipPrefix.replace('%s', formatted);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#64748b',
                        font: { weight: '600', size: 12 }
                    }
                },
                y: {
                    beginAtZero: true,
                    border: { display: false },
                    grid: { color: '#f1f5f9' },
                    ticks: {
                        color: '#64748b',
                        font: { size: 12 }
                    }
                }
            },
            onClick: function(e, elements) {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var monthNum = String(index + 1).padStart(2, '0');
                    var monthCard = document.querySelector('.expense-month[data-month="' + monthNum + '"]');
                    if (monthCard) {
                        monthCard.click();
                    }
                }
            }
        }
    });
});
</script>