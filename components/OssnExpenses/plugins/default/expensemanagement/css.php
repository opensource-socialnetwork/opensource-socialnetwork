/**** <style> ***/
.menu-section-expensemanagement .fa-angle-right:before {
    font-family: FontAwesome Free 5;
    content: "\f24e" !important;
}
.menu-section-item-expensemanagement-currentmonth:before {
    font-family: FontAwesome Free 5;
    content: "\f274" !important;
}
.menu-section-item-expensemanagement:before {
    font-family: FontAwesome Free 5;
    content: "\f0c9" !important;
}
.expense-input,
.expense input[type='number']{
    width: 100%;
    margin-bottom: 5px;
    outline: none;
    display: block;
}	
.expense-tools-container .fa {
	margin-right:0;	
}

.expense-tools-container .fa {
	margin-right:0;	
}

.expense-add-container .input-icon-wrapper::before {
    position: absolute;
    top: 50%;
    left: 12px;                  
    transform: translateY(-50%); 
    color: #a0a0a0;              
    font-size: 14px;         
    z-index: 2;
    pointer-events: none;      
    
    font-family: "Font Awesome 5 Free", "Font Awesome 6 Free", "FontAwesome";
    font-weight: 900; 
}
.expense-add-container .item-icon::before {
    content: "\f290"; 
}
.expense-add-container .price-icon::before {
    content: "\f155";
}
.expense-add-container .input-icon-wrapper .expense-input {
    padding-left: 35px !important; 
}
.em-dashboard {
    --em-bg: #f8fafc;
    --em-surface: #ffffff;
    --em-border: #e2e8f0;
    --em-text: #0f172a;
    --em-muted: #64748b;
    --em-subtle: #94a3b8;
    --em-primary: #2563eb;
    --em-primary-soft: #eff6ff;
    --em-success: #10b981;
    --em-warning: #f59e0b;
    --em-radius: 14px;
    --em-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(15, 23, 42, 0.04);

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: var(--em-text);
}

.em-header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    padding: 18px 22px;
    border-radius: var(--em-radius);
    border: 1px solid var(--em-border);
    box-shadow: var(--em-shadow);
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 14px;
}
.em-header-title {
    margin: 0;
    font-size: 19px;
    font-weight: 700;
    letter-spacing: -0.015em;
    color: var(--em-text);
    display: flex;
    align-items: center;
    gap: 10px;
}
.em-header-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;

    background: var(--em-primary-soft);
    color: var(--em-primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}
.em-year-form {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}
.em-year-form label {
    margin: 0;
    font-weight: 600;
    font-size: 12px;
    color: var(--em-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.em-year-form select {
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    padding: 7px 14px;
    font-weight: 600;
    color: var(--em-text);
    background-color: var(--em-surface);
    cursor: pointer;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
.em-year-form select:focus {
    outline: none;
    border-color: var(--em-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.em-kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 16px;
    margin-bottom: 20px;
}
.em-kpi-card {
    background: var(--em-surface);
    padding: 20px;
    border-radius: var(--em-radius);
    border: 1px solid var(--em-border);
    box-shadow: var(--em-shadow);
    position: relative;
    overflow: hidden;
}
.em-kpi-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--em-primary);
}
.em-kpi-card.is-success::before { background: var(--em-success); }
.em-kpi-card.is-warning::before { background: var(--em-warning); }

.em-kpi-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--em-muted);
    margin-bottom: 8px;
}
.em-kpi-value {
    font-size: 24px;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--em-text);
    line-height: 1.2;
}
.em-kpi-sub {
    font-size: 12px;
    color: var(--em-subtle);
    margin-top: 6px;
}

.em-card {
    background: var(--em-surface);
    border-radius: var(--em-radius);
    border: 1px solid var(--em-border);
    box-shadow: var(--em-shadow);
    padding: 22px;
    margin-bottom: 20px;
}
.em-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 15px;
    font-weight: 700;
    color: var(--em-text);
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}
.em-card-heading-left {
    display: flex;
    align-items: center;
    gap: 9px;
}
.em-card-heading-left i {
    color: var(--em-primary);
}
.em-chart-wrapper {
    position: relative;
    height: 290px;
    width: 100%;
}

.em-months-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(175px, 1fr));
    gap: 14px;
}
.expense-month {
    background: var(--em-surface);
    border: 1px solid var(--em-border);
    border-radius: 12px;
    padding: 16px;
    cursor: pointer;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease, opacity 0.18s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 92px;
}
.expense-month:hover {
    transform: translateY(-3px);
    border-color: var(--em-primary);
    box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.14);
}
.expense-month.is-current {
    border-color: var(--em-primary);
    background: linear-gradient(180deg, var(--em-primary-soft) 0%, #ffffff 100%);
    box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.25);
}
.expense-month-faded {
    opacity: 0.55;
    background: var(--em-bg);
}
.expense-month-faded:hover {
    opacity: 1;
    background: var(--em-surface);
}
.em-month-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 6px;
    margin-bottom: 10px;
}
.expense-month-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--em-muted);
}
.em-badge-current {
    font-size: 10px;
    font-weight: 700;
    background: var(--em-primary);
    color: #ffffff;
    padding: 2px 8px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.expense-month-total {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.015em;
    color: var(--em-text);
}
div.ui-datepicker-header a.ui-datepicker-prev,
div.ui-datepicker-header a.ui-datepicker-next {
    display: none;
}

.em-add-page {
    --em-bg: #f8fafc;
    --em-surface: #ffffff;
    --em-border: #e2e8f0;
    --em-text: #0f172a;
    --em-muted: #475569;
    --em-icon: #334155;
    --em-accent-bg: #f1f5f9;
    --em-radius: 14px;
    --em-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(15, 23, 42, 0.04);

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: var(--em-text);
}

/* Two-Column Workspace Layout */
.em-workspace {
    display: grid;
    grid-template-columns: minmax(320px, 410px) minmax(0, 1fr);
    gap: 20px;
    align-items: start;
}

@media (max-width: 991px) {
    .em-workspace {
        grid-template-columns: 1fr;
    }
}

.em-left-pane {
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: sticky;
    top: 20px;
}

@media (max-width: 991px) {
    .em-left-pane {
        position: static;
    }
}

.em-right-pane {
    min-width: 0;
}

/* Shared Card Styling */
.em-add-page .ossn-widget {
    background: var(--em-surface);
    border: 1px solid var(--em-border);
    border-radius: var(--em-radius);
    box-shadow: var(--em-shadow);
    overflow: hidden;
    margin-bottom: 0;
}

.em-add-page .widget-heading {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-bottom: 1px solid #f1f5f9;
    padding: 15px 20px;
    font-size: 15px;
    font-weight: 700;
    color: var(--em-text);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.em-add-page .widget-heading i.fa:not(.em-print-btn i) {
    color: var(--em-icon) !important;
    margin-right: 7px;
    float: none;
}

.em-add-page .widget-contents {
    padding: 20px;
}

/* Tools Card (Search + Print) */
.em-tools-stack {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.em-search-form {
    margin: 0 !important;
    padding: 0 !important;
    width: 100%;
}

.em-search-group {
    display: flex;
    align-items: stretch;
    width: 100%;
    height: 40px;
    border: 1px solid #cbd5e1;
    border-radius: 9px;
    overflow: hidden;
    background: var(--em-bg);
    transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.em-search-group:focus-within {
    background: var(--em-surface);
    border-color: #334155;
    box-shadow: 0 0 0 3px rgba(51, 65, 85, 0.12);
}

.em-add-page .ossn-form .em-search-group input[type="text"],
.em-search-group input[type="text"] {
    flex: 1 1 auto !important;
    width: 100% !important;
    min-width: 0 !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 13px !important;
    border: none !important;
    border-radius: 0 !important;
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
    font-size: 14px !important;
    color: var(--em-text) !important;
}

.em-search-group .expense-search-list {
    flex: 0 0 44px;
    border: none !important;
    border-left: 1px solid #cbd5e1 !important;
    border-radius: 0 !important;
    background: #f1f5f9;
    color: var(--em-icon) !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.15s ease, color 0.15s ease;
}

.em-search-group .expense-search-list:hover {
    background: #1e293b;
    color: #ffffff !important;
}

.em-search-group .expense-search-list i.fa {
    color: inherit !important;
    margin: 0 !important;
}


/* Right Column: Date-Grouped List */
.em-count-pill {
    font-size: 11px;
    font-weight: 600;
    color: var(--em-muted);
    background: var(--em-bg);
    border: 1px solid var(--em-border);
    padding: 3px 10px;
    border-radius: 999px;
}

.em-groups {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.em-date-group {
    border: 1px solid var(--em-border);
    border-radius: 12px;
    overflow: hidden;
    background: var(--em-surface);
}

.em-date-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 16px;
    background: var(--em-bg);
    border-bottom: 1px solid var(--em-border);
    font-size: 13px;
    font-weight: 700;
    color: #334155;
}

.em-date-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.em-date-label i.fa {
    color: var(--em-icon) !important;
}

.em-date-subtotal {
    font-variant-numeric: tabular-nums;
    color: var(--em-text);
    background: var(--em-surface);
    border: 1px solid var(--em-border);
    padding: 2px 10px;
    border-radius: 999px;
    font-size: 12px;
}

.em-group-items {
    display: flex;
    flex-direction: column;
}

.em-item-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.15s ease;
}

.em-item-row:last-child {
    border-bottom: none;
}

.em-item-row:hover {
    background: #f8fafc;
}

.em-item-main {
    display: flex;
    flex-direction: column;
    gap: 2px;
    flex: 1 1 auto;
    min-width: 0;
}

.em-item-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--em-text);
    word-break: break-word;
}

.em-item-time {
    font-size: 11px;
    color: #64748b;
    font-variant-numeric: tabular-nums;
}

.em-item-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
}

.em-item-row .ammount {
    font-size: 14px;
    font-weight: 700;
    font-variant-numeric: tabular-nums;
    color: var(--em-text);
    text-align: right;
}

.em-item-row .expense-item-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 999px;
    font-weight: 700;
    line-height: 1;
    text-decoration: none;
    transition: transform 0.15s ease, opacity 0.15s ease;
}

.em-item-row .expense-item-delete:hover {
    transform: scale(1.08);
    opacity: 0.92;
}

.em-grand-total {
    margin-top: 18px;
    padding: 14px 18px;
    border-radius: 12px;
    background: var(--em-accent-bg);
    border: 1px solid var(--em-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-size: 15px;
    font-weight: 700;
    color: var(--em-text);
}

.em-grand-total .total {
    font-variant-numeric: tabular-nums;
    font-size: 17px;
}

.em-empty-state {
    text-align: center;
    padding: 36px 16px;
    color: var(--em-muted);
    font-size: 14px;
    border: 1px dashed #cbd5e1;
    border-radius: 12px;
    background: var(--em-bg);
}
.em-form-wrapper {
    --em-bg: #f8fafc;
    --em-surface: #ffffff;
    --em-border: #e2e8f0;
    --em-text: #0f172a;
    --em-muted: #475569;
    --em-icon: #334155;
    --em-radius: 14px;
    --em-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(15, 23, 42, 0.04);

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: var(--em-text);
    margin: 0;
}

.em-form-wrapper .ossn-widget {
    background: var(--em-surface);
    border: 1px solid var(--em-border);
    border-radius: var(--em-radius);
    box-shadow: var(--em-shadow);
    overflow: hidden;
    margin-bottom: 0;
}

.em-form-wrapper .widget-heading {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-bottom: 1px solid #f1f5f9;
    padding: 15px 20px;
    font-size: 15px;
    font-weight: 700;
    color: var(--em-text);
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
}

.em-form-wrapper .widget-heading i.fa {
    color: var(--em-icon) !important;
    float: none;
    margin: 0;
}

.em-form-wrapper .widget-contents {
    padding: 20px;
}

.em-form-date-box {
    margin-bottom: 16px;
}

.em-form-date-box label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    color: var(--em-muted);
    margin-bottom: 7px;
}

.em-form-date-box label i.fa {
    color: var(--em-icon) !important;
}

.em-form-wrapper .em-form-date-box input[type="text"] {
    width: 100% !important;
    height: 40px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 8px !important;
    padding: 0 12px !important;
    margin: 0 !important;
    font-size: 14px !important;
    color: var(--em-text) !important;
    background: var(--em-bg) !important;
    cursor: pointer;
    box-sizing: border-box;
    transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.em-form-wrapper .em-form-date-box input[type="text"]:focus {
    outline: none !important;
    background: var(--em-surface) !important;
    border-color: #334155 !important;
    box-shadow: 0 0 0 3px rgba(51, 65, 85, 0.12) !important;
}

.em-form-wrapper .items-enter {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 16px;
}

.em-form-wrapper .expense-form-item {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 0 !important;
    padding: 10px;
    background: var(--em-bg);
    border: 1px solid var(--em-border);
    border-radius: 10px;
}

.em-form-wrapper .expense-form-item > [class*="col-"] {
    flex: 1 1 130px;
    max-width: none;
    width: auto;
    padding: 0 !important;
    margin: 0 !important;
}

.em-form-wrapper .input-icon-wrapper {
    position: relative;
    width: 100%;
    padding: 0 !important;
    margin: 0 !important;
    background: transparent !important;
    border: none !important;
}

.em-form-wrapper .expense-input {
    width: 100% !important;
    height: 38px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 8px !important;
    padding: 0 11px !important;
    margin: 0 !important;
    font-size: 14px !important;
    color: var(--em-text) !important;
    background: var(--em-surface) !important;
    box-sizing: border-box;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

.em-form-wrapper .expense-input::placeholder {
    color: #94a3b8;
    opacity: 1;
}

.em-form-wrapper .expense-input:focus {
    outline: none !important;
    border-color: #334155 !important;
    box-shadow: 0 0 0 3px rgba(51, 65, 85, 0.12) !important;
}

.em-form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 4px;
}

.em-form-row-btns {
    display: flex;
    align-items: center;
    gap: 8px;
}

.em-form-row-btns .btn {
    border-radius: 8px;
    font-weight: 700;
    min-width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
}

.em-form-footer .add-items {
    border-radius: 8px;
    font-weight: 600;
    height: 36px;
    padding: 0 18px;
}
.em-add-page .widget-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: nowrap;
}

.em-heading-actions {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    white-space: nowrap;
}

.em-print-btn {
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 0 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 12px;
    line-height: 1;
    white-space: nowrap;
    text-decoration: none;
}

.em-print-btn i {
    color: #fff !important;
    margin: 0 !important;
}