<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Event Editor</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<nav>
    <span id="navbar-title"></span>
    <div class="links">
        <a href="home.php">Torna alla home</a>
        <a href="event-Leader.php">Classifica eventi</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
    <div class="form-container">
        <h2>Editor eventi</h2>
        <form action="eventEditorHandler.php" method="POST">
            <div class="form-group">
                <label for="e_id">Event ID (lascialo vuoto per creare un nuovo evento, se non sai l'ID torna alla home e clicca sul tuo evento per vedere i dettagli):</label>
                <input type="text" id="e_id" name="e_id" placeholder="Event ID">
            </div>
            <div class="form-group">
                <label for="e_name">Nome:</label>
                <input type="text" id="e_name" name="e_name" required>
            </div>
            <div class="form-group">
                <label for="e_date">Data:</label>
                <input type="date" id="e_date" name="e_date" required>
            </div>
            <div class="form-group">
                <label for="e_time">Ora:</label>
                <input type="time" id="e_time" name="e_time" required>
            </div>
            <div class="form-group">
                <label for="e_place">Luogo:</label>
                <input type="text" id="e_place" name="e_place" required>
            </div>
            <div class="form-group">
                <label for="invited_users">Invitati (username separato da virgola):</label>
                <input type="text" id="invited_users" name="invited_users" placeholder="e.g. user1, user2, user3">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
