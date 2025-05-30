<?php 
    $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Menu Baru</h3>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 w-50">
                    <label for="idkategori" class="form-label fw-bold">Kategori</label>
                    <select name="idkategori" id="idkategori" class="form-select">
                        <?php foreach($row as $r): ?>
                        <option value="<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                
                <div class="mb-3 w-50">
                    <label for="menu" class="form-label fw-bold">Nama Menu</label>
                    <input type="text" name="menu" id="menu" required placeholder="Isi menu" class="form-control">
                </div>
                
                <div class="mb-3 w-50">
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga" id="harga" required placeholder="Isi harga" class="form-control" min="0">
                    </div>
                </div>
                
                <div class="mb-3 w-50">
                    <label for="gambar" class="form-label fw-bold">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    <div class="form-text">Format: JPG, PNG (Max 2MB)</div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="?f=menu&m=select" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $idkategori = $_POST['idkategori'];
        $menu = $_POST['menu'];
        $harga = $_POST['harga'];
        $gambar = $_FILES['gambar']['name'];
        $temp = $_FILES['gambar']['tmp_name'];

        if (empty($gambar)) {
            echo '<div class="alert alert-danger mt-3">GAMBAR KOSONG</div>';
        } else {
            $sql = "INSERT INTO tblmenu VALUES ('',$idkategori,'$menu','$gambar',$harga)";
            move_uploaded_file($temp,'../upload/'.$gambar);
            $db->runSQL($sql);
            echo "<script>window.location.href='?f=menu&m=select';</script>";
        }
    }
?>