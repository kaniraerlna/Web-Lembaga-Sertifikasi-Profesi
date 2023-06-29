<?php
    $file = $_GET['url'];

    if(file_exists($file)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' .basename($file));
        header('Expired: 0');
        header('Pragma: public');
        header('Content-Length:' . filesize($file));
        readfile($file);
        exit;
    }
?>