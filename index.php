<!DOCTYPE html>
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
.input_img{
    margin: 0 auto;
    text-align: center;
    width: 50%;
    padding: 2rem;
    cursor: pointer;
}
.filtri{
    padding: 2rem;
    place-content: center;
    font-weight: bold;
    display: grid;
    font-size: 1.25rem;
}

.radiof{
    padding: 0.25rem;
}

.input_img, input[type="submit"]{
    font-size: 1.25rem;
    color: #112D4E;
    background-color: #DBE2EF;
    border-radius: 15px;
    box-shadow: 5px 5px 20px #112D4E88;
    border: 2px solid #112D4E44;
    transition: .1s;
}

.input_img:hover, input[type="submit"]:hover{
    background-color: #3F72AF88;
    border: 2px solid #112D4E44;
    transition: .1s;
}

input[type="submit"]{
    padding: 0.75rem;
}
</style>
<body>
    <h1>Carica un'immagine e scegli il filtro da applicare</h1>
    <form action="modifica.php" method="POST" enctype="multipart/form-data">
    <label for="immagine"><div class="input_img">
        <span id="testo">Scegli l'immagine da caricare</span>
        <input type="file" accept="image/*" id="immagine" name="immagine" hidden>
    </div></label>
    <div class="filtri">
    <label class="radiof">
        <input type="radio" name="opzioni" value="bianconero"> Bianco e nero
    </label>
    <label class="radiof">
        <input type="radio" name="opzioni" value="luminosita"> Luminosità
    </label>
    </div>
    <div class="invio" style="text-align: center">
        <input type="submit" value="Applica filtro">
    </div>


    </form>
    <script>
    const input = document.querySelector("input[type=file]");
    const testo = document.getElementById("testo");
    input.addEventListener("change", updateImage);
    function updateImage(){
        testo.textContent = input.files[0].name;
    }
    </script>
</body>
</html>
