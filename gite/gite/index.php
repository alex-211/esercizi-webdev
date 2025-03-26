<?php
    require_once 'config.php';
    require_once 'model/userModel.php';
    require_once 'controlloer/userController.php';

    use userController;
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
        header('Location: login.php');
        break;
    }
?>