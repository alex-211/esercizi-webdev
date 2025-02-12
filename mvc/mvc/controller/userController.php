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

        public function create($nome=null, $cognome=null, $data_nascita=null)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') // distingue se l'utente manda dati o meno -- 3 uguali distinguono se il tipo di variabile è uguale
            // se usiamo il metodo post, allora abbiamo mandato il form
            {

            }
            else // altrimenti fammi vedere il form
            {
                require_once 'view/create.php'
            }
        }
    }
?>