<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "ujianPHP";

$koneksi = mysqli_connect($host, $user, $password, $database)

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko SMKN 2 BUDURAN</title>
    <style>
        .produk {
            border: 1px solid;
        }
    </style>
</head>

<body>


    <a href="?menu=produk">Tokoku</a>



    <ul>
        <?php
        if (isset($_SESSION['email'])) {
        ?>

            <li>
                <a href="?menu=cart">cart</a>
            </li>

            <li>
                <?= $_SESSION['email'] ?>
            </li>
            <li>
                <a href="?menu=logout">Logout</a>
            </li>

        <?php
        }
        ?>

        <?php
        if (!isset($_SESSION["email"])) {
        ?>
            <li>
                <a href="?menu=login">Login</a>
            </li>
            <li>
                <a href="?menu=register">Register</a>
            </li>
        <?php } ?>
    </ul>


    <div class="container-home">
        <?php
        if (isset($_GET['menu'])) {
            $menu = $_GET['menu'];
            switch ($menu) {
                case 'login':
                    require_once "pages/login.php";
                    break;
                case 'register':
                    require_once "pages/register.php";
                    break;
                case 'logout':
                    require_once "pages/logout.php";
                    break;
                case 'cart':
                    require_once "pages/cart.php";
                    break;
                default:
                    require_once "pages/produk.php";
            }
        };
        ?>
    </div>


</body>

</html>