<?php 
    if (isset($_GET['total'])) {
        $total = $_GET['total'];
        $idorder = idorder();
        $idpelanggan = $_SESSION['idpelanggan'];
        $tgl = date('Y-m-d');

        $sql = "SELECT * FROM tblorder WHERE idorder = $idorder";
        $count = $db->rowCOUNT($sql);

        if ($count == 0) {
            insertOrder($idorder,$idpelanggan,$tgl,$total);
            insertOrderDetail($idorder);
        }else {
            insertOrderDetail($idorder);
        }
        kosongkanSession();
        header("location: ?f=home&m=checkout");
    }else{
        info();
    }

    function idorder(){
        global $db;
        $sql = "SELECT idorder FROM tblorder ORDER BY idorder DESC";
        $jumlah = $db->rowCOUNT($sql);
        if ( $jumlah == 0 ){
            $id = 1;
        }else {
            $item = $db->getITEM($sql);
            $id = $item['idorder'] + 1;
        }
        return $id;
    }
    function insertOrder($idorder, $idpelanggan, $tgl, $total){
        global $db;
        $sql = "INSERT INTO tblorder VALUES ($idorder, $idpelanggan, '$tgl', $total,0,0,0)";
        $db->runSQL($sql);
    }
    function insertOrderDetail($idorder = 1){
        global $db;
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $idmenu = $r['idmenu'];
                    $harga = $r['harga'];
                    $sql = "INSERT INTO tblorderdetail VALUES ('', $idorder, $idmenu, $value, $harga)";
                    $db->runSQL($sql);
                }
            }
        }
    }
    function kosongkanSession(){
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);
                unset($_SESSION['_'.$id]);
            }
        }
    }
    function info(){
        echo '<div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                            <h2 class="mt-4 mb-3">Terima Kasih!</h2>
                            <p class="lead text-muted mb-4">Pesanan Anda telah berhasil diproses. Kami akan segera menyiapkan pesanan Anda.</p>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="?f=home&m=history" class="btn btn-primary btn-lg px-4"><i class="fas fa-history me-2"></i>Lihat Riwayat Pesanan</a>
                                <a href="?f=home&m=product" class="btn btn-outline-secondary btn-lg px-4"><i class="fas fa-utensils me-2"></i>Pesan Lagi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
?>