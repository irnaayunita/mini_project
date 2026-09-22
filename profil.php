<?php
session_start();
include "config/koneksi.php";

// Validasi Keamanan Session Login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data profil dari database (mengambil data pertama/terbaru)
$query  = "SELECT * FROM profil";
$result = mysqli_query($koneksi, $query);
$profil = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Portal Kurikulum</title>
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
            <a href="login.php" class="btn-logout">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Container Utama -->
    <div class="container">
        <div class="admin-card">
            
            <!-- Header Profil -->
            <div class="admin-header">
                <div class="admin-avatar">
                    <i class=""></i>
                </div>
            </div>

            <!-- Detail Informasi Profil -->
            <div class="admin-info">
                <h2><?= htmlspecialchars($profil['nama_admin'] ?? 'Data Belum Diisi'); ?></h2>
                <span class="badge-role">Administrator</span>
            </div>

            <div class="profile-details">
                <div class="detail-item">
                    <i class="fa-solid fa-id-badge"></i>
                    <div>
                        <label>ID Admin</label>
                        <p><?= htmlspecialchars($profil['id'] ?? '-'); ?></p>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <div>
                        <label>Kelas </label>
                        <p><?= htmlspecialchars($profil['kelas'] ?? '-'); ?></p>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>
                        <label>Alamat</label>
                        <p><?= htmlspecialchars($profil['alamat'] ?? '-'); ?></p>
                    </div>
                </div>
            </div>

            <div class="btn-container" style="justify-content: center; margin-top: 25px;">
                <a href="index.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

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