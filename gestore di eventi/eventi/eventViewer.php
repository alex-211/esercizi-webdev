<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!--moved all the css code to separate file-->
    <title>Event Viewer</title>
    <style>
        .event-details, .review-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }
        .event-title {
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .review-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .event-info, .review-info {
            font-size: 1em;
            color: #666;
        }
    </style>
</head>
<?php
session_start();

if (isset($_COOKIE['event-clicked'])) {
    $eventId = $_COOKIE['event-clicked'];
} else {
    die("Nessun evento selezionato");
}

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
    die("Utente non trovato");
}


$queryEvent = "SELECT e_id, e_name, e_date, e_time, e_place, e_avgScore, e_owner FROM events WHERE e_id = '$eventId'";
$eventResult = $conn->query($queryEvent);

if ($eventResult->num_rows > 0) {
    $event = $eventResult->fetch_assoc();
    $ownerId = $event['e_owner'];
    

    $queryOwner = "SELECT u_name FROM users WHERE u_id = '$ownerId'";
    $ownerResult = $conn->query($queryOwner);
    $ownerName = ($ownerResult->num_rows > 0) ? $ownerResult->fetch_assoc()['u_name'] : "Sconosciuto";
} else {
    die("Evento non trovato");
}

// Fetch reviews for the event
$queryReviews = "SELECT r_id, e_id, u_id, r_comment, r_funScore, r_complexityScore, r_originalityScore FROM reviews WHERE e_id = '$eventId'";
$reviewResult = $conn->query($queryReviews);

$queryUserReview = "SELECT r_id FROM reviews WHERE e_id = '$eventId' AND u_id = '$userId'";
$userReviewResult = $conn->query($queryUserReview);
$hasReviewed = ($userReviewResult->num_rows > 0);
?>

<body>
<nav>
    <span id="navbar-title">Visualizzatore Evento</span>
    <div class="links">
        <a href="home.php">Torna alla lista eventi</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="event-details">
    <h2 class="event-title">Dettagli Evento</h2>
    <div class="event-info">
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($event['e_name']); ?></p>
        <p><strong>Data:</strong> <?php echo htmlspecialchars($event['e_date']); ?></p>
        <p><strong>Ora:</strong> <?php echo htmlspecialchars($event['e_time']); ?></p>
        <p><strong>Luogo:</strong> <?php echo htmlspecialchars($event['e_place']); ?></p>
        <p><strong>Punteggio medio:</strong> <?php echo htmlspecialchars($event['e_avgScore']); ?></p>
        <p><strong>Proprietario:</strong> <?php echo htmlspecialchars($ownerName); ?></p>
    </div>
</div>

<div class="review-list">
    <h2>Recensioni</h2>
    <?php
    if ($reviewResult->num_rows > 0) {
        while ($review = $reviewResult->fetch_assoc()) {
            $userId = $review['u_id'];
            // Fetch user name
            $queryUser = "SELECT u_name FROM users WHERE u_id = '$userId'";
            $userResult = $conn->query($queryUser);
            $userName = ($userResult->num_rows > 0) ? $userResult->fetch_assoc()['u_name'] : "Sconosciuto";
            
            echo "<div class='review-item'>";
            echo "<div class='review-title'>Recensione di: " . htmlspecialchars($userName) . "</div>";
            echo "<div class='review-info'>";
            echo "<p><strong>Commento:</strong> " . htmlspecialchars($review['r_comment']) . "</p>";
            echo "<p><strong>Punteggio divertimento:</strong> " . htmlspecialchars($review['r_funScore']) . "</p>";
            echo "<p><strong>Punteggio complessità:</strong> " . htmlspecialchars($review['r_complexityScore']) . "</p>";
            echo "<p><strong>Punteggio originalità:</strong> " . htmlspecialchars($review['r_originalityScore']) . "</p>";
            echo "<p><strong>ID Evento:</strong> " . htmlspecialchars($review['e_id']) . "</p>";
            echo "</div></div>";
        }
    } else {
        echo "<p>Nessuna recensione trovata</p>";
    }
    ?>
</div>

<?php if (!$hasReviewed): ?>
<div class="review-form">
    <h2>Lascia una recensione</h2>
    <form action="reviewAdderServer.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($eventId); ?>">
        <div>
            <label for="comment">Commento:</label><br>
            <textarea id="comment" name="comment" rows="4" cols="50" required></textarea>
        </div>
        <div>
            <label for="funScore">Punteggio divertimento (0-5):</label><br>
            <input type="number" id="funScore" name="funScore" min="1" max="10" required>
        </div>
        <div>
            <label for="complexityScore">Punteggio complessità (0-5):</label><br>
            <input type="number" id="complexityScore" name="complexityScore" min="1" max="10" required>
        </div>
        <div>
            <label for="originalityScore">Punteggio originalità (0-5):</label><br>
            <input type="number" id="originalityScore" name="originalityScore" min="1" max="10" required>
        </div>
        <div>
            <button type="submit">Invia recensione</button>
        </div>
    </form>
</div>
<?php endif; ?>

</body>
</html>
