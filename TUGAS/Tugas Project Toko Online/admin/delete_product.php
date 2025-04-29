<?php
session_start();
include '../config/database.php';

// Check admin session
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: http://localhost/KELAS-X%20PHP/dvd_store/pages/index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        $pdo->beginTransaction();
        
        // First delete related records from order_details
        $deleteOrderDetails = $pdo->prepare("DELETE FROM order_details WHERE product_id = ?");
        $deleteOrderDetails->execute([$id]);
        
        // Then delete the product
        $deleteProduct = $pdo->prepare("DELETE FROM products WHERE id = ?");
        if ($deleteProduct->execute([$id])) {
            $pdo->commit();
            $_SESSION['success'] = "Produk berhasil dihapus.";
        } else {
            throw new Exception("Gagal menghapus produk.");
        }
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = $e->getMessage();
    }
    
    header("Location: index.php");
    exit;
    
} else {
    $_SESSION['error'] = "ID Produk tidak valid.";
    header("Location: index.php");
    exit;
}
?>