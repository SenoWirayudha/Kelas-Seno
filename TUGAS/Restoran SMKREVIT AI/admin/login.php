<?php 
session_start();
require_once "../dbcontroller.php";
$db = new DB;
$loginError = "";

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // Hindari hash() sementara jika tidak dibutuhkan
    $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
    $count = $db->rowCOUNT($sql);
    
    if ($count == 0) {
        $loginError = "Email atau Password salah!";
    } else {
        $row = $db->getITEM($sql);
        $_SESSION['user'] = $row['email'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['iduser'] = $row['iduser'];
        header("Location:index.php");
        exit(); // Tambahkan exit agar proses berhenti setelah redirect
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Restoran</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-box {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 10%;
            transition: 0.3s ease;
        }
        .login-box:hover {
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }
        .form-title {
            font-weight: bold;
            color: #4e73df;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-box">
                <h2 class="text-center form-title mb-4">Login Restoran</h2>
                
                <?php if (!empty($loginError)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $loginError ?>
                </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="Login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 

    if (isset($_POST['Login'])) {
        $email = $_POST['email'];
        // $password = hash('sha256',$_POST['password']);
        $password = $_POST['password'];
        $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
        $count = $db->rowCOUNT($sql);
        if ($count == 0) {
            echo "<center><h3>Email atau Password Salah!!</h3></center>";
        }else{
            $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
            $row = $db->getITEM($sql);
            $_SESSION['user'] = $row['email'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['iduser'] = $row['iduser'];
            header("Location:index.php");
        }
    }
?>