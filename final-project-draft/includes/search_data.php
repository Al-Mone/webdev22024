<?php
// Fetches the data for search results
require 'fetch_data.php';
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = isset($_GET['query']) ? $_GET['query'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'users';
$data = fetchSearchData($pdo, $user_id, $query, $type);
$results = $data['results'];
$recommended_users = $data['recommended_users'];
?>