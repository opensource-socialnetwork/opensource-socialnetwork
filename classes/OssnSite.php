<?php

/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnSite extends OssnDatabase {
    /**
     * Get site settings;
     *
     * @param string $settings settings name
     * @param string $settings
     *
     * @return string
     */
    public function getSettings($settings) {
        $params['from'] = 'ossn_site_settings';
        $params['wheres'] = array("name='{$settings}'");
        $this->settings = $this->select($params);
        return $this->settings->value;
    }

    /**
     * Get all site settings
     *
     * @return object
     */
    public function getAllSettings() {
        $params['from'] = 'ossn_site_settings';
        $this->settings = $this->select($params, true);
        foreach ($this->settings as $setting) {
            $result[$setting->name] = $setting->value;
        }
        return arrayObject($result, get_class($this));
    }

    /**
     * Update site settings
     *
     * @param array $settings array(settings)
     * @param array $values array(values)
     * @param array $wheres array(settings id)
     *
     * @return boolean
     */
    public function UpdateSettings($settings, $values, $wheres) {
        $params['table'] = 'ossn_site_settings';
        $params['names'] = $settings;
        $params['values'] = $values;
        $params['wheres'] = $wheres;
        if ($this->settings = $this->update($params)) {
            return true;
        }
        return false;
    }
}//CLASS