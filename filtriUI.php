<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        $lum = $_POST['lum'] ?? 0;
        $cont = $_POST['cont'] ?? 0;
        echo "<h1>Luminosità e Contrasto</h1>";
        $posizionemod = luminositaIMG($posizioneimg, $lum, $cont);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Luminosità <input type='range' value=$lum min=-100 max=100 name='lum'>
        </label><br>
        <label>
        Contrasto <input type='range' value=$cont min=-100 max=100 name='cont'>
        </label>
        </div>
        <input type='hidden' name='filtro' value='luminosita'>
        <input type='hidden' name='posimg' value='$posizioneimg'>
        <input type='submit' value='Applica' name='ricarica'>
        </form>
        ";
    }

    function nitidezza($posizioneimg){
        $sigma = $_POST['sigma'] ?? 0;
        echo "<h1>Nitidezza</h1>";
        $posizionemod = nitidezzaIMG($posizioneimg, $sigma);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Nitidezza <input type='range' value=$sigma min=0 max=5 step=0.2 name='sigma'>
        </label><br>
        </div>
        <input type='hidden' name='filtro' value='nitidezza'>
        <input type='hidden' name='posimg' value='$posizioneimg'>
        <input type='submit' value='Applica' name='ricarica'>
        </form>
        ";
    }

    function sfocatura($posizioneimg){
        $sigma = $_POST['sigma'] ?? 0;
        echo "<h1>Sfocatura</h1>";
        $posizionemod = sfocaturaIMG($posizioneimg, $sigma);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Sfocatura <input type='range' value=$sigma min=0 max=10 step=0.2 name='sigma'>
        </label><br>
        </div>
        <input type='hidden' name='filtro' value='sfocatura'>
        <input type='hidden' name='posimg' value='$posizioneimg'>
        <input type='submit' value='Applica' name='ricarica'>
        </form>
        ";
    }

    function inverticolori($posizioneimg){
        echo "<h1>Bianco e Nero</h1>";
        $posizionemod = inverticoloriIMG($posizioneimg);
        tabellaimg($posizioneimg, $posizionemod);
    }
?>
