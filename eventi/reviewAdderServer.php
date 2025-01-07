<?php
session_start();

if (isset($_POST['event_id']) && isset($_POST['comment']) && isset($_POST['funScore']) && isset($_POST['complexityScore']) && isset($_POST['originalityScore'])) {
    $eventId = $_POST['event_id'];
    $comment = $_POST['comment'];
    $funScore = intval($_POST['funScore']);
    $complexityScore = intval($_POST['complexityScore']);
    $originalityScore = intval($_POST['originalityScore']);

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

    $insertReview = $conn->prepare("INSERT INTO reviews (e_id, u_id, r_comment, r_funScore, r_complexityScore, r_originalityScore) VALUES (?, ?, ?, ?, ?, ?)"); // qua do stanno i punti interrogativi
    $insertReview->bind_param("iisiii", $eventId, $userId, $comment, $funScore, $complexityScore, $originalityScore); // serve per formattare i valori da mandare nella query sopra

    if ($insertReview->execute()) {
        echo "Recensione aggiunta con successo!";
        header("Location: eventViewer.php");
        exit();
    } else {
        echo "Errore durante l'inserimento della recensione: " . $conn->error;
    }

    $insertReview->close();
    $conn->close();
} else {
    die("Dati incompleti.");
}
?>
