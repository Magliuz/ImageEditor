<?php
    function bianconeroIMG($img){
        $originale = new Imagick($img);
        $modificata = clone $originale;
        $modificata->setImageColorspace(Imagick::COLORSPACE_GRAY);
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_bn.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        $originale->clear();
        $modificata->clear();
        return $nuovoPath;
    }

    function luminositaIMG($img, $valoreL = 0, $valoreC = 0){
        $originale = new Imagick($img);
        $modificata = clone $originale;
        $modificata->brightnessContrastImage($valoreL, $valoreC, imagick::CHANNEL_RED | imagick::CHANNEL_GREEN | imagick::CHANNEL_BLUE);
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_bn.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        $originale->clear();
        $modificata->clear();
        return $nuovoPath;
    }

    function inverticoloriIMG($img){
        $originale = new Imagick($img);
        $modificata = clone $originale;
        $modificata->negateImage(false, imagick::CHANNEL_RED | imagick::CHANNEL_GREEN | imagick::CHANNEL_BLUE);
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_inv.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        $originale->clear();
        $modificata->clear();
        return $nuovoPath;
    }
?>
