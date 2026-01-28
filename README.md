# ImageEditor

Editor di immagini in PHP che permette di caricare un'immagine e applicare vari filtri. Il progetto utilizza l'estensione Imagick, o in sua assenza GD, per l'elaborazione delle immagini.

## Funzionalità

*   Bianco e nero
*   Luminosità e contrasto
*   Ruota e specchia
*   Nitidezza
*   Sfocatura
*   Inverti colori
*   Riduci colori
*   Rilevamento dei bordi
*   Pixelate

## Come usare

1. Aprire il file `index.php` in un browser web.
2. Scegliere un'immagine da caricare.
3. Selezionare un filtro da applicare.
4. Cliccare il pulsante "Applica filtro".
5. Modificare eventuali parametri a piacimento e poi applicarli
6. Scaricare l'immagine con: "tasto destro" -> "Salva Immagine"
7. Tornare alla lista cliccando il link `Home`.


## Requisiti

*  Server PHP.
*  Estensione GD o Imagick per PHP.
*  Creazione di una cartella `uploads`

GD è l'estensione inclusa in Xampp. Se si utilizza un server su cui è installata l'estensione Imagick allora il programma utilizzerà quella.


## Limitazioni del programma

* I file salvati nella cartella `uploads` non vengono eliminati automaticamente.
* Non si possono applicare più filtri di seguito a una immagine.
* Ogni volta che si torna alla lista di filtri bisogna scegliere di nuovo il file.
* Il valore sopra gli slider non si aggiorna nel movere lo slider ma mantiene quello dell'ultima modifica.
* Alcune filtri funzionano meglio con una estensione che con l'altra.
