<?php 

class Api extends CI_Controller {

	// ---------------------------------------------------------------------

	public function __construct() {

		parent::__construct();
		
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

		//Load user model
		$this->load->model('user_model');
		
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
		
		//Load user model
		$this->load->model('user_model');

		$user_id = $this->user_model->insert([
			'login' => $login,
			'password' => hash('sha256', $password . SALT),
			'email' => $email
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
	
	public function create_todo () {

		$this->_require_login();

	}

	// ---------------------------------------------------------------------
	
	public function update_todo () {
		$this->_require_login();

		$todo_id = $this->input->post('todo_id');
		
	}

	// ---------------------------------------------------------------------
	
	public function delete_todo () {
		$this->_require_login();
		
		$todo_id = $this->input->post('todo_id');
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