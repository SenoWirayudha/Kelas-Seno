<?php 

    if (isset($_GET['id'])) {
        $id =  $_GET['id'];

        $sql = "DELETE FROM tbluser WHERE iduser = $id";

        $db->runSQL($sql);

        echo "<script>window.location.href='?f=user&m=select';</script>";

    }

?>