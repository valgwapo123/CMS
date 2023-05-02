<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
 


 public function __construct() {
      parent::__construct();
      $this->load->library('migration');
	$this->load->library('session');
	$language=($this->session->userdata('lang_use')=='')? 'de' : $this->session->userdata('lang_use');
	$this->lang->load('home',$language);
	$this->load->model('navigation/NavigationPostModel');
     $this->load->library('curl');

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
         
		$this->curl->set_url(site_url('cron_job')); 
		$this->curl->set_method('post');
		$response = $this->curl->result();


	    if($this->session->userdata('LOGIN')=='YES'){
			
			
			$this->logout();

       		
		}


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
		$this->load->view('login');
		$this->load->view('public/footer');
	}

	function logout(){
		$this->session->unset_userdata('LOGIN');
		$this->session->sess_destroy();
		redirect('/');

	}

	public function redirectlogin(){
		redirect('login');
	}


	public function scanview(){

		$data['parent_id'] = '';

		$data['parent_id_2'] = '';

		$data['parent_full']=  '';
		$language=($this->session->userdata('lang_use')=='')? 'de' : $this->session->userdata('lang_use');	

		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['navigation'] = $this->NavigationPostModel->read_navigation($this->NavigationPostModel->get_parent_id($language),0);

		


		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['login_required'] = '';

		$this->load->view('public/header');
		$this->load->view('public/navigation',$data);
		$this->load->view('scan');
		$this->load->view('public/footer');
	}

	public function quickregister(){


		$data['parent_id'] = '';

		$data['parent_id_2'] = '';

		$data['parent_full']=  '';
		$language=($this->session->userdata('lang_use')=='')? 'de' : $this->session->userdata('lang_use');	

		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['navigation'] = $this->NavigationPostModel->read_navigation($this->NavigationPostModel->get_parent_id($language),0);

		


		$data['language_'] = $this->NavigationPostModel->read_language(0);
		$data['login_required'] = '';

		$this->load->view('public/header');
		$this->load->view('public/navigation',$data);
		$this->load->view('quick_register');
		$this->load->view('public/footer');
		
	}

	



}
