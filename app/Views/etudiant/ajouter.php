<?php


session_start();

// Vérification de la session
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
}else{

include '../layouts/header.php';


require_once __DIR__ . '/../../Controllers/Etudiant/listeetudiantController.php';
require_once '../../Controllers/Etudiant/filierController.php';
// Initialisation
$controller = new listeetudiantController($mysqlClient);
$filiercontroller = new filierController($mysqlClient);

$message = ''; // Variable pour afficher le message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $message = $controller->create($_POST);  // Récupérer le message de la méthode create
        }
    }
}

$filier = $filiercontroller->index();
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

    <script>
        // Fonction pour rediriger la ligne entière vers une autre page
        function redirectToDetail(id) {
            window.location.href = "details.php?idEtudiant=" + id;
        }
    </script>
</head>
<body>

    <h1>Ajouter un étudiant</h1>
    <main>
    <div class="form-container">
<?php if (!empty($message)): ?>
    <div class="message">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>
    <form method="POST">
        <input type="hidden" id="action-input" name="action" value="create">
        <input type="hidden" id="id-input" name="id" value="">

        <label for="prenom">Prénom</label>
        <input type="text" id="prenom-input" name="prenom" placeholder="Prénom" required>

        <label for="note">Note</label>
        <input type="text" id="note-input" name="note" placeholder="Note" required>

        <label for="nom">Nom</label>
        <input type="text" id="nom-input" name="nom" placeholder="Nom" required>

        <label for="filier">Filière</label>
        <select name="filier" id="filier-input" required>
            <?php foreach ($filier as $fil): ?>
                <option value="<?php echo $fil['id']; ?>"><?php echo htmlspecialchars($fil['nomfilier']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="moyenne">Moyenne</label>
        <input type="number" step="0.01" id="moyenne-input" name="moyenne" placeholder="Moyenne" required>

        <button type="submit">Ajouter</button>
    </form>

</div>

    
    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>
<?php } ?>
