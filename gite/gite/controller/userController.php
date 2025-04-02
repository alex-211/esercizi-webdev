<?php
namespace controller;

class userModel
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
        // validate data here and convert it to something that SQL likes
        if ($classe == "" || $classe == null)
        {
            $classe = "PRF";
        }
        $this->userModel->create($nome, $cognome, $classe, $email, $password)
    }

    public function login()
    {
        if ($this->userModel->validateLogin($email, $password) == false)
        {
            // say something bad here
        }
        else
        {
            // put ID in a cookie 
            // redirect to homepage
        }
    }

    public function fetchDetails($id)
    {
        // grab currently logged in user id from cookies
        $user = $this->userModel->fetchDetails($id)
        // maybe put in array ?
    }

    class gitaController
    {
        private $conn
        public function __construct()
        {
            $this->conn = $conn
        }

        public function create()
    }
}
?>