<?php

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
}else{

include '../layouts/header.php';

require_once '../../Controllers/Etudiant/filierController.php';

// Initialisation
$controller = new filierController($mysqlClient);
$filier = $controller->index();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des filières</title>
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/Etudiant/styleAcceuil.css">
    <link rel="stylesheet" type="text/css"  href="../../../public/assets/css/Etudiant/styleFooter.css">

</head>
<body>
    <main>
        <h1>Liste des filières</h1>
        <table class="student-table">
            <tr>
                <th>ID</th> 
                <th>Nom de la filière</th>
                <th>Action</th>
            </tr>
            <?php foreach ($filier as $fil): ?>
                <tr>
                    <td><?php echo $fil['id']; ?></td>
                    <td><?php echo htmlspecialchars($fil['nomfilier']); ?></td>
                    <td>

                            <input type="hidden" name="id" value="<?php echo $fil['id']; ?>">

                            <a type="button" href="liste.php?idfilier=<?php echo $fil['id']; ?>">Consulter</a>

                       
                    </td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </main>
            <div class="button-container">
                <!-- <a href="AjouterEtudiant.php" class="add-student">Ajouter Etudiant</a> -->
                <!-- <a href="deconnexion.php" class="logout-btn">Se déconnecter</a> -->
            </div>
    
            <?php include '../layouts/footer.php'; 
            
        }?>

</body>
</html>

