<?php

	

   if (isset($_GET['apikeyval'])) {
	
	if(phpversion() >=7.4){
	$phpversion=  phpversion();
	}else{
	$phpversion=  'below 7.4 requirement';
	}



	$sqlite3= (extension_loaded('sqlite3'))? "enabled": "not enabled";

	$MOD_REWRITE= (defined('MOD_REWRITE'))? "enabled" : "not enabled"; 


	$curl= (extension_loaded('curl'))?"enabled" : "not enabled";

	

 



	 echo json_encode(array('phpversion' => $phpversion,'sqlite3' => $sqlite3,'sqlite3' => $sqlite3,'MOD_REWRITE' => $MOD_REWRITE,'curl' => $curl,'endpoint' =>checkcurlWorking($_GET['apikeyval']),'zip_open'=> (function_exists('zip_open'))? 'available':'not available' ));

  }


	  function checkcurlWorking($apiKey){



	  	 $ch = curl_init('https://api.keller-digital.com/v0'.'/updates?apiKey='.$apiKey.'&unixtime='.$unixtime);

		// // Set cURL options
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// // Execute the request
		 $response = curl_exec($ch);

		// // Check for errors
		 if (curl_errno($ch)) {
		   // cURL request failed


		  return 'Curl endpoint: Error: ' . curl_error($ch);
		 } else {


		 	if (curl_exec($ch)=='false'){
		 		 return ' api key not working';
		 	}else{
				 return 'working';
		 	}
		//   // cURL request succeeded
		 
		}

		// // Close the connection
		 curl_close($ch);



		



  }





?>	

