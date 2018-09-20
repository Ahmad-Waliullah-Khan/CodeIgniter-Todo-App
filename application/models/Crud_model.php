<?php 

class Crud_model extends CI_Model {

	protected $_table = null;
	protected $_primary_key = null;

	// ---------------------------------------------------------------------

	public function __construct () {

		parent::__construct();
	}

	// ---------------------------------------------------------------------
	
	/**
	*
	*
	* @usage
	* All : $this->user_mdel->get();
	* Single : $this->user_model->get(2);
	* Custom : $this->user_model->get(array('age' => '32', 'gender' => 'male'))
	*/
	public function get($id = null, $order_by = null) {

		if(is_numeric($id)){

			$query = $this->db->where($this->_primary_key, $id);
		}

		if (is_array($id)) {
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}

		if(is_numeric($order_by)){

			$this->db->order_by($this->_primary_key, "desc");
		}

		if (is_array($order_by)) {
			foreach ($order_by as $_key => $_value) {
				$this->db->order_by($_key, $_value);
			}
		}

		// if ($order_by != null) {
		// 	$this->db->order_by($this->_primary_key, "desc");
		// }

		$query = $this->db->get($this->_table);

		return $query->result_array();

		
	}

	// ---------------------------------------------------------------------
	
	/**
	*
	* @param array $data
	* @usage $result = $this->user_model->insert([
			'login' => 'Oli'
		]);
	* Single : $this->user_model->get(2);
	* All : $this->user_mdel->get();
	*/

	// ---------------------------------------------------------------------
	
	public function insert($data) {
		$this->db->insert($this->_table, $data);

		return $this->db->insert_id();

	}

	// ---------------------------------------------------------------------
	
	/**
	*
	* @usage
	* $result = $this->user_model->update(['login' => 'MJ'], 2);
	* $this->user_model->update(['login' => 'Oli'], [date_created' => '0']);
	*/
	public function update($new_data, $where) {
		

		if(is_numeric($where)) {
			$this->db->where($this->_primary_key, $where);
		}

		elseif(is_array($where)) {
			foreach ($where as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		} 

		else {
			die('You must pass a second parameter to the UPDATE() method.');
		}

		$this->db->update($this->_table, $new_data);
		return $this->db->affected_rows();


	}

	// ---------------------------------------------------------------------
	
	/**
	*
	* @usage
	* $result = $this->user_model->delete(2);
	*			$this->user_model->delete(array('name' => 'Oli'))
	*/
	public function delete($id) {

		if(is_array($id))
		{
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}

		elseif(is_numeric($id))
		{
			$this->db->where($this->_primary_key, $id);
		}	

		else {
			die('You must pass a parameter to the DELETE() method.');
		}

		$this->db->delete($this->_table);
		return $this->db->affected_rows();

	}
	
	// ---------------------------------------------------------------------
	
	/**
	*
	* @usage 
	* $result = insertUpdate(['name' => 'ted'], 12)
	*
	*/
	public function insertUpdate($data, $id = false) {

		if(!$id) {
			die('You must pass a second parameter to the insertUPDATE() method.');
		}
		$this->db->select($this->_primary_key);
		$this->db->where($this->_primary_key, $id);
		$query = $this->db->get($this->_table);
		$result = $query->num_rows();

		if($result == 0)
		{
			//insert
			return $this->insert($data);
			

		}
		else 
		{
			//update
			return $this->update($data, $id);
		}

		
	}

	// ---------------------------------------------------------------------

}