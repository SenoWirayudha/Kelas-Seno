<div class= "container mt-4">
<h3 class="mb-0"><i class="fas fa-list-ol me-2"></i>Detail Pembelian</h3>
</div>
<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="post" class="row g-3">
                <div class="col-md-5">
                    <label for="tawal" class="form-label fw-semibold">Tanggal Awal</label>
                    <input type="date" name="tawal" id="tawal" required class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="takhir" class="form-label fw-semibold">Tanggal Akhir</label>
                    <input type="date" name="takhir" id="takhir" required class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" name="simpan" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php 
        $jumlahdata = $db->rowCOUNT("SELECT idorderdetail FROM vorderdetail");
        $banyak = 3;
        $halaman = ceil($jumlahdata / $banyak);

        if (isset($_GET['p'])) {
            $p = $_GET['p'];
            $mulai = ($p * $banyak) - $banyak;
        } else {
            $mulai = 0;
        }

        $sql = "SELECT * FROM vorderdetail ORDER BY idorderdetail DESC LIMIT $mulai, $banyak";
        if (isset($_POST['simpan'])) {
            $tawal = $_POST['tawal'];
            $takhir = $_POST['takhir'];
            $sql = "SELECT * FROM vorderdetail WHERE tglorder BETWEEN '$tawal' AND '$takhir' ";
        }

        $row = $db->getALL($sql);
        $no = 1 + $mulai;
        $total = 0;
    ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Pelanggan</th>
                        <th width="10%">Tanggal</th>
                        <th>Menu</th>
                        <th width="10%">Harga</th>
                        <th width="8%">Jumlah</th>
                        <th width="12%">Total</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($row)) { ?>
                    <?php foreach ($row as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($r['pelanggan']) ?></td>
                        <td><?= date('d/m/Y', strtotime($r['tglorder'])) ?></td>
                        <td><?= htmlspecialchars($r['menu']) ?></td>
                        <td class="text-end">Rp <?= number_format($r['harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= $r['jumlah'] ?></td>
                        <td class="text-end fw-semibold">Rp <?= number_format($r['jumlah'] * $r['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($r['alamat']) ?></td>

                        <?php 
                            $total = $total + ($r['jumlah'] * $r['harga']);
                        ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data pembelian</td>
                    </tr>
                    <?php } ?>
                    <tr class="table-active">
                        <td colspan="6" class="text-end fw-bold fs-5">Grand Total</td>
                        <td colspan="2" class="text-end fw-bold fs-5">Rp <?= number_format($total, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($halaman > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i=1; $i <= $halaman; $i++): ?>
            <li class="page-item <?= (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '' ?>">
                <a class="page-link" href="?f=orderdetail&m=select&p=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<style>
    .card {
        border-radius: 10px;
    }
    .table th {
        font-weight: 600;
        white-space: nowrap;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .table-active {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .form-control, .btn {
        border-radius: 8px;
    }
</style>