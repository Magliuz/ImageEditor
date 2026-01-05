<?php
    include "filtri.php";

    function tabellaimg($posizioneimg, $posizionemod){
        echo "<table>
        <tr><th>Originale</th><th>Modificata</th></tr>
        <tr><td><img src='$posizioneimg'></td><td><img src='$posizionemod'></td></tr>
        </table>";
    }
    function bianconero($posizioneimg){
        echo "<h1>Bianco e Nero</h1>";
        $posizionemod = bianconeroIMG($posizioneimg);
        tabellaimg($posizioneimg, $posizionemod);
    }

    function luminosita($posizioneimg){
        echo "Caio";
    }

    function inverticolori($posizioneimg){
        echo "<h1>Bianco e Nero</h1>";
        $posizionemod = inverticoloriIMG($posizioneimg);
        tabellaimg($posizioneimg, $posizionemod);
    }
?>
