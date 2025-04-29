<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Contoh saat menyimpan pesanan
$stmt = $pdo->prepare("
    INSERT INTO orders 
    (customer_name, address, total, payment_method, status) 
    VALUES (?, ?, ?, ?, 'pending')
");

// Ambil produk yang dipilih dari data POST
$selectedProducts = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];

// Jika tidak ada produk yang dipilih, arahkan kembali ke keranjang
if (empty($selectedProducts)) {
    header("Location: cart.php?error=" . urlencode("Tidak ada produk yang dipilih untuk checkout."));
    exit();
}

// Ambil produk yang dipilih dari database
$userId = $_SESSION['user_id'];
$placeholders = implode(',', array_fill(0, count($selectedProducts), '?'));
$query = "SELECT p.id, p.title, p.price, c.quantity 
          FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = ? AND p.id IN ($placeholders)";
$stmt = $pdo->prepare($query);
$stmt->execute(array_merge([$userId], $selectedProducts));
$cartItems = $stmt->fetchAll();

// Hitung total harga dari produk yang dipilih
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Proses checkout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        // Ambil ID pesanan yang baru saja dibuat
        $orderId = $pdo->lastInsertId();

        // Simpan detail pesanan ke tabel order_details
        foreach ($cartItems as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
        }

        // Hapus produk yang dipilih dari keranjang
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id IN ($placeholders)");
        $stmt->execute(array_merge([$userId], $selectedProducts));

        // Tampilkan pesan sukses
        $message = "Checkout berhasil! Total pembayaran: Rp " . number_format($total, 2, ',', '.');
        header("Location: success.php?message=" . urlencode($message));
        exit();
    }
}
?>

<?php include '../includes/header.php'; ?>
<style>
    .checkout-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .checkout-container h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }
    .checkout-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .checkout-table th, .checkout-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .checkout-table th {
        background-color: #f4f4f4;
        color: #555;
    }
    .checkout-form div {
        margin-bottom: 15px;
    }
    .checkout-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .checkout-form input, .checkout-form textarea, .checkout-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .checkout-form button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .checkout-form button:hover {
        background-color: #218838;
    }
    .product-list {
        margin-top: 20px;
    }
    .product-list ul {
        list-style-type: none;
        padding: 0;
    }
    .product-list li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
</style>
<div class="checkout-container">
    <h1>Checkout</h1>
    
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form class="checkout-form" action="checkout.php" method="post">
        <p><strong>Total yang harus dibayar:</strong> Rp <?= number_format($total, 2, ',', '.') ?></p>

        <div>
            <label for="customer_name">Nama Pelanggan:</label>
            <input type="text" name="customer_name" id="customer_name" required>
        </div>

        <div>
            <label for="address">Alamat Pengiriman:</label>
            <textarea name="address" id="address" rows="4" required></textarea>
        </div>

        <div>
            <label for="payment_method">Metode Pembayaran:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="">Pilih Metode Pembayaran</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="cash_on_delivery">Bayar di Tempat</option>
            </select>
        </div>

        <!-- Kirim produk yang dipilih -->
        <?php foreach ($selectedProducts as $productId): ?>
            <input type="hidden" name="selected_products[]" value="<?= htmlspecialchars($productId) ?>">
        <?php endforeach; ?>

        <button type="submit">Konfirmasi Pembayaran</button>
    </form>

    <h3>Produk yang Dibeli</h3>
    <table class="checkout-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td>Rp <?= number_format($item['price'], 2, ',', '.') ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rp <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>
