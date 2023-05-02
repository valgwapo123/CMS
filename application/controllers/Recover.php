<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recover extends CI_Controller {
 


 public function __construct() {
      parent::__construct();
	$this->load->library('migration');
	$this->load->library('session');
	$language=($this->session->userdata('lang_use')==null)? 'de' : $this->session->userdata('lang_use');
	$this->session->set_userdata('lang_use', $language);
	$this->lang->load('home',$language);
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


			//check active route

		$data['parent_id'] = '';

		$data['parent_id_2'] = '';

		$data['parent_full']=  '';
		//end
		$language=($this->session->userdata('lang_use')=='')? 'de' : $this->session->userdata('lang_use');	

		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['navigation'] = $this->NavigationPostModel->read_navigation($this->NavigationPostModel->get_parent_id($language),0);

		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['login_required'] = '';

		$this->load->view('public/header');
		$this->load->view('public/navigation',$data);
		$this->load->view('recover');
		$this->load->view('public/footer');
	}


}
