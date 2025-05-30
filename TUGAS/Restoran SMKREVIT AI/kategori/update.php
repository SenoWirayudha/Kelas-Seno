<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tblkategori WHERE idkategori = $id";
        $row = $db->getITEM($sql);
    }
?>

<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light border-0">
            <h3 class="card-title mb-0"><i class="fas fa-edit me-2 text-primary"></i>Update Kategori</h3>
        </div>
        <div class="card-body">
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="mb-4 w-50">
                    <label for="kategoriInput" class="form-label fw-bold">Nama Kategori</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-tag"></i></span>
                        <input type="text" name="kategori" id="kategoriInput" required 
                               value="<?php echo isset($row['kategori']) ? $row['kategori'] : '' ?>" 
                               class="form-control form-control-lg"
                               placeholder="Masukkan nama kategori">
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="?f=kategori&m=select" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $kategori = $_POST['kategori'];
        $sql = "UPDATE tblkategori SET kategori = '$kategori' WHERE idkategori = $id";
        $db->runSQL($sql);
        echo "<script>window.location.href='?f=kategori&m=select';</script>";
    }
?>

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