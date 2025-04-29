<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login sebagai admin

// Ambil data pembelian dari database
$status_filter = $_GET['status'] ?? '';
$query = "
    SELECT 
        o.id AS order_id,
        o.customer_name,
        o.address,
        o.total,
        o.payment_method,
        o.status,
        o.created_at,
        od.product_id,
        p.title AS product_title,
        od.quantity,
        od.price AS product_price
    FROM 
        orders o
    JOIN 
        order_details od ON o.id = od.order_id
    JOIN 
        products p ON od.product_id = p.id
    WHERE 
        (:status = '' OR o.status = :status)
    ORDER BY 
        o.created_at DESC
";

// Eksekusi query

// Pastikan inisialisasi variabel
$stmt = $pdo->prepare($query);
$stmt->execute(['status' => $status_filter]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Ini yang kurang
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian - Admin</title>
    
    <style>
        /* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.admin-table th,
.admin-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.admin-table th {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.admin-table tr:hover {
    background-color: #f1f1f1;
}

.admin-table td {
    font-size: 14px;
}

.empty-message {
    text-align: center;
    font-size: 16px;
    color: #777;
}

/* Navbar Styling */
.navbar {
    background-color: #2c3e50;
    color: #fff;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    margin-left: 15px;
    font-size: 16px;
}

.navbar a:hover {
    text-decoration: underline;
}

/* status styling */
/* Status styling */
.status-badge {
    padding: 6px 12px;
    border-radius: 4px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
}

.pending .status-badge {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

.completed .status-badge {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.cancelled .status-badge {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Footer Styling */
.footer {
    text-align: center;
    margin-top: 20px;
    padding: 10px;
    background-color: #2c3e50;
    color: #fff;
    font-size: 14px;
}
    </style>
</head>
<body>
    <?php include 'navbaradmin.php'; ?>
    <div class="container">
        <h1>Data Pembelian</h1>
        <table class="admin-table">
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Total Harga</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>  <!-- Kolom Baru -->
            <th>Tanggal Pesanan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Produk</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            
                    <td><?= htmlspecialchars($order['order_id']) ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= htmlspecialchars($order['address']) ?></td>
                    <td>Rp <?= number_format($order['total'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($order['payment_method']) ?></td>
                    <td class="status-badge"><?= ucfirst($order['status']) ?></td>  <!-- Kolom Baru -->
                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                    <td><?= htmlspecialchars($order['product_title']) ?></td>
                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                    <td>Rp <?= number_format($order['product_price'], 2, ',', '.') ?></td>
                </tr>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
            <tr>
                <td colspan="10">Tidak ada data pembelian.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>
    <?php include 'adminfooter.php'; ?>
</body>
</html>