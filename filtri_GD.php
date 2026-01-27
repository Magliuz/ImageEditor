<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



/* ===== Effetti ===== */

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
    $matrix = [
        [-1, -1, -1],
        [-1, 16 + $sigma, -1],
        [-1, -1, -1]
    ];
    imageconvolution($im, $matrix, 8 + $sigma, 0);
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

function riducicoloriIMG($img, $ncolori = 8) {
    $im = creaCopia($img);
    imagetruecolortopalette($im, true, $ncolori);
    return creaModificata($img, $im);
}

function bordiIMG($img) {
    $im = creaCopia($img);
    imagefilter($im, IMG_FILTER_GRAYSCALE);
    imagefilter($im, IMG_FILTER_EDGEDETECT);
    return creaModificata($img, $im);
}

function pixelIMG($img, $pixelsize = 10) {
    $im = creaCopia($img);
    $w = imagesx($im);
    $h = imagesy($im);

    $tmp = imagecreatetruecolor($w / $pixelsize, $h / $pixelsize);
    imagecopyresized($tmp, $im, 0, 0, 0, 0, $w / $pixelsize, $h / $pixelsize, $w, $h);

    imagecopyresized($im, $tmp, 0, 0, 0, 0, $w, $h, $w / $pixelsize, $h / $pixelsize);
    imagedestroy($tmp);

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
