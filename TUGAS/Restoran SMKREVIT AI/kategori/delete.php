<?php 
if (isset($_GET['id'])) {
    $id =  $_GET['id'];

    $sql = "DELETE FROM tblkategori WHERE idkategori = $id";
    $db->runSQL($sql);

    echo "<script>window.location.href='?f=kategori&m=select';</script>";
    exit;
}
?>
