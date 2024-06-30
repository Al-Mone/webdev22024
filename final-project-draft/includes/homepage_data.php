<?php
//Fetch functionality for homepage
require 'fetch_data.php';
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$data = fetchHomepageData($pdo, $user_id);
$posts = $data['posts'];
$recommended_users = $data['recommended_users'];
$user_photo = $_SESSION['profile_photo'] ?? '../media/default-profile.jpg'; // Fetch the current user's profile photo

// Debug statements
error_log("User Photo URL: " . $user_photo);
?>