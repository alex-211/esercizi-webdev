<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') // controlliamo se i dati arrivano in POST
{
    $content = $_POST['content']; // inseriamo i dati in variabile
    try // il try-catch wrapper server per l'error-handling
    {
        $result = eval("return $content;"); 
        echo $result;
    } catch (Throwable $e) // throwable è un classe di errori ed eccezione base del PHP che copre di tutto
    {
        echo "Syntax error"; // perché fare error handling? Perché é molto meglio x l'utente vedere syntax error piuttosto che un errore del PHP
    }
}