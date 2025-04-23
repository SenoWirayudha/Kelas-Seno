<form action="" method="get">

    nama :
    <input type="text" name="nama" id="">
    alamat :
    <input type="text" name="alamat" id="">
    <input type="submit" name="kirim" value="simpan">

</form>

<?php 

    if (isset($_GET['kirim'])) {
        
        $nama = $_GET['nama'];
        $alamat = $_GET['alamat'];
    
        echo $nama;
        echo '<br>';
        echo $alamat;
    
    }

?>