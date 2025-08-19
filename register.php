<?php

session_start();
$conn = new mysqli("localhost", "root", "", "layanan_masyarakat");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    // Cek username sudah ada atau belum di tabel login
    $cek = $conn->query("SELECT * FROM login WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        $sql = "INSERT INTO login (username, password, level) VALUES ('$username', '$password', '$level')";
        if ($conn->query($sql)) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Layanan Masyarakat</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .login-box { background: #fff; padding: 30px; margin: 100px auto; width: 320px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input, select { width: 100%; padding: 10px; margin: 8px 0; }
        input[type=submit] { background: #28a745; color: #fff; border: none; border-radius: 4px; }
        .error { color: red; text-align: center; }
        .success { color: green; text-align: center; }
        a { display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Register Layanan Masyarakat</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <?php if (isset($success)) echo "<div class='success'>$success</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="level" required>
                <option value="">Pilih Level</option>
                <option value="masyarakat">Masyarakat</option>
                <option value="petugas">Petugas</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" value="Register">
        </form>
        <a href="login.php">Sudah punya akun? Login</a>
    </div>
</body>
</html>