<?php 
class User extends CI_Controller {

	public function __construct () {
		parent:: __construct();
		$this->load->model('user_model');
	}

	public function login() {
		
		//will come from database
		$this->sesion->$array = array(
			'user_id' => '1'
		);
		
		$this->session->set_userdata( $array );
	}


	public function test_get() {
		$result = $this->user_model->get(1);
		print_r($result);	

		//Profiler to dumb database info for debugging
		$this->output->enable_profiler();
	}

	public function test_insert() {
		$result = $this->user_model->insert([
			'login' => 'Oli'
		]);
		print_r($result);
	}

	public function test_update($user_id) {
		$result = $this->user_model->update([
			'login' => 'MJ'
		], $user_id);

		print_r($result);
	}

	public function test_delete($user_id) {
		$result = $this->user_model->delete($user_id);
		print_r($result);
	}
}