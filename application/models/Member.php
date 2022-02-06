<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'members';
    }
    
    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){          
            
            if(!array_key_exists("date of birth", $data)){
				$var = $data['dob'];
				$date = str_replace('/', '-', $var);				
                $data['dob'] = date('Y-m-d', strtotime($date));
            }
			if(!array_key_exists("date of joining", $data)){
				$var = $data['join_date'];
				$date = str_replace('/', '-', $var);				
                $data['join_date'] = date('Y-m-d', strtotime($date));
            }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

	public function saverecords($name,$code,$dept,$dob,$join){
		
		$b_date = date('Y-m-d', strtotime($dob));
		$j_date = date('Y-m-d', strtotime($join));
		$query="insert into members values('','$name','$code','$dept','$b_date','$j_date')";
		$this->db->query($query);
	}
}
