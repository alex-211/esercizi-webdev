<?php
    namespace Controller;
    use model\UserModel;

    class UserController
    {
        private $userModel;

        public function __construct($conn)
        {
            $this->userModel = new UserModel($conn);
        }

        public function read()
        {
            $users= $this->userModel->read();
            require_once 'view/read.php';
        }
    }
?>