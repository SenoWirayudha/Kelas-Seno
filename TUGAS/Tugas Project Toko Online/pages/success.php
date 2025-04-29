<?php
session_start();
include '../config/database.php';

// Cek apakah ada pesan yang dikirim
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Jika tidak ada pesan, arahkan kembali ke halaman checkout
if (empty($message)) {
    header("Location: checkout.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h1>Checkout Berhasil!</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="index.php" class="btn">Kembali ke Beranda</a>
</div>
<?php include '../includes/footer.php'; ?>