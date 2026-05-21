.ossn-location-container {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
}

.ossn-location-container .ossn-location-icon {
    position: absolute;
    left: 12px;
    color: #70757a; /* Google Maps muted gray icon color */
    z-index: 2;
    pointer-events: none;
}

.ossn-location-container input {
    padding-left: 30px !important;
}

.ossn-location-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 10000;
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(32,33,36,0.08), 0 1px 3px rgba(32,33,36,0.1);
    margin-top: 4px;
    max-height: 280px;
    overflow-y: auto;
    display: none;
    padding: 6px 0;
}

.ossn-location-item {
    padding: 12px 16px 12px 38px; /* Extra left padding to align text with the icon above */
    cursor: pointer;
    font-size: 14px;
    color: #202124;
    list-style-type: none;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
}

.ossn-location-item::before {
    content: "\f3c5"; /* FontAwesome map-marker-alt unicode */
    font-family: "Font Awesome 5 Free", "Font Awesome 6 Free", "FontAwesome";
    font-weight: 900;
    position: absolute;
    left: 16px;
    color: #9aa0a6;
}

.ossn-location-item:hover, 
.ossn-location-item:active {
    background-color: #f1f3f4; 
    color: #202124;
}
#ossn-wall-location .ossn-location-icon {
	margin-top: -8px;
}