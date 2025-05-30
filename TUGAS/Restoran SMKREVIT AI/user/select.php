<?php 
    $jumlahdata = $db->rowCOUNT("SELECT iduser FROM tbluser");
    $banyak = 4;

    $halaman =  ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tbluser ORDER BY user ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1+$mulai;
?>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class="fas fa-user-cog me-2"></i>User Management</h3>
        <a class="btn btn-primary" href="?f=user&m=insert" role="button">
            <i class="fas fa-plus me-2"></i>TAMBAH DATA
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th style="width: 25%">User</th>
                            <th style="width: 30%">Email</th>
                            <th style="width: 15%">Level</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                            <th class="text-center" style="width: 10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $r): ?>
                        <tr>
                            <?php 
                                if ($r['aktif'] == 1) {
                                    $status = "AKTIF";
                                    $status_class = "success";
                                } else {
                                    $status = "BANNED";
                                    $status_class = "danger";
                                }
                            ?>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo htmlspecialchars($r['user']) ?></td>
                            <td><?php echo htmlspecialchars($r['email']) ?></td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    <?php echo htmlspecialchars(ucfirst($r['level'])) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="?f=user&m=delete&id=<?php echo $r['iduser'] ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                   <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="?f=user&m=update&id=<?php echo $r['iduser'] ?>" 
                                   class="badge bg-<?php echo $status_class ?>">
                                   <?php echo $status ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i=1; $i <= $halaman; $i++): ?>
                    <li class="page-item <?php echo (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?f=user&m=select&p=<?php echo $i ?>">
                            <?php echo $i ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>