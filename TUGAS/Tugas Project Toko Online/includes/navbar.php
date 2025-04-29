<nav class="navbar">
    <div class="navbar-logo">
        <a href="../pages/index.php">
            <img src="../assets/images/Netflix-Symbol-removebg-preview.png" alt="Logo" class="logo">
        </a>
    </div>
    <ul class="navbar-menu">
        <li><a href="../pages/index.php"><i class="fas fa-home"></i> Beranda</a></li>
        <?php if(!isset($_SESSION['admin_logged_in'])){ ?>
        <li><a href="../pages/cart.php"><i class="fas fa-shopping-cart"></i> Keranjang</a></li>
        <?php } ?>
        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_logged_in'])): ?>
            <li><a href="../pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li><a href="../pages/profile.php"><i class="fas fa-user"></i> Profil</a></li>
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
