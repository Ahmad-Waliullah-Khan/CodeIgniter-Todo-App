<?php 

class Home extends CI_Controller {
	public function index() {
		$this->load->view('home/inc/header_view');
		$this->load->view('home/home_view');
		$this->load->view('home/inc/footer_view');
	}

	// public function test_code() {

	// 	echo hash('sha256', '123456' . SALT);

	// 	//$this->load->library('encrypt');
	// 	// echo $this->encrypt->encode('My Secrete Passsword');
	// 	// echo $this->encrypt->decode('brtTzo3rwLCznM3elUAkHBHsWjSMYWoRsdCbW0SJZzowEpry02W8CrXKPlib3JMr+Mbsl5qqk6EiZlQaldpqXA==');
	// }
}

