<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $username, 'password' => $hashed_password]);

        // Set session and redirect to user profile
        session_start();
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header('Location: user.php');
        exit();
    } else {
        $error = 'Passwords do not match';
        header('Location: signup.php?error=' . urlencode($error));
        exit();
    }
} else {
    header('Location: signup.php');
    exit();
}
?>
