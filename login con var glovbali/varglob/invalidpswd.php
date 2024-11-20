<?php
include("server.php");
if (isset($_COOKIE['user-session'])) // Controlla se il cookie è presente
{
    $username = $_COOKIE['user-session']; // e lo assegna in una variabile che viene usata nell'HTML
    $password = $users[$username]; // siamo gentili e ricordiamo all'utente la sua password
} 
else 
{
    echo "Errore nel login, perfavore ricaricare la pagina"; // nel caso esce un errore generico
    $username = "null"; // assegnamo un valore alla variabile per evitare il brutto errore che esce fuori se non viene definito
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login var. globali - Porpiglia 5AINF</title>
</head>
<body class="geist-mono main">
    <h1>Login su Bossetti-Net</h1>
    <div class="login-box">
        <h2>Guarda, <?php echo htmlspecialchars($username); ?>...</h2>
        <p>Password sbagliata, ma dato che oggi sono particolarmente gentile, te la ricordo io: <?php echo htmlspecialchars($password); ?></p>
        <a href="index.php">Grazie sommo admin</a>
    </div>
</body>
</html>