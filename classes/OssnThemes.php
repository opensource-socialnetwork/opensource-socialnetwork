<?php

/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnThemes extends OssnSite {
    /**
     * Get theme details
     *
     * @params $name = theme id;
     *
     * @return (object) or return false;
     */
    public static function getTheme($name) {
        $name = trim($name);
        if (!preg_match('/\s/', $name)) {
            $dir = ossn_route()->themes;
            $theme = $dir . $name;
            if (is_file("{$theme}/ossn_theme.xml")) {
                $theme_path = simplexml_load_file("{$theme}/ossn_theme.xml");
                return $theme_path;
            }
        }
        return false;
    }

    /**
     * Get active theme
     *
     * @return string;
     */
    public function getActive() {
        return $this->getSettings('theme');
    }

    /**
     * Get total themes
     *
     * @return int;
     */
    public function total() {
        return count($this->getThemes());
    }

    /**
     * Get components list
     *
     * @return components ids;
     */
    public function getThemes() {
        $dir = ossn_route()->themes;
        $theme_ids = array();
        $handle = opendir($dir);

        if ($handle) {
            while ($theme_id = readdir($handle)) {
                if (substr($theme_id, 0, 1) !== '.' && is_dir($dir . $theme_id) && !preg_match('/\s/', $theme_id) && is_file("{$dir}{$theme_id}/ossn_theme.php") && is_file("{$dir}{$theme_id}/ossn_theme.xml")
                ) {
                    $theme_ids[] = $theme_id;
                }
            }
        }

        sort($theme_ids);
        return $theme_ids;
    }

    /**
     * Upload component
     *
     * @requires component package file,
     *
     * @return bool;
     */
    public function upload() {
        $archive = new ZipArchive;
        $data_dir = ossn_get_userdata('tmp/themes');
        if (!is_dir($data_dir)) {
            mkdir($data_dir, 0755, true);
        }
	$file = new OssnFile;
	$file->setFile('theme_file');
        $zip = $file->file;
        $newfile = "{$data_dir}/{$zip['name']}";
        if (move_uploaded_file($zip['tmp_name'], $newfile)) {
            if ($archive->open($newfile) === TRUE) {
                $archive->extractTo($data_dir);
                $archive->close();
                $validate = pathinfo($zip['name'], PATHINFO_FILENAME);
                if (is_file("{$data_dir}/{$validate}/ossn_theme.php") && is_file("{$data_dir}/{$validate}/ossn_theme.xml")
                ) {
                    $archive->open($newfile);
                    $archive->extractTo(ossn_route()->themes);
                    $archive->close();
                    OssnFile::DeleteDir($data_dir);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get active theme startup file
     *
     * @return string;
     */
    public function getActivePath() {
        $path = ossn_route()->themes;
        return "{$path}{$this->getSettings('theme')}/ossn_theme.php";
    }

    /**
     * Enable Theme
     *
     * @params $name = theme id;
     *
     * @return bool;
     */
    public function Enable($theme) {
        if (!empty($theme)) {
            if ($this->UpdateSettings(array('value'), array($theme), array("setting_id='1'"))
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Delete theme
     *
     * @return bool;
     */
    public function deletetheme($theme) {
        if(OssnFile::DeleteDir(ossn_route()->themes . "{$theme}/")){
          return true;  
        }
        return false;
    }


}//class
