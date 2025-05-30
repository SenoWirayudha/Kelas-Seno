<?php 
    $email = $_SESSION['pelanggan'];
    $jumlahdata = $db->rowCOUNT("SELECT idorder FROM vorder WHERE email = '$email'");
    $banyak = 4;

    $halaman =  ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else{
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorder WHERE email = '$email' ORDER BY tglorder DESC LIMIT $mulai, $banyak";

    $row = $db->getALL($sql);

    $no = 1+$mulai;

?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4"><i class="fas fa-history me-2"></i>Riwayat Pembelian</h3>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped">
    <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
        <?php if(!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo date('d F Y', strtotime($r['tglorder'])) ?></td>
            <td>Rp. <?php echo number_format($r['total'], 0, ',', '.') ?></td>
            <td>
                <a href="?f=home&m=detail&id=<?php echo $r['idorder'] ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye me-1"></i>Lihat Detail
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php }?>
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i=1; $i <= $halaman; $i++) : ?>
                <li class="page-item <?php echo ($i == ($p ?? 1)) ? 'active' : ''; ?>">
                    <a class="page-link" href="?f=home&m=history&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</div>