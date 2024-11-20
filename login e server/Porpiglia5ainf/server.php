<?php
session_start();

// variabili che verranno passate come argomenti alla funzione crea oggetto mysql
$servername = "localhost";
$username = "adminBossetti";
$password = "freeAstheWind";
$database = "login";

// oggetto mysql creato
$connessione = new mysqli($servername, $username, $password, $database);
if ($connessione->connect_error) // controlla se la connessione è avvenuta
{
  die("non funge: " . $connessione->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") // controlla il tipo di dati che arrivano al client
{
    $username = $_POST['username']; // e li memorizza in variabili
    $password = $_POST['password'];

    // questa variabile contiene la nostra query in sql
    $sql = "SELECT username, password, email FROM utenti WHERE (username = '$username' OR email = '$username') AND password = '$password'";
    $check = $connessione->query($sql); // usiamo il metodo query dell'oggetto sql e mettiamo il risultato in una variabile

    if ($check->num_rows != 0) // controlliamo se vengono restituiti delle righe l'utente esiste
    {
        // crea cookie
        $nome_cookie = "user-session";
        $valore_cookie = $username;
        setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
        // reindirizza alla pagina di successo
        header("Location: success.php");
    }
    else
    {
        $nome_cookie = "user-session";
        $valore_cookie = $username;
        setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
        header("Location: error.php");
    }
}