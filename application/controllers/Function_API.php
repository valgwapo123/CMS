<?php
class Function_API extends CI_Controller {
 
 function __Construct()
 {
	parent::__Construct ();

 	 $this->load->library('session');
	 $apiKey=null;
	 $response=null;
	 $api=null;
	 $user=null;
	 $country=null;
	 $city=null;
	 $latitude=null;
	 $longitude=null;
	 $referer=null;
	 $bank=null;
	 $error=null;

	//header('Content-Type: application/json');
	$this->load->model("navigation/NavigationPostModel");
  $this->load->model("setting/SettingPostModel");
  $this->load->model("setting/SettingUpdateModel");
  $this->load->model("post/DeleteModel");
 	$this->load->model("post/CreateModel");
 	$this->load->model("post/UpdateModel");
 	$this->load->model("post/PostModel");
 

 	$this->load->library('session');
  
	$this->load->library('curl');
	$this->load->dbforge();

 }
 
 public function Login() {


		$username=$this->input->post('username');
		$password=$this->input->post('password');


		$this->config->item('apihost').'/user/login/?username='.$username.'&password='.$password;
		$this->curl->set_url($this->config->item('apihost').'/user/login/?username='.$username.'&password='.$password);
  $this->curl->set_method('post');
  $response = $this->curl->result();
      if (array_key_exists("error", json_decode($response, true))){
      $message=json_decode($response);      
      $url = (object)parse_url($_SERVER['HTTP_REFERER']);
      
      redirect($url->path.'?error='.$message->error);
		
					




       }else{
         
         	$response= json_encode(json_decode('['.$response.']', JSON_UNESCAPED_SLASHES));			



						$this->create_session($response);



		 	 		$this->session->set_userdata('LOGIN', 'YES');
			     $this->session->set_userdata('username', $this->input->post('username'));
		

					$routelink=($this->input->post('langvalue')=='')? 'de': $this->input->post('langvalue');


					$navitem=($this->NavigationPostModel->GetFirstNavItem_ALias($this->NavigationPostModel->get_parent_id($routelink))=='')? $this->NavigationPostModel->GetFirstNavItem_name($this->NavigationPostModel->get_parent_id($routelink)): $this->NavigationPostModel->GetFirstNavItem_ALias($this->NavigationPostModel->get_parent_id($routelink));

					redirect($routelink.'/'.$navitem);



       }
	
	
	}



	 public function create_session($array){


 	
		
			 foreach(json_decode($array, true) as $elem) {
		     foreach ($elem['auth'] as $key => $value){
								

							$this->session->set_userdata($key,$value);

		     		
		     }
		      foreach ($elem['profile'] as $key => $value){
		      		if($key!='addresses'){

		      				$this->session->set_userdata($key,$value);
		      		}

		      			
								
		     		
		     }
		   
		  } 



 }




	 public function DeleteSqlite($tablename) {

     $unixtime=$this->SettingPostModel->get_unixtime($tablename);
		 	$this->curl->set_url($this->config->item('apihost').'/'.$tablename.'?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime);
    $this->curl->set_method('post');
			 $response = $this->curl->result();


			   $response= json_encode(json_decode('['.$response.']', JSON_UNESCAPED_SLASHES));		

			 foreach(json_decode($response, true) as $elem) {

 					 if (array_key_exists('deleted',$elem)){
								for ($i = 0; $i < count($elem['deleted']); $i++) {

										$return= $this->DeleteModel->deleteitem($tablename,$elem['deleted'][$i]['id_original']);


								}
 					 }	
					
			 }


		}



// commented code
// public function saveFile($filename,$folder) {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, 'https://cms.keller-digital.com/upload/ckfinder/14/' . $folder . '/' . $filename);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
//     $fileData = curl_exec($ch);
//     curl_close($ch);
//     if (!$fileData) {
//       // There was an error executing the cURL request
//       throw new Exception('Error executing cURL request: ' . $this->curl->error_string());
//     }

//     // Save file to local directory
//     file_put_contents($_SERVER['DOCUMENT_ROOT'].'/upload/ckfinder/14/'.$folder.'/'.$filename,$fileData);
//   }



   
	 public function insertSqlite($tablename) {   
	  $id_mandant='';  

     $unixtime=$this->SettingPostModel->get_unixtime($tablename);
     
     echo "<br/>Fetching: ".$tablename.'<br/>';
     echo $this->config->item('apihost').'/'.$tablename.'?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime;
    	$this->curl->set_url($this->config->item('apihost').'/'.$tablename.'?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime);
     $this->curl->set_method('post');
     $response = $this->curl->result();



  	  $response= json_encode(json_decode('['.$response.']', JSON_UNESCAPED_SLASHES));		
     
     
     foreach(json_decode($response, true) as $elem) {






       for ($i = 0; $i < count($elem['schema']); $i++) {

       	//create table
       		

         if (!$this->db->field_exists($elem['schema'][$i]['COLUMN_NAME'], $tablename)){
          $fields = array(
										$elem['schema'][$i]['COLUMN_NAME']=> array(
										   'type' => $elem['schema'][$i]['DATA_TYPE'],
										   'constraint' => 100,

										)
									);
									$this->dbforge->add_column($tablename, $fields);
							}
		}

					  // handle media

       // handle the rows returned       
       foreach($elem['rows'] as $data) { 




       if ($tablename=="navigation"){  

        	$this->createFilefolders($data['id_mandant']);     
       
       }

       		$preview_Array='';
       		$full_Array='';
       		$id='';	
       		if (array_key_exists("images",$data)){
       				$preview_Array=json_decode(json_encode($data['images']['preview']),true);
								$full_Array=json_decode(json_encode($data['images']['full']),true);
								$id= $data['id'];	
       		}



       		$Files_Array='';
       		$id='';	
       		if (array_key_exists("files",$data)){


       			$Files_Array=		json_decode(json_encode($data['files']),true);;
				

       		}
							

								//check if exist id then update else insert into table name
								if( $this->PostModel->read_single_id($data['id'],$tablename)==true){

									//remove file and image
									// unset($data['files'], $data['images']); 

									//remove file 
								

									if (array_key_exists("images",$data)){

									
								
		

									 	
							       	 	$arrayPreview = array();
							       	 	$arrayFull = array();

							     	 		foreach (json_decode(json_encode($data['images']['preview'],true)) as $preview){

							     	 		  $arrayPreview[] = $preview;

							     	 			
							     	 		}



							     	 			foreach (json_decode(json_encode($data['images']['full'],true)) as $full){

							     	 			   $arrayFull[] = $full;


							     	 		}

							  




							     	 		$data['images']=	json_encode( 
							     	 			  array(
							     	 			  	'preview' =>$arrayPreview,
							     	 			  	 'full' =>$arrayFull,
							     	 			
							     	 				),true
							     	 			);


								  }

								 
							  	 if (array_key_exists("files",$data)){
							  		$data['files']=  json_encode($data['files']);
							    }

								if (array_key_exists("html",$data)){

									
								$data['html']=  str_replace("// focusAt","focusAt",$data['html']);		
								$data['html']=  str_replace("/ Do Nothing","//Do Nothing",$data['html']);
								$data['html']=  str_replace("/if","if",$data['html']);
								$data['html']=  str_replace("/if","if",$data['html']);
							  }
							  


								  $return= $this->UpdateModel->update_table($data['id'],array_merge($data,array("checksum" =>md5(json_encode($data)))),$tablename); 



								} else {
									
									//remove file 
								
									if (array_key_exists("images",$data)){


										  
									 	
							       	 	$arrayPreview = array();
							       	 	$arrayFull = array();

							     	 		foreach (json_decode(json_encode($data['images']['preview'],true)) as $preview){

							     	 		  $arrayPreview[] = $preview;

							     	 			
							     	 		}



							     	 			foreach (json_decode(json_encode($data['images']['full'],true)) as $full){

							     	 			   $arrayFull[] = $full;


							     	 		}

							     	 		$data['images']=	json_encode( 
							     	 			  array(
							     	 			  	'preview' =>$arrayPreview,
							     	 			  	 'full' =>$arrayFull,
							     	 			
							     	 				),true
							     	 			);

								  }
									
								   if (array_key_exists("files",$data)){
							  		$data['files']= json_encode($data['files']);
							    }

									if (array_key_exists("html",$data)){
										$data['html']=  str_replace("// focusAt","focusAt",$data['html']);		
										$data['html']=  str_replace("/ Do Nothing","//Do Nothing",$data['html']);
										$data['html']=  str_replace("/if","if",$data['html']);
										$data['html']=  str_replace("/if","if",$data['html']);
									}
							  
								 
								  $return= $this->CreateModel->insertDatabase(array_merge($data,array("checksum" =>md5(json_encode($data)))),$tablename); 
								}	 

							 //store image f   

				// get id_mandant				
				$id_mandant=$this->NavigationPostModel->get_id_mandant();
				

					 	if (array_key_exists("images",$data)){		


	  	      	 	 foreach($preview_Array as $prev) {  

									
							

												$src = $this->config->item('cms_image_path').$prev;
												$path = 'upload/img-gen/'.str_replace("/img-gen/","",$prev);
	  										
	  										$this->saveFile($src,$path);	


	  	      	 	 }

	  	      	 	  foreach($full_Array as $fullimage) { 



	  	      	 	  			$src = $this->config->item('cms_image_path').$fullimage;

												$path = 'upload/img-gen/'.str_replace("/img-gen/","",$fullimage);
	
  										
	  										$this->saveFile($src,$path);
	  	      	 	 
	
									



	  	      	 	 }

                
	  	      	 	 	 foreach($Files_Array as $files) {  
                  if (!file_exists('upload/'.$tablename.'/')) {
                    mkdir('upload/'.$tablename, 0777, true);
                  }

	  	      	 	  			$src = $this->config->item('cms_image_path').$files;
                  $path = 'upload/'.$tablename.'/'.str_replace("/".$tablename."/","",$files);
	  										
	  										$this->saveFile($src,$path);
	  	      	 	 
  	      	 		 }	
  	      	 	}

  	    
		   	
       }
     if (array_key_exists("media",$elem)){	

     	  
      foreach($elem['media']['files'] as $filename) {

       	

       	$path = 'upload/ckfinder/'.$id_mandant.'/files/'.$filename;
        $this->saveFile($this->config->item('cms_image_path').'/ckfinder/'.$id_mandant.'/files/'.$filename,$path);
       }
       foreach($elem['media']['images'] as $filename) {
  
       		$path = 'upload/ckfinder/'.$id_mandant.'/images/'.$filename;
           $this->saveFile($this->config->item('cms_image_path').'/ckfinder/'.$id_mandant.'/images/'.$filename,$path);

       }


       
     }

    	


  
     } 

		

	
	  	echo json_encode(
  	    array(
  	    	'response'=> 'job run successfully',
  	    	
  	    
  	  	)
  	  );



	}


 public function unixtimeupdate($tablename){

 	 $passingdata = array(			
		 		'date_time_sync'=>date('m/d/Y h:i:s a', time()),
		 		 'unixtime'=>time()
				);
      
  	  	$return= $this->SettingUpdateModel->update_setting($tablename,$passingdata); 
 }

 public function unixtime_default($tablename){
 	   // check if this table was already created and updated
   // if not create the table and set timestamp = 0
			if( $this->SettingPostModel->check_exist($tablename) !=true){
   	 $passingdata = array(
       'table_name' => $tablename,
       'date_time_sync'=>date($this->config->item('date_start').' h:i:s a', 0),
      	'unixtime'=>0
     );
     $return= $this->CreateModel->insertDatabase($passingdata,'Setting'); 
   }
 }




public function saveFile($src,$path){
		$url = $src;

		// Set the path to save the file to
		$save_path = $path;

		// Open the file for writing
		$fp = fopen($save_path, 'w');

		// Use curl to download the file
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FILE, $fp);

		// Execute the download
		$data = curl_exec($ch);

		// Close the file and curl handle
		fclose($fp);
		curl_close($ch);
}



 public function checkColumnExist($array,$tblname){


   foreach($array as $data) { 

	 		foreach ($data as $key => $value){

	 			 if (!$this->db->field_exists($key, $tblname))
					{


							$fields = array(
								$key=> array(
								   'type' => 'TEXT',
								   'constraint' => 100,

								)
							);
							 $this->dbforge->add_column($tblname, $fields);


					}

				

	 		}	
 		}



 }




	public function quickregister() {


		$url = $this->config->item('apihost');

		$username=$this->input->post('username');
		$password=$this->input->post('password');

		$gender=$this->input->post('gender');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$phone==intval($this->input->post('phone'));
		$firstname=$this->input->post('firstname');
		$password=$this->input->post('password');
		$qrcode=$this->input->post('qrcode');
		$id_mandant=$this->input->post('id_mandant');

		$response ='';

		if ($this->input->post('referer')>0){    


			$this->curl->set_url($this->config->item('apihost').'/session/?do=quickregister&id_mandant='.$qrcode.'&'.$password.'=&refererid=&phone='.$phone.'&age=&'.$username.'=&gender'.$gender.'=&username=&'.$password.'=&apiKey='.$this->config->item('apikey'));
	    $this->curl->set_method('post');
	    echo $response = $this->curl->result();

		}else{

				$this->curl->set_url($this->config->item('apihost').'/session/?do=quickregister&id_mandant='.$id_mandant.'&'.$password.'=&refererid=&phone='.$phone.'&age=&'.$username.'=&gender'.$gender.'=&username=&'.$password.'=&apiKey='.$this->config->item('apikey'));
	    $this->curl->set_method('post');
	   echo $response = $this->curl->result();
		}	
	


	



	}	


		public function recover() {


		// kvstore API url
		$url = $this->config->item('apihost');


		$email=$this->input->post('email');



		$this->curl->set_url($this->config->item('apihost').'/session/?do=recover&email='.$email.'&apiKey='.$this->config->item('apikey'));
    $this->curl->set_method('post');
    $response = $this->curl->result();

		


		 echo json_encode(
	      array('response'=> ($response==false)? "no response": "$response"
	   )
	    );

		   redirect('recover?er=yes');
       
	


	}



	//check update api
		 public function checkupdate() {
     echo "Checkupdate<br>";
     $unixtime=0;
      $unixtime=$this->SettingPostModel->get_unixtime('updates');
     echo $this->config->item('apihost').'/updates?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime;
     echo '<br>'.date("d.m.y H:i:s",$unixtime).'<br/>';
     
     $this->curl->set_url($this->config->item('apihost').'/updates?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime);
     $this->curl->set_method('post');
     $response = $this->curl->result();
     //echo "<br>";
     print_r($response);
     
     return $response;
  	}    





    public function createFilefolders($id_mandant){
   	//create folder

    if (!file_exists('upload')) {
								
						 mkdir('upload', 0755, true);
    }

   	if (!file_exists('upload/img-gen')) {
								
						 mkdir('upload/img-gen', 0755, true);
			}
			
			if (!file_exists('upload/ckfinder/'.$id_mandant.'/files')) {
								
						 mkdir('upload/ckfinder/'.$id_mandant.'/files', 0755, true);
			}

				if (!file_exists('upload/ckfinder/'.$id_mandant.'/images')) {
								
						 mkdir('upload/ckfinder/'.$id_mandant.'/images', 0755, true);
			}




			


			

   }	



  
  public function checkupdate_route(){

  		
  	
  	
			

	    $unixtime=	($this->SettingPostModel->check_exist('updates') !=true)?  0:  $this->SettingPostModel->get_unixtime('updates');

			$this->config->item('apihost').'/updates?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime;
			$this->curl->set_url($this->config->item('apihost').'/updates?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime);
			$this->curl->set_method('post');


			 $response = $this->curl->result();
			
			if($response !='false'){
				$countupdate =count(json_decode($response,true));
				if($countupdate>0){
					//run cron job automatic
					$this->cron_job('yes');
				}	
			}else{
				echo "false";
			}


    
  

 
  }


   public function requirement_checker(){


   	$apiKey=$this->input->post('apiKey');


   	echo $apiKey;

   	// if($apiKey !=''){
			if(phpversion() >=7.4){
			echo 'PHP version: <Strong style="color: green;">' . phpversion() .' </Strong>';
			}else{
			echo 'PHP version: <Strong style="color: red;">below 7.4 requirement </Strong>';
			}

			echo '<br>';

			echo (extension_loaded('sqlite3'))? "SQLite3 :<Strong style='color: green;'> enabled  </Strong>": "SQLite3 :<Strong style='color: red;'>  not enabled </Strong>";
			echo '<br>';
			echo (defined('MOD_REWRITE'))? "<Strong style='color: green;'> mod_rewrite : enabled</Strong>" : "mod_rewrite : <Strong style='color: red;'>not enabled </Strong>"; 
			echo '<br>';

			echo (extension_loaded('curl'))?    "curl extension: <Strong style='color: green;'>enabled</Strong>" :    "curl : <Strong style='color: green;'>not enabled</Strong>";
			echo '<br>';

			echo $this->checkcurlWorking($apiKey);

			echo '<br>';
   	}
   
    



  public function formchecker(){
  	$this->load->view('requirement_checker');
  }


  public function checkcurlWorking($apiKey){


  	 $unixtime=	($this->SettingPostModel->check_exist('updates') !=true)?  0:  $this->SettingPostModel->get_unixtime('updates');
      $this->config->item('apihost').'/updates?apiKey='.$apiKey.'&unixtime='.$unixtime;
   
     
     $this->curl->set_url($this->config->item('apihost').'/updates?apiKey='.$this->config->item('apikey').'&unixtime='.$unixtime);
     $this->curl->set_method('post');
      $response = $this->curl->result();

     if($response=='[]'){
     	echo ' Curl endpoint: <Strong style="color: red;">api key not working</Strong>';
     }else{
     	echo ' Curl endpoint: <Strong style="color: green;">working</Strong>';
     }	
      



  }


  //checking interval  $this->config->item('interval_cronjob')
  public function CheckIntervalTime(){


			$databasetime = date("h:i:sa", strtotime( $this->PostModel->get_timeupdate()));

			  $FROM_time = date("H:i", strtotime($databasetime));
			 
			 $To_time = date("H:i", strtotime(date("h:i:sa")));




			$time1 = new DateTime(date("H:i", strtotime($databasetime)));
			$time2 = new DateTime(date("H:i", strtotime(date("h:i:sa"))));

			$interval = $time1->diff($time2);
			 $interval->format('%H:%I:%S');

      if($interval->format('%H:%I:%S') > $this->config->item('interval_cronjob')){

      	// echo 'true';

      	return true;
      }else{
      	//echo 'false';

      		return false;
      }



  }
 
	public function cron_job($automatic = 'no'){    


		

			//create folder setup
	

    if($this->SettingPostModel->check_exist('updates') !=true){
    

    
      	$passingdata = array(
        'table_name' => 'updates',
        'date_time_sync'=>0
       );
       $return= $this->CreateModel->insertDatabase($passingdata,'Setting'); 
    }else{

    	if($automatic=='no'){
					if(	$this->CheckIntervalTime()==false){


					return; //stop
					}
    	}

    


    }

    // list jobs
    // for running this at the first time
    // now the "date_time_sync" should be 0
    
				foreach (json_decode($this->checkupdate()) as $newupdate) {
					$this->createTable($newupdate); //create table
					$this->unixtime_default($newupdate);
				  $this->insertSqlite($newupdate); //run api function of updates

					if($this->SettingPostModel->get_unixtime($newupdate)==0){
				  	$this->unixtimeupdate($newupdate);
					}	

				}


			//get all table 	
			foreach ($this->PostModel->showall('Setting') as $key =>$val){

		 		if($val['table_name'] !='updates'){

		 			//delete 
		 				 $this->DeleteSqlite($val['table_name']);
		 				
		 		}
		 	
			}

			
		//setting logs
    $passingdata = array(
			
		 		'date_time_sync'=>date('m/d/Y h:i:s a', time()),
		 		 'unixtime'=>time()
				);
    // uncommented for testing
  	 $return= $this->SettingUpdateModel->update_setting('updates',$passingdata); 
	
	}	








//create table
	public function createTable($tablename){


		if (!$this->db->table_exists($tablename)){


				$this->dbforge->add_field(array(
            $tablename.'_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
       
           'checksum' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
            ),
        ));
        $this->dbforge->add_key($tablename.'_id', TRUE);
      $this->dbforge->create_table($tablename, TRUE);
	  }
	}



	
}
