<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "cybersafe";

$port = 3307; // Change this port manually if needed

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error() . "<br><br>Please make sure MySQL is running in your XAMPP Control Panel on port " . $port . " and the <code>cybersafe</code> database has been imported from <code>database.sql</code>.");
}

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?msg=login_required");
        exit;
    }
}
?>
