<?php
    require_once 'config.php';
    require_once 'model/userModel.php';
    require_once 'controller/userController.php';

    use Controller\UserController;

    $url = "";

    if (isset($_GET['url']))
    {
        $url = $_GET['url'];
    }
    else
    {
        $url = '/';
    }

    $controller = new UserController($conn);

    switch($url)
    {
        case '/':
            $controller->read();
            break;
        case 'create':
            $controller->create($_POST['nome'] ?? null, $_POST['cognome'] ?? null, $_POST['data_nascita'] ?? null);
            // ?? = è una if minimizzata: se trovo il dato in POST dal form, passa il dato, se no passa null
            break;
        default:
            echo "404 not found (coglione)";
            break;
    }
?>