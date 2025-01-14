<?php


require_once '../../Models/login/loginModule.php'; // Include the login controller

class loginController
{
    private $userModel;

    // Constructor
    public function __construct($mysqlClient) {
        $this->userModel = new loginModule($mysqlClient); // Instantiate the UserModel
    }

    // Method to authenticate the user
    public function authenticate($username, $password) {
        
        // Call the model's authenticate method
        return $this->userModel->authenticate($username, $password);
    }
    
}
?>
