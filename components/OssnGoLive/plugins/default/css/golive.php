/****** <style> ********/
.golive-immersive-studio i {
    margin-right: 0px;
}
.golive-immersive-studio {
    position: relative;
    width: 100%;
    max-width: 1100px;
    margin: 15px auto;
    background: #0b0f15;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.golive-stage-container {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #000000;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

#golive-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scaleX(-1); /* Mirror camera preview */
}

/* Floating Top Bar Overlay */
.golive-top-bar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: linear-gradient(to bottom, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0) 100%);
    z-index: 20;
    color: #ffffff;
}

.golive-top-title {
    font-weight: 600;
    font-size: 16px;
    letter-spacing: 0.5px;
}

.golive-icon-btn {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #ffffff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
    text-decoration: none;
}

.golive-icon-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
}

/* Floating Bottom Action Bar */
.golive-bottom-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 100%);
    z-index: 20;
}

.golive-action-pill {
    padding: 12px 36px;
    font-size: 16px;
    font-weight: 700;
    border-radius: 30px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    transition: transform 0.1s, background 0.2s;
}

.golive-action-pill:active {
    transform: scale(0.96);
}

.golive-btn-live {
    background: #e0245e;
    color: #ffffff;
}

.golive-btn-live:hover {
    background: #c91c50;
}

.golive-btn-end {
    background: #dc3545;
    color: #ffffff;
}

.golive-btn-end:hover {
    background: #b02a37;
}

/* Status Badge */
.golive-badge {
    position: absolute;
    top: 22px;
    left: 75px;
    z-index: 25;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.8px;
    color: #fff;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    pointer-events: none;
    line-height: 1;
    min-width: 95px;
    justify-content: center;
}

/* Live Viewer Count Badge */
.golive-viewer-count-badge {
    position: absolute;
    top: 22px;
    left: 180px;
    z-index: 25;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.8px;
    color: #fff;
    background: rgba(0, 0, 0, 0.75);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    pointer-events: none;
    line-height: 1;
}

.golive-viewer-count-badge i {
    color: #fa5252;
}

.badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #ffffff;
    flex-shrink: 0;
    display: inline-block;
}

.golive-badge.offline {
    background: rgba(24, 25, 26, 0.8);
    border: 1px solid rgba(255,255,255,0.2);
}

.golive-badge.live {
    background: #e0245e;
    animation: pulse-badge 1.5s infinite;
}

@keyframes pulse-badge {
    0% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(0.97); }
    100% { opacity: 1; transform: scale(1); }
}

/* ==========================================================
   Facebook Live Style Chat Feed Overlay (Soft & Translucent)
   ========================================================== */
.golive-studio-interactions {
    position: absolute;
    bottom: 80px;
    left: 16px;
    width: 320px;
    max-height: 220px;
    background: rgba(20, 24, 33, 0.45); /* Softer, lighter translucent dark background */
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    z-index: 25;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    pointer-events: none; /* Broadcaster only watches */
}

.golive-studio-chat-stream {
    padding: 10px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-height: 200px;
    scroll-behavior: smooth;
    mask-image: linear-gradient(to bottom, transparent 0%, black 15%);
    -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 15%);
}

.golive-studio-chat-stream::-webkit-scrollbar {
    width: 3px;
}
.golive-studio-chat-stream::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.golive-chat-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: #f8fafc;
    animation: goliveFadeIn 0.25s ease-out forwards;
}

@keyframes goliveFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.golive-chat-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    border: 1.5px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.golive-chat-content {
    background: rgba(0, 0, 0, 0.45);
    padding: 6px 10px;
    border-radius: 12px;
    word-break: break-word;
    max-width: 250px;
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.golive-chat-name {
    font-weight: 700;
    font-size: 11px;
    color: #60a5fa;
    display: block;
    margin-bottom: 2px;
}

.golive-chat-text {
    font-size: 12px;
    line-height: 1.35;
    color: #f1f5f9;
}

/* ==========================================================
   Flying Reactions Container & Animation
   ========================================================== */
.golive-flying-reactions-container {
    position: absolute;
    bottom: 20px;
    right: 20px;
    width: 90px;
    height: 240px;
    pointer-events: none;
    z-index: 30;
    overflow: hidden;
}

.golive-flying-reaction {
    position: absolute;
    bottom: 0;
    right: 15px;
    font-size: 26px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
    animation: floatUpReaction 2s cubic-bezier(0.25, 1, 0.5, 1) forwards;
}

@keyframes floatUpReaction {
    0% {
        transform: translateY(0) scale(0.4) rotate(0deg);
        opacity: 0;
    }
    15% {
        opacity: 1;
        transform: translateY(-30px) scale(1.2) rotate(-10deg);
    }
    50% {
        transform: translateY(-120px) scale(1) rotate(15deg);
        opacity: 0.9;
    }
    100% {
        transform: translateY(-240px) scale(0.85) rotate(-10deg);
        opacity: 0;
    }
}

/* ==========================================================
   Settings Modal Styling
   ========================================================== */
.golive-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.65);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.golive-modal-card {
    background: #161b22;
    border: 1px solid #30363d;
    width: 100%;
    max-width: 400px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    color: #f0f6fc;
}

.golive-modal-header {
    padding: 16px 20px;
    background: #0d1117;
    border-bottom: 1px solid #30363d;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.golive-modal-header h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.golive-close-btn {
    background: none;
    border: none;
    color: #8b949e;
    font-size: 24px;
    cursor: pointer;
    line-height: 1;
}

.golive-close-btn:hover {
    color: #ffffff;
}

.golive-modal-body {
    padding: 20px;
}

.golive-form-group {
    margin-bottom: 16px;
}

.golive-form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #8b949e;
    margin-bottom: 6px;
}

.golive-select {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    border: 1px solid #30363d;
    border-radius: 8px;
    background-color: #0d1117;
    color: #f0f6fc;
}

.golive-select:focus {
    border-color: #58a6ff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.15);
}

.golive-error-overlay {
    position: absolute;
    color: #fff;
    text-align: center;
    padding: 20px;
    z-index: 10;
}

/* ==========================================================
   Mobile Responsiveness (< 768px Screens)
   ========================================================== */
@media (max-width: 768px) {
    .golive-immersive-studio {
        margin: 5px;
        width: calc(100% - 10px);
        border-radius: 8px;
    }

    .golive-studio-interactions {
        left: 10px;
        right: 10px;
        width: auto;
        max-height: 110px;
        bottom: 70px;
    }

    .golive-studio-chat-stream {
        max-height: 95px;
        padding: 6px;
        gap: 6px;
    }

    .golive-chat-content {
        max-width: 180px;
        padding: 5px 8px;
    }

    .golive-chat-avatar {
        width: 24px;
        height: 24px;
    }

    .golive-badge {
        top: 14px;
        left: 55px;
        font-size: 9px;
        padding: 4px 8px;
        min-width: 75px;
    }

    .golive-viewer-count-badge {
        top: 14px;
        left: 138px;
        font-size: 9px;
        padding: 4px 8px;
    }

    .golive-top-bar {
        padding: 10px 12px;
    }

    .golive-bottom-bar {
        padding: 12px;
    }

    .golive-action-pill {
        padding: 10px 24px;
        font-size: 14px;
    }
}
.menu-section-item-golive:before {
    content: "\f519" !important;
}