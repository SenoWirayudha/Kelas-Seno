<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ambil pengguna dari database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {

        if($user['is_admin'] === 1){
            $_SESSION['is_admin'] = true;
            $_SESSION['admin_logged_in'] = true;
            header('Location: http://localhost/KELAS-X%20PHP/dvd_store/admin/');
            exit();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
<div class="login-container">
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Login">
    </form>
    <a href="register.php">Belum punya akun? Daftar di sini</a>
</div>
</div>
<?php include '../includes/footer.php'; ?>