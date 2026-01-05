<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include "filtriUI.php";
    move_uploaded_file($_FILES['immagine']['tmp_name'], "./uploads/" . $_FILES['immagine']['name']);
    $posizioneimg = "./uploads/" . $_FILES['immagine']['name'];
    $scelta = $_POST['filtro'];
?>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Modifica Immagini</title>
<style>
body{
    color: #112D4E;
    background-color: #F9F7F7;
}
h1{
    text-align: center;
    margin: 0 auto;
    padding: 2rem 2rem 4rem;
    font-size: 2.5rem;
    width: 80%;
    text-shadow: 2px 2px 3px #112D4E44;
}
table{
    margin: 0 auto;
    width: 75%;
    border-collapse: collapse;
}

th{
    padding: 1rem;
    font-weight: bold;
    font-size: 1.5rem;
}

td, th{
    width: 50%;
    border: 2px solid #112D4E44;
    border-collapse: collapse;
}

img{
    width: 100%;
}
</style>
<body>

<?php
    switch($scelta){
        case "bianconero": bianconero($posizioneimg);
            break;
        case "luminosita": luminosita($posizioneimg);
            break;
        case "inverticolori": inverticolori($posizioneimg);
            break;
    }
?>
</body>
</html>
