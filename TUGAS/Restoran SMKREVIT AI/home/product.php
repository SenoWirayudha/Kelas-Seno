<h3 class="text-center my-4">Menu</h3>

<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $where = "WHERE idkategori=$id";
        $id = "&id=" . $id;
    } else {
        $where = "";
        $id = "";
    }

    $jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
    $banyak = 3;
    $halaman = ceil($jumlahdata / $banyak);
    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $mulai = ($p * $banyak) - $banyak;

    $sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="container">
    <div class="row justify-content-center">
        <?php if (!empty($row)) : ?>
            <?php foreach ($row as $r) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow rounded">
                        <img src="upload/<?php echo $r['gambar'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo $r['menu'] ?>">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                            <p class="card-text text-muted">Rp <?php echo number_format($r['harga'], 0, ',', '.') ?></p>
                            <a href="?f=home&m=beli&id=<?php echo $r['idmenu'] ?>" class="btn btn-primary mt-auto">BELI</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center">
                <p class="text-muted">Menu tidak tersedia.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4">
            <?php for ($i = 1; $i <= $halaman; $i++) : ?>
                <li class="page-item <?php echo ($p == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?f=home&m=product&p=<?php echo $i . $id ?>"><?php echo $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
