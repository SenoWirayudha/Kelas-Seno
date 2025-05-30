<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Update Menu</h3>
        </div>
        <div class="card-body">
            <?php 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                    $item = $db->getITEM($sql);
                    $idkategori = $item['idkategori'];
                }

                $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 w-75">
                    <label for="idkategori" class="form-label fw-semibold">Kategori</label>
                    <select name="idkategori" id="idkategori" class="form-select">
                        <?php foreach($row as $r): ?>
                        <option <?php if ($idkategori == $r['idkategori']) echo "selected"; ?> value="<?php echo $r['idkategori'] ?>">
                            <?php echo $r['kategori'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3 w-75">
                    <label for="menu" class="form-label fw-semibold">Nama Menu</label>
                    <input type="text" name="menu" id="menu" required value="<?php echo $item['menu']?>" class="form-control">
                </div>

                <div class="mb-3 w-75">
                    <label for="harga" class="form-label fw-semibold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga" id="harga" required value="<?php echo $item['harga']?>" class="form-control">
                    </div>
                </div>

                <div class="mb-3 w-75">
                    <label for="gambar" class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    <?php if (!empty($item['gambar'])): ?>
                    <div class="mt-2">
                        <img src="../upload/<?php echo $item['gambar']?>" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                        <p class="text-muted small mt-1">Gambar saat ini</p>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="?f=menu&m=select" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
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
        $gambar = $item['gambar'];
        $temp = $_FILES['gambar']['tmp_name'];

        if (!empty($temp)) {
            $gambar = $_FILES['gambar']['name'];
            move_uploaded_file($temp,'../upload/'.$gambar);
        }

        $sql = "UPDATE tblmenu SET idkategori = $idkategori, menu = '$menu', gambar = '$gambar', harga = '$harga' WHERE idmenu = $id";
        $db->runSQL($sql);
        echo "<script>window.location.href='?f=menu&m=select';</script>";
    }
?>

<style>
    .card {
        border-radius: 10px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
    }
    .btn {
        border-radius: 8px;
        padding: 10px 20px;
    }
    .img-thumbnail {
        border-radius: 8px;
    }
</style>