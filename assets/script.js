// Bagian Login
// Function Show/Hide Password
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleEye = document.getElementById('toggleEye');
    
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



// Canvas Partikel Latar Belakang
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;

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
});



// Bagian index
document.addEventListener("DOMContentLoaded", function () {
    // Alert Konfirmasi saat Logout
    const btnLogout = document.querySelector('.btn-logout');
    if (btnLogout) {
        btnLogout.addEventListener('click', function (e) {
            const confirmLogout = confirm("Apakah Anda yakin ingin keluar dari akun ini?");
            if (!confirmLogout) {
                e.preventDefault();
            }
        });
    }
});



// Bagian Profil Admin
document.addEventListener("DOMContentLoaded", function () {
    // Efek interaktif tambahan jika foto diklik
    const adminPhoto = document.getElementById("admin-photo-img");
    
    if (adminPhoto) {
        adminPhoto.addEventListener("click", function () {
            this.style.transform = "scale(1.05)";
            this.style.transition = "transform 0.3s ease";
            
            setTimeout(() => {
                this.style.transform = "scale(1)";
            }, 300);
        });
    }
});

// tampil delete
function deleteData(nip) {
            if (confirm("!!!!!Apakah kamu yakin ingin menghapus data ini?")) {
                window.location.href = "delete_guru.php?nip=" + nip;
            }
        }

function deleteData(kode_mapel) {
            if (confirm("!!!!!Apakah kamu yakin ingin menghapus data ini?")) {
                window.location.href = "delete_mapel.php?kode_mapel=" + kode_mapel;
            }
        }

