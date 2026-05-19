<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Source Social Network Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$hu = array(
	'ossnads'                       => 'Hirdetéskezelő',
	'fields:required'               => 'Minden mező kitöltése kötelező!',
	'ad:created'                    => 'A hirdetés sikeresen elkészült!',
	'ad:create:fail'                => 'Nem sikerült létrehozni a hirdetést!',
	'ad:title'                      => 'Cím',
	'ad:site:url'                   => 'Weboldal URL',
	'ad:desc'                       => 'Leírás',
	'ad:browse'                     => 'Tallózás',
	'ad:clicks'                     => 'Kattintások',
	'sponsored'                     => 'HIRDETÉS',
	'ad:deleted'                    => "A(z) '%s' című hirdetés sikeresen törölve lett.",
	'ad:delete:fail'                => 'Nem sikerült törölni a hirdetést! Kérjük, próbálja meg később újra.',
	'ad:edited'                     => 'A hirdetés sikeresen módosítva.',
	'ad:edit:fail'                  => 'Nem sikerült szerkeszteni a hirdetést! Kérjük, próbálja meg később újra.',
	'ads:manager'                   => 'Hirdetéskezelő',
	'ads:boost:community'           => 'Pörgesse fel közösségét. Hozzon létre új hirdetési kampányt, vagy kezelje a meglévőket.',
	'ads:create'                    => 'Hirdetés létrehozása',

	'ad:placement'                  => 'Hirdetés megjelenítési helyei',
	'ad:gender:target'              => 'Demográfiai célzás nemek szerint',
	'ad:end:date'                   => 'Kampány lejárati dátuma (Opcionális)',
	'ad:photo'                      => 'Banner hirdetés képe',
	'add'                           => 'Kampány létrehozása',

	'ad:placement:newsfeed'         => 'Aktivitási hírfolyam (Oldalsáv)',
	'ad:placement:profile'          => 'Felhasználói profilok (Oldalsáv)',
	'ad:placement:groups'           => 'Csoportoldalak (Oldalsáv)',
	'ad:placement:global'           => 'Minden egyéb téma oldalsáv (Globális)',

	'ad:file:choose'                => 'Válasszon ki vagy húzzon ide egy hirdetésképet...',
	'ad:file:restriction'           => 'Kizárólag képfájlok engedélyezettek (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Kép eltávolítása',
	'ad:char:left'                  => '%s karakter maradt',
	'ad:status:expired'             => 'Lejárt',
	'ad:status:active'              => 'Aktív',
	'ad:views'                      => 'Megtekintések',
	'ad:status'                     => 'Állapot',
	'ad:end:date:infinity'          => 'Soha',

	//cron
	'ossn:adscron:title'            => 'Szükséges beállítás: Hirdetések automatikus lejárata',
	'ossn:adscron:last:run'         => 'Legutóbbi Cron futás:',
	'ossn:adscron:never'            => 'Soha',
	'ossn:adscron:configure'        => 'Beállítás',
	'ossn:adscron:description'      => 'Ahhoz, hogy a hirdetések állapota automatikusan %s állapotra váltson, be kell állítania egy rendszer szintű cron feladatot, amely naponta egyszer, délben (12:00) fut le.',
	'ossn:adscron:expired'          => 'Lejárt',
	'ossn:adscron:command:label'    => 'Crontab parancs',
	'ossn:adscron:path:placeholder' => 'AZ_ÖN_SZERVERÉNEK_PHP_ÚTVONALA',
	'ossn:adscron:warning:title'    => 'Fontos megjegyzés:',
	'ossn:adscron:warning:text'     => 'Amint egy hirdetés lejár, az %s. A hirdetőknek teljesen új hirdetést kell létrehozniuk a nulláról.',
	'ossn:adscron:cannot:edit'      => 'többé nem szerkeszthető és nem újítható meg',
);
ossn_register_languages('hu', $hu);