<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!--moved all the css code to separate file-->
    <title>Smart Event Planner</title>
    <style>
        .event-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        .event-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .event-info {
            font-size: 1em;
            color: #666;
        }
    </style>
</head>
<?php
session_start();
setcookie("event-clicked", "", time() - 3600, "/");
if (isset($_COOKIE['user-session'])) {
    $userNamee = $_COOKIE['user-session'];
} else {
    echo("non funziona");
}

$servername = "34.17.71.245"; // hostato su google cloud 34.17.71.245
$username = "php";
$password = "f=v;RoiHHkVSvl/("; // TODO hash this to it's not plaintext 
$database = "event-planner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) // controlla se la connessione è avvenuta
{
  die("non funge: " . $conn->connect_error);
}
else
{
    $queryUserID = "SELECT u_id FROM users WHERE u_name = '$userNamee'";
    $qIDresult =  $conn->query($queryUserID);
    if ($qIDresult->num_rows > 0) {
        $row = $qIDresult->fetch_assoc();
        $userId = $row['u_id'];
    }
    $queryOwnedEvents = "SELECT e_id, e_name, e_date, e_time, e_avgScore FROM events WHERE e_owner = '$userId' ORDER BY e_date DESC, e_time DESC";
    $qResult = $conn->query($queryOwnedEvents);
}
?>

<body>
<nav>
    <span id="navbar-title"></span>
    <div class="links">
        <a href="#">Aggiungi evento</a>
        <a href="#">Modifica evento</a>
        <a href="event-Leader.php">Classifica eventi</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="event-list">
    <h2>Lista Eventi</h2>
    <ul>
        <?php
        if ($qResult->num_rows > 0) {
            while ($event = $qResult->fetch_assoc()) {
                $eventId = $event['e_id'];
                $eventScore = $event['e_avgScore'];
                echo "<li class='event-item' onclick=\"document.cookie='event-clicked=$eventId';window.location.href='eventViewer.php';\">";
                echo "<div class='event-title'>" . htmlspecialchars($event['e_name']) . "</div>";
                echo "<div class='event-info'>Data: " . htmlspecialchars($event['e_date']) . " - Ora: " . htmlspecialchars($event['e_time']) . " - Punteggio medio: " . htmlspecialchars($eventScore) . "</div>";               
                echo "</li>";
            }
        } else {
            echo "<li>Nessun evento trovato</li>";
        }
        ?>
    </ul>
</div>

</body>
</html>