<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!--moved all the css code to separate file-->
    <title>Smart Event Planner</title>
</head>
<body>
<nav>
    <span id="navbar-title"></span>
    <div class="links">
        <a href="eventEditor.php">Aggiungi/modifica evento</a>
        <a href="home.php">Torna alla home</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
</body>
</html>
<?php
$servername = "34.17.71.245";
$username = "php";
$password = "f=v;RoiHHkVSvl/(";
$database = "event-planner";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Errore di connessione: " . $conn->connect_error);
}


$queryEvents = "SELECT e_id, e_name, e_date, e_time, e_place, e_owner FROM events";
$eventsResult = $conn->query($queryEvents);

if ($eventsResult->num_rows > 0) {
    while ($event = $eventsResult->fetch_assoc()) {
        $eventId = $event['e_id'];


        $queryReviews = "SELECT r_funScore, r_complexityScore, r_originalityScore FROM reviews WHERE e_id = '$eventId'";
        $reviewsResult = $conn->query($queryReviews);

        if ($reviewsResult->num_rows > 0) {
            $totalScore = 0;
            $reviewCount = 0;

            while ($review = $reviewsResult->fetch_assoc()) {
                $totalScore += ($review['r_funScore'] + $review['r_complexityScore'] + $review['r_originalityScore']) / 3;
                $reviewCount++;
            }


            $avgScore = round($totalScore / $reviewCount, 2);


            $updateScoreQuery = "UPDATE events SET e_avgScore = '$avgScore' WHERE e_id = '$eventId'";
            $conn->query($updateScoreQuery);
        }
    }
}


$querySortedEvents = "SELECT e_id, e_name, e_date, e_time, e_place, e_avgScore FROM events ORDER BY e_avgScore DESC";
$sortedEventsResult = $conn->query($querySortedEvents);

if ($sortedEventsResult->num_rows > 0) {
    echo "<h1>Eventi ordinati per punteggio medio</h1>";
    echo "<div class='event-list'>";

    while ($event = $sortedEventsResult->fetch_assoc()) {
        echo "<div class='event-item'>";
        echo "<h2>" . htmlspecialchars($event['e_name']) . " (Punteggio medio: " . htmlspecialchars($event['e_avgScore']) . ")</h2>";
        echo "<p><strong>Data:</strong> " . htmlspecialchars($event['e_date']) . "</p>";
        echo "<p><strong>Ora:</strong> " . htmlspecialchars($event['e_time']) . "</p>";
        echo "<p><strong>Luogo:</strong> " . htmlspecialchars($event['e_place']) . "</p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p>Nessun evento trovato.</p>";
}

$conn->close();
?>
