<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function bianconeroIMG($img) {
    $im = creaCopia($img);
    imagefilter($im, IMG_FILTER_GRAYSCALE);
    return creaModificata($img, $im);
}

function luminositaIMG($img, $valoreL = 0, $valoreC = 0) {
    $im = creaCopia($img);
    imagefilter($im, IMG_FILTER_BRIGHTNESS, round($valoreL * 2.5));
    imagefilter($im, IMG_FILTER_CONTRAST, -$valoreC);
    return creaModificata($img, $im);
}

function ruotaIMG($img, $gradiInt, $sO, $sV) {
    $im = creaCopia($img);

    if ($sO){
        imageflip($im, IMG_FLIP_HORIZONTAL);
    }
    if ($sV){
        imageflip($im, IMG_FLIP_VERTICAL);
    }
    $bg = imagecolorallocatealpha($im, 0, 0, 0, 0);
    $im = imagerotate($im, -$gradiInt, $bg);

    return creaModificata($img, $im);
}

function nitidezzaIMG($img, $sigma = 1) {
    $im = creaCopia($img);
    $sharpen = array(
        array(0.0, -1.0, 0.0),
        array(-1.0, 5.0, -1.0),
        array(0.0, -1.0, 0.0)
        );
        $divisor = array_sum(array_map('array_sum', $sharpen));
        imageconvolution($im, $sharpen, $divisor, 0);
        return creaModificata($img, $im);
}

function sfocaturaIMG($img, $sigma = 1) {
    $im = creaCopia($img);
    for ($i = 0; $i < $sigma; $i++) {
        imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
    }
    return creaModificata($img, $im);
}

function inverticoloriIMG($img) {
    $im = creaCopia($img);
    imagefilter($im, IMG_FILTER_NEGATE);
    return creaModificata($img, $im);
}

function riducicoloriIMG($img, $dt = true, $ncolori = 8) {
    $im = creaCopia($img);
    imagetruecolortopalette($im, $dt, $ncolori);
    return creaModificata($img, $im);
}

function bordiIMG($img) {
    $im = creaCopia($img);
    imagefilter($im, IMG_FILTER_GRAYSCALE);
    imagefilter($im, IMG_FILTER_EDGEDETECT);
    imagefilter($im, IMG_FILTER_CONTRAST, -80);
    imagefilter($im, IMG_FILTER_BRIGHTNESS, 40);
    return creaModificata($img, $im);
}

function pixelIMG($img, $pixelsize = 10) {
    $im = creaCopia($img);
    $width = imagesx($im);
    $height = imagesy($im);

    $im = imagescale($im, max(1, (int)($width / $pixelsize)), max(1, (int)($height / $pixelsize)), IMG_NEAREST_NEIGHBOUR);
    $im = imagescale($im, $width, $height, IMG_NEAREST_NEIGHBOUR);

    return creaModificata($img, $im);
}


function creaCopia($img) {
    return imagecreatefromstring(file_get_contents($img));
}

function creaModificata($img, $modificata) {
    $pathInfo = pathinfo($img);
    $nuovoPath = $pathInfo['dirname'].'/'.$pathInfo['filename'].'_mod.'.$pathInfo['extension'];

    switch (strtolower($pathInfo['extension'])) {
        case 'jpg':
        case 'jpeg': imagejpeg($modificata, $nuovoPath, 90); break;
        case 'png':  imagepng($modificata, $nuovoPath); break;
        case 'gif':  imagegif($modificata, $nuovoPath); break;
    }

    imagedestroy($modificata);
    return $nuovoPath;
}

?>
