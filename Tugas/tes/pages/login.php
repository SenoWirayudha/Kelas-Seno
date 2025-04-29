<div class="container-login">
    <form action="" method="post">
        <input type="email" name="email" placeholder="Masukkan Email Anda">
        <input type="password" name="password" placeholder="Masukkan Password Anda">
        <input type="submit" name="submit" value="submit">
    </form>
</div>

<?php

if(isset($_POST['submit'])){
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM customer WHERE email='$email' and password='$password'";


$result = mysqli_query($koneksi, $sql);

$baris = mysqli_num_rows($result);

if($baris === 0){
    echo "<h1>Email Ataw Password Salah</h1>";
} else {
    $_SESSION['email']=$email;
    header("location:index.php?menu=produk");
}

}

?>