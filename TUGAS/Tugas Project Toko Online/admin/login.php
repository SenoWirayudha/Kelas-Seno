<?php
session_start();
include '../config/database.php';
include '../admin/navbaradmin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi.";
    } else {
        // Ambil data pengguna dari database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // Langkah 1: Debugging - Cek panjang password yang dimasukkan dan hash password
            echo '<pre>';
            echo "Hash Password dari DB: " . $user['password'] . "<br>";
            echo "Panjang Hash Password: " . strlen($user['password']) . "<br>";
            echo "Password yang dimasukkan: " . $password . "<br>";
            echo "Panjang Password yang dimasukkan: " . strlen($password) . "<br>";

            // Langkah 2: Verifikasi password menggunakan password_verify
            if (password_verify($password, $user['password'])) {
                // Simpan data ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin']; // Status admin

                // Arahkan pengguna ke halaman sesuai perannya
                if ($user['is_admin']==1) {
                    $_SESSION['admin_logged_in']=true;
                    header("Location: ../admin/index.php");
                } else {
                    header("Location: ../includes/header.php");
                }
                exit();
            } else {
                // Verifikasi gagal, tampilkan pesan error
                $error = "Password salah.";
            }

        } else {
            $error = "Username tidak ditemukan.";
        }
    }
}
?>

<!-- Form HTML -->
<h1>Login Pengguna</h1>
<div class="container">

<form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Login</button>

    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
    
    <p>Belum punya akun? <a href="../admin/register.php">Daftar di sini</a>.</p> <!-- Hyperlink ke halaman pendaftaran -->
</form>
</div>
<style>
    /* styles.css */

/* Reset dasar */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    width: 80%;
    max-width: 600px; /* Maksimal lebar kontainer */
    margin: auto;
    padding: 20px;
    background-color: white; /* Latar belakang putih */
    border-radius: 8px; /* Sudut membulat */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan halus */
}

h1 {
    text-align: center;
    color: #333; /* Warna teks judul */
}

label {
    display: block; /* Memastikan label berada di atas input */
    margin-bottom: 5px; /* Jarak antara label dan input */
}

input[type="text"],
input[type="password"],
input[type="file"] {
    width: calc(100% - 20px); /* Lebar input penuh dengan margin */
    padding: 10px; /* Jarak dalam input */
    margin-bottom: 15px; /* Jarak antara input */
    border: 1px solid #ccc; /* Batas abu-abu */
    border-radius: 4px; /* Sudut membulat pada input */
}

button {
    width: 100%; /* Tombol penuh lebar */
    padding: 10px;
    background-color: #007bff; /* Warna biru tombol */
    color: white; /* Warna teks tombol */
    border: none; /* Menghapus batas tombol */
    border-radius: 4px; /* Sudut membulat pada tombol */
    cursor: pointer; /* Menunjukkan bahwa tombol dapat diklik */
}

button:hover {
    background-color: #0056b3; /* Warna biru lebih gelap saat hover */
}

p {
    text-align: center;
}

</style>
<?php include '../includes/footer.php'; ?>