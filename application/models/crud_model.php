<?php 

class CRUD_model extends CI_Model {

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
	*
	*/
	public function update($data, $user_id) {
		$this->db->where(['user_id' => $user_id]);
		$this->db->update('user', $data);

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
	
}