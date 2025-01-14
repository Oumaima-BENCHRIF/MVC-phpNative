<?php

session_start();

// Vérification de la session
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
}else{

include '../layouts/header.php';


require_once __DIR__ . '/../../Controllers/Etudiant/listeetudiantController.php';

$controller = new listeetudiantController($mysqlClient);

if(isset($_GET['idEtudiant'])){

    $etudiants = $controller->detailetudiant($_GET['idEtudiant']);
    $etudiant = $etudiants[0];
   
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
   
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/Etudiant/styleAcceuil.css">
    <link rel="stylesheet" type="text/css"  href="../../../public/assets/css/Etudiant/styleFooter.css">

</head>
<body>
   
<h1>Details un étudiant</h1>
    <main>
    <div class="form-container">
    
    <form method="POST">
        
        <input type="hidden" id="action-input" name="action" value="create">
        <input type="hidden" id="id-input" name="id" value="<?php echo $etudiant["id"] ?>">

        <label for="prenom">Prénom</label>
        <input type="text" id="prenom-input" value="<?php echo $etudiant["prenom"] ?>" name="prenom" placeholder="Prénom" required>

        <label for="note">Note</label>
        <input type="text" id="note-input" name="note" value="<?php echo $etudiant["note"] ?>"  placeholder="Note" required>

        <label for="nom">Nom</label>
        <input type="text" id="nom-input" name="nom" value="<?php echo $etudiant["nom"] ?>"  placeholder="Nom" required>

        <label for="filier">Filier</label>
        <input type="text" id="filier-input" name="filier" value="<?php echo $etudiant["nomfilier"] ?>"  placeholder="Filière" required>

        <label for="moyenne">Moyenne</label>
        <input type="number" step="0.01" id="moyenne-input" value="<?php echo $etudiant["moyenne"] ?>"  name="moyenne" placeholder="Moyenne" required>
        
    </form>
</div>

    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>
<?php } ?>
