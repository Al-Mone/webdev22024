<?php
require 'config.php';

// Fetch photos from JSONPlaceholder
$photos = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/photos'), true);

// Fetch all users
$stmt = $pdo->query('SELECT id FROM users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$users) {
    echo "No users found in the database.";
    exit();
}

foreach ($users as $index => $user) {
    $profile_photo = $photos[$index % 5000]['url'];
    $cover_photo = 'media/default-cover.jpg'; // Adjust the path to your default cover photo

    // Debug: Print the values being assigned
    echo "Assigning photos to user ID {$user['id']}<br>";
    echo "Profile photo: $profile_photo<br>";
    echo "Cover photo: $cover_photo<br>";

    // Update user with profile and cover photos
    $stmt = $pdo->prepare('UPDATE users SET profile_photo = :profile_photo, cover_photo = :cover_photo WHERE id = :id');
    $stmt->execute([
        'profile_photo' => $profile_photo,
        'cover_photo' => $cover_photo,
        'id' => $user['id']
    ]);

    // Debug: Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo "User ID {$user['id']} updated successfully.<br>";
    } else {
        echo "Failed to update user ID {$user['id']}<br>";
    }
}

echo "Photos assigned to users successfully.";
?>