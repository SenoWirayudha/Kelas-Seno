<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil total dari data POST
$total = isset($_POST['total']) ? $_POST['total'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    
    // Validasi pembayaran di sini (contoh: cek bukti transfer)

    // Update status ke completed
    $stmt = $pdo->prepare("
        UPDATE orders 
        SET status = 'completed' 
        WHERE id = ?
    ");
    $stmt->execute([$order_id]);

    // Redirect atau tampilkan pesan sukses
}

// Proses checkout (misalnya, simpan pesanan ke database)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $customerName = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $paymentMethod = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : '';

    // Validasi input
    if (empty($customerName) || empty($address) || empty($paymentMethod)) {
        $error = "Nama, alamat, dan metode pembayaran harus diisi.";
    } else {
        // Simpan pesanan ke tabel orders
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, customer_name, address, payment_method) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $total, $customerName, $address, $paymentMethod]);

        // Hapus item dari keranjang setelah checkout
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);

        $message = "Checkout berhasil! Total pembayaran: Rp " . number_format($total, 2, ',', '.');
        // Redirect atau tampilkan pesan sukses
        header("Location: success.php?message=" . urlencode($message));
        exit();
    }
}
?>