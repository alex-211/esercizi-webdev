<?php
session_start();

// array con gli utenti
// ma perché non usare un database?
// ah già, prossimo esercizio
$users = [
    'admin' => 'password',
    'boss' => 'etti',
    'yara00' => 'aiuto' 
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') // Controlliamo il tipo di dati che vengono passati dal client
{
    $username = $_POST['username']; // e li mettiamo in delle variabili
    $password = $_POST['password'];

    if(isset($users[$username])) // controlla se l'utente esiste
    {
        if ($users[$username] === $password) // controlla se la password inserita è giusta
        {
            $nome_cookie = "user-session";
            $valore_cookie = $username;
            setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
            // biscotto x te 😊 
            header("Location: palermo.php"); // se è giusta pag. di benvenuto
            // perché la pagina di benvenuto si chiama palermo? perché a palermo si inzuppa il biscottino
            // direi che co sti commenti basta
        }
        else
        {
            $nome_cookie = "user-session";
            $valore_cookie = $username;
            setcookie($nome_cookie, $valore_cookie, time() + 86400, "/");
            // dai, anche se hai sbagliato la pswd ti do un biscotto lo stesso, oggi mi sento gentile
            header("Location: invalidpswd.php"); // se non lo è, errore
        }
    }
    else
    {
        header("Location: userdne.php"); // se l'utente non esite, errore 
        // senti, va bene che son gentile ma se non ricordi manco lo username il biscotto non te lo do
    }
}
?>