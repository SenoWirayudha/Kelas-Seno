<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0"><i class= "fas fa-utensils me-2" ></i>Menu</h3>
    <a class="btn btn-primary" href="?f=menu&m=insert" role="button">
        <i class="fas fa-plus me-2"></i>TAMBAH DATA
    </a>
</div>
</div>

<?php 
    if (isset($_POST['opsi'])) {
        $opsi = $_POST['opsi'];
        $where = "WHERE idkategori = $opsi";
    } else {
        $opsi = 0;
        $where = "";
    }
?>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="" method="post">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <label for="opsi" class="form-label fw-semibold">Filter Kategori:</label>
                </div>
                <div class="col-md-8">
                    <select name="opsi" id="opsi" class="form-select" onchange="this.form.submit()">
                        <?php 
                            $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
                            foreach ($row as $r): 
                        ?>
                        <option <?php if($r['idkategori']==$opsi) echo "selected" ?> value="<?php echo $r['idkategori'] ?>">
                            <?php echo $r['kategori'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
    $banyak = 3;
    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Menu</th>
                    <th width="15%">Harga</th>
                    <th width="15%">Gambar</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($row)) { ?>
                <?php foreach ($row as $r): ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $r['menu'] ?></td>
                    <td>Rp <?php echo number_format($r['harga'], 0, ',', '.') ?></td>
                    <td>
                        <img class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" 
                             src="../upload/<?php echo $r['gambar'] ?>" alt="<?php echo $r['menu'] ?>">
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="?f=menu&m=update&id=<?php echo $r['idmenu'] ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="?f=menu&m=delete&id=<?php echo $r['idmenu'] ?>" class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php } else { ?>
                <tr>
                    <td colspan="5" class="text-center py-4">Tidak ada data menu</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($halaman > 1): ?>
<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <?php for ($i=1; $i <= $halaman; $i++): ?>
        <li class="page-item <?php echo (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '' ?>">
            <a class="page-link" href="?f=menu&m=select&p=<?php echo $i ?>">
                <?php echo $i ?>
            </a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .img-thumbnail {
        border-radius: 8px;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
    }
</style>