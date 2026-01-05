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

    function inverticoloriIMG($img){
        $originale = new Imagick($img);
        $modificata = clone $originale;
        $modificata->negateImage(false);
        $pathInfo = pathinfo($img);
        $nuovoPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_inv.' . $pathInfo['extension'];
        $modificata->writeImage($nuovoPath);
        $originale->clear();
        $modificata->clear();
        return $nuovoPath;
    }
?>
