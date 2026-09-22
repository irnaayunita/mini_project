<?php
session_start();

// Validasi Keamanan Session Login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil variabel dari session
$id_user      = $_SESSION['id_user'];
$username     = $_SESSION['username'];
$nama_lengkap = $_SESSION['nama_lengkap'];
$role         = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Portal Kurikulum</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Style CSS Eksternal -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

 <!-- Navigation Bar -->
<nav class="navbar">
    <div class="brand-logo">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Kurikulum</span>
    </div>

    <div class="user-profile">
        <div class="profile-info">
            <span class="name"><?= htmlspecialchars($nama_lengkap); ?></span>
            <span class="role-badge <?= $role === 'admin' ? 'badge-admin' : 'badge-user'; ?>">
                <?= htmlspecialchars($role); ?>
            </span>
        </div>
        <a href="logout.php" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Keluar</span>
        </a>
    </div>
</nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Banner Ucapan Selamat Datang -->
        <div class="welcome-hero">
            <h1>Selamat Datang, <?= htmlspecialchars($nama_lengkap); ?> 👋</h1>
            <p>Anda masuk sebagai <strong><?= ucfirst($role); ?></strong>. Panel navigasi di bawah ini untuk mengakses sistem kurikulum.</p>
        </div>

        <div class="section-title">
            <i class="fa-solid fa-grid-2" style="color: #6366f1;"></i>
            <span>Menu Navigasi Utama</span>
        </div>

        <!-- Grid Menu Sesuai Hak Akses Role -->
        <div class="menu-grid">
            
            <div class="menu-grid">
    
    <?php if (isset($role) && $role === 'admin') : ?>
        <!-- FITUR KHUSUS ADMIN -->
        
        <!-- 1. KARTU PROFIL ADMIN (Menggantikan Dashboard Utama) -->
        <a href="profil.php" class="menu-card">
            <div>
                <div class="card-icon icon-purple">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h3>Profil Admin</h3>
                <p>Lihat detail identitas pengelola</p>
            </div>
            <div class="card-action">
                <span>Lihat Profil</span>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </a>

                <a href="tambah_guru.php" class="menu-card">
                    <div>
                        <div class="card-icon icon-blue">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <h3>Kelola Data Guru</h3>
                        <p>Tambah data guru pengajar, ubah profil akademis, atau perbarui informasi staf.</p>
                    </div>
                    <div class="card-action">
                        <span>Kelola Data</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>

                <a href="tambah_mapel.php" class="menu-card">
                    <div>
                        <div class="card-icon icon-blue">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <h3>Kelola Data Mata Pelajaran</h3>
                        <p>Tambah data mata pelajaran, ubah profil akademis, atau perbarui informasi staf.</p>
                    </div>
                    <div class="card-action">
                        <span>Kelola Data</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>


        <?php else : ?>
        <!-- FITUR KHUSUS USER  -->
        
                <a href="tampil_guru.php" class="menu-card">
                    <div>
                        <div class="card-icon icon-blue">
                            <i class="fa-solid fa-users-viewfinder"></i>
                        </div>
                        <h3>Daftar Guru</h3>
                        <p>Lihat daftar lengkap seluruh guru.</p>
                    </div>
                    <div class="card-action">
                        <span>Lihat Informasi</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>

                <a href="tampil_mapel.php" class="menu-card">
                    <div>
                        <div class="card-icon icon-blue">
                            <i class="fa-solid fa-users-viewfinder"></i>
                        </div>
                        <h3>Daftar Mata Pelajaran</h3>
                        <p>Lihat daftar lengkap seluruh mata pelajaran yang tersedia.</p>
                    </div>
                    <div class="card-action">
                        <span>Lihat Informasi</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>

            <?php endif; ?>

            </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; <?= date('Y'); ?> Akses Sistem Informasi Kurikulum.
    </footer>

    <!-- Script JS Eksternal -->
    <script src="assets/script.js"></script>
</body>
</html>