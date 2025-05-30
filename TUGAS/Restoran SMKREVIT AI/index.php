<?php 
    ob_start(); // Tambahkan ini
    session_start();
    require_once "dbcontroller.php";
    $db = new DB;
    $sql = "SELECT * FROM tblkategori ORDER BY kategori";
    $row = $db->getALL($sql);

    if (isset($_GET['log'])) {
        session_destroy();
        header("Location:index.php");
        exit();
    }

    function cart() {
        global $db;
        $cart = 0;
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $cart++;
                }
            }
        }
        return $cart;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran SMK JAYA | Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #2e59d9;
            --secondary-color: #858796;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --accent-color: #f6c23e;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color);
            transition: all 0.3s;
        }
        
        .navbar-brand:hover {
            color: var(--primary-dark);
            transform: scale(1.02);
        }
        
        .user-nav {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        
        .user-nav a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            padding: 0.25rem 0;
            position: relative;
        }
        
        .user-nav a:hover {
            color: var(--primary-color);
        }
        
        .user-nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s;
        }
        
        .user-nav a:hover::after {
            width: 100%;
        }
        
        .cart-count {
            color: var(--accent-color);
            font-weight: 700;
        }
        
        .sidebar {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
        }
        
        .sidebar-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }
        
        .nav-link {
            color: var(--secondary-color);
            padding: 0.5rem 0;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .content-area {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 2rem;
            min-height: 70vh;
        }
        
        @media (max-width: 768px) {
            .user-nav {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header/Navigation -->
        <div class="row py-4 align-items-center">
            <div class="col-md-3">
                <h3 class="m-0">
                    <a class="navbar-brand" href="index.php">
                        <i class="fas fa-utensils me-2"></i>Restoran SMK
                    </a>
                </h3>
            </div>

            <div class="col-md-9">
                <div class="user-nav float-end">
                    <?php 
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <div><a href="?f=home&m=history"><i class="fas fa-history me-1"></i>History</a></div>
                            <div>Cart: <a href="?f=home&m=beli" class="cart-count">('.cart().')</a></div>
                            <div><a href="?f=home&m=beli"><i class="fas fa-user me-1"></i>'.$_SESSION['pelanggan'].'</a></div>
                            <div><a href="?log=logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></div>
                        ';
                    } else {
                        echo '
                            <div><a href="?f=home&m=login"><i class="fas fa-sign-in-alt me-1"></i>Login</a></div>
                            <div><a href="?f=home&m=daftar"><i class="fas fa-user-plus me-1"></i>Daftar</a></div>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="sidebar">
                    <h4 class="sidebar-title"><i class="fas fa-list me-2"></i>Kategori</h4>
                    <hr class="mt-0">
                    <?php if (!empty($row)) { ?>
                    <ul class="nav flex-column">
                        <?php foreach ($row as $r): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?f=home&m=product&id=<?php echo $r['idkategori']; ?>">
                                <i class="fas fa-chevron-right me-2"></i><?php echo $r['kategori']; ?>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-9">
                <div class="content-area">
                    <?php 
                        if (isset($_GET['f']) && isset($_GET['m'])) {
                            $f = $_GET['f'];
                            $m = $_GET['m'];
                            $file = $f.'/'.$m.'.php';
                            require_once $file;
                        } else {
                            require_once "home/product.php";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>