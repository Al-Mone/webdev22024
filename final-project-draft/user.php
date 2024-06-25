<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $pdo->prepare('SELECT u.id, u.username, u.name, u.email, u.phone, u.website, a.street, a.suite, a.city, a.zipcode, a.geo_lat, a.geo_lng, c.name AS company_name, c.catchPhrase, c.bs FROM Users u
                       JOIN Addresses a ON u.address_id = a.id
                       JOIN Companies c ON u.company_id = c.id
                       WHERE u.id = :id');
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user exists
if (!$user) {
    header("Location: logout.php");
    exit();
}

// Fetch user posts
$posts_stmt = $pdo->prepare('SELECT * FROM Posts WHERE userId = :id');
$posts_stmt->execute(['id' => $user_id]);
$posts = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch recommended users (excluding the current user)
$recommended_stmt = $pdo->prepare('SELECT u.id, u.username, u.name, u.email FROM Users u WHERE u.id != :id ORDER BY RAND() LIMIT 5');
$recommended_stmt->execute(['id' => $user_id]);
$recommended_users = $recommended_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #000;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }
        .search-bar {
            border: 1px solid #fff;
            border-radius: 50px;
            background-color: #000;
            color: #fff;
            padding: 5px 10px;
        }
        .profile-container {
            position: relative;
            margin-top: 20px;
        }
        .cover-photo {
            width: 100%;
            height: 200px;
            background: url('<?php echo htmlspecialchars($user['cover_photo'] ?? 'default-cover.jpg'); ?>') no-repeat center center;
            background-size: cover;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            position: absolute;
            bottom: -75px;
            left: 20px;
            border: 5px solid #fff;
        }
        .user-details {
            margin-top: 80px;
            padding: 20px;
        }
        .user-details h2, .user-details p {
            margin: 0;
        }
        .posts, .recommended-users {
            margin-top: 20px;
        }
        .post, .recommended-user {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .post-header, .recommended-user-header {
            display: flex;
            align-items: center;
        }
        .post-header img, .recommended-user-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .post-footer, .recommended-user-footer {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .btn-new-post, .btn-follow {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Logo</a>
        <form class="form-inline mx-auto">
            <input class="form-control mr-sm-2 search-bar" type="search" placeholder="Search" aria-label="Search">
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($user['profile_picture'] ?? 'default-profile.png'); ?>" alt="Profile" class="profile-pic-nav">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="profile-container">
            <div class="cover-photo"></div>
            <img src="<?php echo htmlspecialchars($user['profile_picture'] ?? 'default-profile.png'); ?>" alt="Profile" class="profile-pic">
        </div>
        <div class="user-details">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
            <p><?php echo htmlspecialchars($user['bio'] ?? ''); ?></p>
            <p><?php echo htmlspecialchars($user['contact'] ?? ''); ?></p>
            <?php if ($user['id'] == $user_id): ?>
                <button class="btn btn-dark btn-new-post">New Post</button>
            <?php else: ?>
                <button class="btn btn-dark btn-follow">Follow</button>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-8 posts">
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <div class="post-header">
                            <img src="<?php echo htmlspecialchars($user['profile_picture'] ?? 'default-profile.png'); ?>" alt="Profile">
                            <h5><?php echo htmlspecialchars($user['username']); ?></h5>
                            <button class="btn btn-link ml-auto">...</button>
                        </div>
                        <div class="post-body">
                            <p><?php echo htmlspecialchars($post['body']); ?></p>
                        </div>
                        <div class="post-footer">
                            <button class="btn btn-light">Like</button>
                            <button class="btn btn-light">Comment</button>
                            <button class="btn btn-light">Share</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 recommended-users">
                <h5>Recommended Users</h5>
                <?php foreach ($recommended_users as $recommended_user): ?>
                    <div class="recommended-user">
                        <div class="recommended-user-header">
                            <img src="<?php echo htmlspecialchars($recommended_user['profile_picture'] ?? 'default-profile.png'); ?>" alt="Profile">
                            <h6><?php echo htmlspecialchars($recommended_user['username']); ?></h6>
                        </div>
                        <div class="recommended-user-footer">
                            <button class="btn btn-light">Follow</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
