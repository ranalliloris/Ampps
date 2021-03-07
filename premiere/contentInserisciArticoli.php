<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Nuovo Articolo</title>
</head>
<body>
    <form method="POST" action="php/inserisciArticoli.php"> 
    <label>Numero Articolo</label>
    <input type="text" id="NumArt" name="NumArt" />
    <br /><br />
    <label>Descrizione</label>
    <input type="text" id="Descrizione" name="Descrizione" />
    <br /><br />
    <label>Giacenza</label>
    <input type="number" id="Giacenza" name="Giacenza" />
    <br /><br />
    <label>Categoria</label>
    <input type="text" id="Categoria" name="Categoria" />
    <br /><br />
    <label>Magazzino</label>
    <input type="number" id="Magazzino" name="Magazzino" />
    <br /><br />
    <label>Prezzo Unitario</label>
    <input type="text" id="PrzUnitario" name="PrzUnitario" />
    <br /><br />
    <button type="submit" value="Inserisci">Inserisci</button>
    <button type="reset" style="margin-left:3px;">Cancella</button>
    </form>
</body>
</html>