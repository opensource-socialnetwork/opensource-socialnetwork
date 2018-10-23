<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$de = array(
		'ossnsmilies' => 'Smilies',
		'ossn:smilies:admin:settings:compat:title' => 'Abwärts-Kompatibilitäts Modus',
		'ossn:smilies:admin:settings:compat:note' => '<i class="fa fa-info-circle"></i><br><i>
		Beim Aufbau eines ganz neuen sozialen Netzwerks mit Ossn 4.5 und höher sollte dieser Modus <b><u>ausgeschaltet</u></b> bleiben.<br>
		Es stehen nunmehr über 1000 Unicode Emojis zur Verfügung, die die Benutzung alter Smilies im Stil von :) überflüssig machen.<br>
		Ist der Abwärts-Kompatibilitäts Modus <b><u>eingeschaltet</u></b>, werden folgende Zeichenfolgen wie bislang durch Smilies ersetzt:</i><br>
		:(&#x1f641;&nbsp;&nbsp;:)&#x1f642;&nbsp;&nbsp;=D&#x1f600;&nbsp;&nbsp;;)&#x1f609;&nbsp;&nbsp;:p&#x1f61b;&nbsp;&nbsp;8)&#x1f60e;&nbsp;&nbsp;o.O&#x1f62f;&nbsp;&nbsp;:O&#x1f632;&nbsp;&nbsp;:*&#x1f618;&nbsp;&nbsp;a:&#x1f607;&nbsp;&nbsp;:h:&#x2764;&nbsp;&nbsp;3:|&#x1f608;&nbsp;&nbsp;u:&#x1f620;&nbsp;&nbsp;:v&#x1f47b;&nbsp;&nbsp;g:&#x1f61f;&nbsp;&nbsp;c:&#x1f62a;<i><br>
		<br></i>',
		'ossn:smilies:admin:settings:compat:off' => 'ausgeschaltet',
		'ossn:smilies:admin:settings:compat:on' => 'eingeschaltet',
		'ossn:smilies:admin:settings:save:error' => 'Die Einstellung konnte nicht gespeichert werden! Überprüfe die error_log Datei.',
		'ossn:smilies:admin:settings:saved' => 'Die Einstellung wurde gespeichert.',
);
ossn_register_languages('de', $de);
