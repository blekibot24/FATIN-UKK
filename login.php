<?php


session_start();

$conn = new mysqli("localhost", "root", "", "layanan_masyarakat");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level'];

        if ($user['level'] == 'admin') {
            header("Location: admin.php");
        } elseif ($user['level'] == 'petugas') {
            header("Location: petugas.php");
        } else {
            header("Location: masyarakat.php");
        }
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Layanan Masyarakat</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .login-box { background: #fff; padding: 30px; margin: 100px auto; width: 320px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 8px 0; }
        input[type=submit] { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; }
        .error { color: red; text-align: center; }
        a { display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Layanan Masyarakat</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="register.php">Belum punya akun? Register</a>