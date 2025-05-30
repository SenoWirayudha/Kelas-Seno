<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tblorder WHERE idorder = $id";
        $row = $db->getITEM($sql);
    }
?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-cash-register me-2"></i>Pembayaran Order</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-4 w-75">
                    <label for="total" class="form-label fw-semibold">Total</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="total" id="total" required 
                               value="<?php echo $row['total'] ?>" class="form-control" readonly>
                    </div>
                </div>
                
                <div class="mb-4 w-75">
                    <label for="bayar" class="form-label fw-semibold">Bayar</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="bayar" id="bayar" required 
                               class="form-control" min="<?php echo $row['total'] ?>">
                    </div>
                    <small class="text-muted">Masukkan jumlah pembayaran</small>
                </div>
                
                <div class="mt-4">
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-money-bill-wave me-2"></i>Proses Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $bayar = $_POST['bayar'];
        $kembali = $bayar - $row['total'];
        
        if ($kembali < 0) {
            echo '<div class="alert alert-danger mt-3">Pembayaran kurang! Silakan masukkan jumlah yang cukup.</div>';
        } else {
            $sql = "UPDATE tblorder SET bayar = $bayar, kembali = $kembali, status = 1 WHERE idorder = $id";
            $db->runSQL($sql);
            echo "<script>window.location.href='?f=order&m=select';</script>";
        }
    }
?>

<style>
    .card {
        border-radius: 10px;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
    }
    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>