<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'login') {
        header('Location: ../login.php');
    } elseif ($action == 'signup') {
        header('Location: ../signup.php');
    } else {
        header('Location: /');
    }
    exit();
}
?>