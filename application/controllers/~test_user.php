<?php 
class Test_User extends CI_Controller {

	// ---------------------------------------------------------------------
	
	public function __construct () {
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->helper('email');
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

		// print_r($result);

		// die;

		//will come from database
		// $this->sesion->$array = array(
		// 	'user_id' => '1'
		// );
		
		// $this->session->set_userdata( $array );
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
		

		// print_r($result);

		// die;

		//will come from database
		// $this->sesion->$array = array(
		// 	'user_id' => '1'
		// );
		
		// $this->session->set_userdata( $array );
	}

	// ---------------------------------------------------------------------
	
	public function test_get() {
		$result = $this->user_model->get(1);
		print_r($result);	

		//Profiler to dumb database info for debugging
		$this->output->enable_profiler();
	}

	// ---------------------------------------------------------------------
	
	public function test_insert() {
		$result = $this->user_model->insert([
			'login' => 'Oli'
		]);
		print_r($result);
	}

	// ---------------------------------------------------------------------
	
	public function test_update($user_id) {
		$result = $this->user_model->update([
			'login' => 'MJ'
		], $user_id);

		print_r($result);
	}

	// ---------------------------------------------------------------------
	
	public function test_delete($user_id) {
		$result = $this->user_model->delete($user_id);
		print_r($result);
	}
	
	// ---------------------------------------------------------------------
	
}