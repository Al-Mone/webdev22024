<?php
require 'includes/checkLogin.php';
checkLogin();

$user_photo = $_SESSION['profile_photo'] ?? '../media/default-profile.jpg'; // Default profile photo
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="homepage.php">Logo</a>
            <div class="d-flex align-items-center mx-auto">
                <form class="form-inline my-auto search-bar-container" action="search.php" method="GET">
                    <input class="form-control mr-sm-2 search-bar" type="search" name="query" placeholder="Search"
                        aria-label="Search">
                    <i class="fas fa-search search-icon"></i>
                </form>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile" class="profile-pic-nav">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <form method="POST" action="user.php">
                            <button class="dropdown-item" name="profile">Profile</button>
                        </form>
                        <form method="POST" action="logout.php">
                            <button class="dropdown-item" name="logout">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">