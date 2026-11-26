.ossntodos-wrapper {
    --td-bg-card: #ffffff;
    --td-bg-subtle: #f6f6f7;
    --td-bg-hover: #f9f9fa;
    --td-bg-completed: #fafafa;
    --td-border: #e5e5e7;
    --td-border-strong: #d4d4d8;
    --td-text-primary: #18181b;
    --td-text-secondary: #71717a;
    --td-text-muted: #a1a1aa;
    --td-accent: #18181b;
    --td-accent-text: #ffffff;
    --td-check-bg: #16a34a;
    --td-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);

    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 8px 0 24px;
}

.white-darkmode .ossntodos-wrapper {
    --td-bg-card: #181818;
    --td-bg-subtle: #222222;
    --td-bg-hover: #202020;
    --td-bg-completed: #151515;
    --td-border: #2c2c2c;
    --td-border-strong: #3a3a3a;
    --td-text-primary: #f2f2f2;
    --td-text-secondary: #9e9e9e;
    --td-text-muted: #666666;
    --td-accent: #f2f2f2;
    --td-accent-text: #141414;
    --td-check-bg: #22c55e;
    --td-shadow: 0 8px 30px rgba(0, 0, 0, 0.45);
}

.ossntodos-card {
    background: var(--td-bg-card);
    border: 1px solid var(--td-border);
    border-radius: 14px;
    box-shadow: var(--td-shadow);
    overflow: hidden;
}

/* Header */
.ossntodos-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    padding: 20px 24px;
    border-bottom: 1px solid var(--td-border);
}

.ossntodos-title-group {
    display: flex;
    align-items: center;
    gap: 14px;
}

.ossntodos-icon-box {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--td-bg-subtle);
    border: 1px solid var(--td-border);
    color: var(--td-text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.ossntodos-heading {
    font-size: 18px;
    font-weight: 700;
    color: var(--td-text-primary);
    letter-spacing: -0.01em;
}

.ossntodos-subtitle {
    font-size: 12.5px;
    color: var(--td-text-secondary);
}

/* Segmented Tabs */
.ossntodos-tabs {
    display: inline-flex;
    background: var(--td-bg-subtle);
    padding: 4px;
    border-radius: 10px;
    border: 1px solid var(--td-border);
    gap: 2px;
}

.ossntodos-tab {
    border: none;
    background: transparent;
    color: var(--td-text-secondary);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 7px;
    cursor: pointer;
    transition: all 0.15s ease;
}

.ossntodos-tab:hover {
    color: var(--td-text-primary);
}

.ossntodos-tab.active {
    background: var(--td-bg-card);
    color: var(--td-text-primary);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
}

/* Composer Bar */
.ossntodos-composer {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 16px 24px;
    background: var(--td-bg-subtle);
    border-bottom: 1px solid var(--td-border);
}

.ossntodos-input-main {
    flex: 1 1 280px;
    position: relative;
    display: flex;
    align-items: center;
}

.ossntodos-input-icon {
    position: absolute;
    left: 14px;
    color: var(--td-text-muted);
    font-size: 13px;
    pointer-events: none;
}

.ossntodos-input,
.ossntodos-select,
.ossntodos-date {
    background: var(--td-bg-card);
    border: 1px solid var(--td-border-strong);
    color: var(--td-text-primary);
    border-radius: 9px;
    font-size: 13.5px;
    height: 40px;
    transition: border-color 0.15s ease;
}

.ossntodos-input {
    width: 100%;
    padding: 0 14px 0 36px;
}

.ossntodos-input::placeholder {
    color: var(--td-text-muted);
}

.ossntodos-input:focus,
.ossntodos-select:focus,
.ossntodos-date:focus {
    outline: none;
    border-color: var(--td-text-secondary);
}

.ossntodos-composer-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.ossntodos-select,
.ossntodos-date {
    padding: 0 12px;
}

.white-darkmode .ossntodos-date {
    color-scheme: dark;
}

.ossntodos-submit-btn {
    height: 40px;
    padding: 0 18px;
    border-radius: 9px;
    border: none;
    background: var(--td-accent);
    color: var(--td-accent-text);
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity 0.15s ease;
}

.ossntodos-submit-btn:hover {
    opacity: 0.88;
}

/* Task Rows */
.ossntodos-list {
    display: flex;
    flex-direction: column;
}

.ossntodos-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 15px 24px;
    border-bottom: 1px solid var(--td-border);
    background: var(--td-bg-card);
    transition: background-color 0.15s ease;
}

.ossntodos-item:last-child {
    border-bottom: none;
}

.ossntodos-item:hover {
    background: var(--td-bg-hover);
}

.ossntodos-item.is-completed {
    background: var(--td-bg-completed);
}

/* Custom Round Checkbox */
.ossntodos-check-wrap {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    margin: 0;
    cursor: pointer;
    flex-shrink: 0;
}

.ossntodos-check-wrap input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
    margin: 0;
}

.ossntodos-checkmark {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: 2px solid var(--td-border-strong);
    display: flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    font-size: 11px;
    transition: all 0.15s ease;
}

.ossntodos-check-wrap:hover .ossntodos-checkmark {
    border-color: var(--td-text-secondary);
}

.ossntodos-check-wrap input:checked + .ossntodos-checkmark {
    background: var(--td-check-bg);
    border-color: var(--td-check-bg);
    color: #ffffff;
}

/* Task Body & Metadata */
.ossntodos-item-body {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.ossntodos-item-title {
    font-size: 14.5px;
    font-weight: 500;
    color: var(--td-text-primary);
    word-break: break-word;
    transition: color 0.15s ease;
}

.ossntodos-item.is-completed .ossntodos-item-title {
    text-decoration: line-through;
    color: var(--td-text-muted);
}

.ossntodos-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.ossntodos-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 999px;
}

.ossntodos-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.ossntodos-pill-high {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}
.ossntodos-pill-high .ossntodos-dot {
    background: #ef4444;
}

.ossntodos-pill-low {
    background: var(--td-bg-subtle);
    color: var(--td-text-secondary);
    border: 1px solid var(--td-border);
}
.ossntodos-pill-low .ossntodos-dot {
    background: var(--td-text-secondary);
}

.ossntodos-due {
    font-size: 12px;
    color: var(--td-text-secondary);
    background: var(--td-bg-subtle);
    border: 1px solid var(--td-border);
    padding: 2px 9px;
    border-radius: 6px;
}

/* Delete Button */
.ossntodos-delete {
    background: transparent;
    border: none;
    color: var(--td-text-secondary);
    font-size: 14px;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
    flex-shrink: 0;
}

.ossntodos-delete:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

/* Empty State */
.ossntodos-empty {
    text-align: center;
    padding: 48px 24px;
    color: var(--td-text-secondary);
}

.ossntodos-empty-icon {
    font-size: 36px;
    color: var(--td-text-muted);
    margin-bottom: 10px;
}

@media (max-width: 640px) {
    .ossntodos-header,
    .ossntodos-composer,
    .ossntodos-item {
        padding-left: 16px;
        padding-right: 16px;
    }
    .ossntodos-composer-actions {
        width: 100%;
    }
    .ossntodos-select,
    .ossntodos-date {
        flex: 1;
    }
}
/* Fix ossn_view_form fieldset wrapper & .ossn-form overrides */
.ossntodos-composer fieldset {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    width: 100%;
    border: 0;
    margin: 0;
    padding: 0;
}

.ossn-form.ossntodos-composer input[type="text"].ossntodos-input {
    width: 100%;
    padding: 0 14px 0 36px !important;
    margin-bottom: 0 !important;
    background: var(--td-bg-card);
    border: 1px solid var(--td-border-strong);
    color: var(--td-text-primary);
    border-radius: 9px;
    height: 40px;
}

.ossn-form.ossntodos-composer select.ossntodos-select,
.ossn-form.ossntodos-composer input[type="date"].ossntodos-date {
    width: auto;
    padding: 0 12px !important;
    margin-bottom: 0 !important;
    background: var(--td-bg-card);
    border: 1px solid var(--td-border-strong);
    color: var(--td-text-primary);
    border-radius: 9px;
    height: 40px;
}
.ossntodos-wrapper i:not(.ossntodos-delete-all i) {
    margin-right: 0;
}
.ossntodos-note-toggle {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    border: 1px solid var(--td-border-strong);
    background: var(--td-bg-card);
    color: var(--td-text-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
}

.ossntodos-note-toggle:hover,
.ossntodos-note-toggle.active {
    color: var(--td-text-primary);
    border-color: var(--td-text-secondary);
}

.ossntodos-composer-note {
    width: 100%;
}

.ossn-form.ossntodos-composer textarea.ossntodos-textarea,
.ossntodos-textarea {
    width: 100%;
    padding: 10px 14px !important;
    margin-bottom: 0 !important;
    background: var(--td-bg-card);
    border: 1px solid var(--td-border-strong);
    color: var(--td-text-primary);
    border-radius: 9px;
    font-size: 13.5px;
    resize: vertical;
}

.ossntodos-item-text {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.ossntodos-item-desc {
    font-size: 13px;
    color: var(--td-text-secondary);
    line-height: 1.45;
}

.ossntodos-item-actions {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-shrink: 0;
}

.ossntodos-action-btn {
    background: transparent;
    border: none;
    color: var(--td-text-secondary);
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

.ossntodos-edit-btn:hover {
    color: var(--td-text-primary);
    background: var(--td-bg-subtle);
}

.ossntodos-delete:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

.ossntodos-inline-edit {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ossntodos-inline-edit-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
}
.ossntodos-edit-cancel {
    height: 40px;
    padding: 0 16px;
    border-radius: 9px;
    border: 1px solid var(--td-border-strong);
    background: var(--td-bg-subtle);
    color: var(--td-text-primary);
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.15s ease;
}

.ossntodos-edit-cancel:hover {
    background: var(--td-bg-card);
    border-color: var(--td-text-secondary);
}
.ossntodos-delete-all-btn {
    height: 36px;
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

.ossntodos-delete-all-btn:hover {
    background: #ef4444;
    border-color: #ef4444;
    color: #ffffff;
}
.menu-section-item-todos:before {
    content: "\f0ae" !important;
    font-weight: 900 !important;
}