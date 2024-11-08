<?php
    $sql = "SELECT * FROM tentang";
    
    $hasil = mysqli_query($koneksi,$sql);
    while ($row = mysqli_fetch_array($hasil)) {
    ?>

<div class="tentang">
    <h2><?= $row[1] ?></h2>
    <P><?= $row[2] ?></P>
</div>
    <?php
    }
?>
