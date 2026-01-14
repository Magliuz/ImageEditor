<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if(isset($_FILES['immagine']) && $_FILES['immagine']['error'] == 4){
        header("Location: index.php");
    }
    include "filtriUI.php";
    if(!isset($_POST['ricarica'])){
        move_uploaded_file($_FILES['immagine']['tmp_name'], "./uploads/" . $_FILES['immagine']['name']);
        $posizioneimg = "./uploads/" . $_FILES['immagine']['name'];
    }else{
        $posizioneimg = $_POST['posimg'];
    }
    $scelta = $_POST['filtro'];

?>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Modifica Immagini</title>
<style>
body{
       text-align: center;
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

.filtri{
    padding: 2rem;
    place-content: center;
    font-weight: bold;
    display: grid;
    gap: 0.75rem;
    font-size: 1.25rem;
}

input[type="range"]{
    width: 100%;
}

form{
    text-align: center;
}

input[type="submit"]{
    font-size: 1.25rem;
    color: #112D4E;
    background-color: #DBE2EF;
    border-radius: 15px;
    box-shadow: 5px 5px 20px #112D4E88;
    border: 2px solid #112D4E44;
    transition: .1s;
}

input[type="submit"]:hover{
    background-color: #3F72AF88;
    border: 2px solid #112D4E44;
    transition: .1s;
}

input[type="submit"]{
    padding: 0.75rem;
}

a{
    margin: 0 auto;
    font-size: 1.5rem;
}
</style>
<body>

<?php
    switch($scelta){
        case "bianconero": bianconero($posizioneimg);
            break;
        case "luminosita": luminosita($posizioneimg);
            break;
        case "ruota": ruota($posizioneimg);
            break;
        case "nitidezza": nitidezza($posizioneimg);
            break;
        case "sfocatura": sfocatura($posizioneimg);
            break;
        case "inverticolori": inverticolori($posizioneimg);
            break;
        case "bordi": bordi($posizioneimg);
            break;
        case "pixel": pixel($posizioneimg);
            break;
    }
?>
<br><br>
<a href="index.php">Home</a>
</body>
</html>
