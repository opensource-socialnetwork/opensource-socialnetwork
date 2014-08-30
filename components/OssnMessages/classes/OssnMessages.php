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
class OssnMessages extends OssnDatabase {
	public function send($from, $to, $message){
		$message = htmlentities($message, ENT_QUOTES, "UTF-8");
		$params['into'] = 'ossn_messages';
		$params['names'] = array('message_from', 'message_to', 'message', 'time', 'viewed');
		$params['values'] = array((int)$from, (int)$to, $message, time(), '0');
		if($this->insert($params)){
		  return true;	
		}
		return false;
	}
	public function get($from, $to){
		$params['from'] = 'ossn_messages';
		$params['wheres'] = array("message_from='{$from}' AND 
								  message_to='{$to}' OR 
								  message_from='{$to}' AND 
								  message_to='{$from}'");
		$params['order_by'] = "id ASC";
		return $this->select($params, true);
	}
	public function markViewed($from, $to){
		$params['table'] = 'ossn_messages';
		$params['names'] = array('viewed');
		$params['values'] = array(1);
		$params['wheres'] = array("message_from='{$from}' AND 
								   message_to='{$to}'");
		if($this->update($params)){
		 return true;	
		}
	return false;	
	}
	public function getNew($from , $to, $viewed = 0){
		$params['from'] = 'ossn_messages';
		$params['wheres'] = array("message_from='{$from}' AND 
								   message_to='{$to}' AND viewed='{$viewed}'");
		return $this->select($params, true);
	}
	public function recentChat($to){
		$params['from'] = 'ossn_messages';
		$params['wheres'] = array("message_to='{$to}' OR message_from='{$to}'");
	    $params['order_by'] = "id DESC";
		$c = $this->select($params, true);
        foreach($c as $rec){
	     $r[$rec->message_from] = $rec->message_to;	
        }
        foreach($r as $k => $v){
          if($k !== $to){
            $latest = get_object_vars($this->get($to, $k));
            $latest = array_reverse($latest);
            $latest = arrayObject($latest[0]);
            $c = get_object_vars($latest);
            if(!empty($c)){
               $u[] = $latest;
            }  
          }
        }
        return $u;
	}
	public function recentSent($from){
		$params['from'] = 'ossn_messages';
		$params['wheres'] = array("message_from='{$from}'");
	    $params['order_by'] = "id DESC";
		$c = $this->select($params, true);   
        foreach($c as $rec){
	     $r[$rec->message_from] = $rec->message_to;	  
        }
		return $r;
	}
	public function countUNREAD($to){
		$params['from'] = 'ossn_messages';
		$params['wheres'] = array("message_to='{$to}'AND viewed='0'");
	    $params['params'] = array('count(*) as new');
		$count = $this->select($params, true);
		return $count->{0}->new;
	}
}//class