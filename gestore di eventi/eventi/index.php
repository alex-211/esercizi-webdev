<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Event Planner: login</title>
</head>
<body>
<h1 class="geist-mono main">Welcome to the Smart Event Planner!</h1>
    <div class="geist-mono main" class="login-box">
        <form action="server.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</body> 
</body>
</html>