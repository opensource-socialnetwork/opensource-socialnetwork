<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */

class OssnSite extends OssnDatabase{
   /**
	* Get site settings;
	*
	* @params = $settings => settings name
	*
	* @return string;
	*/	
	public function getSettings($settings){
		$params['from'] = 'ossn_site_settings';
		$params['wheres'] = array("name='{$settings}'");
		$this->settings = $this->select($params);
		return $this->settings->value;
	}
   /**
	* Get all site settings;
	*
	* @return object;
	*/		
	public function getAllSettings(){
		$params['from'] = 'ossn_site_settings';
		$this->settings = $this->select($params, true);
		foreach($this->settings as $setting){
		   $result[$setting->name] = $setting->value;	
		}
		return arrayObject($result, get_class($this));
	}	
   /**
	* Update site settings;
	*
	* @params = $settings => array(settings)
	*           $values => array(values)
	*           $wheres => array(settings id)
	*
	* @return bool;
	*/		
	public function UpdateSettings($settings, $values, $wheres){
		$params['table'] = 'ossn_site_settings';
		$params['names'] = $settings;
		$params['values'] = $values;
		$params['wheres'] = $wheres;
		if($this->settings = $this->update($params)){
		 return true;	
		}
		return false;
	}
   /**
	* Check Update;
	*
	* @return string;
	*/		
	public function checkUpdate(){
	    global $OhYesChat;
	    $plugin = elgg_get_plugins_path().'OhYesChat/';
	    $url = 'https://api.github.com/repos/lianglee/OhYesChat/contents/manifest.xml';
        $args['method'] = 'GET';
        $args['header'] = "Accept-language: en\r\n" .
              "Cookie: ohyes=chat\r\n" .
              "User-Agent: Mozilla/5.0\r\n" ;
        $options['http'] = $args;
        $context = stream_context_create($options);
        $file = file_get_contents($url, false, $context);
        $data = json_decode($file);
        $file = simplexml_load_string(base64_decode($data->content));
        require_once("{$plugin}version.php");
	    if(empty($file->version)){
	       return array('ohyeschat:new:version:error');	
	    }
	    if($file->version > $OhYesChat->release){
		   return array('ohyeschat:new:version:avaialbe', $file->version);	
	    }  
	    elseif($OhYesChat->release = $file->version){
	      return  array('ohyeschat:new:version:latest', $OhYesChat->release);	
	    }
    }
}//CLASS