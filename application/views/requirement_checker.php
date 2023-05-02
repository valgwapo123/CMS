<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
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
  </style>
</head>
<body>
<div class="container">  
  <form id="formchecker" action="" method="post">
    <h3>Requirement Checker</h3>

    <fieldset>
      <input placeholder="api key"  name="apiKey" id="apiKey" type="text" tabindex="1" required autofocus>
    </fieldset>

    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
     
     <div id="response"></div>
  </form>
</div>
</body>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

 <script type="text/javascript">
   $('form#formchecker').submit(function(e) {


      var apikeyval = document.getElementById("apiKey").value;

    e.preventDefault();

    $.ajax({
        method: "post",
        url: "<?php echo site_url('checker_req'); ?>",
        data: {apikey:document.getElementById("apiKey").value},
        dataType:'TEXT',
        success: function(value){

           document.getElementById("response").innerHTML =value;
          console.log(value);
     

        },
        error: function() { alert("Error Connection Lost."); }
   });

    console.log(document.getElementById("apiKey").value);
    console.log('xxx');

});
 </script>
</html>
