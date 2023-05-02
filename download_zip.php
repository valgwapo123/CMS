

<?php

 if (isset($_GET['apikeyval'])) {
     
     ob_clean();
     // create a new curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.keller-digital.com/v0/install?apiKey=".$_GET['apikeyval']);

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);



    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

   
    $arr=json_decode(str_replace("[]","",$output), true);
    
    dfCurl(str_replace("http","https",$arr['frontend']));


    if (!file_exists('zip')) {
                                
         mkdir('zip', 0755, true);
    }


}
    function dfCurl($url){
     $ch     =   curl_init($url);
     $dir            =   'zip/';
     $fileName       =   basename($url);
     $saveFilePath   =   $dir . $fileName;
     $fp             =   fopen($saveFilePath, 'wb');
     curl_setopt($ch, CURLOPT_FILE, $fp);
     curl_setopt($ch, CURLOPT_HEADER, 0);

     curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');

     // Enable progress updates
     curl_setopt($ch, CURLOPT_NOPROGRESS, false);

     echo "done";
     curl_exec($ch);
     curl_close($ch);
     fclose($fp);
    }



    function progress($resource, $download_size, $downloaded, $upload_size, $uploaded)
     {
     // Calculate the download progress
     $progress = ($downloaded / $download_size) * 100;

     // Output the progress as a percentage
     // echo "Progress: $progress%\n";
     }



?>


