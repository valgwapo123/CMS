

<!DOCTYPE html>
<html>



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Setup</title>
	<?php
	ob_start("minifier");
	function minifier($code) {
	$search = array(
	     
	    // Remove whitespaces after tags
	    '/\>[^\S ]+/s',
	     
	    // Remove whitespaces before tags
	    '/[^\S ]+\</s',
	     
	    // Remove multiple whitespace sequences
	    '/(\s)+/s',
	     
	    // Removes comments
	    '/<!--(.|\s)*?-->/'
	);
	$replace = array('>', '<', '\\1');
	$code = preg_replace($search, $replace, $code);
	return $code;
	}?>
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-font-smoothing: antialiased;
      -moz-font-smoothing: antialiased;
      -o-font-smoothing: antialiased;
      font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
    }

    body {
      font-family: "Roboto", Helvetica, Arial, sans-serif;
      font-weight: 100;
      font-size: 12px;
      line-height: 30px;
      color: #777;
      background: #4CAF50;
    }

    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      position: relative;
    }

    #formchecker input[type="text"],
    #formchecker input[type="email"],
    #formchecker input[type="tel"],
    #formchecker input[type="url"],
    #formchecker textarea,
    #formchecker button[type="submit"] {
      font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
    }

    #formchecker {
      background: #F9F9F9;
      padding: 25px;
      margin: 150px 0;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    #formchecker h3 {
      display: block;
      font-size: 30px;
      font-weight: 300;
      margin-bottom: 10px;
    }

    #formchecker h4 {
      margin: 5px 0 15px;
      display: block;
      font-size: 13px;
      font-weight: 400;
    }

    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }

    #formchecker input[type="text"],
    #formchecker input[type="email"],
    #formchecker input[type="tel"],
    #formchecker input[type="url"],
    #formchecker textarea {
      width: 100%;
      border: 1px solid #ccc;
      background: #FFF;
      margin: 0 0 5px;
      padding: 10px;
    }

    #formchecker input[type="text"]:hover,
    #formchecker input[type="email"]:hover,
    #formchecker input[type="tel"]:hover,
    #formchecker input[type="url"]:hover,
    #formchecker textarea:hover {
      -webkit-transition: border-color 0.3s ease-in-out;
      -moz-transition: border-color 0.3s ease-in-out;
      transition: border-color 0.3s ease-in-out;
      border: 1px solid #aaa;
    }

    #formchecker textarea {
      height: 100px;
      max-width: 100%;
      resize: none;
    }

    #formchecker button[type="submit"] {
      cursor: pointer;
      width: 100%;
      border: none;
      background: #4CAF50;
      color: #FFF;
      margin: 0 0 5px;
      padding: 10px;
      font-size: 15px;
    }

    #formchecker button[type="submit"]:hover {
      background: #43A047;
      -webkit-transition: background 0.3s ease-in-out;
      -moz-transition: background 0.3s ease-in-out;
      transition: background-color 0.3s ease-in-out;
    }

    #formchecker button[type="submit"]:active {
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .copyright {
      text-align: center;
    }

    #formchecker input:focus,
    #formchecker textarea:focus {
      outline: 0;
      border: 1px solid #aaa;
    }

    ::-webkit-input-placeholder {
      color: #888;
    }

    :-moz-placeholder {
      color: #888;
    }

    ::-moz-placeholder {
      color: #888;
    }

    :-ms-input-placeholder {
      color: #888;
    }


    #installbtn{
		cursor: pointer;
		width: 100%;
		border: none;
		background: #4CAF50;
		color: #FFF;
		margin: 0 0 5px;
		padding: 10px;
		font-size: 15px;
    }

    #installbtn:hover{
    	  background: #43A047;
      -webkit-transition: background 0.3s ease-in-out;
      -moz-transition: background 0.3s ease-in-out;
      transition: background-color 0.3s ease-in-out;
    }

    .loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #3498db;
		width: 50px;
		height: 50px;
		-webkit-animation: spin 2s linear infinite; /* Safari */
		animation: spin 2s linear infinite;
	}

	/* Safari */
	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}

  </style>
	<?php
	ob_end_flush();
	?>
</head>

<body>
<div class="container">  
  <form id="formchecker" action="" method="post">
    <h3 id="req_title"></h3>
     <h5 id="doneinstall">DOWNLOAD DONE..</h5>
     <h5 id="UNZIP">UNZIP DONE..</h5>
    <fieldset>
      <input placeholder="api key"  name="apiKey" id="apiKey" type="text" tabindex="1" required autofocus value="3492ioeoSDFweyhiwe8923y4">
    </fieldset>

    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
     


      <button onclick="downloadsrc()" name="submit" type="button" id="installbtn" data-submit="...Sending">Install</button>
      
     <center id="loader">
     	 <h3 id="downlable"></h3>
     	  <div class="loader" ></div>
     </center>
		
  </form>

</div>
</body>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

 <script type="text/javascript">

	document.getElementById("installbtn").style.display = "none";


	document.getElementById("req_title").innerHTML = "Requirement Checker"; 
	document.getElementById("loader").style.display = "none";
	document.getElementById("doneinstall").style.display = "none";
	document.getElementById("UNZIP").style.display = "none";


    $("#formchecker").submit(function(e) {


      var apikeyval = document.getElementById("apiKey").value;

    e.preventDefault();

    $.ajax({
        method: "post",
        url: "<?php echo ('req_check.php?apikeyval=')?>"+apikeyval,
        dataType:'JSON',
        success: function(value){

        	// document.getElementById("response").style.display = "block";
        	// document.getElementById("phpversion").innerHTML=value.phpversion;
        	// document.getElementById("sqlite3").innerHTML=value.sqlite3;
        	// document.getElementById("MOD_REWRITE").innerHTML=value.MOD_REWRITE;
        	// document.getElementById("curl").innerHTML=value.curl;
        	// document.getElementById("endpoint").innerHTML=value.endpoint;
        	// document.getElementById("zipopen").innerHTML=value.zip_open;


        	if(value.endpoint =='working' && value.sqlite3 =='enabled'){
        		document.getElementById("installbtn").style.display= "block";
        		document.getElementById("req_title").innerHTML = "Install your website"; 
        		document.getElementById("contact-submit").style.display= "none";
        	}
        
        
           // document.getElementById("response").innerHTML =value;
          console.log(value);
     	

        },
        error: function() { alert("Error Connection Lost."); }
   });

 

});


    function downloadsrc(){

        document.getElementById("loader").style.display = "block";

	
		document.getElementById("installbtn").style.display = "none";
		document.getElementById("apiKey").style.display = "none";
		document.getElementById("downlable").innerHTML = "Downloading"; 

  		setTimeout(calldownload,5000);
    }

    function calldownload(){

	var apikeyval = document.getElementById("apiKey").value;

      $.ajax({
	        method: "post",
	        url: "<?php echo ('download_zip.php?apikeyval=')?>"+apikeyval,
	        dataType:'TEXT',
	        success: function(response){

	        	console.log(response.trim());
	        	if(response.trim()=='done'){

	        		 document.getElementById("loader").style.display = "none";
	        		 document.getElementById("doneinstall").style.display = "block";
	        		 unzip();
	        	}
	      		
	      	  

	      	 
	      	    //  run(response)
	      	

	        },
	        error: function() { alert("Error Connection Lost."); }
	      });
    }


        function unzip(){

		document.getElementById("loader").style.display = "block";

	      $.ajax({
		        method: "post",
		        url: "<?php echo ('unzip.php')?>",
		        dataType:'TEXT',
		        success: function(response){

		        	console.log(response.trim());
		        	if(response.trim()=='done'){
		        		document.getElementById("loader").style.display = "block";
		        		document.getElementById("downlable").innerHTML = "unzipping..";  	
		        		document.getElementById("UNZIP").style.display = "block";
		        		 document.getElementById("loader").style.display = "none";
		        	}
		      		
		      	  

		      	 
		      	    //  run(response)
		      	

		        },
		        error: function() { alert("Error Connection Lost."); }
		      });
    }



	
 </script>
</html>

