<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil alamat pengguna dari database (jika ada)
$stmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$addresses = $stmt->fetchAll();

// Menangani penghapusan alamat
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $addressId = $_GET['id'];
    
    // Hapus alamat dari database
    $stmt = $pdo->prepare("DELETE FROM addresses WHERE id = ? AND user_id = ?");
    $stmt->execute([$addressId, $_SESSION['user_id']]);

    // Set pesan sukses
    $message = "Alamat berhasil dihapus!";
    
    // Redirect ke halaman yang sama untuk refresh
    header("Location: manage_address.php");
    exit();
}

// Menangani penambahan alamat
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = trim($_POST['address']);
    
    // Simpan alamat baru ke database
    $stmt = $pdo->prepare("INSERT INTO addresses (user_id, address) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $address]);

    // Set pesan sukses
    $message = "Alamat berhasil ditambahkan!";
    
    // Redirect ke halaman yang sama untuk refresh
    header("Location: manage_address.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h1>Kelola Alamat Pengiriman</h1>
    <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
    
    <form action="" method="POST">
        <label for="address">Alamat Baru:</label>
        <input type="text" id="address" name="address" required>
        <input type="submit" value="Tambahkan Alamat">
    </form>

    <h2>Alamat Tersimpan</h2>
    <?php if (empty($addresses)): ?>
        <p>Anda belum menambahkan alamat.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($addresses as $address): ?>
                <li>
                    <?= htmlspecialchars($address['address']) ?>
                    <a href="?action=delete&id=<?= $address['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus alamat ini?');">Hapus</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="profile.php">Kembali ke Profil</a></p>
</div>
<?php include '../includes/footer.php'; ?>