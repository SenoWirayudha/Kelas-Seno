<?php 

    if (isset($_GET['id'])) {
        $id =  $_GET['id'];

        $sql = "DELETE FROM tblpelanggan WHERE idpelanggan = $id";

        $db->runSQL($sql);

        echo "<script>window.location.href='?f=pelanggan&m=select';</script>";

    }

?>