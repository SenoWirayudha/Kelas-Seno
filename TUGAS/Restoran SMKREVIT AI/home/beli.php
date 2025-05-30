<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h3>
        </div>
    </div>
<?php 
    if (isset($_GET['hapus'])) {
        $id =  $_GET['hapus'];
        unset($_SESSION['_'.$id]);
        header("Location:?f=home&m=beli");
    }
    if (isset($_GET['tambah'])) {
        $id =  $_GET['tambah'];
        $_SESSION['_'.$id]++;
        header("Location:?f=home&m=beli");
    }
    if (isset($_GET['kurang'])) {
        $id =  $_GET['kurang'];
        $_SESSION['_'.$id]--;
        header("Location:?f=home&m=beli");

        if ($_SESSION['_'.$id] == 0) {
            unset($_SESSION['_'.$id]);
        }
    }
    if (!isset($_SESSION['pelanggan'])) {
        header("location: ?f=home&m=login");
    }else{
        if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        isi($id);
        header("Location: ?f=home&m=beli");
        }else {
            keranjang();
        }
    }
    function isi($id){
        if (isset($_SESSION['_'.$id])) {
            $_SESSION['_'.$id]++;
        }else {
            $_SESSION['_'.$id] = 1;
        }
    }

    function keranjang(){
        global $db;
        $total = 0;
        global $total;
        echo '
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);
                foreach ($row as $r) {
                    echo "<tr>";
                    echo '<td><strong>'.$r['menu'].'</strong></td>';
                    echo '<td>Rp. '.number_format($r['harga'], 0, ',', '.').'</td>';
                    echo '<td>
    <div class="btn-group" role="group">
        <a href="?f=home&m=beli&kurang='.$r['idmenu'].'" class="btn btn-outline-secondary btn-sm"><i class="fas fa-minus"></i></a>
        <span class="btn btn-outline-secondary btn-sm disabled">'.$value.'</span>
        <a href="?f=home&m=beli&tambah='.$r['idmenu'].'" class="btn btn-outline-secondary btn-sm"><i class="fas fa-plus"></i></a>
    </div>
</td>';
                    echo '<td>Rp. '.number_format($r['harga'] * $value, 0, ',', '.').'</td>';
                    echo '<td><a href="?f=home&m=beli&hapus='.$r['idmenu'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i>Hapus</a></td>';
                    echo "</tr>";
                    $total = $total + ($value * $r['harga']);
                }
            }
        }
        echo '
            </tbody>
            <tfoot>
                <tr class="table-primary">
                    <td colspan="3" class="text-end"><strong>GRAND TOTAL :</strong></td>
                    <td><strong>Rp. '.number_format($total, 0, ',', '.').'</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        ';
        echo '</table>';
    }
?>
<?php 
    if (!empty($total)) {
?>
<div class="text-end mt-4">
    <a class="btn btn-primary btn-lg" href="?f=home&m=checkout&total=<?= $total ?>" role="button">
        <i class="fas fa-shopping-cart me-2"></i>Checkout
    </a>
</div>
<?php 
    }
?>
</div>