<?php
require_once 'config.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}


$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email']    ?? '');
$password =      $_POST['password'] ?? '';


$errors = [];

if (strlen($username) < 3) {
    $errors[] = 'Username must be at least 3 characters.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';  // fixed typo: $errors not $erros
}

if (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
}

// ── 3. Check availability & insert
try {

    // Check username
    $stmt = $conn->prepare('SELECT id FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    if ($stmt->fetch()) {
        echo 'This username is already taken.';
        exit;
    }

    // Check email
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        echo 'This email is already registered.';
        exit;
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
    );

    $stmt->execute([
        ':username' => $username,
        ':email'    => $email,
        ':password' => $hashedPassword,
    ]);

    
    header('Location: success.php');
    exit;

} catch (PDOException $e) {
    error_log('Registration error: ' . $e->getMessage()); // saved to server log
    echo 'Something went wrong. Please try again later.';
}