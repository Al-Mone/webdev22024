<?php
require 'functions.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    error_log("User ID not found in session");
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
error_log("Current User ID: " . $user_id);

$user = fetchUserDetails($pdo, $user_id);
if (!$user) {
    error_log("User not found in database with ID: " . $user_id);
} else {
    error_log("User Data: " . print_r($user, true));
}

$posts = fetchUserPosts($pdo, $user_id);
$recommended_users = fetchRecommendedUsers($pdo, $user_id);

$user_photo = !empty($user['profile_photo']) ? $user['profile_photo'] : '../media/default-profile.jpg';
$cover_photo = !empty($user['cover_photo']) ? $user['cover_photo'] : '../media/default-cover.jpg';

$_SESSION['profile_photo'] = $user_photo;
$_SESSION['cover_photo'] = $cover_photo;

// Debug statements
error_log("User Photo URL: " . $user_photo);
error_log("Cover Photo URL: " . $cover_photo);
?>