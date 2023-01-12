<?php
    $file_copied = $_GET["file_copied"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "./data/".$file_copied;

    if(file_exists($file_path)) {
        header("Content-Type: application/octet-stream");
        header('Content-Description: File Transfer');
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Transfer-Encoding:binary");
        header("Cache-Control:cache,must-revalidate");
        header("Pragma: public");
        header("Content-Length: " . filesize($file_path));
        flush();
        readfile($file_path);
        die();
    }
?>

  
