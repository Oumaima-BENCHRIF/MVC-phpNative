<?php
require_once '../../Models/Etudiant/filierModule.php';

class filierController
{
    private $model;

    public function __construct($mysqlClient)
    {
        $this->model = new filierModule($mysqlClient);
    }

    public function index()
    {
        return $this->model->getAllfilier();
    }

    public function create($data)
    {
        return $this->model->addfilier($data['nomfilier']);
    }

    public function edit($id, $data)
    {
        return $this->model->updatefilier($id, $data['nomfilier']);
    }

    public function delete($id)
    {
        return $this->model->deletefilier($id);
    }
    
}
?>
