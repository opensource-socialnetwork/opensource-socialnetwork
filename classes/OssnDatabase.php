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

class OssnDatabase {
    /**
    * Connect to mysql database
    *
    * @return bool;
    */	
	public function Connect(){
        $settings = ossn_database_settings();	
        $connect =  new mysqli(
					   $settings->host, 
					   $settings->user, 
					   $settings->password, 
					   $settings->database
					   );
        if(!$connect->connect_errno){
			return $connect;	
        } 
        else {
        return false;
       } 
	}
    /**
    * Prepare a mysqli query
    *
    * @return bool;
    */	
    public function statement($query){
        if(!empty($query)){	
          $this->query =  $query;
		  return true;
        }
        return false;
    }
    /**
    * Execute a mysqli query and store result in memory
    *
    * @return bool;
    */	
    public function execute(){
	    $this->database = $this->Connect();
	    if(isset($this->query) && !empty($this->query)){
		    $this->exe = $this->database->query($this->query);
		    if(!$this->exe){
			   throw new exception("{$this->database->error} \n {$this->query} ");
		    }
		    if(isset($this->database->insert_id)){
		       $this->last_id = $this->database->insert_id;
		    } 
            unset($this->query);
		    $this->database->close();
		    return true;
	    }
        return false;	
	}
    /**
    * Prepare a query to insert data in database
    *
	* @params = array();
	*           $params['names'] = names of columns
	*           $params['values'] = values that need to be inserted
	*           $params['into'] = table name
	*
    * @return bool;
    */		
    public function insert($params){
        if(is_array($params)){
 	        if(count($params['names']) == count($params['values'])){
                $colums = "`".implode("`, `", $params['names']).'`';
	            $values = "'".implode("', '", $params['values'])."'";
	            $query = "INSERT INTO {$params['into']} ($colums) VALUES ($values);";
	            $this->statement($query);
		        if($this->execute()){
		            return true;	
		        }
	         }
        }
        return false;
	}
    /**
    * Prepare a query to update data in database
    *
	* @params = array();
	*           $params['names'] = names of columns
	*           $params['values'] = values that need to be updated
	*           $params['table'] = table name
	*           $params['wheres'] =  specify a selection criteria to update required records
	*
    * @return bool;
    */		
    public function update($params = array()){
		if(is_array($params)){
			if(count($params['names']) == count($params['values']) && !empty($params['table'])){
				$valuec = count($params['names']);
				$i = 1;
				foreach($params['names'] as $key => $val){
					$data[$val] = $params['values'][$key]; 
				}
				foreach($data as $keys => $vals){
			        if($i == $valuec){
					  $valyes[] = "`{$keys}` = '{$vals}'";
					} else {
					$valyes[] = "`{$keys}` = '{$vals}',";	
					}
					$i++;
				}
				$q = implode('', $valyes);
				$params['wheres'] = implode(' ', $params['wheres']);
				$query = "UPDATE {$params['table']} SET {$q} WHERE {$params['wheres']}";
				$this->statement($query);
				if($this->execute()){
					return true;
				}
					
			}
		}
	}
    /**
    * Prepare a query to select data from database
    *
	* @params = array();
	*           $params['from'] = names of table
	*           $params['params'] = names of columns which you want to select
	*           $params['wheres'] =  specify a selection criteria to get required records
	*
    * @return bool;
    */	
    public function select($params, $multi = ''){
	   if(is_array($params)){
		   if(!isset($params['params'])){
		       $parameters = '*';	
		       } else {
		       $parameters = implode(', ',$params['params']);	
		    }
		    $order_by = '';
		    if(!empty($params['order_by'])){
		       $order_by = "ORDER by {$params['order_by']}";
		    }
		    $where = implode(' ', $params['wheres']);
		    if(!empty($params['wheres'])){
		       $wheres = "WHERE({$where})"; 	
		    }
		    $query = "SELECT {$parameters} FROM `{$params['from']}` {$wheres} {$order_by};";
		    $this->statement($query);
		    if($this->execute()){
		       return $this->fetch($multi);	
	  	    }
	   }
	    return false;
	}
    /**
    * Prepare a query to delete data from database
    *
	* @params = array();
	*           $params['from'] = names of table
	*           $params['wheres'] =  specify a criteria for deletion
	*
    * @return bool;
    */		
    public function delete($params){
   	        if(is_array($params)){
	  	      $where = implode(' ', $params['wheres']);
		      if(!empty($params['wheres'])){
		         $wheres = "WHERE({$where})"; 	
		      }
		     $query = "DELETE FROM `{$params['from']}` {$wheres};";
		     $this->statement($query);
		     if($this->execute()){
		        return $this->fetch($multi);	
		     }
			}
	        return false;
	}  
    /**
    * Fetch the data from memory that is stored during execution;
    *
	* @params = $data = (ture if you want to fetch all data , or flase if only one row)
	*
    * @return bool;
    */		
    public function fetch($data = false){ 
      if(isset($this->exe)){	
         if($data !== true){         
	        if($fetch = $this->exe){
      	      return arrayObject($fetch->fetch_assoc());  
             }
		 }
		 if($data === true){
	        if($fetch = $this->exe){
			    while($all = $fetch->fetch_assoc()) {
                       $alldata[] = arrayObject($all);
                  } 
			}
				  if(isset($alldata) && !empty($alldata)){
					return arrayObject($alldata);  
				  }
		}
	  }
      return false;
	}
	/**
    * Get a guid of newly create entry
    *
    * @return (int);
    */
    public function getLastEntry(){
           if(!empty($this->last_id)){
	           return $this->last_id;	
	       }
    }

}//class