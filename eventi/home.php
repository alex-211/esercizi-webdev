<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Event Planner</title>
    <style>

    </style>
</head>
<body>

<header>
<nav>

    <div class="links">
    <a href="eventEditor.php">Aggiungi/modifica evento</a>
        <a href="event-Leader.php">Classifica eventi</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
</header>

<div class="container">
<?php
session_start();

if (isset($_COOKIE['user-session'])) {
    $userNamee = $_COOKIE['user-session'];
} else {
    die("Utente non autenticato");
}

$servername = "34.17.71.245";
$username = "php";
$password = "f=v;RoiHHkVSvl/(";
$database = "event-planner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Errore di connessione: " . $conn->connect_error);
}

$queryUserID = "SELECT u_id FROM users WHERE u_name = '$userNamee'";
$qIDresult = $conn->query($queryUserID);
if ($qIDresult->num_rows > 0) {
    $userId = $qIDresult->fetch_assoc()['u_id'];
} else {
    die("Utente non trovato.");
}

// Display events owned by the user
$queryOwnedEvents = "SELECT * FROM events WHERE e_owner = '$userId' ORDER BY e_date DESC";
$ownedEventsResult = $conn->query($queryOwnedEvents);

echo "<h2>Eventi di cui sei proprietario</h2>";
if ($ownedEventsResult->num_rows > 0) {
    while ($event = $ownedEventsResult->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;' onclick=\"document.cookie='event-clicked=" . $event['e_id'] . "'; window.location='eventViewer.php';\">";
        echo "<h3>" . htmlspecialchars($event['e_name']) . "</h3>";
        echo "<p>Data: " . $event['e_date'] . "</p>";
        echo "<p>Ora: " . $event['e_time'] . "</p>";
        echo "<p>Luogo: " . htmlspecialchars($event['e_place']) . "</p>";
        echo "<p>Score medio: " . $event['e_avgScore'] . "</p>";
        echo "</div>";
    }
    echo "<br>";
} else {
    echo "<p>Non hai eventi di cui sei proprietario.</p>";
    echo "<br>";
}

// Display events the user is invited to
$queryInvitedEvents = "SELECT events.* FROM events INNER JOIN invitedTo ON events.e_id = invitedTo.e_id WHERE invitedTo.u_id = '$userId' ORDER BY events.e_date DESC";
$invitedEventsResult = $conn->query($queryInvitedEvents);

echo "<h2>Eventi a cui sei invitato</h2>";
if ($invitedEventsResult->num_rows > 0) {
    while ($event = $invitedEventsResult->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;' onclick=\"document.cookie='event-clicked=" . $event['e_id'] . "'; window.location='eventViewer.php';\">";
        echo "<h3>" . htmlspecialchars($event['e_name']) . "</h3>";
        echo "<p>Data: " . $event['e_date'] . "</p>";
        echo "<p>Ora: " . $event['e_time'] . "</p>";
        echo "<p>Luogo: " . htmlspecialchars($event['e_place']) . "</p>";
        echo "<p>Score medio: " . $event['e_avgScore'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Non sei invitato a nessun evento.</p>";
}

$conn->close();
?>
</div>

</body>
</html>
