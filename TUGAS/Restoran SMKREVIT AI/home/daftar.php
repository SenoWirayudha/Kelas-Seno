<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-user-plus me-2"></i>Registrasi Pelanggan Baru</h3>
                </div>
                <div class="card-body p-5">
                    <?php 
                    if (isset($_POST['simpan'])) {
                        $pelanggan = $_POST['pelanggan'];
                        $alamat = $_POST['alamat'];
                        $telp = $_POST['telp'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $konfirmasi = $_POST['konfirmasi'];
                        
                        if ($konfirmasi === $password) {
                            $sql = "INSERT INTO tblpelanggan VALUES ('','$pelanggan','$alamat','$telp','$email','$password',1)";
                            $db->runSQL($sql);
                            header("location:?f=home&m=info");
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Password dan konfirmasi password tidak sesuai!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                    ?>
                    
                    <form action="" method="post" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="pelanggan" class="form-label">Nama Pelanggan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="pelanggan" id="pelanggan" class="form-control" required placeholder="Nama lengkap">
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi nama pelanggan
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" name="alamat" id="alamat" class="form-control" required placeholder="Alamat lengkap">
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi alamat
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="telp" id="telp" class="form-control" required placeholder="Nomor telepon">
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi nomor telepon
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="Alamat email">
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi email yang valid
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Buat password">
                                </div>
                                <div class="invalid-feedback">
                                    Harap buat password
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="konfirmasi" id="konfirmasi" class="form-control" required placeholder="Ulangi password">
                                </div>
                                <div class="invalid-feedback">
                                    Harap konfirmasi password
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="simpan" value="simpan" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted">Sudah punya akun? <a href="?f=home&m=login" class="text-primary">Login disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation script
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>