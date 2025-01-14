<?php
require_once '../../../config/connexion.php';

class filierModule
{
    private $db;

    public function __construct($mysqlClient)
    {
        $this->db = $mysqlClient;
    }

    public function getAllfilier()
    {
        $stmt = $this->db->query("SELECT * FROM filier");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getfilierById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM filier WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addfilier($nomfilier)
    {
        $stmt = $this->db->prepare("INSERT INTO filier (nomfilier) VALUES (:nomfilier)");
        return $stmt->execute([
            'nomfilier' => $nomfilier,
        ]);
    }

    public function updatefilier($id, $nomfilier)
    {
        $stmt = $this->db->prepare("UPDATE filier SET nomfilier = :nomfilier WHERE id = :id");
        return $stmt->execute([
            'nomfilier' => $nomfilier,
            'id' => $id,
        ]);
    }

    public function deletefilier($id)
    {
        $stmt = $this->db->prepare("DELETE FROM filier WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM filier WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
