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
    <!-- Masukkan ini di dalam tag <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="logout.php" onclick="confirmLogout()" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Keluar
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

        <?php if (isset($role) && $role !== 'admin') : ?>
        <!-- PENJELASAN KURIKULUM, MODUL AJAR, PKL, DAN PKK (KHUSUS USER) -->
        <div class="section-title">
            <i class="fa-solid fa-book-open-reader" style="color: #6366f1;"></i>
            <span>Informasi Kurikulum & Program Unggulan SMK</span>
        </div>

        <!-- Penjelasan Kurikulum SMK -->
        <div class="kurikulum-box">
            <h3><i class="fa-solid fa-school"></i> Implementasi Kurikulum Merdeka di SMK</h3>
            <p>
                Kurikulum Merdeka di Sekolah Menengah Kejuruan (SMK) dirancang secara khusus untuk memperkuat keterkaitan dan kesepadanan (<em>Link and Match</em>) antara dunia pendidikan vokasi dengan Dunia Usaha, Dunia Industri, dan Dunia Kerja (DUDIKA). Kurikulum ini menekankan pada fleksibilitas pembelajaran, penguatan kompetensi teknis (<em>hard skills</em>), pembentukan karakter dan etika kerja (<em>soft skills</em>), serta pembiasaan Profil Pelajar Pancasila agar peserta didik siap kerja, melanjutkan studi, maupun berwirausaha.
            </p>
        </div>

        <!-- Cards Penjelasan Detail Modul Ajar, PKL, dan PKK -->
        <div class="menu-grid" style="margin-bottom: 35px;">
            <!-- Modul Ajar -->
            <div class="menu-card" style="cursor: default;">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h3>Modul Ajar Pembelajaran</h3>
                    <p>
                        Modul Ajar merupakan dokumen perencanaan pembelajaran komprehensif yang disusun berdasarkan Capaian Pembelajaran (CP) dan Alur Tujuan Pembelajaran (ATP). Di SMK, Modul Ajar berfungsi sebagai panduan operasional bagi guru dan siswa yang mencakup:
                    </p>
                </div>
            </div>

            <!-- PKL -->
            <div class="menu-card" style="cursor: default;">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h3>Praktik Kerja Lapangan (PKL)</h3>
                    <p>
                        Praktik Kerja Lapangan merupakan mata pelajaran wajib kelompok keahlian yang dilaksanakan secara langsung di DUDI mitra. PKL bertujuan memberikan pengalaman kerja nyata serta internalisasi budaya industri bagi siswa SMK melalui:
                    </p>
                </div>
            </div>

            <!-- PKK -->
            <div class="menu-card" style="cursor: default;">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <h3>Projek Kreatif & Kewirausahaan (PKK)</h3>
                    <p>
                        Mata pelajaran PKK dirancang untuk melatih dan menumbuhkan jiwa kewirausahaan (<em>entrepreneurship</em>) siswa melalui proses pembuatan produk riil berupa barang atau jasa bernilai jual tinggi dengan tahapan:
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Menu Navigasi Utama -->
        <div class="section-title">
            <i class="fa-solid fa-grid-2" style="color: #6366f1;"></i>
            <span>Menu Navigasi Utama</span>
        </div>

        <!-- Grid Menu Sesuai Hak Akses Role -->
        <div class="menu-grid">
    
        <?php if (isset($role) && $role === 'admin') : ?>
            <!-- FITUR KHUSUS ADMIN -->
            <a href="tambah_guru.php" class="menu-card">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Kelola Data Guru</h3>
                    <p>Tambah data guru pengajar, profil akademis, dan informasi staf.</p>
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
                    <p>Tambah data mata pelajaran, profil akademis, dan informasi staf.</p>
                </div>
                <div class="card-action">
                    <span>Kelola Data</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="tampil_guru.php" class="menu-card">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Tampilan Data Guru</h3>
                    <p>Tampil data guru pengajar, ubah profil akademis, atau perbarui informasi staf.</p>
                </div>
                <div class="card-action">
                    <span>Lihat Data</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="tampil_mapel.php" class="menu-card">
                <div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3>Tampilan Data Mata Pelajaran</h3>
                    <p>Tampil data mata pelajaran, ubah profil akademis, atau perbarui informasi staf.</p>
                </div>
                <div class="card-action">
                    <span>Lihat Data</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

        <?php else : ?>
            <!-- FITUR KHUSUS USER -->
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

    <script src="assets/script.js"></script>

</body>
</html>