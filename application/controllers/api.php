<?php 

//Set time zone
date_default_timezone_set('Asia/Kolkata'); 

class Api extends CI_Controller {

	// ---------------------------------------------------------------------

	public function __construct() {

		parent::__construct();

		$this->load->model('user_model');
		$this->load->model('todo_model');
		$this->load->model('note_model');
		
	}

	// ---------------------------------------------------------------------
	
	private function _require_login () {

		$user_id = $this->session->userdata('user_id');

		if($user_id === false) {
			$this->output->set_output(json_encode([
				'result' => 0,
				'error' => 'You are not autorized!'
			]));
			return false;
		}
		
	}

	// ---------------------------------------------------------------------
	
	public function login() {

		$login = $this->input->post('login');
		$password = $this->input->post('password');
		
		$result = $this->user_model->get([
			'login' => $login,
			'password' => hash('sha256', $password . SALT)
		]);

		$this->output->set_content_type('application_json');

		if($result) {
			$this->session->set_userdata(['user_id' => $result[0]['user_id']]);
			
			$this->output->set_output(json_encode([
				'result' => 1
			]));

			return false;
		}

		$this->output->set_output(json_encode([
				'result' => 0
			]));

	
	}

	// ---------------------------------------------------------------------
	
	public function register() {



		$this->output->set_content_type('application_json');


		// $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');

		$this->form_validation->set_rules('login', 'Login', 'required|is_unique[user.login]|min_length[4]|max_length[16]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|max_length[16]');

		//custom validation message
		// $this->form_validation->set_message('required', 'Cannot enter empty field');
		// $this->form_validation->set_message('valid_email', 'Must be a valid Email');



		if (($this->form_validation->run() == FALSE)) {
			
			$this->output->set_output(json_encode([
				'result' => 0,
				'error' => $this->form_validation->error_array()
			]));
			return false;
		} 
		// else {
		// 	# code...
		// }

		$login = $this->input->post('login');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$cofirm_password = $this->input->post('cofirm_password');

		$dateSql = date('Y-m-d h:i:sa');

		$user_id = $this->user_model->insert([
			'login' => $login,
			'password' => hash('sha256', $password . SALT),
			'email' => $email,
			'date_created' => $dateSql,
			'date_modified' => $dateSql
		]);

	

		if($user_id) {
			$this->session->set_userdata(['user_id' => $user_id]);
			
			$this->output->set_output(json_encode([
				'result' => 1
			]));

			return false;
		}

		$this->output->set_output(json_encode([
				'result' => 0,
				'error' => 'User not created!'
			]));
		
	}

	// ---------------------------------------------------------------------
	
	public function get_todo ($id =null) {
		$this->_require_login();

		if($id != null) {
			$result = $this->todo_model->get([
			'todo_id' => $id,
			'user_id' => $this->session->userdata('user_id')
		]);
		} else {
			$this->todo_model->get([
				'user_id' => $this->session->userdata('user_id')
			]);
		}
		
		$this->db->order_by("todo_id", "desc");
		$query = $this->db->get('todo');
		$result = $query->result_array();

		$this->output->set_output(json_encode($result));

		// print_r($result);

	}

	// ---------------------------------------------------------------------
	
	public function create_todo () {

		$this->_require_login();

		$this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');

		if($this->form_validation->run() === false)
		{
			$this->output->set_output(json_encode([
				'result' => 0,
				'error' => $this->form_validation->error_array()
			]));
			
			return false;
		}

		$dateSql = date('Y-m-d h:i:sa');

		$result = $this->todo_model->insert([
			'content' => $this->input->post('content'),
			'user_id' => $this->session->userdata('user_id'),
			'date_added' => $dateSql,
			'date_modified' => $dateSql
		]);

		if ($result) {

			//Get the freshest Todo entry for the DOM
			// $query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);
			// $result = $query->result();
			$this->output->set_output(json_encode([
				'result' => 1,
				'data' => $result
			]));
			return false;
		}
		$this->output->set_output(json_encode([
			'result' => 0,
			'error' => 'Could not insert record'
		]));

	}

	// ---------------------------------------------------------------------
	
	public function update_todo () {
		$this->_require_login();

		$todo_id = $this->input->post('todo_id');
		$completed = $this->input->post('completed');

		$result = $this->todo_model->update([
			'completed' => $completed
		], $todo_id);
		// $this->db->where(['todo_id' => $todo_id]);
		// $this->db->update('todo', [
		// 	'completed' => $completed
		// ]);

		// $result = $this->db->affected_rows();

		if ($result) {
			$this->output->set_output(json_encode([
				'result' => 1
			]));

			return false;
		}

		$this->output->set_output(json_encode([
				'result' => 0
			]));
		return false;
		
	}

	// ---------------------------------------------------------------------
	
	public function delete_todo () {
		$this->_require_login();

		$result = $this->todo_model->delete([
			'todo_id' => $this->input->post('todo_id'),
			'user_id' => $this->session->userdata('user_id')
		]);

		if($result > 0) {

			$this->output->set_output(json_encode([
				'result' => 1
			]));
			return false;
		}
		$this->output->set_output(json_encode([
			'result' => 0,
			'message' => 'Could not delete record.'
		]));
	}

	// ---------------------------------------------------------------------
	
	public function get_note () {
		$this->_require_login();



	}

	// ---------------------------------------------------------------------
	
	public function create_note () {
		$this->_require_login();



	}

	// ---------------------------------------------------------------------
	
	public function update_note () {
		$this->_require_login();
		
		$note_id = $this->input->post('note_id');	
	}

	// ---------------------------------------------------------------------
	
	public function delete_note () {
		$this->_require_login();

		$note_id = $this->input->post('note_id');
		
	}

	// ---------------------------------------------------------------------
	
}