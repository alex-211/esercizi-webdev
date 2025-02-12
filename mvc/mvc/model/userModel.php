<?php
    namespace Model;
    
    class UserModel
    {
        private $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function read()
        {
            $result = $this->conn->query("SELECT * FROM user");
            return $result->fetchAll(); 
        }

        public function create($nome, $cognome, $data_nascita)
        {
            $result = $this->conn->prepare("INSERT INTO user (nome, cognome, data_nascita) VALUES (?, ?, ?)");
            // prepare: modo sicuro per passare dati al DB -- evita SQLinjection 
            // non eseguo la query ma la preparo e non passo direttamente i valori
            return $result->execute($nome, $cognome, $data_nascita); // eseguisce effetivamente la query
        }
    }
?>