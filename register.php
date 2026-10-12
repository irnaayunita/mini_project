<?php
session_start();
require_once "config/koneksi.php";

$error = '';
$success = '';

if (isset($_POST['register'])) {
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $password     = $_POST['password'];
    $role         = 'user'; // Otomatis di-set sebagai user

    // Validasi Username hanya boleh huruf (tanpa spasi/angka)
    if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        $error = "Username harus diisi dengan huruf saja tanpa spasi atau angka!";
    } 
    // Validasi Nama lengkap hanya boleh huruf dan spasi
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama_lengkap)) {
        $error = "Nama lengkap harus diisi dengan huruf dan spasi!";
    } 
    // Validasi Password harus lebih dari 5 huruf/karakter (minimal 6 karakter)
    elseif (strlen($password) <= 5) {
        $error = "Password harus lebih dari 5 karakter!";
    } else {
        $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($cek_user) > 0) {
            $error = "Username sudah digunakan, silakan pilih yang lain!";
        } else {
            $query = "INSERT INTO users (username, nama_lengkap, password, role) VALUES ('$username', '$nama_lengkap', '$password', '$role')";
            if (mysqli_query($koneksi, $query)) {
                $success = "Registrasi berhasil! Silakan masuk.";
            } else {
                $error = "Registrasi gagal, silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kurikulum</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Load Custom CSS dari Assets -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="glass-card">
        <!-- Banner Left -->
        <div class="banner-side">
            <div class="brand-logo">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>KURIKULUM SMKN 1 MAJA</span>
            </div>
            <div class="banner-content">
                <h1>Platform Digital Pengelolaan Kurikulum</h1>
                <p>Akses cepat dan aman untuk data guru, data mapel, dan pengolahan data akademis sekolah.</p>
                
                <div class="feature-badge" style="background: rgba(255, 255, 255, 0.1); padding: 8px 12px; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; margin-top: 15px; color: #ffffff; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-shield-check" style="color: #60a5fa;"></i>
                    Sistem Multi-User
                </div>
            </div>
            <div class="banner-footer" style="font-size: 12px; color: #94a3b8;">
                &copy; Akses Kurikulum
            </div>
        </div>

        <!-- Form Right -->
        <div class="form-side">
            <div class="form-header">
                <h2>Buat Akun</h2>
                <p>Silakan isi data diri Anda untuk mendaftar</p>
            </div>

            <?php if (!empty($error)) : ?>
                <div class="alert-error" style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= $error; ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)) : ?>
                <div style="background-color: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= $success; ?> <a href="login.php" style="color: #047857; text-decoration: underline; font-weight: 700;">Masuk di sini</a></span>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-box">
                        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autocomplete="off">
                        <i class="fa-solid fa-user icon-left"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <div class="input-box">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required autocomplete="off">
                        <i class="fa-solid fa-id-card icon-left"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class="fa-solid fa-lock icon-left"></i>
                        <i class="fa-solid fa-eye toggle-password" id="toggleEye" onclick="togglePassword()"></i>
                    </div>
                </div>

                <button type="submit" name="register" class="btn-login" style="margin-top: 10px;">
                    <span>Daftar</span>
                    <i class="fa-solid fa-user-plus"></i>
                </button>

                <div style="text-align: center; margin-top: 16px; font-size: 13px; color: var(--text-muted);">
                    Sudah punya akun? <a href="login.php" style="color: var(--navy-primary); font-weight: 700; text-decoration: none;">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Load Custom JS dari Assets -->
    <script src="assets/script.js"></script>
</body>
</html>