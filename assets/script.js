// ==========================================================================
// 1. SHOW/HIDE PASSWORD
// ==========================================================================
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleEye = document.getElementById('toggleEye');
    
    if (passwordInput) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleEye.classList.remove('fa-eye');
            toggleEye.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleEye.classList.remove('fa-eye-slash');
            toggleEye.classList.add('fa-eye');
        }
    }
}

// ==========================================================================
// 2. EVENT LISTENER UTAMA (DOM LOADED)
// ==========================================================================
document.addEventListener("DOMContentLoaded", function () {
    
    // --- Canvas Partikel (Opsional) ---
    const canvas = document.getElementById('particles-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        const particles = [];
        for (let i = 0; i < 45; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 2 + 1,
                dx: (Math.random() - 0.5) * 0.5,
                dy: (Math.random() - 0.5) * 0.5,
                alpha: Math.random() * 0.5 + 0.1
            });
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.x += p.dx;
                p.y += p.dy;

                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${p.alpha})`;
                ctx.fill();
            });
            requestAnimationFrame(animateParticles);
        }
        animateParticles();
    }

    // --- Pop-Up Konfirmasi Logout (SweetAlert2 / Fallback Confirm) ---
    document.addEventListener('click', function (e) {
        const btnLogout = e.target.closest('.btn-logout');
        if (btnLogout) {
            e.preventDefault();
            e.stopPropagation();
            
            const targetUrl = btnLogout.getAttribute('href') || 'logout.php';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Konfirmasi Keluar',
                    text: 'Apakah Anda yakin ingin keluar dari sistem ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1e3a8a',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Ya, Keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = targetUrl;
                    }
                });
            } else {
                if (confirm('Apakah Anda yakin ingin keluar dari akun ini?')) {
                    window.location.href = targetUrl;
                }
            }
        }
    });
});

// ==========================================================================
// 3. FUNGSI HAPUS DATA (GURU & MAPEL)
// ==========================================================================
function deleteGuru(nip) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Hapus Data Guru?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_guru.php?nip=" + nip;
            }
        });
    } else {
        if (confirm("Apakah kamu yakin ingin menghapus data guru ini?")) {
            window.location.href = "delete_guru.php?nip=" + nip;
        }
    }
}

function deleteMapel(kode_mapel) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Hapus Mata Pelajaran?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_mapel.php?kode_mapel=" + kode_mapel;
            }
        });
    } else {
        if (confirm("Apakah kamu yakin ingin menghapus data mata pelajaran ini?")) {
            window.location.href = "delete_mapel.php?kode_mapel=" + kode_mapel;
        }
    }
}

function confirmLogout() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Konfirmasi Keluar',
            text: 'Apakah Anda yakin ingin keluar dari sistem ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengarahkan ke file logout.php yang akan membersihkan session
                window.location.href = 'logout.php';
            }
        });
    } else {
        if (confirm('Apakah Anda yakin ingin keluar dari akun ini?')) {
            window.location.href = 'logout.php';
        }
    }
}