<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {
 


 public function __construct() {
      parent::__construct();
	$this->load->library('session');
	$language=$this->session->userdata('lang_use');
	$this->lang->load('home',$language);
	$this->load->library('migration');
	$this->load->model('navigation/NavigationPostModel');
  }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{



		$data['navigation'] = $this->NavigationPostModel->read_navigation();
		$data['login_required'] = '';

			//check active route

		
		//end

		
		$this->load->view('public/header');
		$this->load->view('public/navigation',$data);
		$this->load->view('scan');
		$this->load->view('public/footer');
	}

	
}
