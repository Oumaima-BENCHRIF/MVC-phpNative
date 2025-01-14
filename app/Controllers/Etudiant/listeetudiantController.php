<?php

require_once '../../Models/Etudiant/listeetudiantModule.php';

class listeetudiantController
{
    private $model;

    public function __construct($mysqlClient)
    {
        $this->model = new listeetudiantModule($mysqlClient);
    }

    public function index($idfilier)
    {
        return $this->model->getAlllisteetudiant($idfilier);
    }

    public function indexs()
    {
        return $this->model->getAlllisteetudiants();
    }

    public function create($data)
    {
        $isAdded = $this->model->addlisteetudiant(
            $data['prenom'], 
            $data['note'], 
            $data['nom'], 
            $data['moyenne'],
            $data['filier']
        );
    
        if ($isAdded) { 
            header("Location: liste.php");
            return 'Etudiant ajouté avec succès!';
        } else {
            return 'Erreur lors de l\'ajout de l\'étudiant.';
        }
    }

    public function edit($id, $data)
    {
        return $this->model->updatelisteetudiant($id, $data['prenom'], $data['note'], $data['nom'], $data['moyenne'], $data['filier']);
    }

    public function delete($id)
    {
        if (is_numeric($id)) {
            return $this->model->deletelisteetudiant($id);
        }
        return false;
    }
    
    public function detailetudiant($id)
    {
        return $this->model->detailetudiants($id);
    }
}
?>
