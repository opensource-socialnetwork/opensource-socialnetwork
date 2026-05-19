/**** <style> *********/
.ossn-ad-creation-form {
    padding: 10px;
}
.ossn-ad-creation-form .ossn-ad-split-layout {
    display: flex;
    flex-direction: row;
    gap: 30px;
    flex-wrap: wrap;
}
.ossn-ad-creation-form .ossn-ad-column-left,
.ossn-ad-creation-form .ossn-ad-column-right {
    flex: 1;
    min-width: 280px;
}
.ossn-ad-creation-form .form-group-fancy {
    margin-bottom: 20px;
}
.ossn-ad-creation-form .form-label-row-fancy {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.ossn-ad-creation-form .form-label-fancy {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #4a5568;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.ossn-ad-creation-form .char-counter-badge {
    font-size: 11px;
    font-weight: 600;
    background-color: #e2e8f0;
    color: #4a5568;
    padding: 2px 8px;
    border-radius: 20px;
    transition: all 0.2s;
}

.ossn-ad-creation-form .form-control-fancy {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background-color: #f8fafc;
    color: #334155;
    transition: all 0.25s ease-in-out;
    box-sizing: border-box;
}
.ossn-ad-creation-form .form-control-fancy:focus {
    border-color: #3182ce;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
    outline: none;
}
.ossn-ad-creation-form input[type="date"].form-control-fancy {
    font-family: inherit;
    cursor: pointer;
}
.ossn-ad-creation-form textarea.form-control-fancy {
    resize: vertical;
    min-height: 115px;
}

.ossn-ad-creation-form .file-input-hidden {
    display: none;
}
.ossn-ad-creation-form .ossn-ad-dropzone-wrapper {
    border: 2px dashed #cbd5e0;
    border-radius: 8px;
    background: #f8fafc;
    transition: all 0.25s ease-in-out;
}
.ossn-ad-creation-form .ossn-ad-dropzone-wrapper.drag-over {
    border-color: #3182ce;
    background-color: #ebf8ff;
    transform: scale(1.01);
}
.ossn-ad-creation-form .btn-file-trigger {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 30px 20px;
    cursor: pointer;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    margin-bottom: 0;
}
.ossn-ad-creation-form .btn-file-trigger i {
    font-size: 28px;
    color: #a0aec0;
    transition: color 0.2s;
}
.ossn-ad-creation-form .ossn-ad-dropzone-wrapper.drag-over .btn-file-trigger i {
    color: #3182ce;
}
.ossn-ad-creation-form .btn-file-trigger .main-text {
    font-weight: 600;
    font-size: 14px;
    color: #4a5568;
}
.ossn-ad-creation-form .btn-file-trigger .sub-text {
    font-size: 12px;
    color: #a0aec0;
}

.ossn-ad-creation-form .image-preview-box {
    position: relative;
    margin-top: 15px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.ossn-ad-creation-form .image-preview-box img {
    max-width: 100%;
    max-height: 190px;
    object-fit: contain;
    border-radius: 4px;
}
.ossn-ad-creation-form .btn-remove-preview {
    background-color: #fff5f5;
    color: #c53030;
    border: 1px solid #fed7d7;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.ossn-ad-creation-form .btn-remove-preview:hover {
    background-color: #fff5f5;
    border-color: #e53e3e;
    box-shadow: 0 2px 4px rgba(229, 62, 62, 0.1);
}
.ossn-ad-creation-form .hidden {
    display: none !important;
}

.ossn-ad-creation-form .form-actions-fancy {
    width: 100%;
    margin-top: 15px;
    border-top: 1px solid #f1f5f9;
    padding-top: 18px;
    text-align: right;
}
.ossn-ad-creation-form .btn-fancy-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: #ffffff;
    border: none;
    padding: 10px 28px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(56, 161, 105, 0.15);
    transition: all 0.2s ease;
}
.ossn-ad-creation-form .btn-fancy-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 12px rgba(56, 161, 105, 0.25);
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
}

.ossn-ad-creation-form input[type="date"].form-control-fancy {
    font-family: inherit;
    cursor: pointer;
}

/* 2. Webkit helper to match the interactive picker icon to your slate text color theme */
.ossn-ad-creation-form input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    filter: invert(0.3) sepia(1) hue-rotate(180deg); /* Optional: can change arrow/calendar icon color */
    opacity: 0.7;
}

.ossn-ads-list-container {
	padding-top: 5px;
}

.ossn-admin-ad-cron i,
.ossn-ads-list-container i {
	margin-right: 0;
}

.ossn-ads-management-table th {
	font-weight: 600;
	text-transform: uppercase;
	font-size: 11px;
	letter-spacing: 0.5px;
	color: #4a5568;
	background-color: #f8fafc;
	border-bottom: 2px solid #e2e8f0 !important;
	vertical-align: middle !important;
}

.ossn-ads-management-table td {
	vertical-align: middle !important;
	padding: 12px 8px !important;
	font-size: 13.5px;
}

.ossn-ads-management-table .ad-title-cell strong {
	color: #2d3748;
	font-weight: 600;
}

.ossn-ads-management-table .ad-url-cell {
	max-width: 150px;
}

.ossn-ads-management-table .ad-table-external-link {
	color: #0b769c;
	text-decoration: none;
	display: inline-block;
	max-width: 100%;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.ossn-ads-management-table .ad-table-external-link:hover {
	text-decoration: underline;
}

.ossn-ads-management-table .ad-badge-flex-wrap {
	display: flex;
	flex-wrap: wrap;
	gap: 4px;
	max-width: 180px;
}

.ossn-ads-management-table .ad-list-badge-info,
.ossn-ads-management-table .ad-list-badge-neutral {
	font-size: 11px;
	font-weight: 600;
	padding: 2px 6px;
	border-radius: 4px;
}

.ossn-ads-management-table .ad-list-badge-info {
	background-color: #ebf8ff;
	color: #2b6cb0;
	border: 1px solid #cee3f8;
}

.ossn-ads-management-table .ad-list-badge-neutral {
	background-color: #f7fafc;
	color: #4a5568;
	border: 1px solid #e2e8f0;
}

.ossn-ads-management-table .ad-list-badge-none {
	color: #a0aec0;
	font-style: italic;
}

.ossn-ads-management-table .ad-date-string-text {
	font-weight: 500;
	color: #4a5568;
	font-family: monospace;
	font-size: 12.5px;
}

.ossn-ads-management-table .ad-metric-badge {
	font-weight: bold;
	padding: 3px 9px;
	border-radius: 12px;
	font-size: 11.5px;
	display: inline-block;
	min-width: 35px;
}

.ossn-ads-management-table .ad-metric-badge.views {
	background-color: #f0fdf4;
	color: #166534;
	border: 1px solid #dcfce7;
}

.ossn-ads-management-table .ad-metric-badge.clicks {
	background-color: #f0f9ff;
	color: #075985;
	border: 1px solid #e0f2fe;
}

.ossn-ads-management-table .ad-status-badge {
	display: inline-flex;
	align-items: center;
	gap: 5px;
	font-size: 11px;
	font-weight: 700;
	padding: 4px 10px;
	border-radius: 20px;
	text-transform: uppercase;
}

.ossn-ads-management-table .ad-status-badge.active {
	background-color: #c6f6d5;
	color: #22543d;
}

.ossn-ads-management-table .ad-status-badge.active i {
	font-size: 8px;
	color: #38a169;
}

.ossn-ads-management-table .ad-status-badge.expired {
	background-color: #fed7d7;
	color: #742a2a;
}

.ossn-ads-management-table .btn-flat-edit {
	color: #4a5568;
	background-color: #edf2f7;
	border: 1px solid #e2e8f0;
	padding: 5px 10px;
	border-radius: 10px;
	display: inline-block;
}

.ossn-ads-management-table .btn-flat-edit:hover {
	background-color: #e2e8f0;
	color: #1a202c;
}

.ossn-ads-management-table .no-ads-placeholder-row {
	padding: 40px !important;
	color: #a0aec0;
	font-size: 15px;
}

.ossn-ads-management-table .no-ads-placeholder-row i {
	font-size: 20px;
	display: block;
	margin-bottom: 6px;

}

/*****
 configure
*********/
.ossn-admin-ad-cron {
	background: #ffffff;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
	border: 1px solid #e2e8f0;
	border-radius: 8px;
	margin-bottom: 25px;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
	overflow: hidden;
}

.ossn-admin-ad-cron summary {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 16px 20px;
	cursor: pointer;
	list-style: none;
	user-select: none;
	background: #fafafa;
}

.ossn-admin-ad-cron summary::-webkit-details-marker {
	display: none;
}

.ossn-admin-ad-cron .header-left {
	display: flex;
	align-items: center;
	gap: 12px;
}

.ossn-admin-ad-cron .arrow-icon {
	color: #64748b;
	font-size: 16px;
	transition: transform 0.2s ease;
}

.ossn-admin-ad-cron .clock-icon-wrapper {
	background: #f1f5f9;
	color: #475569;
	width: 32px;
	height: 32px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	font-size: 14px;
}

.ossn-admin-ad-cron .title-text h4 {
	margin: 0;
	color: #1e293b;
	font-weight: 700;
	font-size: 15px;
	letter-spacing: -0.2px;
}

.ossn-admin-ad-cron .last-run-status {
	font-size: 12px;
	color: #64748b;
	margin-top: 2px;
}

.ossn-admin-ad-cron .badge-toggle {
	font-size: 12px;
	font-weight: 600;
	color: #3b82f6;
	background: #eff6ff;
	padding: 4px 10px;
	border-radius: 20px;
}

.ossn-admin-ad-cron .cron-body {
	padding: 20px;
	border-top: 1px solid #e2e8f0;
}

.ossn-admin-ad-cron .cron-body p {
	color: #475569;
	font-size: 14px;
	margin: 0 0 15px 0;
	line-height: 1.5;
}

.ossn-admin-ad-cron .command-box {
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	border-radius: 6px;
	padding: 12px 16px;
	margin-bottom: 15px;
}

.ossn-admin-ad-cron .command-label {
	font-size: 11px;
	font-weight: 700;
	color: #94a3b8;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	display: block;
	margin-bottom: 6px;
}

.ossn-admin-ad-cron code {
	font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
	font-size: 13px;
	color: #0f172a;
	word-break: break-all;
	display: block;
	font-weight: 500;
}

.ossn-admin-ad-cron .path-placeholder {
	background: #fef08a;
	color: #854d0e;
	padding: 2px 6px;
	border-radius: 4px;
	font-weight: bold;
	font-size: 11px;
	letter-spacing: 0.3px;
}

.ossn-admin-ad-cron .warning-alert {
	background: #fff1f2;
	border: 1px solid #ffe4e6;
	border-radius: 6px;
	padding: 12px 16px;
	display: flex;
	gap: 12px;
	align-items: flex-start;
}

.ossn-admin-ad-cron .warning-alert i {
	color: #f43f5e;
	font-size: 16px;
	margin-top: 2px;
}

.ossn-admin-ad-cron .warning-alert div {
	font-size: 13px;
	color: #9f1239;
	line-height: 1.5;
	margin: 0;
}

/* Arrow Rotation Engine */
.ossn-admin-ad-cron[open] .arrow-icon {
	transform: rotate(90deg);
	color: #3b82f6;
}

.ossn-ads-admin-buttons-top {
	margin-bottom: 20px;
	display: block;
	width: 100%;
}

.ossn-ads-admin-buttons-top::after {
	content: "";
	clear: both;
	display: table;
}

.ossn-ads-admin-buttons-top .ossn-ad-btn {
	font-family: inherit;
	font-size: 13px !important;
	font-weight: 600 !important;
	padding: 8px 16px !important;
	border-radius: 6px !important;
	border: none !important;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	/* Explicit pixel gap spacing for icons and language string text alignment */
	cursor: pointer;
	text-decoration: none !important;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
	transition: transform 150ms ease, box-shadow 150ms ease, filter 150ms ease;
	vertical-align: middle;
	box-sizing: border-box;
}

.ossn-ads-admin-buttons-top .ossn-ad-btn:active {
	transform: scale(0.97);
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-success {
	background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
	color: #ffffff !important;
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-success:hover {
	filter: brightness(1.05);
	box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-success i {
	font-size: 11px;
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-danger {
	background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important;
	color: #ffffff !important;
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-danger:hover {
	filter: brightness(1.05);
	box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
}

.ossn-ads-admin-buttons-top .ossn-ad-btn-right {
	float: right !important;
	margin-top: 0 !important;
}

