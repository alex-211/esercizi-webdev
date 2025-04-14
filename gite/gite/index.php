<?php
    require_once 'config.php';
    require_once 'model/userModel.php';
    require_once 'controller/userController.php';

    use controller\userController;
    $controller = new userController($conn);

    if (isset($_GET['url']))
    {
        $url = $_GET['url'];
    }
    else
    {
        $url = '/';
    }

    switch ($url)
    {
        case '/':
            header('Location: view/login.php'); 
            break;
    }
?>