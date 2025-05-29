<?php
/**
 * CONTOH KODE PHP
 * File ini berisi contoh-contoh kode PHP untuk berbagai konsep dasar
 */

// Menampilkan header
echo "<h1>CONTOH KODE PHP</h1>";

// 1. VARIABEL DAN TIPE DATA
echo "<h2>1. Variabel dan Tipe Data</h2>";

// String
$nama = "Budi Santoso";
// Integer
$umur = 25;
// Float
$tinggi = 175.5;
// Boolean
$aktif = true;

echo "Nama: $nama <br>";
echo "Umur: $umur tahun<br>";
echo "Tinggi: $tinggi cm<br>";
echo "Status: " . ($aktif ? "Aktif" : "Tidak Aktif") . "<br><br>";

// 2. OPERATOR
echo "<h2>2. Operator</h2>";

// Operator Aritmatika
$a = 10;
$b = 3;

echo "a = $a, b = $b <br>";
echo "a + b = " . ($a + $b) . "<br>";
echo "a - b = " . ($a - $b) . "<br>";
echo "a * b = " . ($a * $b) . "<br>";
echo "a / b = " . ($a / $b) . "<br>";
echo "a % b = " . ($a % $b) . "<br>";
echo "a ** b = " . ($a ** $b) . "<br><br>";

// Operator Perbandingan
echo "a == b: " . ($a == $b ? "true" : "false") . "<br>";
echo "a != b: " . ($a != $b ? "true" : "false") . "<br>";
echo "a > b: " . ($a > $b ? "true" : "false") . "<br>";
echo "a < b: " . ($a < $b ? "true" : "false") . "<br><br>";

// Operator Logika
$c = true;
$d = false;

echo "c = " . ($c ? "true" : "false") . ", d = " . ($d ? "true" : "false") . "<br>";
echo "c && d: " . (($c && $d) ? "true" : "false") . "<br>";
echo "c || d: " . (($c || $d) ? "true" : "false") . "<br>";
echo "!c: " . (!$c ? "true" : "false") . "<br><br>";

// 3. STRUKTUR KONTROL
echo "<h2>3. Struktur Kontrol</h2>";

// If-Else
echo "<h3>If-Else</h3>";
$nilai = 75;

echo "Nilai: $nilai<br>";
if ($nilai >= 80) {
    echo "Nilai A<br>";
} elseif ($nilai >= 70) {
    echo "Nilai B<br>";
} elseif ($nilai >= 60) {
    echo "Nilai C<br>";
} else {
    echo "Nilai D<br>";
}
echo "<br>";

// Switch Case
echo "<h3>Switch Case</h3>";
$hari = "Senin";

echo "Hari: $hari<br>";
switch ($hari) {
    case "Senin":
        echo "Hari pertama dalam seminggu<br>";
        break;
    case "Selasa":
        echo "Hari kedua dalam seminggu<br>";
        break;
    case "Rabu":
        echo "Hari ketiga dalam seminggu<br>";
        break;
    default:
        echo "Hari lainnya<br>";
}
echo "<br>";

// For Loop
echo "<h3>For Loop</h3>";
for ($i = 1; $i <= 5; $i++) {
    echo "Perulangan ke-$i<br>";
}
echo "<br>";

// While Loop
echo "<h3>While Loop</h3>";
$j = 1;
while ($j <= 5) {
    echo "While ke-$j<br>";
    $j++;
}
echo "<br>";

// Do-While Loop
echo "<h3>Do-While Loop</h3>";
$k = 1;
do {
    echo "Do-While ke-$k<br>";
    $k++;
} while ($k <= 5);
echo "<br>";

// 4. ARRAY
echo "<h2>4. Array</h2>";

// Array Numerik
echo "<h3>Array Numerik</h3>";
$buah = ["Apel", "Jeruk", "Mangga", "Pisang"];
echo "Buah[0]: " . $buah[0] . "<br>";
echo "Buah[1]: " . $buah[1] . "<br>";
echo "Jumlah buah: " . count($buah) . "<br><br>";

// Array Asosiatif
echo "<h3>Array Asosiatif</h3>";
$mahasiswa = [
    "nim" => "12345",
    "nama" => "Andi",
    "jurusan" => "Teknik Informatika",
    "ipk" => 3.75
];

echo "NIM: " . $mahasiswa["nim"] . "<br>";
echo "Nama: " . $mahasiswa["nama"] . "<br>";
echo "Jurusan: " . $mahasiswa["jurusan"] . "<br>";
echo "IPK: " . $mahasiswa["ipk"] . "<br><br>";

// Array Multidimensi
echo "<h3>Array Multidimensi</h3>";
$nilai_siswa = [
    ["Andi", 85, 90, 78],
    ["Budi", 80, 85, 83],
    ["Citra", 90, 95, 88]
];

echo "<table border='1'>";
echo "<tr><th>Nama</th><th>Matematika</th><th>Bahasa Inggris</th><th>IPA</th></tr>";

foreach ($nilai_siswa as $siswa) {
    echo "<tr>";
    foreach ($siswa as $nilai) {
        echo "<td>$nilai</td>";
    }
    echo "</tr>";
}

echo "</table><br>";

// Fungsi Array
echo "<h3>Fungsi Array</h3>";
$angka = [5, 3, 8, 1, 9, 2, 7];
echo "Array angka: " . implode(", ", $angka) . "<br>";

sort($angka);
echo "Setelah sort(): " . implode(", ", $angka) . "<br>";

$angka_terbalik = array_reverse($angka);
echo "Setelah array_reverse(): " . implode(", ", $angka_terbalik) . "<br>";

echo "Jumlah elemen: " . count($angka) . "<br>";
echo "Nilai maksimum: " . max($angka) . "<br>";
echo "Nilai minimum: " . min($angka) . "<br><br>";

// 5. FUNGSI
echo "<h2>5. Fungsi</h2>";

// Fungsi tanpa parameter
function sapa() {
    echo "Halo, selamat datang!<br>";
}

echo "<h3>Fungsi tanpa parameter</h3>";
sapa();
echo "<br>";

// Fungsi dengan parameter
function sapaOrang($nama) {
    echo "Halo, $nama!<br>";
}

echo "<h3>Fungsi dengan parameter</h3>";
sapaOrang("Budi");
sapaOrang("Ani");
echo "<br>";

// Fungsi dengan nilai default parameter
function hitungLuas($panjang = 1, $lebar = 1) {
    return $panjang * $lebar;
}

echo "<h3>Fungsi dengan nilai default parameter</h3>";
echo "Luas (5, 3): " . hitungLuas(5, 3) . "<br>";
echo "Luas (4): " . hitungLuas(4) . "<br>";
echo "Luas (): " . hitungLuas() . "<br><br>";

// Fungsi dengan return value
function tambah($a, $b) {
    return $a + $b;
}

echo "<h3>Fungsi dengan return value</h3>";
$hasil = tambah(10, 5);
echo "10 + 5 = $hasil<br><br>";

// 6. FORM HANDLING
echo "<h2>6. Form Handling</h2>";
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h3>Form Pendaftaran</h3>
    Nama: <input type="text" name="nama"><br><br>
    Email: <input type="email" name="email"><br><br>
    Jenis Kelamin:
    <input type="radio" name="gender" value="Laki-laki"> Laki-laki
    <input type="radio" name="gender" value="Perempuan"> Perempuan<br><br>
    Hobi:
    <input type="checkbox" name="hobi[]" value="Membaca"> Membaca
    <input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga
    <input type="checkbox" name="hobi[]" value="Musik"> Musik
    <input type="checkbox" name="hobi[]" value="Traveling"> Traveling<br><br>
    Kota:
    <select name="kota">
        <option value="Jakarta">Jakarta</option>
        <option value="Bandung">Bandung</option>
        <option value="Surabaya">Surabaya</option>
        <option value="Yogyakarta">Yogyakarta</option>
    </select><br><br>
    Pesan: <br>
    <textarea name="pesan" rows="4" cols="30"></textarea><br><br>
    <input type="submit" name="submit" value="Daftar">
</form>

<?php
// Memproses form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    echo "<h3>Data yang dikirim:</h3>";
    
    // Mengambil nilai dari form
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $hobi = isset($_POST['hobi']) ? $_POST['hobi'] : [];
    $kota = isset($_POST['kota']) ? $_POST['kota'] : '';
    $pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';
    
    // Validasi sederhana
    if (empty($nama) || empty($email)) {
        echo "<p style='color:red'>Nama dan email harus diisi!</p>";
    } else {
        echo "Nama: " . htmlspecialchars($nama) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Jenis Kelamin: " . htmlspecialchars($gender) . "<br>";
        
        echo "Hobi: ";
        if (!empty($hobi)) {
            echo implode(", ", array_map('htmlspecialchars', $hobi));
        } else {
            echo "Tidak ada";
        }
        echo "<br>";
        
        echo "Kota: " . htmlspecialchars($kota) . "<br>";
        echo "Pesan: " . nl2br(htmlspecialchars($pesan)) . "<br>";
    }
}

// 7. DATE AND TIME
echo "<h2>7. Date and Time</h2>";

echo "Tanggal sekarang: " . date("d-m-Y") . "<br>";
echo "Waktu sekarang: " . date("H:i:s") . "<br>";
echo "Tanggal dan waktu: " . date("d-m-Y H:i:s") . "<br>";
echo "Hari: " . date("l") . "<br>";
echo "Bulan: " . date("F") . "<br>";
echo "Tahun: " . date("Y") . "<br>";
echo "Timestamp sekarang: " . time() . "<br><br>";

// 8. STRING FUNCTIONS
echo "<h2>8. String Functions</h2>";

$str = "Hello World! Belajar PHP itu menyenangkan.";
echo "String: $str<br>";
echo "Panjang string: " . strlen($str) . "<br>";
echo "Jumlah kata: " . str_word_count($str) . "<br>";
echo "Reverse string: " . strrev($str) . "<br>";
echo "Posisi 'PHP': " . strpos($str, "PHP") . "<br>";
echo "Ganti 'PHP' dengan 'JavaScript': " . str_replace("PHP", "JavaScript", $str) . "<br>";
echo "Uppercase: " . strtoupper($str) . "<br>";
echo "Lowercase: " . strtolower($str) . "<br>";
echo "Substring: " . substr($str, 0, 5) . "<br><br>";

// 9. MATH FUNCTIONS
echo "<h2>9. Math Functions</h2>";

echo "pi(): " . pi() . "<br>";
echo "min(5, 8, 2, 10, 3): " . min(5, 8, 2, 10, 3) . "<br>";
echo "max(5, 8, 2, 10, 3): " . max(5, 8, 2, 10, 3) . "<br>";
echo "abs(-7.5): " . abs(-7.5) . "<br>";
echo "sqrt(64): " . sqrt(64) . "<br>";
echo "round(3.7): " . round(3.7) . "<br>";
echo "round(3.3): " . round(3.3) . "<br>";
echo "rand(1, 10): " . rand(1, 10) . "<br><br>";

// 10. FILE HANDLING
echo "<h2>10. File Handling</h2>";

// Membuat file
$file = "contoh_file.txt";
$content = "Ini adalah contoh file yang dibuat dengan PHP.\nBaris kedua dari file.\nBaris ketiga dari file.";

// Menulis ke file
file_put_contents($file, $content);
echo "File $file berhasil dibuat.<br>";

// Membaca file
echo "<h3>Isi file:</h3>";
echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";

// Membaca file baris per baris
echo "<h3>Membaca file baris per baris:</h3>";
$lines = file($file);
foreach ($lines as $line_num => $line) {
    echo "Baris #<b>" . ($line_num + 1) . "</b> : " . htmlspecialchars($line) . "<br>";
}

// Menambahkan konten ke file
file_put_contents($file, "\nBaris ini ditambahkan kemudian.", FILE_APPEND);
echo "<br>Konten baru telah ditambahkan ke file.<br>";

// Membaca file setelah penambahan
echo "<h3>Isi file setelah penambahan:</h3>";
echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";

// 11. ERROR HANDLING
echo "<h2>11. Error Handling</h2>";
?>

<h3>Try-Catch</h3>
<?php
try {
    // Mencoba membuka file yang tidak ada
    $file_tidak_ada = "file_tidak_ada.txt";
    $content = file_get_contents($file_tidak_ada);
    
    if (!$content) {
        throw new Exception("File tidak dapat dibuka!");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
} finally {
    echo "Blok finally selalu dijalankan<br>";
}
?>

<h3>Custom Error Handler</h3>
<?php
// Fungsi error handler kustom
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Error:</b> [$errno] $errstr - $errfile:$errline<br>";
}

// Set error handler
set_error_handler("customErrorHandler");

// Memicu error (mencoba menggunakan variabel yang tidak didefinisikan)
echo $variabel_tidak_ada;

// Mengembalikan error handler default
restore_error_handler();
?>

<h3>Kembali ke Materi</h3>
<p><a href="pemograman.php">Kembali ke Materi Dasar Pemrograman PHP</a></p>