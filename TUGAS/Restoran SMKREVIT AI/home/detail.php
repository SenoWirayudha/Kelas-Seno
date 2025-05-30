<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $jumlahdata = $db->rowCOUNT("SELECT idorderdetail FROM vorderdetail WHERE idorder = $id");
    $banyak = 4;

    $halaman =  ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else{
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorderdetail WHERE idorder = $id ORDER BY idorderdetail ASC LIMIT $mulai, $banyak";

    $row = $db->getALL($sql);

    $no = 1+$mulai;

?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="fas fa-receipt me-2"></i>Detail Pembelian
                <small class="text-muted">#<?php echo $id; ?></small>
            </h3>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Menu</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
    <tbody>
        <?php if(!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo date('d F Y', strtotime($r['tglorder'])) ?></td>
            <td>
                <span class="fw-bold"><?php echo $r['menu'] ?></span>
            </td>
            <td>Rp. <?php echo number_format($r['harga'], 0, ',', '.') ?></td>
            <td class="text-center">
                <span class="badge bg-secondary"><?php echo $r['jumlah'] ?></span>
            </td>
            <td>Rp. <?php echo number_format($r['harga'] * $r['jumlah'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <?php }?>
    </tbody>
</table>

</div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a href="?f=home&m=history" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
        </a>
        
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <?php for ($i=1; $i <= $halaman; $i++) : ?>
                    <li class="page-item <?php echo ($i == ($p ?? 1)) ? 'active' : ''; ?>">
                        <a class="page-link" href="?f=home&m=detail&id=<?php echo $id; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>