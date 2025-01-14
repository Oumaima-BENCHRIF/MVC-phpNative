<?php

require_once  '../../../config/connexion.php';


class loginModule {

    private $db;

    // Constructor
    public function __construct($mysqlClient) {
        $this->db = $mysqlClient;
    }

    // Function to check user credentials
    public function authenticate($email, $password) {
        // Prepare the SQL query
        $query = "SELECT * FROM `user` WHERE `Email` = :email LIMIT 1";
 
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':email', $email);
        
        $stmt->execute();

        // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password using password_verify
            if ($password === $user['password']) {
                return $user; // Return user data if authentication is successful
            }
        }

        return false; // Return false if authentication failed
    }
}
?>
