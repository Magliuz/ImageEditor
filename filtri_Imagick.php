<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    function bianconeroIMG($img){
        $modificata = creaCopia($img);
        $modificata->setImageColorspace(Imagick::COLORSPACE_GRAY);
        return creaModificata($img, $modificata);
    }

    function luminositaIMG($img, $valoreL = 0, $valoreC = 0){
        $modificata = creaCopia($img);
        $modificata->brightnessContrastImage($valoreL, $valoreC, imagick::CHANNEL_RED | imagick::CHANNEL_GREEN | imagick::CHANNEL_BLUE);
        return creaModificata($img, $modificata);
    }

    function ruotaIMG($img, $gradiInt, $sO, $sV){
        $modificata = creaCopia($img);
        if($sO){
            $modificata->flopImage();
        }
        if($sV){
            $modificata->flipImage();
        }
        $modificata->rotateimage(new ImagickPixel('#00000000'), $gradiInt);
        return creaModificata($img, $modificata);
    }

    function nitidezzaIMG($img, $sigma = 0){
        $modificata = creaCopia($img);
        $modificata->sharpenimage(0, $sigma, imagick::CHANNEL_RED | imagick::CHANNEL_GREEN | imagick::CHANNEL_BLUE);
        return creaModificata($img, $modificata);
    }

    function sfocaturaIMG($img, $sigma = 0){
        $modificata = creaCopia($img);
        $modificata->blurImage(0, $sigma);
        return creaModificata($img, $modificata);
    }

    function inverticoloriIMG($img){
        $modificata = creaCopia($img);
        $modificata->negateImage(false, imagick::CHANNEL_RED | imagick::CHANNEL_GREEN | imagick::CHANNEL_BLUE);
        return creaModificata($img, $modificata);
    }

    function riducicoloriIMG($img, $ncolori = 8){
        $modificata = creaCopia($img);
         $modificata->quantizeImage($ncolori, Imagick::COLORSPACE_SRGB, 0, false, false);
        return creaModificata($img, $modificata);
    }

    function bordiIMG($img){
        $modificata = creaCopia($img);
        $modificata->setImageColorspace(Imagick::COLORSPACE_GRAY);
        $modificata->edgeImage(0);
        return creaModificata($img, $modificata);
    }

    function pixelIMG($img, $pixelsize = 10){
        $modificata = creaCopia($img);
        $width  = $modificata->getImageWidth();
        $height = $modificata->getImageHeight();
        $modificata->scaleImage(max(1, (int)($width / $pixelsize)), max(1, (int)($height / $pixelsize)));
        $modificata->scaleImage($width, $height);
        return creaModificata($img, $modificata);
    }

    function creaCopia($img){
        return new Imagick($img);
    }

    function creaModificata($img, $modificata){
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_mod.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        $modificata->clear();
        $modificata->destroy();
        return $nuovoPath;
    }

?>
