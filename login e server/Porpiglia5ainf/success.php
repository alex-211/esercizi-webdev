<?php
if (isset($_COOKIE['user-session'])) // Controlla se il cookie è presente
{
    $username = $_COOKIE['user-session']; // e lo assegna in una variabile che viene usata nell'HTML
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
    <title>Boss Login - Porpiglia 5AINF</title>
</head>
<body class="geist-mono main">
    <h1>Login su Bossetti-Net</h1>
    <div class="login-box">
        <h2>Benvenuto, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Sei correttamente loggato</p>
        <a href="index.php">Logout</a>
    </div>
</body>
</html>