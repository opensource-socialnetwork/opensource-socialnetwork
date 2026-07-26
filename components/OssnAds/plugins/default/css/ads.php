/******** <style> ******/
/******************************************
	Ossn Ads
*******************************************/
/* Master Ad Card Container */
.ossn-ad-item {
    background: var(--bs-body-bg, #ffffff);
    border: 1px solid var(--bs-border-color, #e2e8f0);
    border-radius: 12px;
    padding: 0;
    margin-bottom: 16px;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.ossn-ad-item:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    border-color: var(--bs-border-color, #cbd5e1);
}

/* Clickable Link Wrapper */
.ossn-ad-item .ad-clickable-card {
    display: block;
    padding: 14px;
    text-decoration: none !important;
    color: inherit !important;
    transition: background-color 0.2s ease;
}

.ossn-ad-item .ad-clickable-card:hover {
    background-color: var(--bs-tertiary-bg, #f8fafc);
}

/* Top Meta Row (Sponsored Tag + Domain Alignment) */
.ossn-ad-item .ad-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.ossn-ad-item .ad-sponsored-tag {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #2563eb;
    background-color: #eff6ff;
    padding: 2px 8px;
    border-radius: 4px;
}

.ossn-ad-item .ad-domain-host {
    font-size: 0.75rem;
    color: var(--bs-secondary-color, #64748b);
    font-weight: 600;
}

/* Ad Headline / Title */
.ossn-ad-item .ad-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--bs-heading-color, #0f172a);
    margin-bottom: 8px;
    line-height: 1.35;
    transition: color 0.15s ease;
}

.ossn-ad-item:hover .ad-title {
    color: #2563eb;
}

/* Banner Image Frame with Dynamic 1200x630 Aspect Ratio */
.ossn-ad-item .ad-image-container {
    width: 100%;
    aspect-ratio: 1200 / 630;
    height: auto;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f1f5f9;
    margin-bottom: 10px;
    border: 1px solid var(--bs-border-color, #e2e8f0);
    display: flex;
    align-items: center;
    justify-content: center;
}

.ossn-ad-item .ad-image {
    width: 100%;
    height: 100%;
    object-fit: contain !important;
    transition: transform 0.25s ease;
}

.ossn-ad-item:hover .ad-image {
    transform: scale(1.02);
}

/* Ad Copy Description */
.ossn-ad-item p {
    font-size: 0.825rem;
    color: var(--bs-body-color, #475569);
    line-height: 1.45;
    margin-bottom: 0;
    word-break: break-word;
}