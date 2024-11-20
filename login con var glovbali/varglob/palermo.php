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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) // quando il form html manda una richiesta php con il logout manda il submit
{
    setcookie("user-session", "", time() - 86400); // tempo negativo del cookie, che scade
    header("Location: index.php"); // si ritorna alla pagina di login
    // niente più biscotti
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
        <h2>Benvenuto, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Sei correttamente loggato</p>
        <form method="POST"> <!--mi stai dicendo che devo usare un form per far funzionare il bottone col php?-->
                            <!--purtroppo sì, mi manca il javascript-->
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>