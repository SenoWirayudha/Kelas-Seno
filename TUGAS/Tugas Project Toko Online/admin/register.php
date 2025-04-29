<?php
// Koneksi ke database
$db = new mysqli('localhost', 'root', '', 'dvd_store');
include '../includes/header.php';

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// Fungsi register
function registerUser($username, $password, $profilePicture) {
    global $db;

    // Validasi data
    if (empty($username) || empty($password)) {
        return "Username dan password harus diisi.";
    }

    // Enkripsi password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Set is_admin default ke 0 (bukan admin)
    $isAdmin = 0;

    // Waktu pendaftaran
    $createAt = date("Y-m-d H:i:s");

    // Query untuk menyimpan data
    $stmt = $db->prepare("INSERT INTO users (username, password, created_at, is_admin, profile_picture) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: (" . $db->errno . ") " . $db->error);
    }

    // Bind parameter
    $stmt->bind_param("sssis", $username, $hashedPassword, $createAt, $isAdmin, $profilePicture);

    if ($stmt->execute()) {
        return "Pendaftaran berhasil!";
    } else {
        return "Pendaftaran gagal: " . $stmt->error;
    }

    $stmt->close();
}

// Contoh penggunaan fungsi registerUser
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Menangani upload gambar profil
    $profilePicture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        // Tentukan direktori untuk menyimpan gambar
        $targetDir = "../uploads/"; // Pastikan folder ini ada dan memiliki izin yang tepat
        $profilePicture = $targetDir . basename($_FILES["profile_picture"]["name"]);
        
        // Pindahkan file ke folder uploads
        if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profilePicture)) {
            echo "Maaf, terjadi kesalahan saat mengunggah gambar.";
            exit;
        }
    }

   echo registerUser($username, $password, $profilePicture);
}

$db->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pendaftaran Pengguna</title>
   <link rel="stylesheet" href="../css/styles.css"> <!-- Link ke file CSS -->
</head>
<body>
   <div class="container">
       <h1>Pendaftaran Pengguna Baru</h1>
       <form action="register.php" method="POST" enctype="multipart/form-data">
           <div>
               <label for="username">Username:</label>
               <input type="text" id="username" name="username" required>
           </div>
           <div>
               <label for="password">Password:</label>
               <input type="password" id="password" name="password" required>
           </div>
           <div>
               <label for="profile_picture">Gambar Profil:</label>
               <input type="file" id="profile_picture" name="profile_picture">
           </div>
           <div>
               <button type="submit">Daftar</button>
           </div>
           <p>Sudah punya akun? <a href="../admin/login.php">Login di sini</a>.</p> <!-- Hyperlink ke halaman pendaftaran -->
       </form>

       <?php
       // Menampilkan pesan pendaftaran jika ada
       if (isset($_GET['message'])) {
           echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
       }
       ?>
   </div>

   <?php include '../includes/footer.php'; ?>
</body>
</html>
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