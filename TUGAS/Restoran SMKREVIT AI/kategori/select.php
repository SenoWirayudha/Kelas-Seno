<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idkategori FROM tblkategori");
    $banyak = 4;
    $halaman = ceil($jumlahdata / $banyak);
    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $mulai = ($p * $banyak) - $banyak;
    $sql = "SELECT * FROM tblkategori ORDER BY kategori ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class="fas fa-list-alt me-2"></i>Daftar Kategori</h3>
        <a class="btn btn-primary" href="?f=kategori&m=insert" role="button">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($row)) : ?>
                            <?php foreach ($row as $r): ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r['kategori'] ?></td>
                                <td class="text-nowrap">
                                    <a href="?f=kategori&m=update&id=<?php echo $r['idkategori'] ?>" 
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="?f=kategori&m=delete&id=<?php echo $r['idkategori'] ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    Tidak ada data kategori
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($halaman > 1): ?>
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if($p > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?f=kategori&m=select&p=<?php echo $p-1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php for ($i=1; $i <= $halaman; $i++): ?>
                <li class="page-item <?php echo ($p == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?f=kategori&m=select&p=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if($p < $halaman): ?>
                <li class="page-item">
                    <a class="page-link" href="?f=kategori&m=select&p=<?php echo $p+1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>