<?php
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "sekolah";
    $koneksi = mysqli_connect ($host,$user,$password,$database);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SMKN 2 Buduran</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="images/LOGO SMENDA.jpg" alt=""></a>
            </div>
            <div class="sekolah">
                <h2>SMKN 2 Buduran</h2>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="?menu=Home">Home</a></li>
                    <li><a href="?menu=Kontak">Kontak</a></li>
                    <li><a href="?menu=Jurusan">Jurusan</a></li>
                    <li><a href="?menu=Tentang">Tentang</a></li>
                    <li><a href="?menu=Jadwal">Jadwal</a></li>
                    <li><a href="?menu=Sejarah">Sejarah</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <?php
                if (isset($_GET["menu"])) {
                    $menu = $_GET["menu"];
                if ($menu == "Home") {
                    require_once ("pages/home.php");
                }
                if ($menu == "Kontak") {
                    require_once ("pages/kontak.php");
                }
                if ($menu == "Jurusan"){
                    require_once("pages/jurusan.php");
                }
                if ($menu == "Tentang") {
                    require_once("pages/tentang.php");
                }
                if ($menu == "Jadwal") {
                    require_once("pages/jadwal.php");
                }
                if ($menu == "Sejarah") {
                    require_once("pages/sejarah.php");
                }
                }
                else {
                    require_once("pages/home.php");
                }
            ?>
        </div>
        <div class="footer">
            <p>Web ini dibuat oleh: Sen</p>
        </div>
    </div>
</body>
</html>