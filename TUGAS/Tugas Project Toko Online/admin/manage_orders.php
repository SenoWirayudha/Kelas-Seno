<?php
session_start();
include '../config/database.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/header.php';
?>

<h1>Daftar Pesanan</h1>
<table>
    <tr>
        <th>ID Pesanan</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>Tanggal</th>
        <th>Detail</th>
    </tr>
    <?php
    $stmt = $pdo->query("SELECT * FROM orders");
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['customer_name']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['created_at']}</td>";
        echo "<td><a href='order_details.php?id={$row['id']}'>Lihat Detail</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>