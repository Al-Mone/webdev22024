<?php
require_once 'functions.php';

function fetchHomepageData($pdo, $user_id)
{
    $posts = fetchAllPosts($pdo, $user_id);
    $recommended_users = fetchRecommendedUsers($pdo, $user_id);
    return ['posts' => $posts, 'recommended_users' => $recommended_users];
}

function fetchSearchData($pdo, $user_id, $query, $type)
{
    if ($type === 'users') {
        $stmt = $pdo->prepare('SELECT id, username, name, email, profile_photo FROM Users WHERE username LIKE :query');
        $stmt->execute(['query' => "%$query%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->prepare('SELECT p.id, p.title, p.body, u.username, u.profile_photo FROM Posts p JOIN Users u ON p.userId = u.id WHERE p.title LIKE :query OR p.body LIKE :query');
        $stmt->execute(['query' => "%$query%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $recommended_users = fetchRecommendedUsers($pdo, $user_id);
    return ['results' => $results, 'recommended_users' => $recommended_users];
}
?>