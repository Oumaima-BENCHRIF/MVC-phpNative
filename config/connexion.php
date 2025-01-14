<?php
// Ensure the path to config.php is correct


$dbConfig = [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'etudiant',
    'user' => 'root',
    'password' => ''
];

try {
    $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']};charset=utf8";
    $mysqlClient = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Confirm successful connection
} catch (Exception $e) {
    // Display a user-friendly error message
    die('Une erreur est survenue. Veuillez réessayer plus tard.');
}
?>
