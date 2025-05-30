<?php 
    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;
    
    if (!isset($_SESSION['user'])) {
        header("location:login.php");
    }

    if (isset($_GET['log'])) {
        session_destroy();
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Restaurant Management System</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #4e73df;
            --sidebar-bg: #2c3e50;
            --sidebar-active: #34495e;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 20px;
            transition: all 0.3s;
        }
        
        .navbar {
            height: 60px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .sidebar-brand {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: var(--sidebar-active);
            text-decoration: none;
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: all 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.75rem 0 rgba(58, 59, 69, 0.2);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php" class="sidebar-brand text-decoration-none">
            <i class="fas fa-utensils mr-2"></i> Restaurant Admin
        </a>
        
        <ul class="nav flex-column mt-3">
            <?php 
                $level = $_SESSION['level'];
                $current_page = isset($_GET['f']) ? $_GET['f'] : '';
                
                $admin_links = [
                    ['f' => 'kategori', 'm' => 'select', 'icon' => 'fa-list', 'text' => 'Categories'],
                    ['f' => 'menu', 'm' => 'select', 'icon' => 'fa-utensils', 'text' => 'Menu Items'],
                    ['f' => 'pelanggan', 'm' => 'select', 'icon' => 'fa-users', 'text' => 'Customers'],
                    ['f' => 'order', 'm' => 'select', 'icon' => 'fa-clipboard-list', 'text' => 'Orders'],
                    ['f' => 'orderdetail', 'm' => 'select', 'icon' => 'fa-list-ol', 'text' => 'Order Details'],
                    ['f' => 'user', 'm' => 'select', 'icon' => 'fa-user-cog', 'text' => 'Users']
                ];
                
                $kasir_links = [
                    ['f' => 'order', 'm' => 'select', 'icon' => 'fa-clipboard-list', 'text' => 'Orders'],
                    ['f' => 'orderdetail', 'm' => 'select', 'icon' => 'fa-list-ol', 'text' => 'Order Details']
                ];
                
                $koki_links = [
                    ['f' => 'orderdetail', 'm' => 'select', 'icon' => 'fa-list-ol', 'text' => 'Order Details']
                ];
                
                switch ($level) {
                    case 'admin':
                        foreach ($admin_links as $link) {
                            $active = ($current_page == $link['f']) ? 'active' : '';
                            echo '<li class="nav-item">
                                <a class="nav-link '.$active.'" href="?f='.$link['f'].'&m='.$link['m'].'">
                                    <i class="fas '.$link['icon'].'"></i> '.$link['text'].'
                                </a>
                            </li>';
                        }
                        break;
                    case 'kasir':
                        foreach ($kasir_links as $link) {
                            $active = ($current_page == $link['f']) ? 'active' : '';
                            echo '<li class="nav-item">
                                <a class="nav-link '.$active.'" href="?f='.$link['f'].'&m='.$link['m'].'">
                                    <i class="fas '.$link['icon'].'"></i> '.$link['text'].'
                                </a>
                            </li>';
                        }
                        break;
                    case 'koki':
                        foreach ($koki_links as $link) {
                            $active = ($current_page == $link['f']) ? 'active' : '';
                            echo '<li class="nav-item">
                                <a class="nav-link '.$active.'" href="?f='.$link['f'].'&m='.$link['m'].'">
                                    <i class="fas '.$link['icon'].'"></i> '.$link['text'].'
                                </a>
                            </li>';
                        }
                        break;
                    default:
                        echo '<li class="nav-item">
                            <a class="nav-link" href="#">No Menu Available</a>
                        </li>';
                        break;
                }
            ?>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand navbar-light bg-white mb-4 static-top rounded">
            <div class="container-fluid justify-content-end">
            <div class="d-flex align-items-center">
                <div class="user-profile me-3">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['user'], 0, 1)); ?>
                    </div>
                <div>
                <div class="fw-bold"><?php echo $_SESSION['user']; ?></div>
                <div class="small text-muted"><?php echo ucfirst($_SESSION['level']); ?></div>
                </div>
            </div>                    
                    <div class="dropdown">
                        <button class="btn btn-link text-dark dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="?f=user&m=updateuser&id=<?= $_SESSION['iduser']; ?>">
                                    <i class="fas fa-user-cog mr-2"></i> Profile Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="?log=logout">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid">
            <?php 
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    $f = $_GET['f'];
                    $m = $_GET['m'];

                    $file = '../'.$f.'/'.$m.'.php';
                    
                    // Check if file exists before including
                    if (file_exists($file)) {
                        require_once $file;
                    } else {
                        echo '<div class="alert alert-danger">Module not found</div>';
                    }
                } else {
                    // Dashboard welcome content when no module is selected
                    echo '<div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Dashboard Overview</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-5">
                                <i class="fas fa-utensils fa-4x text-primary mb-3"></i>
                                <h3 class="mb-3">Welcome, '.$_SESSION['user'].'!</h3>
                                <p class="text-muted">Select a menu option from the sidebar to begin managing the restaurant.</p>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>

    <!-- <script src="../bootstrap/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        $(document).ready(function() {
            $('[data-toggle="sidebar"]').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
    </script> -->
    <!-- Untuk Bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="sidebar"]').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
        $(document).ready(function() {
        // Inisialisasi dropdown
        $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>