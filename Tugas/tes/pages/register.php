<div class="container-login">
    <form action="" method="post">
        <input type="email" name="email" placeholder="Masukkan Email Anda">
        <input type="password" name="password" placeholder="Masukkan Password Anda">
        <input type="submit" name="submit" value="submit">
    </form>
</div>

<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customer (email, password) VALUES ('$email','$password')";

    $result = mysqli_query($koneksi, $sql);
    echo $result;

    header("location:index.php?menu=produk");
}

?>