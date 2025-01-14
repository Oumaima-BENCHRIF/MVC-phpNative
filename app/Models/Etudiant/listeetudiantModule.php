<?php

require_once '../../../config/connexion.php';

class listeetudiantModule
{
    private $db;

    public function __construct($mysqlClient)
    {
        $this->db = $mysqlClient;
    }

    public function getAlllisteetudiant($idfilier)
    {
        $stmt = $this->db->prepare("SELECT listeetudiant.*, listeetudiant.id AS idetudiant, filier.* 
                                    FROM listeetudiant
                                    INNER JOIN filier ON listeetudiant.idfilier = filier.id 
                                    WHERE idFilier = :idfilier");
        $stmt->execute(['idfilier' => $idfilier]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlllisteetudiants()
    {
        $stmt = $this->db->query("SELECT listeetudiant.*, listeetudiant.id AS idetudiant, filier.* 
                                  FROM listeetudiant 
                                  INNER JOIN filier ON listeetudiant.idfilier = filier.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getlisteetudiantById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM listeetudiant WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addlisteetudiant($prenom, $note, $nom, $moyenne, $idFilier)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO listeetudiant (prenom, note, nom, moyenne, idFilier) 
                                        VALUES (:prenom, :note, :nom, :moyenne, :idFilier)");
            return $stmt->execute([
                'prenom' => $prenom,
                'note' => $note,
                'nom' => $nom,
                'moyenne' => $moyenne,
                'idFilier' => $idFilier
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updatelisteetudiant($id, $prenom, $note, $nom, $moyenne, $idFilier)
    {
        $stmt = $this->db->prepare("UPDATE listeetudiant 
                                    SET prenom = :prenom, note = :note, nom = :nom, moyenne = :moyenne, idFilier = :idFilier 
                                    WHERE id = :id");
        return $stmt->execute([
            'prenom' => $prenom,
            'note' => $note,
            'nom' => $nom,
            'moyenne' => $moyenne,
            'idFilier' => $idFilier,
            'id' => $id
        ]);
    }

    public function deletelisteetudiant($id)
    {
        $stmt = $this->db->prepare("DELETE FROM listeetudiant WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function detailetudiants($id)
    {
        $stmt = $this->db->prepare("SELECT listeetudiant.*, listeetudiant.id AS idetudiant, filier.* 
                                    FROM listeetudiant 
                                    INNER JOIN filier ON listeetudiant.idfilier = filier.id 
                                    WHERE listeetudiant.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
