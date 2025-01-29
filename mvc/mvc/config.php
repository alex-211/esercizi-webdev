<?php
    $host = 'localhost';
    $dbname = 'mvc';
    $username = 'beppe';
    $password = 'beppe';
    // B E P P E 

    try
    {
        $conn = new PDO("mysql:host=$host;dbname=$dbname" , $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e)
    {
        die("Non riesco a connettermi al database $dbname: " . $e->getMessage());
    }
?>