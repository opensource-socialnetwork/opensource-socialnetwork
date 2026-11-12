/*************************************************
    GAMES COMPONENT - COMPLETE CSS
**************************************************/

/* Global Wrapper Reset */
.games-container,
.game-play-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 16px 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* ===============================================
   1. GRID LISTING PAGE (all.php)
   =============================================== */

/* Header & Search Bar */
.games-header-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.games-header-bar h3 {
    font-size: 24px;
    font-weight: 700;
    color: #050505;
    margin: 0;
}

.games-search-box {
    position: relative;
    width: 320px;
}

.games-search-box .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #8a8d91;
    font-size: 14px;
    pointer-events: none;
}

.games-search-box input#ossn-game-search-input {
    width: 100% !important;
    padding: 8px 16px 8px 38px !important;
    border-radius: 20px !important;
    background: #f0f2f5 !important;
    border: 1px solid #e4e6eb !important;
    height: 40px !important;
    font-size: 14px !important;
    color: #050505 !important;
    outline: none !important;
    box-shadow: none !important;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

.games-search-box input#ossn-game-search-input:focus {
    background: #ffffff !important;
    border-color: #1877f2 !important;
}

/* Scrollable Category Filter Pills */
.games-filter-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 8px;
    scrollbar-width: thin;
    margin-bottom: 24px;
}

.games-filter-bar::-webkit-scrollbar {
    height: 4px;
}

.games-filter-bar::-webkit-scrollbar-thumb {
    background: #ced0d4;
    border-radius: 4px;
}

button.game-filter-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 18px !important;
    background: #e4e6eb !important;
    color: #050505 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    border-radius: 20px !important;
    border: none !important;
    outline: none !important;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s ease;
    box-shadow: none !important;
}

button.game-filter-pill:hover {
    background: #d8dadf !important;
}

button.game-filter-pill.active {
    background: #1877f2 !important;
    color: #ffffff !important;
}

/* Games Grid */
.games-grid-wrapper {
    position: relative;
    min-height: 250px;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 16px;
}

.game-card {
    background: #ffffff;
    border: 1px solid #e4e6eb;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.game-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.game-card a {
    text-decoration: none !important;
    color: #050505;
    display: block;
}

/* Thumbnail Square Ratio */
.game-thumbnail-wrapper {
    position: relative;
    width: 100%;
    padding-top: 100%;
    background: #f0f2f5;
    overflow: hidden;
}

.game-thumbnail-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.game-card:hover .game-thumbnail-wrapper img {
    transform: scale(1.05);
}

.game-play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.game-play-overlay i {
    font-size: 42px;
    color: #ffffff;
}

.game-card:hover .game-play-overlay {
    opacity: 1;
}

.game-info {
    padding: 10px 12px;
}

.game-title {
    font-weight: 600;
    font-size: 14px;
    color: #050505;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.game-category {
    display: inline-block;
    font-size: 12px;
    color: #65676b;
    margin-top: 2px;
}


/* ===============================================
   2. PLAYER THEATER PAGE (play.php)
   =============================================== */

/* Header Bar & Back Button */
.game-play-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    padding: 0 4px;
    flex-wrap: wrap;
}

.btn-game-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #e4e6eb;
    color: #050505 !important;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    text-decoration: none !important;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.btn-game-back:hover {
    background: #d8dadf;
}

.game-play-title {
    font-size: 20px;
    font-weight: 700;
    color: #050505;
    margin: 0;
    line-height: 1.2;
    flex: 1;
    min-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Fullscreen Toggle Button Style */
.btn-game-fullscreen {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    background: #1877f2;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.btn-game-fullscreen:hover {
    background: #166fe5;
}

/* Black Theater Stage Box */
.game-iframe-stage {
    position: relative;
    background: #000000;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

/* Fullscreen browser state handling */
.game-iframe-stage:fullscreen {
    width: 100vw;
    height: 100vh;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
}

.game-iframe-stage:-webkit-full-screen {
    width: 100vw;
    height: 100vh;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
}

.game-iframe-stage:fullscreen .game-iframe-wrapper {
    width: 100%;
    height: 100%;
    padding-top: 0;
}

.game-iframe-stage:-webkit-full-screen .game-iframe-wrapper {
    width: 100%;
    height: 100%;
    padding-top: 0;
}

/* Responsive 16:9 Aspect Ratio Frame Wrapper */
.game-iframe-wrapper {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Ratio */
    height: 0;
    background: #000000;
}

.game-iframe-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100% !important;
    height: 100% !important;
    border: 0;
    display: block;
}

/* Description Card */
.game-details-card {
    background: #ffffff;
    border: 1px solid #e4e6eb;
    border-radius: 12px;
    padding: 20px;
    margin-top: 16px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.game-details-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #050505;
    margin-top: 0;
    margin-bottom: 10px;
}

.game-details-card p {
    font-size: 14px;
    line-height: 1.5;
    color: #65676b;
    margin: 0;
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .game-play-header {
        flex-direction: column;
        align-items: stretch;
    }
    .game-play-title {
        text-align: center;
        order: -1;
    }
    .btn-game-back, .btn-game-fullscreen {
        width: 100%;
        justify-content: center;
    }
}
/* Hidden by default in normal view */
.btn-exit-fullscreen {
    display: none;
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 99999;
    background: rgba(0, 0, 0, 0.7);
    color: #ffffff;
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    align-items: center;
    gap: 6px;
    backdrop-filter: blur(4px);
}

/* Automatically show when container enters fullscreen mode */
.game-iframe-stage:fullscreen .btn-exit-fullscreen,
.game-iframe-stage:-webkit-full-screen .btn-exit-fullscreen {
    display: inline-flex;
}