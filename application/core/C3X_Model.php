<?php

class C3X_Model extends CI_Model
{
	var $table;
	var $pk;
	var $fields;

	function __construct() { $this->C3X_Model(); }

	function C3X_Model()
	{
		$this->load->database();
	}
	
	/** Utility Methods **/
	function fields(){
		return $this->fields;
	}
	
	function pk(){
		return $this->pk;
	}
	
	/** CRUD Methods **/
	function get( $options = array() ){
		foreach ($this->fields as $key => $value) {
			if(isset($options[$key]) && $key != "pages" && $key != "categories")
				$this->db->where($key, $options[$key]);
		}
			
		if(!empty($options['pages'])){
			$pages = str_replace("-", " ", $options['pages'] );
			$this->db->where("MATCH(pages) AGAINST('".$pages."' IN BOOLEAN MODE)");
		}

		if(!empty($options['categories'])){
			$categories = str_replace("-", " ", $options['categories'] );
			$this->db->where("MATCH(categories) AGAINST('".$categories."' IN BOOLEAN MODE)");
		}

		if(isset($options['exclude'])){
			$this->db->where("id NOT IN ('".implode("','", $options['exclude']). "')");
		}
			
		if(isset($options[$this->pk]))
				$this->db->where($this->pk, $options[$this->pk]);
		
		// limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);
		
		// sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);
		
		$query = $this->db->get($this->table);
//print_r($this->db->last_query());
		if(isset($options['count'])) return $query->num_rows();
		
		if(isset($options[$this->pk])) return $query->row(0);
			
		return $query->result();
	}

	
	function add($options = array())
	{
		$this->db->insert($this->table, $options);
		
		return $this->db->insert_id();
	}
	
	function update($options = array())
	{
		foreach ($this->fields as $key => $value) {
			if(isset($options[$key]))
				$this->db->set($key, $options[$key]);
		}

		$this->db->where($this->pk, $options[$this->pk]);
		
		$this->db->update($this->table);
		
		return $this->db->affected_rows();
	}
	
	function delete($pId)
	{
		$this->db->delete($this->table, array($this->pk => $pId)); 	
		
		return $this->db->affected_rows();
	}
}

?>