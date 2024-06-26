<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details for navbar
$stmt = $pdo->prepare('SELECT id, username FROM Users WHERE id = :id');
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all posts
$posts_stmt = $pdo->prepare('SELECT p.id, p.title, p.body, u.username FROM Posts p JOIN Users u ON p.userId = u.id ORDER BY p.id DESC');
$posts_stmt->execute();
$posts = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch recommended users (excluding the current user)
$recommended_stmt = $pdo->prepare('SELECT u.id, u.username FROM Users u WHERE u.id != :id ORDER BY RAND() LIMIT 5');
$recommended_stmt->execute(['id' => $user_id]);
$recommended_users = $recommended_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user photos from jsonplaceholder.typicode.com
$photos = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/photos'), true);
$user_photo = $photos[$user_id % 5000]['url'];

if (isset($_POST['profile'])) {
    header("Location: user.php?user_id=$user_id");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #000;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff;
        }

        .search-bar-container {
            position: relative;
        }

        .search-bar {
            border: 1px solid #fff;
            border-radius: 50px;
            background-color: #000;
            color: #fff;
            padding: 5px 40px 5px 15px;
            width: 300px;
        }

        .search-bar:focus {
            outline: none;
            color: #000;
            background-color: #fff;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #fff;
        }

        .search-bar:focus+.search-icon {
            color: #000;
        }

        .profile-pic-nav {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        .posts,
        .recommended-users {
            margin-top: 20px;
        }

        .post,
        .recommended-user {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .post-header,
        .recommended-user-header {
            display: flex;
            align-items: center;
        }

        .post-header img,
        .recommended-user-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .post-footer,
        .recommended-user-footer {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .post-footer .btn {
            padding: 0 10px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="homepage.php">Logo</a>
        <form class="form-inline mx-auto search-bar-container" action="search.php" method="GET">
            <input class="form-control mr-sm-2 search-bar" type="search" name="query" placeholder="Search"
                aria-label="Search">
            <i class="fas fa-search search-icon"></i>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile" class="profile-pic-nav">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <form method="POST">
                        <button class="dropdown-item" name="profile">Profile</button>
                        <button class="dropdown-item" name="logout">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 posts">
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <div class="post-header">
                            <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile">
                            <h5><?php echo htmlspecialchars($post['username']); ?></h5>
                            <button class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v"
                                    style="color: #000;"></i></button>
                        </div>
                        <div class="post-body">
                            <h6><?php echo htmlspecialchars($post['title']); ?></h6>
                            <p><?php echo htmlspecialchars($post['body']); ?></p>
                        </div>
                        <div class="post-footer">
                            <button class="btn btn-light"><i class="far fa-thumbs-up"></i></button>
                            <button class="btn btn-light"><i class="far fa-comment"></i></button>
                            <button class="btn btn-light ml-auto"><i class="far fa-share-square"></i></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 recommended-users">
                <h5>Recommended Users</h5>
                <?php foreach ($recommended_users as $recommended_user): ?>
                    <div class="recommended-user">
                        <div class="recommended-user-header">
                            <img src="<?php echo htmlspecialchars($photos[$recommended_user['id'] % 5000]['url']); ?>"
                                alt="Profile">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>