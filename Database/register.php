<?php
// Include database connection
require_once 'config.php';

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an INSERT statement
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "User registered successfully. You can now [login](link_to_login_page).";
            // You might want to redirect the user to a login page
            // header("location: login.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        unset($stmt);
    }
}
// Close connection
unset($pdo);
?>
