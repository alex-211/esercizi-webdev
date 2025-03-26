<?php
    $host = 'localhost';
    $dbname = 'gite';
    $username = 'php';
    $password = 'php';

    try
    {
        $conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
        die("Impossibile connettersi al database $dbname: " . ex->getMessage());
    }
?>