<?php

namespace model;

class UserModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = $conn;    
    }

    public function read()
    {
        $result = $this->conn->query("SELECT * FROM user");
        return $result->fetchAll();
    }

    public function create($nome, $cognome, $classe, $email, $password)
    {
        $idQuery = $this->conn->prepare("SELECT MAX(id) FROM utente");
        $idQuery->execute();
        $id = $idQuery->fetchColumn(); // fetch o fetchColumn è essenziale per leggere il valore restituito. fetch restituisce un array mentre fetchColumn un dato

        if ($id == null)
        {
            $id = 1;
        }
        else 
        {
            $id++;
        }

        $query = $this->conn->prepare("INSERT INTO utente (id, nome, cognome, classe, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        return $query->execute([$id, $nome, $cognome, $classe, $email, $password]);
    }

    public function validateLogin($email, $password)
    {
        $query = $this->conn->prepare("SELECT id FROM utente WHERE email = :email AND password = :password");
        $query->execute(['email' => $email, 'password' => $password]);
        $ris = $query->fetchColumn();

        if ($ris == null)
        {
            return false;
        }
        else
        {
            return $ris;
        }
    }

    public function fetchDetails($id)
    {
        $query = $this->conn->prepare("SELECT nome, cognome, classe, email FROM utente WHERE id = :id"); // boh? id
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
}