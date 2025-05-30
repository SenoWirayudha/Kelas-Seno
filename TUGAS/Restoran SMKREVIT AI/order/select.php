<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idorder FROM vorder");
    $banyak = 4;
    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorder ORDER BY status,idorder ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class= "fas fa-clipboard-list me-2"></i> Order Pembelian</h3>
        <div class="d-flex">
            <span class="badge bg-secondary me-2">Total Data: <?= $jumlahdata ?></span>
            <span class="badge bg-primary">Halaman: <?= isset($_GET['p']) ? $_GET['p'] : 1 ?>/<?= $halaman ?></span>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Pelanggan</th>
                        <th width="15%">Tanggal</th>
                        <th width="12%">Total</th>
                        <th width="12%">Bayar</th>
                        <th width="12%">Kembali</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($row)) { ?>
                    <?php foreach ($row as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($r['pelanggan']) ?></td>
                        <td><?= date('d/m/Y', strtotime($r['tglorder'])) ?></td>
                        <td class="fw-semibold">Rp <?= number_format($r['total'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($r['bayar'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($r['kembali'], 0, ',', '.') ?></td>
                        <?php if ($r['status'] == 0): ?>
                            <td>
                                <a href="?f=order&m=bayar&id=<?= $r['idorder'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-money-bill-wave me-1"></i>Bayar
                                </a>
                            </td>
                        <?php else: ?>
                            <td><span class="badge bg-success">LUNAS</span></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data order</td>
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
            <li class="page-item <?= (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '' ?>">
                <a class="page-link" href="?f=order&m=select&p=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>