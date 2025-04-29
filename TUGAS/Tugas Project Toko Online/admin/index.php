<?php
session_start();
include '../config/database.php';

// Fix the admin check logic
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: http://localhost/KELAS-X%20PHP/dvd_store/pages/index.php");
    exit;
}

include './navbaradmin.php';
?>

<div class="container">
    <h1>Dashboard Admin</h1>
    
    <?php 
    // Display error messages if any
 
    // Display success messages if any
    if(isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }
    ?>
    
    <h2>Daftar Produk</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Category</th>
            <th>Aksi</th>
        </tr>
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM products ORDER BY id ASC");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>";
                echo "<td>{$row['stock']}</td>";
                echo "<td>{$row['category']}</td>";
                echo "<td class='action-buttons'>
                        <a href='edit_product.php?id={$row['id']}' class='edit-btn'>Edit</a>
                        <a href='delete_product.php?id={$row['id']}' class='delete-btn' 
                           onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\");'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='4' class='error-message'>Terjadi kesalahan dalam mengambil data produk.</td></tr>";
        }
        ?>
    </table>
</div>

<style>
/* Header */
h1, h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Alert Messages */
.alert {
    padding: 15px;
    margin: 20px 0;
    border-radius: 4px;
    text-align: center;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border: 1px solid #dee2e6;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #dee2e6;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f8f9fa;
}

tr:hover {
    background-color: #f2f2f2;
}

/* Action Buttons */
.action-buttons {
    white-space: nowrap;
}

.edit-btn, .delete-btn {
    text-decoration: none;
    color: #fff;
    padding: 6px 12px;
    border-radius: 4px;
    margin: 0 5px;
    display: inline-block;
}

.edit-btn {
    background-color: #007bff;
}

.edit-btn:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #dc3545;
}

.delete-btn:hover {
    background-color: #c82333;
}

/* Error Message */
.error-message {
    color: #dc3545;
    text-align: center;
    font-style: italic;
}

/* Container */
.container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}
</style>

<?php include '../includes/footer.php'; ?>