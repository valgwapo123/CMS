<?php 


$zip = new ZipArchive;
if ($zip->open('zip/install.zip') === TRUE) {
    $zip->extractTo('zip');
    $zip->close();
    echo 'done';
} else {
    echo 'Failed to open the zip file';
}
?>