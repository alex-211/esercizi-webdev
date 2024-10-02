<?php
    if($_SERVER['REQUEST_METHOD']='POST')
    {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];

        echo "Ciao, ".htmlspecialchars($nome)." ".htmlspecialchars("$cognome");
    }
?>