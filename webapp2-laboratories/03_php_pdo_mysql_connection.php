<?php
$hostname = 'localhost';
$username = 'admin';
$password = 'dCEPvm_GSXA_NneU';
$database = 'my_db';

try {

    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
