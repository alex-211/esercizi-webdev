<?php
setcookie("user-session", "", time() - 86400);
// Cancelliamo i cookie quando si torna sulla pagina di login
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
        <form action="server.php" method="post">
            <label for="username">Username o email:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>