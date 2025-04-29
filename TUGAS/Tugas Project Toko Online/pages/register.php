<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan pengguna ke database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hashedPassword])) {
        $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Registrasi gagal. Username mungkin sudah digunakan.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
<div class="login-container">
    <h1>Registrasi</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Daftar">
    </form>
    <p><a href="login.php">Sudah punya akun? Login di sini</a></p> <!-- Tautan untuk login -->
    </div>
</div>
<?php include '../includes/footer.php'; ?>