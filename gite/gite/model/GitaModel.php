<?php
    namespace model;

    class GitaModel
    {
        private $conn
        public function __construct()
        {
            $this->conn = $conn
        }

        public function create($nome, $data_inizio, $data_fine)
        {
            idQuery = $this->conn->prepare("SELECT MAX(id) FROM gita");
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

            $query = $this->conn->prepare("INSERT INTO gite VALUES(?, ?, ?, ?");
            return query->execute([$id, $nome, $data_inizio, $data_fine]);
        }
    }
?>