<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar dari folder uploads jika ada
    $query_select = "SELECT gambar_produk FROM produk WHERE id=$id";
    $result_select = mysqli_query($koneksi, $query_select);
    if ($result_select) {
        $row = mysqli_fetch_assoc($result_select);
        if ($row['gambar_produk']) {
            unlink('uploads/' . $row['gambar_produk']); // Hapus gambar dari folder
        }
        
        // Hapus data dari database
        $query_delete = "DELETE FROM produk WHERE id=$id";
        
        if (mysqli_query($koneksi, $query_delete)) {
            echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
        } else {
            die("Query gagal dijalankan: " . mysqli_error($koneksi));
        }
    }
} else {
    die("ID tidak ditemukan.");
}
?>
