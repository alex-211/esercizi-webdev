<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>Lista degli utenti</h1>
    <a href="index.php?url=create"><button>Crea nuovo utente</button></a>
    <?php
        foreach ($users as $user):
    ?>
    <p> 
        ID: <?= $user['id']?>
        Nome: <?= $user['nome']?>
        Cognome: <?= $user['cognome']?>
        Data di nascita: <?= $user['data_nascita']?>
    </p>
    <?php endforeach; ?>
</body>
</html>