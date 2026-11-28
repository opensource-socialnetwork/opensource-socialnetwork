/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/* Sidebar Menu Icon (Font Awesome 5/6) */
.menu-section-item-addressbook:before {
		content: "\f2b9" !important;
		font-family: "Font Awesome 5 Free", "Font Awesome 6 Free", FontAwesome !important;
		font-weight: 900 !important;
}

:root {
		--ab-bg-card: #ffffff;
		--ab-bg-subtle: #f8fafc;
		--ab-bg-hover: #f1f5f9;
		--ab-border: #e2e8f0;
		--ab-border-strong: #cbd5e1;
		--ab-text-primary: #0f172a;
		--ab-text-secondary: #64748b;
		--ab-accent: #334155;
		--ab-accent-hover: #1e293b;
		--ab-accent-contrast: #ffffff;
		--ab-accent-soft: rgba(51, 65, 85, 0.1);
		--ab-shadow: 0 1px 3px rgba(15, 23, 42, 0.05), 0 1px 2px rgba(15, 23, 42, 0.03);
}

.white-darkmode,
.dark-mode {
		--ab-bg-card: #18181b;
		--ab-bg-subtle: #202024;
		--ab-bg-hover: #27272a;
		--ab-border: #2e2e32;
		--ab-border-strong: #3f3f46;
		--ab-text-primary: #f4f4f5;
		--ab-text-secondary: #a1a1aa;
		--ab-accent: #e4e4e7;
		--ab-accent-hover: #ffffff;
		--ab-accent-contrast: #18181b;
		--ab-accent-soft: rgba(244, 244, 245, 0.1);
		--ab-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
}

.ossnab-wrapper {
		width: 100%;
		margin: 0 auto 24px;
}

.ossnab-card {
		background: var(--ab-bg-card);
		border: 1px solid var(--ab-border);
		border-radius: 14px;
		box-shadow: var(--ab-shadow);
		overflow: hidden;
}

.ossnab-header {
		padding: 20px 24px;
		border-bottom: 1px solid var(--ab-border);
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 14px;
}

.ossnab-title-group {
		display: flex;
		align-items: center;
		gap: 14px;
}

.ossnab-icon-box {
		width: 42px;
		height: 42px;
		border-radius: 11px;
		background: var(--ab-accent-soft);
		color: var(--ab-accent);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 18px;
		flex-shrink: 0;
}

.ossnab-heading {
		font-size: 18px;
		font-weight: 700;
		color: var(--ab-text-primary);
}

.ossnab-subtitle {
		font-size: 13px;
		color: var(--ab-text-secondary);
}

.ossnab-composer-wrap {
		padding: 18px 24px;
		background: var(--ab-bg-subtle);
		border-bottom: 1px solid var(--ab-border);
}

.ossnab-composer-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 10px;
		margin-bottom: 10px;
}

.ossn-form.ossnab-composer input.ossnab-input,
.ossn-form.ossnab-composer select.ossnab-select,
.ossn-form.ossnab-composer textarea.ossnab-textarea,
.ossnab-input,
.ossnab-select,
.ossnab-textarea {
		width: 100%;
		height: 40px;
		padding: 0 13px !important;
		margin-bottom: 0 !important;
		background: var(--ab-bg-card);
		border: 1px solid var(--ab-border-strong);
		color: var(--ab-text-primary);
		border-radius: 9px;
		font-size: 13.5px;
		box-shadow: none;
}

.ossn-form.ossnab-composer textarea.ossnab-textarea,
.ossnab-textarea {
		height: auto;
		padding: 10px 13px !important;
		resize: vertical;
}

.ossnab-composer-footer {
		display: flex;
		flex-direction: column;
		gap: 10px;
}

.ossnab-composer-btns {
		display: flex;
		align-items: center;
		gap: 8px;
}

.ossnab-submit-btn {
		height: 38px;
		padding: 0 16px;
		border-radius: 9px;
		border: none;
		background: var(--ab-accent);
		color: var(--ab-accent-contrast);
		font-size: 13.5px;
		font-weight: 600;
		cursor: pointer;
		white-space: nowrap;
		transition: background 0.15s ease;
}

.ossnab-submit-btn:hover {
		background: var(--ab-accent-hover);
}

.ossnab-cancel-btn {
		height: 38px;
		padding: 0 16px;
		border-radius: 9px;
		border: 1px solid var(--ab-border-strong);
		background: var(--ab-bg-card);
		color: var(--ab-text-primary);
		font-size: 13.5px;
		font-weight: 600;

		cursor: pointer;
		white-space: nowrap;
		transition: all 0.15s ease;
}

.ossnab-cancel-btn:hover {
		background: var(--ab-bg-hover);
}

.ossnab-delete-all-btn {
		height: 38px;
		padding: 0 13px;
		border-radius: 9px;
		border: 1px solid rgba(239, 68, 68, 0.35);
		background: rgba(239, 68, 68, 0.08);
		color: #ef4444;
		font-size: 13px;
		font-weight: 600;
		cursor: pointer;
		white-space: nowrap;
		transition: all 0.15s ease;
}

.ossnab-delete-all-btn:hover {
		background: #ef4444;
		border-color: #ef4444;
		color: #ffffff;
}

.ossnab-toolbar {
		padding: 14px 24px;
		background: var(--ab-bg-subtle);
		border-bottom: 1px solid var(--ab-border);
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 12px;
}

.ossnab-search-wrap {
		position: relative;
		flex: 1 1 260px;
		max-width: 380px;
}

.ossnab-search-icon {
		position: absolute;
		left: 13px;
		top: 50%;
		transform: translateY(-50%);
		color: var(--ab-text-secondary);
		font-size: 13px;
}

.ossnab-search-input {
		width: 100%;
		height: 36px;
		padding: 0 13px 0 34px !important;
		border-radius: 9px;
		border: 1px solid var(--ab-border-strong);
		background: var(--ab-bg-card);
		color: var(--ab-text-primary);
		font-size: 13px;
}

.ossnab-tabs {
		display: inline-flex;
		flex-wrap: wrap;
		background: var(--ab-bg-card);
		border: 1px solid var(--ab-border);
		padding: 3px;
		border-radius: 10px;
		gap: 2px;
}

.ossnab-tab {
		border: none;
		background: transparent;
		color: var(--ab-text-secondary);
		font-size: 12.5px;
		font-weight: 600;
		padding: 5px 11px;
		border-radius: 7px;
		cursor: pointer;
		transition: all 0.15s ease;
}

.ossnab-tab:hover {
		color: var(--ab-text-primary);
}

.ossnab-tab.active {
		background: var(--ab-accent);
		color: var(--ab-accent-contrast);
}

.ossnab-list {
		display: flex;
		flex-direction: column;
}

.ossnab-item {
		padding: 16px 24px;
		border-bottom: 1px solid var(--ab-border);
		display: flex;
		align-items: flex-start;
		gap: 14px;
		transition: background 0.15s ease;
}

.ossnab-item:last-child {
		border-bottom: none;
}

.ossnab-item:hover {
		background: var(--ab-bg-hover);
}

.ossnab-avatar {
		width: 42px;
		height: 42px;
		border-radius: 50%;
		background: var(--ab-bg-subtle);
		border: 1px solid var(--ab-border-strong);
		color: var(--ab-text-primary);
		font-weight: 700;
		font-size: 14px;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-shrink: 0;
}

.ossnab-item-body {
		flex: 1;
		min-width: 0;
		display: flex;
		flex-direction: column;
		gap: 5px;
}

.ossnab-item-top {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 8px;
}

.ossnab-item-name {
		font-size: 15px;
		font-weight: 700;
		color: var(--ab-text-primary);
}

.ossnab-pill {
		font-size: 11px;
		font-weight: 600;
		padding: 2px 9px;
		border-radius: 999px;
		text-transform: capitalize;
}

.ossnab-pill-personal {
		background: rgba(59, 130, 246, 0.12);
		color: #3b82f6;
}

.ossnab-pill-work {
		background: rgba(168, 85, 247, 0.12);
		color: #a855f7;
}

.ossnab-pill-family {
		background: rgba(16, 185, 129, 0.12);
		color: #10b981;
}

.ossnab-pill-other {
		background: rgba(100, 116, 139, 0.14);
		color: var(--ab-text-secondary);
}

.ossnab-meta {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 14px;
		font-size: 13px;
}

.ossnab-meta-link {
		color: var(--ab-text-primary);
		text-decoration: underline;
		text-decoration-color: var(--ab-border-strong);
		text-underline-offset: 2px;
}

.ossnab-meta-link:hover {
		text-decoration-color: var(--ab-text-primary);
}

.ossnab-meta-text {
		color: var(--ab-text-secondary);
}

.ossnab-item-desc {
		font-size: 13px;
		color: var(--ab-text-secondary);
		line-height: 1.45;
}

.ossnab-item-actions {
		display: flex;
		align-items: center;
		gap: 4px;
		flex-shrink: 0;
}

.ossnab-action-btn {
		background: transparent;
		border: none;
		color: var(--ab-text-secondary);
		font-size: 14px;
		width: 32px;
		height: 32px;
		border-radius: 8px;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: all 0.15s ease;
}

.ossnab-fav-btn:hover,
.ossnab-fav-btn.active {
		color: #f59e0b;
		background: rgba(245, 158, 11, 0.12);
}

.ossnab-edit-btn:hover {
		color: var(--ab-text-primary);
		background: var(--ab-bg-subtle);
}

.ossnab-delete:hover {
		color: #ef4444;
		background: rgba(239, 68, 68, 0.1);
}

.ossnab-inline-edit {
		width: 100%;
		display: flex;
		flex-direction: column;
		gap: 10px;
}

.ossnab-empty {
		padding: 48px 24px;
		text-align: center;
		color: var(--ab-text-secondary);
}

.ossnab-empty-icon {
		font-size: 34px;
		margin-bottom: 10px;
		opacity: 0.5;
}

@media (max-width: 768px) {
		.ossnab-composer-grid {
				grid-template-columns: 1fr;
		}
		.ossnab-header,
		.ossnab-composer-wrap,
		.ossnab-toolbar,
		.ossnab-item {
				padding-left: 16px;
				padding-right: 16px;
		}
}