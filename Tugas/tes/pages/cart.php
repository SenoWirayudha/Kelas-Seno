<?php 

if(!isset($_SESSION['email'])){
    header("location:index.php?menu=login");
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    unset($_SESSION['cart'][$id]);
}



if(isset($_GET['add'])){
    $id = $_GET['add'];
    $sql = "SELECT * FROM produk WHERE id=$id";
    $hasil = mysqli_query($koneksi, $sql);
    
    $row = mysqli_fetch_assoc($hasil);
    
    $_SESSION['cart'][$row['id']]=[
        'id' => $row['id'],  
        'produk' => $row['produk'],  
        'deskripsi' => $row['deskripsi'],
        'jumlah' =>  isset($_SESSION['cart'][$row['id']]) ? $_SESSION['cart'][$row['id']]['jumlah']+ 1 : 1 
    ];
}

$cart = count($_SESSION['cart']);

if($cart == 0){
    header("location:index.php?menu=produk");
}
?>                          


<?php 
    foreach($_SESSION['cart'] as $key){
?>
<div class="produk">
    <h1><?=$key['id']?></h1>
    <h1><?=$key['produk']?></h1>
    <h1><?=$key['deskripsi']?></h1>
    <h1><?= $key['jumlah']?></h1>
    <a href="?menu=cart&hapus=<?=$key['id']?>">Hapus</a>
    <br>
</div>
<?php 
    }
?>