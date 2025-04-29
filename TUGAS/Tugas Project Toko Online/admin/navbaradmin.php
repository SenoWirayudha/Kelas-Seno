<link rel="stylesheet" href="../assets/css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<nav class="navbar">
    <div class="navbar-logo">
        <!-- <a href="../pages/index.php"> -->
            <img src="../assets/images/Netflix-Symbol-removebg-preview.png" alt="Logo" class="logo">
        <!-- </a> -->
    </div>
    <ul class="navbar-menu">
        <li><a href="../admin/index.php"><i class="fas fa-home"></i> Beranda</a></li>
        <li><a href="../admin/data_pembelian.php"><i class="fas fa-history"></i>History</a></li>
        <li><a href="../admin/user_management.php"><i class="fas fa-user"></i>User</a></li>
        <li><a href="../admin/add_product.php"><i class="fas fa-plus"></i>Tambah Produk</a></li>
        <!-- <?php if(!isset($_SESSION['admin_logged_in'])){ ?>
        <<li><a href="../pages/cart.php"><i class="fas fa-shopping-cart"></i> Keranjang</a></li>
        <?php } ?> --> 
        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_logged_in'])): ?>
            <li><a href="../pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li style="color: white;"><i class="fas fa-user"></i> Admin</li>
        <?php else: ?>
            <li><a href="../pages/login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li><a href="../pages/register.php"><i class="fas fa-user-plus"></i> Registrasi</a></li>
        <?php endif; ?>
    </ul>
</nav>
<style>
    .navbar-logo .logo {
    height: auto; /* Ukuran logo */
    width: 30px;
    object-fit: cover;
    }

    .navbar .navbar-logo img{
        width: 60px;
    }
</style>
