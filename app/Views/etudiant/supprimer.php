<?php

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
    }else{

require_once __DIR__ . '/../../Controllers/Etudiant/listeetudiantController.php';

$controller = new listeetudiantController($mysqlClient);

if (isset($_GET['idEtudiant'])) {
    // Suppression de l'étudiant
    $result = $controller->delete($_GET['idEtudiant']);
    if ($result) {
        header("Location: liste.php?success=1");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'étudiant.";
    }
} else {
    echo "ID de l'étudiant invalide.";
}
}
?>
