<?php 
class Todo_model extends CRUD_Model {

	protected $_table = 'todo';
	protected $_primary_key = 'todo_id';

	// ---------------------------------------------------------------------

	public function __construct () {

		parent::__construct();
	}

	// ---------------------------------------------------------------------

}

