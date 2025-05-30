<?php 

    if (isset($_GET['id'])) {
        $id =  $_GET['id'];

        $sql = "DELETE FROM tblmenu WHERE idmenu = $id";

        $db->runSQL($sql);

        echo "<script>window.location.href='?f=menu&m=select';</script>";

    }

?>