<?php
if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $sql = "INSERT INTO tblkategori VALUES ('','$kategori')";
    $db->runSQL($sql);

    echo "<script>window.location.href='?f=kategori&m=select';</script>";
    exit;
}
?>

<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kategori Baru</h3>
        </div>
        <div class="card-body">
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="mb-4">
                    <label for="kategoriInput" class="form-label fw-bold">Nama Kategori</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        <input type="text" name="kategori" id="kategoriInput" required 
                               placeholder="Masukkan nama kategori" 
                               class="form-control form-control-lg"
                               aria-describedby="kategoriHelp">
                    </div>
                    <div id="kategoriHelp" class="form-text text-muted">Contoh: Makanan Pembuka, Minuman, dll.</div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="?f=kategori&m=select" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add this script before closing body tag -->
<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>