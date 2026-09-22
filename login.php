<?php
session_start();
require_once "config/koneksi.php";

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'] ?? '';

    if (empty($role)) {
        $error = "Pilih hak akses terlebih dahulu!";
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
                <span>Kurikulum</span>
            </div>
            <div class="banner-content">
                <h1>Platform Digital Pengelolaan Kurikulum</h1>
                <p>Akses cepat dan aman untuk data guru, data mapel, dan pengolahan data akademis sekolah.</p>
                
                <div class="feature-badge">
                    <i class="fa-solid fa-shield-check" style="color: #4ade80;"></i>
                    Sistem Multi-User
                </div>
            </div>
            <div class="banner-footer">
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
                <div class="alert-error">
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
                            <option value="admin">Admin </option>
                            <option value="user">User </option>
                        </select>
                        <i class="fa-solid fa-user-shield icon-left"></i>
                        <i class="fa-solid fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login">
                    <span>Masuk</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Load Custom JS dari Assets -->
    <script src="assets/script.js"></script>
</body>
</html>