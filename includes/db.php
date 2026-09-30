<?php
session_start();

$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "cybersafe";
$port = 3307;

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?msg=login_required");
        exit;
    }
}
?>
