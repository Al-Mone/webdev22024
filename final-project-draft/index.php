<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
    height: 100%;
    margin: 0;
    overflow: hidden;
  }
  .video-bg {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    object-fit: cover;
    z-index: -1;
  }
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(0, 0, 0, 0.5); /* Dims the background */
    z-index: 0;
  }
  .content {
    position: relative;
    z-index: 1;
    color: white; /* Makes the text white */
    text-align: center;
  }
  h1 {
    font-size: 4rem; /* Increases the header text size */
    opacity: 0;
    animation-fill-mode: forwards;
    animation: moveUp 1s forwards;
    letter-spacing: 0.1em; /* Adds slight letter-spacing */
  }
  p {
    opacity: 0;
    animation-fill-mode: forwards;
    animation: fadeIn 0.5s forwards 1s;
    letter-spacing: 0.05em; /* Adds slight letter-spacing */
  }
  .btn {
    opacity: 0;
    animation-fill-mode: forwards;
    animation: fadeIn 0.5s forwards 1s;
    margin: 0.5rem;
    border-radius: 25px; /* Makes the buttons rounder */
    letter-spacing: 0.05em; /* Adds slight letter-spacing */
  }
  @keyframes moveUp {
    from {
      transform: translateY(100px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  </style>
</head>
<body>
  <video autoplay muted loop class="video-bg">
    <source src="media\bg-vid.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="overlay"></div>
  <div class="container d-flex h-100 align-items-center justify-content-center">
    <div class="content">
      <h1 class="display-3 my-5">Bigger, Better, Bolder</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin suscipit tempor varius. Sed a tortor mauris.</p>
      <form action="redirect.php" method="post">
        <button type="submit" name="action" value="login" class="btn btn-outline-light">Log in</button>
        <button type="submit" name="action" value="signup" class="btn btn-dark">Sign up</button>
      </form>
    </div>
  </div>
  <script>
    window.addEventListener('load', () => {
      document.querySelector('h1').style.opacity = '1';
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
