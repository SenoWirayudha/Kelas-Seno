<?php
/**
 * DASAR PEMROGRAMAN PHP
 * File ini berisi materi dasar pemrograman PHP
 */

// 1. PENGENALAN PHP
$pengenalan = "
PHP (PHP: Hypertext Preprocessor) adalah bahasa pemrograman server-side yang populer
untuk pengembangan web. PHP dapat disisipkan ke dalam HTML dan bekerja dengan
berbagai database seperti MySQL, PostgreSQL, dan lainnya.

Keunggulan PHP:
- Open source dan gratis
- Mudah dipelajari
- Berjalan di berbagai platform (Windows, Linux, Mac)
- Kompatibel dengan hampir semua server web
- Mendukung berbagai database
";

// 2. SINTAKS DASAR PHP
$sintaks = "
Kode PHP ditulis di dalam tag <?php ?>.
Setiap pernyataan PHP diakhiri dengan titik koma (;).
PHP bersifat case-sensitive untuk nama variabel.
";

// 3. VARIABEL DAN TIPE DATA
$variabel = "
Variabel dalam PHP dimulai dengan tanda $ diikuti dengan nama variabel.
PHP adalah bahasa dengan tipe data dinamis.

Tipe data dasar dalam PHP:
- String: Teks atau karakter
- Integer: Bilangan bulat
- Float: Bilangan desimal
- Boolean: Nilai true atau false
- Array: Kumpulan nilai
- Object: Instance dari class
- NULL: Variabel tanpa nilai
- Resource: Referensi ke resource eksternal
";

// 4. OPERATOR
$operator = "
PHP mendukung berbagai jenis operator:

1. Operator Aritmatika: +, -, *, /, %, **
2. Operator Assignment: =, +=, -=, *=, /=, %=
3. Operator Perbandingan: ==, ===, !=, !==, <, >, <=, >=, <=>
4. Operator Logika: &&, ||, !, and, or, xor
5. Operator Increment/Decrement: ++, --
6. Operator String: . (concatenation), .= (concatenation assignment)
7. Operator Array: +, ==, ===, !=, !==
8. Operator Kondisional: ? : (ternary)
";

// 5. STRUKTUR KONTROL
$strukturKontrol = "
PHP mendukung struktur kontrol berikut:

1. Percabangan (Conditional):
   - if, else, elseif
   - switch-case
   - ternary operator

2. Perulangan (Loops):
   - for
   - while
   - do-while
   - foreach (untuk array)
   - break dan continue
";

// 6. ARRAY
$array = "
Array adalah struktur data yang dapat menyimpan beberapa nilai dalam satu variabel.

Jenis array dalam PHP:
1. Array Numerik: Array dengan index numerik
2. Array Asosiatif: Array dengan key berupa string
3. Array Multidimensi: Array di dalam array
";

// 7. FUNGSI
$fungsi = "
Fungsi adalah blok kode yang dapat digunakan kembali.

Jenis fungsi dalam PHP:
1. Fungsi Bawaan (Built-in functions)
2. Fungsi Buatan Pengguna (User-defined functions)
3. Fungsi Anonim (Anonymous functions)
4. Arrow Functions (PHP 7.4+)
";

// 8. FORM HANDLING
$formHandling = "
PHP sering digunakan untuk memproses form HTML.
Data form dapat diakses melalui superglobal variables:
- $_GET: Untuk data yang dikirim melalui URL (method GET)
- $_POST: Untuk data yang dikirim secara tersembunyi (method POST)
- $_REQUEST: Kombinasi dari $_GET, $_POST, dan $_COOKIE
";

// 9. DATABASE
$database = "
PHP dapat terhubung dengan berbagai database, yang paling umum adalah MySQL.
Cara menghubungkan PHP dengan MySQL:
1. MySQLi (object-oriented dan procedural)
2. PDO (PHP Data Objects)
";

// 10. SESSION DAN COOKIES
$sessionCookies = "
Session dan cookies digunakan untuk menyimpan informasi antar halaman.

Session: Menyimpan data di server
- session_start(): Memulai session
- $_SESSION: Menyimpan variabel session
- session_destroy(): Menghapus session

Cookies: Menyimpan data di browser pengguna
- setcookie(): Membuat cookie
- $_COOKIE: Mengakses nilai cookie
";

// 11. INCLUDE DAN REQUIRE
$includeRequire = "
PHP memungkinkan untuk menyertakan file lain ke dalam script:
- include: Menyertakan file (warning jika file tidak ada)
- require: Menyertakan file (fatal error jika file tidak ada)
- include_once: Menyertakan file sekali saja
- require_once: Menyertakan file sekali saja
";

// 12. PENANGANAN FILE
$penangananFile = "
PHP dapat membaca dan menulis file:
- fopen(): Membuka file
- fread(), fgets(): Membaca file
- fwrite(): Menulis ke file
- fclose(): Menutup file
- file_get_contents(): Membaca seluruh isi file
- file_put_contents(): Menulis ke file
";

// 13. PENANGANAN ERROR
$penangananError = "
PHP menyediakan beberapa cara untuk menangani error:
- try-catch: Menangkap exception
- set_error_handler(): Membuat fungsi penanganan error kustom
- error_reporting(): Mengatur level error yang dilaporkan
- ini_set('display_errors'): Mengatur apakah error ditampilkan
";

// 14. NAMESPACE
$namespace = "
Namespace digunakan untuk mengelompokkan kelas, fungsi, dan konstanta
untuk menghindari konflik nama.
";

// 15. OOP (OBJECT ORIENTED PROGRAMMING)
$oop = "
PHP mendukung pemrograman berorientasi objek (OOP) dengan fitur:
- Class dan Object
- Properties dan Methods
- Inheritance (Pewarisan)
- Access Modifiers (public, protected, private)
- Interface dan Abstract Class
- Traits
- Static Methods dan Properties
- Magic Methods (__construct, __destruct, dll)
";

// Menampilkan materi
echo "<h1>DASAR PEMROGRAMAN PHP</h1>";
echo "<h2>1. Pengenalan PHP</h2>";
echo "<pre>$pengenalan</pre>";

echo "<h2>2. Sintaks Dasar PHP</h2>";
echo "<pre>$sintaks</pre>";

echo "<h2>3. Variabel dan Tipe Data</h2>";
echo "<pre>$variabel</pre>";

echo "<h2>4. Operator</h2>";
echo "<pre>$operator</pre>";

echo "<h2>5. Struktur Kontrol</h2>";
echo "<pre>$strukturKontrol</pre>";

echo "<h2>6. Array</h2>";
echo "<pre>$array</pre>";

echo "<h2>7. Fungsi</h2>";
echo "<pre>$fungsi</pre>";

echo "<h2>8. Form Handling</h2>";
echo "<pre>$formHandling</pre>";

echo "<h2>9. Database</h2>";
echo "<pre>$database</pre>";

echo "<h2>10. Session dan Cookies</h2>";
echo "<pre>$sessionCookies</pre>";

echo "<h2>11. Include dan Require</h2>";
echo "<pre>$includeRequire</pre>";

echo "<h2>12. Penanganan File</h2>";
echo "<pre>$penangananFile</pre>";

echo "<h2>13. Penanganan Error</h2>";
echo "<pre>$penangananError</pre>";

echo "<h2>14. Namespace</h2>";
echo "<pre>$namespace</pre>";

echo "<h2>15. OOP (Object Oriented Programming)</h2>";
echo "<pre>$oop</pre>";
?>