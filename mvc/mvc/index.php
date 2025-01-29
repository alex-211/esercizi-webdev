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
        default:
            echo "404 not found (coglione)";
            break;
    }
?>