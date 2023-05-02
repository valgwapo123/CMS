<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Switchlanguage extends CI_Controller {
 


 public function __construct() {
      parent::__construct();
	$this->load->library('session');
    $this->load->model('navigation/NavigationPostModel');
	
  }


  public function switchlang($param1,$param2,$param3)
 {


     if($param3=='login' ){
        $this->session->set_userdata('lang_use', $param1);

        redirect($param1.'/'.$param2);

     }else{
        $this->session->set_userdata('lang_use', $param1);

       redirect($param1.'/'.$param3);
     }
    
 	
 }

}


