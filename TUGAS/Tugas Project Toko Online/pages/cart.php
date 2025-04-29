<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil produk dari keranjang
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT p.id, p.title, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll();
?>

<?php include '../includes/header.php'; ?>

<style>
    /* Container Styles */


.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.cart-container {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 2rem;
}

.cart-container h1 {
    color: #333;
    font-size: 1.8rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

/* Table Styles */
.cart-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 2rem;
}

.cart-table th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid #dee2e6;
}

.cart-table td {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
}

.cart-table tr:last-child td {
    border-bottom: none;
}

.cart-table tr:hover {
    background-color: #f8f9fa;
}

/* Checkbox Styles */
.product-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

/* Total Container Styles */
.total-container {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 6px;
    margin: 2rem 0;
    text-align: right;
    font-size: 1.2rem;
}

/* Button Styles */
.btn {
    background-color: #007bff;
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.2s;
}

.btn:hover {
    background-color: #0056b3;
}

/* Empty Cart Styles */
.empty-cart {
    text-align: center;
    color: #6c757d;
    font-size: 1.1rem;
    margin: 2rem 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .cart-container {
        padding: 1rem;
    }
    
    .cart-table {
        display: block;
        overflow-x: auto;
    }
    
    .cart-table th,
    .cart-table td {
        padding: 0.75rem;
    }
    
    .btn {
        width: 100%;
        text-align: center;
    }
}

/* Price Formatting */
.cart-table td:nth-child(3),
.cart-table td:nth-child(5) {
    font-family: monospace;
    font-size: 0.95rem;
}
</style>
<div class="container">
<div class="cart-container">
    <h1>Keranjang Belanja</h1>

    <?php if (count($cartItems) > 0): ?>
        <form id="cartForm" action="checkout.php" method="POST">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <input 
                                    type="checkbox" 
                                    name="selected_products[]" 
                                    value="<?php echo $item['id']; ?>" 
                                    class="product-checkbox"
                                    data-price="<?php echo $item['price']; ?>" 
                                    data-quantity="<?php echo $item['quantity']; ?>"
                                />
                            </td>
                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                            <td>Rp <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>Rp <?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?></td>
                           
                          
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-container">
                <strong>Total yang Dipilih: Rp <span id="selectedTotal">0</span></strong>
            </div>
            <button type="submit" class="btn">Lanjutkan ke Checkout</button>
        </form>
    <?php else: ?>
        <p class="empty-cart">Keranjang Anda kosong.</p>
        <a href="index.php" class="btn">Kembali ke Beranda</a>
    <?php endif; ?>
</div>
</div>
<?php include '../includes/footer.php'; ?>

<script>
    // JavaScript untuk menghitung total harga berdasarkan produk yang dipilih
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const selectedTotal = document.getElementById('selectedTotal');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            let total = 0;
            checkboxes.forEach(item => {
                if (item.checked) {
                    const price = parseFloat(item.dataset.price);
                    const quantity = parseInt(item.dataset.quantity);
                    total += price * quantity;
                }
            });
            selectedTotal.textContent = total.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        });
    });
</script>
