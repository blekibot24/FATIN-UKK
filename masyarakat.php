<?php


session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'masyarakat') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Masyarakat</title>
</head>
<body>
    <h2>Selamat datang, Masyarakat!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>