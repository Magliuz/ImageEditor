<?php
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


    function creaCopia($img){
        $originale = new Imagick($img);
        return clone $originale;
    }

    function creaModificata($img, $modificata){
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_mod.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        return $nuovoPath;
    }

?>
