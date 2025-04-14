<?php
namespace controller;

class userController
{
    private $conn;
    public function __construct()
    {
        $this->conn = $conn;
    }

    public function read()
    {
        $this->userModel->read();
    }

    public function create()
    {
        //TODO validate data here and convert it to something that SQL likes
        if ($classe == "" || $classe == null)
        {
            $classe = "PRF";
        }
        $this->userModel->create($nome, $cognome, $classe, $email, $password);
    }

    public function login()
    {
        if ($this->userModel->validateLogin($email, $password) == false)
        {
            //TODO say something bad here
        }
        else
        {
            //TODO put ID in a cookie 
            //TODO redirect to homepage
        }
    }

    public function fetchDetails($id)
    {
        //TODO grab currently logged in user id from cookies
        $user = $this->userModel->fetchDetails($id);
        //? maybe put in array ?
    }
}

class gitaController
    {
        private $conn;
        public function __construct()
        {
            $this->conn = $conn;
        }

        public function create($nome, $data_inizio, $data_fine)
        {
            //TODO prepare data
            $this->gitaModel->create($nome, $data_inizio, $data_fine);
        }

        public function modify($id, $nome, $data_inizio, $data_fine)
        {
            $look = $this->fetchDetails($id);
            if ($look != null)
            {
                switch (true) 
                {
                    case $look[0] == null:
                        $nome = $this->fetchDetails($id)[0];
                        break;
                    case $look[1] == null:
                        $data_inizio = $this->fetchDetails($id)[1];
                        break;
                    case $look[2] == null:
                        $data_fine = $this->fetchDetails($id)[2];
                        break;
                    default:
                    break;
                }
            }
            else
            {
                //TODO tell user gita was not found
            }
        }
    }
?>