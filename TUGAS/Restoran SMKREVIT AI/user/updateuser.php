<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbluser WHERE iduser=$id";
        $row = $db->getITEM($sql);
    }
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0"><i class="fas fa-user-edit me-2"></i>Update User</h3>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                        <div class="mb-3 w-50">
                            <label for="user" class="form-label">Nama User</label>
                            <input type="text" name="user" id="user" required 
                                   value="<?php echo htmlspecialchars($row['user'] ?? '') ?>" 
                                   class="form-control">
                        </div>
                        
                        <div class="mb-3 w-50">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" required 
                                   value="<?php echo htmlspecialchars($row['email'] ?? '') ?>" 
                                   class="form-control">
                        </div>
                        
                        <div class="mb-3 w-50">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" required 
                                   value="<?php echo htmlspecialchars($row['password'] ?? '') ?>" 
                                   class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah</small>
                        </div>
                        
                        <div class="mb-3 w-50">
                            <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" id="konfirmasi" required 
                                   value="<?php echo htmlspecialchars($row['password'] ?? '') ?>" 
                                   class="form-control">
                        </div>
                        
                        <div class="mb-3 w-50">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-select">
                                <option value="admin" <?= ($row['level'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="koki" <?= ($row['level'] ?? '') === 'koki' ? 'selected' : '' ?>>Koki</option>
                                <option value="kasir" <?= ($row['level'] ?? '') === 'kasir' ? 'selected' : '' ?>>Kasir</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="?f=user&m=select" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $user = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];
        $level = $_POST['level'];
        
        if ($konfirmasi === $password) {
            $sql = "UPDATE tbluser SET user='$user', email='$email', password='$password', level='$level' WHERE iduser=$id";
            $db->runSQL($sql);
            echo "<script>window.location.href='?f=user&m=select';</script>";
        } else {
            echo '<div class="alert alert-danger mt-3">Password tidak sesuai!</div>';
        }
    }
?>