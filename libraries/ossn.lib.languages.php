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
/**
 * Register a language in system;
 * @param  string $code code of language;
 *
 * @last edit: $arsalanshah
 * @return void;
 */
function ossn_register_language($code = '', $file) {
		if(isset($code) && isset($file)) {
				global $Ossn;
				$Ossn->locale[$code][] = $file;
		}
}

/**
 * Get a languages strings;
 * @param string $code Code of language;
 * @param array $params Translations;
 * 
 * @return void;
 */
function ossn_register_languages($code, $params = array()) {
		global $Ossn;
		if(isset($Ossn->localestr[$code], $code)) {
				$params = array_merge($Ossn->localestr[$code], $params);
		}
		$Ossn->localestr[$code] = $params;
}

/**
 * Get registered language codes;
 * 
 * @return array
 */
function ossn_locales() {
		global $Ossn;
		if(!isset($Ossn->locale)) {
				return false;
		}
		foreach($Ossn->locale as $key => $val) {
				$keys[] = $key;
		}
		if(!empty($keys)) {
				return $keys;
		} else {
				return array();
				
		}
}

/**
 * Print a locale;
 * @param string $id Id of locale;
 * @param array $args Array;
 *
 * @return string
 */
function ossn_print($id = '', $args = array()) {
		global $Ossn;
		$id   = strtolower($id);
		$code = ossn_site_settings('language');
		if(!empty($Ossn->localestr[$code][$id])) {
				$string = $Ossn->localestr[$code][$id];
				if($args) {
						$string = vsprintf($string, $args);
				}
				return $string;
		} else {
				return $id;
		}
		
}

/**
 * Load system locales
 *
 * @return void
 */
function ossn_default_load_locales() {
		global $Ossn;
		$active = ossn_site_settings('language');
		if(ossn_site_settings('cache') == 1) {
				$system_locale_cache = ossn_get_userdata("system/locales/");
				$cached_locale       = $system_locale_cache . "ossn.{$active}.json";
				if(file_exists($cached_locale)) {
						//this includes component language file too
						//Cache the locale files #1321
						$cached_locale_array = json_decode(file_get_contents($cached_locale), true);
						if(!json_last_error()) {
								$Ossn->localestr[$active] = $cached_locale_array;
						} else {
							throw new exception('Can not decode the cached language file');	
						}
				}
		} else {
				if(isset($Ossn->locale[$active])) {
						foreach($Ossn->locale[$active] as $locales) {
								if(is_file($locales)) {
										include_once($locales);
								}
						}
				}
		}
}
/**
 * Load json locales.
 *
 * @return string|false or false
 */
function ossn_load_json_locales($lcode = "") {
		global $Ossn;
		$code = ossn_site_settings('language');
		if(!empty($lcode)) {
				$code = $lcode;
		}
		if(!isset($Ossn->localestr[$code])) {
				return false;
		}
		$isUTF8 = function($str) {
				return preg_match("/^(
         [\x09\x0A\x0D\x20-\x7E]            # ASCII
       | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
       |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
       |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
       |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
       |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
      )*$/x", $str);
		};
		foreach($Ossn->localestr[$code] as $key => $item) {
				if(!$isUTF8($item)) {
						$strings[$key] = utf8_encode($item);
				} else {
						$strings[$key] = $item;
				}
		}
		$json = json_encode($strings, JSON_UNESCAPED_UNICODE);
		if($json) {
				return $json;
		}
		return json_encode(array());
}
/**
 * Return an array of installed translations as an associative
 * array "two letter code" => "native language name".
 *
 * This function contain code from other project
 * See licenses/elgg/LICENSE.txt 
 *
 * @return array
 */

function ossn_get_installed_translations($percentage = true) {
		global $Ossn;
		$installed = array();
		ossn_load_available_languages();
		
		foreach($Ossn->locale as $k => $v) {
				$installed[$k] = ossn_print($k, array(), $k);
				$completeness  = ossn_get_language_completeness($k);
				if(($completeness < 100) && ($k != 'en') && $percentage !== false) {
						$installed[$k] .= " (" . $completeness . "% " . ossn_print('ossn:language:complete') . ")";
				}
		}
		
		return $installed;
}
/**
 * Return the level of completeness for a given language code (compared to english)
 *
 * @param string $language Language
 *
 * This function contain code from other project
 * See licenses/elgg/LICENSE.txt 
 *
 * @return int
 */
function ossn_get_language_completeness($language) {
		global $Ossn;
		$en = count($Ossn->localestr['en']);
		
		$missing = ossn_get_missing_language_keys($language);
		if($missing) {
				$missing = count($missing);
		} else {
				$missing = 0;
		}
		
		//$lang = count($Ossn->translations[$language]);
		$lang = $en - $missing;
		
		return round(($lang / $en) * 100, 2);
}
/**
 * Return the translation keys missing from a given language,
 * or those that are identical to the english version.
 *
 * @param string $language The language
 *
 * @return mixed
 */
function ossn_get_missing_language_keys($language) {
		global $Ossn;
		
		$missing = array();
		
		foreach($Ossn->localestr['en'] as $k => $v) {
				if(!isset($Ossn->localestr[$language][$k])) {
						$missing[] = $k;
				}
		}
		
		if(count($missing)) {
				return $missing;
		}
		
		return false;
}
/**
 * Get list of ISO 639-1 language codes
 *
 * @return array
 */
function ossn_standard_language_codes() {
		return array(
				'aa',
				'ab',
				'af',
				'am',
				'ar',
				'as',
				'ay',
				'az',
				'ba',
				'be',
				'bg',
				'bh',
				'bi',
				'bn',
				'bo',
				'br',
				'ca',
				'co',
				'cs',
				'cy',
				'da',
				'de',
				'dz',
				'el',
				'en',
				'eo',
				'es',
				'et',
				'eu',
				'fa',
				'fi',
				'fj',
				'fo',
				'fr',
				'fy',
				'ga',
				'gd',
				'gl',
				'gn',
				'gu',
				'he',
				'ha',
				'hi',
				'hr',
				'hu',
				'hy',
				'ia',
				'id',
				'ie',
				'ik',
				'is',
				'it',
				'iu',
				'iw',
				'ja',
				'ji',
				'jw',
				'ka',
				'kk',
				'kl',
				'km',
				'kn',
				'ko',
				'ks',
				'ku',
				'ky',
				'la',
				'ln',
				'lo',
				'lt',
				'lv',
				'mg',
				'mi',
				'mk',
				'ml',
				'mn',
				'mo',
				'mr',
				'ms',
				'mt',
				'my',
				'na',
				'ne',
				'nl',
				'no',
				'oc',
				'om',
				'or',
				'pa',
				'pl',
				'ps',
				'pt',
				'qu',
				'rm',
				'rn',
				'ro',
				'ru',
				'rw',
				'sa',
				'sd',
				'sg',
				'sh',
				'si',
				'sk',
				'sl',
				'sm',
				'sn',
				'so',
				'sq',
				'sr',
				'ss',
				'st',
				'su',
				'sv',
				'sw',
				'ta',
				'te',
				'tg',
				'th',
				'ti',
				'tk',
				'tl',
				'tn',
				'to',
				'tr',
				'ts',
				'tt',
				'tw',
				'ug',
				'uk',
				'ur',
				'uz',
				'vi',
				'vo',
				'wo',
				'xh',
				'yi',
				'yo',
				'za',
				'zh',
				'zu'
		);
}
/**
 * Load all available languages
 *
 * @return void
 */
function ossn_load_available_languages($language_selection = false) {
		if(!$language_selection) {
				$codes = ossn_standard_language_codes();
		} else {
				$codes = array();
				$codes[] = $language_selection;
		}
		$path  = ossn_route();
		
		$components = new OssnComponents;
		$themes = new OssnThemes;

		//load core framework languages
		foreach($codes as $code) {
				$file = $path->locale . "ossn.{$code}.php";
				if(is_file($file)) {
						include_once($file);
				}
		}
		//load component languages
		$components = $components->getComponents();
		foreach($components as $component) {
				foreach($codes as $code) {
						$file = $path->components . '/' . $component . "/locale/ossn.{$code}.php";
						if(is_file($file)) {
								include_once($file);
						}
				}
		}
		//load theme languages
		$themes = $themes->getThemes();
		foreach($themes as $theme) {
				foreach($codes as $code) {
						$file = $path->themes . $theme . "/locale/ossn.{$code}.php";
						if(is_file($file)) {
								include_once($file);
						}
				}
		}
}
/**
 * Get list of all available languages
 *
 * @return array
 */
function ossn_get_available_languages() {
		$codes = ossn_standard_language_codes();
		$path  = ossn_route();
		
		$com_langs  = array();
		$core_langs = array();
		
		$components = new OssnComponents;
		
		//load core framework languages
		foreach($codes as $code) {
				$file = $path->locale . "ossn.{$code}.php";
				if(is_file($file)) {
						$core_langs[] = $code;
				}
		}
		//load component languages
		$components = $components->getActive();
		foreach($components as $component) {
				foreach($codes as $code) {
						$file = $path->components . '/' . $component->com_id . "/locale/ossn.{$code}.php";
						if(is_file($file)) {
								$com_langs[] = $code;
						}
				}
		}
		$langs = array_merge($com_langs, $core_langs);
		return array_unique($langs);
}
