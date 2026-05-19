/****** <style> *********/
#ossn-wall-postbg {
	border: 1px solid #E5E6E9;
	background: #fff;
	padding: 5px;
	border-radius: 10px;
	display: flex;
	flex-wrap: wrap;
	gap: 5px;
	overflow: hidden;
}

.postbg-container {
    height: 320px !important;
    min-height: 320px !important;
    color: #333;
    font-size: 30px !important;
    font-weight: 700;
    text-align: center !important;
    
    /* CRITICAL: Switch to block layout so caret tracking works, it won't work with flex */
    display: block !important;
    
    /* Perfect vertical centering without breaking contenteditable functionality */
    padding-top: 110px !important; 
    padding-left: 30px !important;
    padding-right: 30px !important;
    line-height: 1.3em !important;
    
    white-space: pre-wrap !important;
    word-break: break-word !important;
    box-sizing: border-box !important;
}

/* Keeps token tags sitting naturally inline on the background canvas */
.postbg-container .ossn-wall-token {
    display: inline !important;
    vertical-align: middle !important;
}


.postbg-text {
    height: 320px !important;
    min-height: 320px !important;
    
    /* Overriding editor hacks for clean static output rendering */
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    
    /* Clear out the asymmetrical editor top padding */
    padding: 30px !important; 
    margin: 0 0 5px 0 !important;
	
    text-align: center !important;
    line-height: 1.4em !important;
    box-sizing: border-box !important;
}

#ossn-wall-postbg span {
	width: 32px;
	height: 32px;
	display: inline-block;
	margin-right: 5px;
	border-radius: 5px;
	cursor: pointer;
}

/* If .postbg-container is added as a class to the textarea itself */
.ossn-wall-textarea.postbg-container~.ossn-wall-userimage-form,
.ossn-wall-container-data:has(.postbg-container) .ossn-wall-userimage-form {
	display: none !important;
}

/* Reset the padding so text moves to the left */
.ossn-wall-textarea.postbg-container {
	padding-left: 12px !important;
}