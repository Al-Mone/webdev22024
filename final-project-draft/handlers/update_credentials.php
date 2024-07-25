<?php
//Under Development: function for updating credentials through the application
require '../includes/config.php';
require '../includes/checkLogin.php';
checkLogin();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $website = $_POST['website'] ?? '';
    $company_name = $_POST['company_name'] ?? '';

    $stmt = $pdo->prepare('UPDATE Users SET username = ?, bio = ?, email = ?, phone = ?, website = ?, company_name = ? WHERE id = ?');
    $stmt->execute([$username, $bio, $email, $phone, $website, $company_name, $user_id]);

    $_SESSION['profile_photo'] = $profile_photo;
    $_SESSION['cover_photo'] = $cover_photo;

    header('Location: user.php');
    exit();
}
?>