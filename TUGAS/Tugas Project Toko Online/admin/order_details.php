<?php
session_start();
include '../config/database.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);
    $order = $stmt->fetch();

    $stmtDetails = $pdo->prepare("SELECT od.*, p.title FROM order_details od JOIN products p ON od.product_id = p.id WHERE od.order_id = ?");
    $stmtDetails->execute([$id]);
    $orderDetails = $stmtDetails->fetchAll();
} else {
    echo "<p>Pesanan tidak ditemukan.</p>";
    exit;
}

include '../includes/header.php';
?>

<h1>Detail Pesanan #<?= htmlspecialchars($order['id']) ?></h1>
<p>Nama Pelanggan: <?= htmlspecialchars($order['customer_name']) ?></p>
<p>Alamat: <?= htmlspecialchars($order['address']) ?></p>
<p>Tanggal: <?= htmlspecialchars($order['created_at']) ?></p>

<h2>Detail Produk</h2>
<table>
    <tr>
        <th>Judul Produk</th>
        <th>Jumlah</th>
    </tr>
    <?php foreach ($orderDetails as $detail): ?>
        <tr>
            <td><?= htmlspecialchars($detail['title']) ?></td>
            <td><?= htmlspecialchars($detail['quantity']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>