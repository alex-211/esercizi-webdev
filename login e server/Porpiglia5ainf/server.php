<?php
session_start();

$servername = "localhost";
$username = "adminBossetti";
$password = "freeAstheWind";
$database = "login";

$connessione = new mysqli($servername, $username, $password, $database);
if ($connessione->connect_error) 
{
  die("non funge: " . $connessione->connect_error);
}
else
{
    //echo "funge"; 
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username, password, email FROM utenti WHERE (username = '$username' OR email = '$username') AND password = '$password'";

    if ($check = $connessione->query($sql))
    {
        echo "bossetti net user";
    }
    else
    {
        echo "not a bossetti net user";
    }
}