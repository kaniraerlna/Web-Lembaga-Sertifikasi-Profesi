<?php
    session_start();

    function randomCaptcha(){
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $pass = array();

        $panjangAlpha = strlen($alphabet) - 2;
        for($i = 0; $i < 6; $i++){  
            $n = rand(0, $panjangAlpha);
            $pass[] = $alphabet[$n];
        }

        return implode($pass);
    }

    // untuk mengacak captcha
    $code = randomCaptcha();
    $_SESSION['code'] = $code;

    // lebar dan tinggi captcha
    $wh = imagecreatetruecolor(200, 50);

    // background colour
    $bgc = imagecolorallocate($wh, 20, 19, 216);

    // text color abu abu
    $fc = imagecolorallocate($wh, 223, 230, 233);
    imagefill($wh, 0, 0, $bgc);

    // ($image, $fontsize, $string, $fontcolor)
    imagestring($wh, 10, 80, 20, $code, $fc);

    // buat gambar
    header('content-type; image/jpg');
    imagejpeg($wh);
    imagedestroy($wh);
?>