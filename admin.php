<?php

session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <h2>Selamat datang, Admin!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>