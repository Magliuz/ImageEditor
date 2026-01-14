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

    function ruota($posizioneimg){
        $gradi = $_POST['gradi'] ?? 0;
        $sO = isset($_POST['sO']);
        $sV = isset($_POST['sV']);
        echo "<h1>Ruota e Specchia</h1>";
        $posizionemod = ruotaIMG($posizioneimg, $gradi, $sO, $sV);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Gradi <input type='range' value=$gradi min=0 max=360 step=45 name='gradi'>
        </label><br>
        <label>
        Specchia orizzontalmente <input type='checkbox' value='o' name='sO' ".($sO ? 'checked' : ''). ">
        </label>
        <label>
        Specchia verticalmente <input type='checkbox' value='v' name='sV'  ".($sV ? 'checked' : ''). ">
        </label>
        </div>
        <input type='hidden' name='filtro' value='ruota'>
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
        echo "<h1>Inverti colori</h1>";
        $posizionemod = inverticoloriIMG($posizioneimg);
        tabellaimg($posizioneimg, $posizionemod);
    }

    function riducicolori($posizioneimg){
        $ncolori = $_POST['ncol'] ?? 0;
        echo "<h1>Riduci colori</h1>";
        $posizionemod = sfocaturaIMG($posizioneimg, $ncolori);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Numero di colori <input type='range' value=$ncolori min=0 max=256 step=4 name='ncol'>
        </label><br>
        </div>
        <input type='hidden' name='filtro' value='riducicolori'>
        <input type='hidden' name='posimg' value='$posizioneimg'>
        <input type='submit' value='Applica' name='ricarica'>
        </form>
        ";
    }

    function bordi($posizioneimg){
        echo "<h1>Bordi</h1>";
        $posizionemod = bordiIMG($posizioneimg);
        tabellaimg($posizioneimg, $posizionemod);
    }

    function pixel($posizioneimg){
         $pix = $_POST['pix'] ?? 10;
        echo "<h1>Pixel</h1>";
        $posizionemod = pixelIMG($posizioneimg, $pix);
        tabellaimg($posizioneimg, $posizionemod);
        echo "
        <form action='$_SERVER[PHP_SELF]' method='POST'>
        <div class='filtri'>
        <label>
        Dimensione pixels <input type='range' value=$pix min=1 max=50 name='pix'>
        </label><br>
        </div>
        <input type='hidden' name='filtro' value='pixel'>
        <input type='hidden' name='posimg' value='$posizioneimg'>
        <input type='submit' value='Applica' name='ricarica'>
        </form>
        ";
    }
?>
