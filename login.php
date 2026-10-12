<?php
session_start();
require_once "config/koneksi.php";

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'] ?? '';

    // Validasi Hak akses wajib dipilih
    if (empty($role)) {
        $error = "Pilih hak akses terlebih dahulu!";
    } 
    // Validasi Username hanya boleh berisi huruf
    elseif (!preg_match("/^[a-zA-Z]+$/", $username)) {
        $error = "Username harus diisi dengan huruf saja tanpa spasi atau angka!";
    } 
    // Validasi Password harus lebih dari 5 karakter
    elseif (strlen($password) <= 5) {
        $error = "Password harus lebih dari 5 karakter!";
    } else {
        $query  = "SELECT * FROM users WHERE username = '$username' AND role = '$role'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($password === $row['password']) {
                $_SESSION['login']        = true;
                $_SESSION['id_user']      = $row['id_user'];
                $_SESSION['username']     = $row['username'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['role']         = $row['role'];

                if ($row['role'] === 'admin') {
                    header("Location: index.php");
                    exit;
                } else if ($row['role'] === 'user') {
                    header("Location: index.php");
                    exit;
                }
            } else {
                $error = "Password yang Anda masukkan salah!";
            }
        } else {
            $error = "Username atau Hak Akses tidak cocok!";
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
                <h2>Selamat Datang</h2>
                <p>Silakan masuk ke akun Anda untuk memulai</p>
            </div>

            <?php if (!empty($error)) : ?>
                <div class="alert-error" style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= $error; ?></span>
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
                    <label for="password">Password</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class="fa-solid fa-lock icon-left"></i>
                        <i class="fa-solid fa-eye toggle-password" id="toggleEye" onclick="togglePassword()"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Hak Akses</label>
                    <div class="input-box">
                        <select id="role" name="role" required>
                            <option value="" disabled selected>-- Pilih Akses --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <i class="fa-solid fa-user-shield icon-left"></i>
                        <i class="fa-solid fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login" style="margin-top: 10px;">
                    <span>Masuk</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

                <div style="text-align: center; margin-top: 16px; font-size: 13px; color: var(--text-muted);">
                    Belum punya akun? <a href="register.php" style="color: var(--navy-primary); font-weight: 700; text-decoration: none;">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Load Custom JS dari Assets -->
    <script src="assets/script.js"></script>
</body>
</html>