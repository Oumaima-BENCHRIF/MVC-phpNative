<?php

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: ../../Views/Login/index.php');
    exit();
}else {

include '../layouts/header.php';
require_once __DIR__ . '/../../Controllers/Etudiant/listeetudiantController.php';
require_once '../../Controllers/Etudiant/filierController.php';



// Initialisation
$controller = new listeetudiantController($mysqlClient);
$filiercontroller = new filierController($mysqlClient);

$etudiant = null; // Initialisation de la variable $etudiant
$message = ''; // Variable pour afficher le message de confirmation ou d'erreur
$messageClass = '';
if (isset($_GET['idEtudiant'])) {
    $etudiants = $controller->detailetudiant($_GET['idEtudiant']);
    if (count($etudiants) > 0) {
        $etudiant = $etudiants[0];
    } else {
        // Si l'étudiant n'existe pas, rediriger ou afficher une erreur
        echo "Étudiant non trouvé.";
        exit;
    }

    // Process POST request after fetching the student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'edit') {
                // Perform the update operation
                $isUpdated = $controller->edit($_GET['idEtudiant'], $_POST);
               
                if ($isUpdated) {
                    
                    $etudiants = $controller->detailetudiant($_GET['idEtudiant']);
                    if (count($etudiants) > 0) {
                        $etudiant = $etudiants[0];
                    } else {
                        // Si l'étudiant n'existe pas, rediriger ou afficher une erreur
                        echo "Étudiant non trouvé.";
                        exit;
                    }
                    $messageClass = "success";
                    $message = "L'étudiant a été mis à jour avec succès.";
                } else {
                    $messageClass = "error";
                    $message = "Une erreur est survenue lors de la mise à jour de l'étudiant.";
                }
            
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
    <link rel="icon" href="../../../public/img/avatar.svg" type="image/x-icon">
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
<h1>Modifier un étudiant</h1>
    <main>
    <div class="form-container">
 

 <div id="message" class="message <?php echo $messageClass; ?>">
     <?php if (!empty($message)) {
         echo "<p>$message</p>";
     } ?>
 </div>


 <form method="POST">
 <input type="hidden" name="action" value="edit">
 <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['idEtudiant']); ?>">

 <label for="prenom">Prénom</label>
 <input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" placeholder="Prénom" required>

 <label for="note">Note</label>
 <input type="text" name="note" value="<?php echo htmlspecialchars($etudiant['note']); ?>" placeholder="Note" required>

 <label for="nom">Nom</label>
 <input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" placeholder="Nom" required>

 <label for="filier">Filière</label>
 <select name="filier" required>
     <?php foreach ($filier as $fil): ?>
         <option value="<?php echo $fil['id']; ?>" <?php echo ($fil['id'] == $etudiant['idFilier']) ? 'selected' : ''; ?>>
             <?php echo htmlspecialchars($fil['nomfilier']); ?>
         </option>
     <?php endforeach; ?>
 </select>

 <label for="moyenne">Moyenne</label>
 <input type="number" step="0.01" name="moyenne" value="<?php echo htmlspecialchars($etudiant['moyenne']); ?>" placeholder="Moyenne" required>

 <button type="submit">Modifier</button>
</form>

</div>
    </main>
    <script>
setTimeout(function() {
    document.getElementById('message').style.display = 'none';
    
  
}, 2000);
</script>
    <?php include '../layouts/footer.php'; ?>
</body>
</html>
<?php } ?>
