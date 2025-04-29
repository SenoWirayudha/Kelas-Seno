<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil informasi pengguna dari database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Proses mengganti username
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $newUsername = trim($_POST['username']);

    if (!empty($newUsername)) {
        // Cek apakah username sudah ada
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$newUsername, $_SESSION['user_id']]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            // Perbarui username di database
            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->execute([$newUsername, $_SESSION['user_id']]);
            $message = "Username berhasil diperbarui!";
        }
    } else {
        $error = "Username tidak boleh kosong.";
    }
}



// Proses pemotongan gambar
// Load gambar berdasarkan ekstensi file
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crop'])) {
    $data = json_decode($_POST['crop'], true);
    $imagePath = $_POST['image_path'];

    // Validasi apakah $imagePath ada dan file gambar benar-benar ada
    if (empty($imagePath) || !file_exists($imagePath)) {
        $error = "File gambar tidak ditemukan.";
        $uploadOk = 0;
    } else {
        // Proses pemotongan gambar
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        switch ($imageFileType) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'gif':
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                $error = "Format gambar tidak didukung.";
                $uploadOk = 0;
                break;
        }

        if ($uploadOk == 1 && $image) {
            $croppedImage = imagecrop($image, [
                'x' => $data['x'],
                'y' => $data['y'],
                'width' => $data['width'],
                'height' => $data['height']
            ]);

            if ($croppedImage !== FALSE) {
                $newFileName = uniqid() . '.' . $imageFileType;
                $targetDir = "../uploads/";
                $saveFunction = "image" . ($imageFileType === 'png' ? 'png' : 'jpeg');
                $saveFunction($croppedImage, $targetDir . $newFileName, $imageFileType === 'png' ? null : 100);

                imagedestroy($croppedImage);

                // Simpan path gambar ke database
                $stmt = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
                $stmt->execute([$newFileName, $_SESSION['user_id']]);

                // Redirect ke halaman yang sama untuk refresh
                header("Location: profile.php");
                exit();
            }
        }
    }
}

// Proses unggah foto profil
$imagePath = null; // Inisialisasi variabel untuk menyimpan path gambar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES['profile_picture']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah ada kesalahan saat mengupload
    if ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
        $error = "Terjadi kesalahan saat mengupload file.";
        $uploadOk = 0;
    }

    // Cek apakah file gambar adalah gambar sebenarnya
    if (!empty($_FILES['profile_picture']['tmp_name']) && getimagesize($_FILES['profile_picture']['tmp_name']) === false) {
        $error = "File yang diupload bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES['profile_picture']['size'] > 10000000) { // 10MB
        $error = "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Cek format file
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $error = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Jika semua cek lulus, coba untuk mengupload file
    if ($uploadOk == 1) {
        // Simpan file sementara untuk pemotongan
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            // Tampilkan gambar untuk pemotongan
            $imagePath = $targetFile; // Path gambar yang diupload
        } else {
            $error = "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}


// Ambil riwayat pesanan pengguna
$stmt = $pdo->prepare("SELECT o.*, od.product_id, od.quantity, od.price, p.title 
                        FROM orders o 
                        JOIN order_details od ON o.id = od.order_id 
                        JOIN products p ON od.product_id = p.id 
                        WHERE o.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();

// Proses pengiriman ulasan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review'])) {
    $productId = $_POST['product_id'];
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    // Validasi input
    if ($rating < 1 || $rating > 5) {
        $error = "Rating harus antara 1 dan 5.";
    } elseif (empty($comment)) {
        $error = "Komentar tidak boleh kosong.";
    } else {
        // Simpan ulasan ke database
        $stmt = $pdo->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$productId, $_SESSION['user_id'], $rating, $comment]);

        // Update total rating dan jumlah rating di tabel products
        $stmt = $pdo->prepare("UPDATE products SET total_rating = total_rating + ?, rating_count = rating_count + 1 WHERE id = ?");
        $stmt->execute([$rating, $productId]);

        $message = "Ulasan berhasil ditambahkan!";
    }
}

// Proses pembatalan pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_order'])) {
    $orderId = $_POST['order_id'];

    // Hapus data terkait di order_details terlebih dahulu
    $stmt = $pdo->prepare("DELETE FROM order_details WHERE order_id = ?");
    $stmt->execute([$orderId]);

    // Hapus pesanan dari tabel orders
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$orderId, $_SESSION['user_id']]);

    $message = "Pesanan berhasil dibatalkan!";
}


// Proses memperbarui ulasan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_review'])) {
    $reviewId = $_POST['review_id'];
    $rating = $_POST['rating'];
    $comment = trim($_POST['comment']);

    // Validasi input
    if ($rating < 1 || $rating > 5) {
        $error = "Rating harus antara 1 dan 5.";
    } elseif (empty($comment)) {
        $error = "Komentar tidak boleh kosong.";
    } else {
        // Perbarui ulasan di database
        $stmt = $pdo->prepare("UPDATE reviews SET rating = ?, comment = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$rating, $comment, $reviewId, $_SESSION['user_id']]);

        $message = "Ulasan berhasil diperbarui!";
    }
}

?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<style>
    .profile-picture {
        width: 150px; /* Atur lebar gambar */
        height: 150px; /* Atur tinggi gambar */
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
        border-radius: 50%; /* Membuat gambar menjadi bulat */
        border: 2px solid #ccc; /* Tambahkan border jika diinginkan */
    }
    #preview {
        width: 100%; /* Atur lebar preview */
        height: auto; /* Tinggi otomatis */
    }
</style>

<div class="container">
    <h2>Profil Pengguna</h2>
    <?php if (isset($message)) { echo "<div class='alert alert-success'>$message</div>"; } ?>
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    
    <!-- Form untuk mengganti username -->
    <form id="usernameForm" action="profile.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="usernameInput" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <button type="submit">Ubah Username</button>
        </div>
    </form>

    <!-- Form untuk mengunggah foto profil -->
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="profile_picture">Unggah Foto Profil:</label>
            <input type="file" name="profile_picture" accept="image/*" required>
            <button type="submit">Unggah</button>
        </div>
    </form>
    
    <?php if ($imagePath): ?>
    
        <h3>Pemotongan Gambar</h3>
        <img id="imageToCrop" src="<?php echo htmlspecialchars($imagePath); ?>" alt="Preview" />
        <button id="cropButton">Potong Gambar</button>
        <input type="hidden" id="cropData" name="crop" />

    <?php endif; ?>

    <h3>Gambar Profil</h3>
    <?php if (!empty($user['profile_picture'])): ?>
        <img class="profile-picture" src="../uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Gambar Profil" />
    <?php else: ?>
        <p>Tidak ada gambar profil yang tersedia.</p>
    <?php endif; ?>

    <h3>Riwayat Pesanan</h3>
    <?php if (count($orders) > 0): ?>
        <table style="margin: 60px;">
            <thead>
                <tr>
                    <th>Tanggal Pesanan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Metode Pembayaran</th>
                    <th>Ulasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['created_at']) ?></td>
                        <td><?= htmlspecialchars($order['title']) ?></td>
                        <td><?= htmlspecialchars($order['quantity']) ?></td>
                        <td>Rp <?= number_format($order['price'], 2, ',', '.') ?></td>
                        <td>Rp <?= number_format($order['total'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($order['payment_method']) ?></td>
                        <td>
                            <form action="" method="POST">
                                <label for="rating">Rating:</label>
                                <select name="rating" id="rating" required>
                                    <option value="">Pilih Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <br>
                                <label for="comment">Komentar:</label>
                                <textarea name="comment" id="comment" required></textarea>
                                <br>
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($order['product_id']) ?>">
                                <input type="submit" name="review" value="Kirim Ulasan" class="btn">
                            </form>                        
                        </td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                                <input type="submit" name="cancel_order" value="Hapus" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin mengahapus pesanan ini?');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada riwayat pesanan.</p>
    <?php endif; ?>

    <h3>Ulasan yang Dikirim</h3>
<?php
// Ambil ulasan yang sudah ada untuk pengguna
$stmt = $pdo->prepare("SELECT r.*, p.title FROM reviews r JOIN products p ON r.product_id = p.id WHERE r.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$reviews = $stmt->fetchAll();
?>
<?php if (count($reviews) > 0): ?>
    <ul>
        <?php foreach ($reviews as $review): ?>
            <li>
                <strong><?= htmlspecialchars($review['title']) ?> (Rating: <?= htmlspecialchars($review['rating']) ?>)</strong>
                <p><?= htmlspecialchars($review['comment']) ?></p>
                <form action="profile.php" method="POST">
                    <input type="hidden" name="review_id" value="<?= htmlspecialchars($review['id']) ?>">
                    <input type="submit" name="edit_review" value="Edit Ulasan" class="btn btn-primary">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada ulasan yang telah dikirim.</p>
<?php endif; ?>
<?php
// Proses menampilkan formulir edit jika pengguna mengklik "Edit Ulasan"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_review'])) {
    $reviewId = $_POST['review_id'];

    // Ambil data ulasan yang ada
    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE id = ? AND user_id = ?");
    $stmt->execute([$reviewId, $_SESSION['user_id']]);
    $review = $stmt->fetch();

    if ($review) {
        ?>
        <h3>Edit Ulasan</h3>
        <form action="profile.php" method="POST">
            <div>
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" required>
                    <option value="1" <?= $review['rating'] == 1 ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= $review['rating'] == 2 ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= $review['rating'] == 3 ? 'selected' : '' ?>>3</option>
                    <option value="4" <?= $review['rating'] == 4 ? 'selected' : '' ?>>4</option>
                    <option value="5" <?= $review['rating'] == 5 ? 'selected' : '' ?>>5</option>
                </select>
            </div>
            <div>
                <label for="comment">Komentar:</label>
                <textarea name="comment" id="comment" required><?= htmlspecialchars($review['comment']) ?></textarea>
            </div>
            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
            <button type="submit" name="update_review">Perbarui Ulasan</button>
        </form>
        <?php
    } else {
        echo "<p>Ulasan tidak ditemukan.</p>";
    }
}
?>

</div>

<script>
    let cropper;
    const image = document.getElementById('imageToCrop');

    image.onload = function() {
        cropper = new Cropper(image, {
            aspectRatio: 1, // Mengunci rasio aspek menjadi 1:1
            viewMode: 1, // Hanya memperbolehkan pemotongan dalam area gambar yang terlihat
            crop(event) {
                // Ambil data pemotongan
                const cropData = {
                    x: event.detail.x,
                    y: event.detail.y,
                    width: event.detail.width,
                    height: event.detail.height
                };
                document.getElementById('cropData').value = JSON.stringify(cropData); // Menyimpan data pemotongan ke input tersembunyi
            },
        });
    };

    document.getElementById('cropButton').addEventListener('click', function() {
        // Ambil data crop
        const cropData = document.getElementById('cropData').value;
        
        // Pastikan cropData tidak kosong
        if (cropData) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'profile.php';

            const cropInput = document.createElement('input');
            cropInput.type = 'hidden';
            cropInput.name = 'crop';
            cropInput.value = cropData; // Kirim data crop

            const imagePathInput = document.createElement('input');
            imagePathInput.type = 'hidden';
            imagePathInput.name = 'image_path';
            imagePathInput.value = document.getElementById('imageToCrop').src; // Kirim path gambar

            form.appendChild(cropInput);
            form.appendChild(imagePathInput);
            document.body.appendChild(form);
            form.submit();
        } else {
            alert("Silakan pilih area gambar untuk dipotong.");
        }
    });
</script>

<?php include '../includes/footer.php'; ?>