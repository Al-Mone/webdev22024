<?php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mock password for JSON placeholder users
    $mockPassword = 'mockPassword123';

    // Fetch user from database
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (is_null($user['password'])) {
            // Check mock password for placeholder users
            if ($password === $mockPassword) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: user.php');
                exit();
            } else {
                $error = 'Invalid credentials';
            }
        } else {
            // Verify password for regular users
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: user.php');
                exit();
            } else {
                $error = 'Invalid credentials';
            }
        }
    } else {
        $error = 'Invalid credentials';
    }

    header('Location: login.php?error=' . urlencode($error));
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
