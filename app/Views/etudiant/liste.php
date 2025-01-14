<?php

session_start();
// Vérification de la session
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
}else{

include '../layouts/header.php';


require_once __DIR__ . '/../../Controllers/Etudiant/listeetudiantController.php';

// Initialisation
$controller = new listeetudiantController($mysqlClient);

if (isset($_GET['idfilier'])) {
    $etudiants = $controller->index($_GET['idfilier']);
} else {
    $etudiants = $controller->indexs();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  
    
    <link rel="icon" href="../../../public/img/avatar.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/logo/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Liste des Étudiants</title>
   
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/Etudiant/styleAcceuil.css">
    <link rel="stylesheet" type="text/css"  href="../../../public/assets/css/Etudiant/styleFooter.css">


    
    <script>
        // Fonction pour rediriger la ligne entière vers une autre page
        function redirectToDetail(id) {
            window.location.href = "details.php?idEtudiant=" + id;
        }
    </script>
</head>
<body>
    <h1>Liste des Étudiants</h1>
    <main>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Filière</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($etudiants)): ?>
                    <tr><td colspan="4">Aucun étudiant trouvé.</td></tr>
                <?php else: ?>
                    <?php foreach ($etudiants as $etu): ?>
                        <tr class="student-row" onclick="redirectToDetail(<?php echo $etu['idetudiant']; ?>)">
                            <td data-label="Prénom"><?php echo htmlspecialchars($etu['prenom']); ?></td>
                            <td data-label="Nom"><?php echo htmlspecialchars($etu['nom']); ?></td>
                            <td data-label="Filière"><?php echo htmlspecialchars($etu['nomfilier']); ?></td>
                            <td>
                                <a href="modifier.php?idEtudiant=<?php echo $etu['idetudiant']; ?>">Modifier</a> 
                                <a href="supprimer.php?idEtudiant=<?php echo $etu['idetudiant']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="ajouter.php" class="add-student">Ajouter Etudiant</a>
            <!-- <a href="deconnexion.php" class="logout-btn">Se déconnecter</a> -->
        </div>
    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>
<?php } ?>
