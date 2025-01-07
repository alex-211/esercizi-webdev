<?php
$servername = "34.17.71.245"; // hostato su google cloud 34.17.71.245
$username = "php";
$password = "f=v;RoiHHkVSvl/("; // TODO hash this to it's not plaintext 
$database = "event-planner";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) // controlla se la connessione è avvenuta
{
  die("non funge: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") // controlla il tipo di dati che arrivano al client
{
    $username = $_POST['username']; // e li memorizza in variabili
    $password = $_POST['password'];

    // questa variabile contiene la nostra query in sql
    $getUser = "SELECT u_email, u_password FROM users WHERE u_name = '$username' AND u_password = '$password'";
    $qResult = $conn->query($getUser); // usiamo il metodo query dell'oggetto sql e mettiamo il risultato in una variabile

    if ($qResult->num_rows != 0) // controlliamo se vengono restituiti delle righe l'utente esiste
    {
        // crea cookie
        $nome_cookie = "user-session";
        $valore_cookie = $username;
        setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
        // reindirizza alla pagina di successo
        header("Location: home.php");
    }
    else
    {
        $nome_cookie = "user-session";
        $valore_cookie = $username;
        setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
        header("Location: error.php");
    }
}
?>