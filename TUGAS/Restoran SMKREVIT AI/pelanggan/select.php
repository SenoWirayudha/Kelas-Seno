<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idpelanggan FROM tblpelanggan");
    $banyak = 4;

    $halaman =  ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tblpelanggan ORDER BY pelanggan ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1+$mulai;
?>
<div class= "container mt-4">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Pelanggan</h3>        
</div>
</div>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th style="width: 20%">Pelanggan</th>
                            <th style="width: 25%">Alamat</th>
                            <th style="width: 15%">Telp</th>
                            <th style="width: 20%">Email</th>
                            <th class="text-center" style="width: 10%">Aksi</th>
                            <th class="text-center" style="width: 10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $r): ?>
                        <tr>
                            <?php 
                                if ($r['aktif'] == 1) {
                                    $status = "Aktif";
                                    $status_class = "success";
                                } else {
                                    $status = "Nonaktif";
                                    $status_class = "danger";
                                }
                            ?>
                            <td class="text-center align-middle"><?php echo $no++ ?></td>
                            <td class="align-middle"><?php echo htmlspecialchars($r['pelanggan']) ?></td>
                            <td class="align-middle"><?php echo htmlspecialchars($r['alamat'] ?? '-') ?></td>
                            <td class="align-middle"><?php echo htmlspecialchars($r['telp'] ?? '-') ?></td>
                            <td class="align-middle"><?php echo htmlspecialchars($r['email']) ?></td>
                            <td class="text-center align-middle">
                                <a href="?f=pelanggan&m=delete&id=<?php echo $r['idpelanggan'] ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Yakin ingin menghapus data pelanggan ini?')"
                                   data-toggle="tooltip" title="Hapus">
                                   <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a href="?f=pelanggan&m=update&id=<?php echo $r['idpelanggan'] ?>" 
                                   class="badge rounded-pill bg-<?php echo $status_class ?> px-3 py-2 text-white text-decoration-none">
                                   <?php echo $status ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i=1; $i <= $halaman; $i++): ?>
                        <li class="page-item <?php echo (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="?f=pelanggan&m=select&p=<?php echo $i ?>">
                                <?php echo $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>