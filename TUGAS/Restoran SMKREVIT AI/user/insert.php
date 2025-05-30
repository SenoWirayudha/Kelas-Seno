<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0"><i class="fas fa-user-plus me-2"></i>Insert User</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3 w-50">
                    <label for="user" class="form-label fw-bold">Nama User</label>
                    <input type="text" name="user" id="user" required 
                           placeholder="Masukkan nama user" 
                           class="form-control">
                </div>
                
                <div class="mb-3 w-50">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" required 
                           placeholder="Masukkan email" 
                           class="form-control">
                </div>
                
                <div class="mb-3 w-50">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" name="password" id="password" required 
                           placeholder="Masukkan password" 
                           class="form-control">
                    <div class="form-text">Minimal 8 karakter</div>
                </div>
                
                <div class="mb-3 w-50">
                    <label for="konfirmasi" class="form-label fw-bold">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi" id="konfirmasi" required 
                           placeholder="Konfirmasi password" 
                           class="form-control">
                </div>
                
                <div class="mb-3 w-50">
                    <label for="level" class="form-label fw-bold">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="koki">Koki</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="?f=user&m=select" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>

            <?php 
                if (isset($_POST['simpan'])) {
                    $user = $_POST['user'];
                    $email = $_POST['email'];
                    $password = hash('sha256', $_POST['password']);
                    $konfirmasi = hash('sha256', $_POST['konfirmasi']);
                    $level = $_POST['level'];
                    
                    if ($konfirmasi === $password) {
                        $sql = "INSERT INTO tbluser VALUES ('', '$user', '$email', '$password', '$level', 1)";
                        $db->runSQL($sql);
                        echo "<script>window.location.href='?f=user&m=select';</script>";
                    } else {
                        echo '<div class="alert alert-danger mt-3">Password tidak sesuai!</div>';
                    }
                }
            ?>
        </div>
    </div>
</div>
