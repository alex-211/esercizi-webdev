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

// Handle form data
$eventId = isset($_POST['e_id']) ? intval($_POST['e_id']) : null;
$eventName = htmlspecialchars($_POST['e_name']);
$eventDate = $_POST['e_date'];
$eventTime = $_POST['e_time'];
$eventPlace = htmlspecialchars($_POST['e_place']);
$invitedUsers = isset($_POST['invited_users']) ? explode(',', $_POST['invited_users']) : [];

if ($eventId) {
    // Edit existing event
    $updateQuery = "UPDATE events SET e_name = ?, e_date = ?, e_time = ?, e_place = ? WHERE e_id = ? AND e_owner = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssii", $eventName, $eventDate, $eventTime, $eventPlace, $eventId, $userId);

    if ($stmt->execute()) {
        echo "Evento aggiornato con successo!";
    } else {
        echo "Errore durante l'aggiornamento dell'evento: " . $conn->error;
    }
} else {
    // Create new event with initial avgScore = 0
    $insertQuery = "INSERT INTO events (e_name, e_date, e_time, e_place, e_owner, e_avgScore) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssssi", $eventName, $eventDate, $eventTime, $eventPlace, $userId);

    if ($stmt->execute()) {
        $eventId = $stmt->insert_id; // Get the new event ID
        echo "Evento creato con successo!";
        header("Location: home.php");
    } else {
        echo "Errore durante la creazione dell'evento: " . $conn->error;
    }
}

// Handle invitations
if ($invitedUsers && $eventId) {
    foreach ($invitedUsers as $invitedUser) {
        $invitedUser = trim($invitedUser);
        $queryInvitedID = "SELECT u_id FROM users WHERE u_name = '$invitedUser'";
        $invitedResult = $conn->query($queryInvitedID);

        if ($invitedResult->num_rows > 0) {
            $invitedUserId = $invitedResult->fetch_assoc()['u_id'];
            $insertInviteQuery = "INSERT INTO invitedTo (e_id, u_id) VALUES ('$eventId', '$invitedUserId')";
            $conn->query($insertInviteQuery);
        }
    }
}

$conn->close();
?>
