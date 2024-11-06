<?php
session_start();

$servername = "localhost";
$username = "adminBossetti";
$password = "freeAstheWind";

$connessione = new mysqli($servername, $username, $password);
if ($connessione->connect_error) 
{
  die("non funge: " . $connessione->connect_error);
}
else
{
    //echo "funge"; 
}

// contrariamente a quanto dice la pagine, non funge e si ferma all'echo funge
// probabile cambio l'index in php perché boh

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "bossetti99" && $password == "innocenza")
    {
        $_SESSION['username'] = $username;
        echo "real boss";
    }
    else
    {
        echo "not a real boss";
    }
}