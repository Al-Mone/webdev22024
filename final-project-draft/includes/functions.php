<?php
// Fetch user details
function fetchUserDetails($pdo, $user_id)
{
    $stmt = $pdo->prepare('SELECT u.id, u.username, u.name, u.email, u.phone, u.website, u.bio, u.profile_photo, u.cover_photo, a.street, a.suite, a.city, a.zipcode, a.geo_lat, a.geo_lng, c.name AS company_name, c.catchPhrase, c.bs 
                           FROM Users u
                           LEFT JOIN Addresses a ON u.address_id = a.id
                           LEFT JOIN Companies c ON u.company_id = c.id
                           WHERE u.id = :id');
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Fetch user posts
function fetchUserPosts($pdo, $user_id)
{
    $stmt = $pdo->prepare('SELECT * FROM Posts WHERE userId = :id');
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Fetch All Posts
function fetchAllPosts($pdo, $user_id)
{
    $stmt = $pdo->prepare('SELECT p.*, u.username, u.profile_photo FROM Posts p JOIN Users u ON p.userId = u.id ORDER BY p.id DESC');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch recommended users (excluding the current user)
function fetchRecommendedUsers($pdo, $user_id)
{
    $stmt = $pdo->prepare('SELECT u.id, u.username, u.name, u.email, u.profile_photo FROM Users u WHERE u.id != :id ORDER BY RAND() LIMIT 5');
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>