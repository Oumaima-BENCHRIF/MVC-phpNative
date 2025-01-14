<?php

session_start();

require_once '../../Controllers/login/loginController.php'; // Include the login controller

$message = ''; // Message d'erreur ou de succès

// Initialisation du contrôleur
$controller = new loginController($mysqlClient);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    if (!empty($username) && !empty($password)) {
		
        $user = $controller->authenticate($username, $password);

        if ($user) {
            $_SESSION['username'] = $user['Email']; // Store the username in the session
            $_SESSION['user_id'] = $user['id']; // Store the user ID in the session

            header('Location: ../etudiant/liste.php');
            exit();
        } else {
            // If authentication fails, show an error message
            $message = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    } else {
        // If the fields are empty, show an error message
        $message = 'Veuillez remplir tous les champs.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Animated Login Form</title>

    <link rel="icon" href="../../../public/img/avatar.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/logo/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img class="wave" src="../../../public/img/wave.png">
    <div class="container">
        <div class="img">
            <img aria-label="image" src="../../../public/img/bg.svg">
        </div>
        <div class="login-content">
            <form method="POST">
                <img aria-label="image" src="../../../public/img/avatar.svg">
                <h2 class="title">Welcome</h2>
                <!-- Afficher le message d'erreur s'il y en a -->
                <?php if ($message): ?>
                    <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input name="Username" type="text" class="input" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input name="Password" type="password" class="input">
                    </div>
                </div>
                <!-- <a href="#">Forgot Password?</a> -->
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../../../public/assets/js/main.js"></script>
</body>
</html>
