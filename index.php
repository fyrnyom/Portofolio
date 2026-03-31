<?php
$nama = "Arfan Achmad A";
$role = "Jika itu membuatku senang, aku senang melakukannya";
$deskripsi_singkat = "Saya siswa SMKN 1 BANGSRI yang antusias dengan teknologi backend. Fokus pada pembuatan kode yang bersih, efisien, dan solusi digital yang inovatif.";
$email = "arf79616@gmail.com";
$phone = "+62 8xx-xxxx-xxxx";
$alamat = "Jepara, Jawa Tengah, Indonesia";

// Data Project
$projects = [
    [
        "judul" => "Quizzku",
        "deskripsi" => "Aplikasi kuis interaktif untuk mengukur kecepatan berpikir dengan 10 soal dan batas waktu 15 detik per soal.",
        "gambar" => "project.png",
        "teknologi" => "PHP • HTML • CSS • JavaScript"
    ],
    [
        "judul" => "Portofolio Pribadi",
        "deskripsi" => "Website portofolio personal bertema dark modern untuk menampilkan profil, keahlian, dan project.",
        "gambar" => "project.png",
        "teknologi" => "PHP • Bootstrap • CSS"
    ]
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama; ?> | Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="particles-js"></div>

    <nav class="navbar-custom">
        <div class="nav-container-custom">
            <div class="nav-logo">Arfan.<span>Dev</span></div>

            <input type="checkbox" id="check">
            <label for="check" class="icons">
                <span id="menu-icon">☰</span>
                <span id="close-icon">✕</span>
            </label>

            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact" class="nav-btn">Hubungi Saya</a></li>
            </ul>
        </div>
    </nav>

    <main class="container py-5 mt-5">
        <div class="row g-4 align-items-stretch">

            <!-- PROFILE CARD -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="glass-card profile-card text-center h-100">
                    <div class="profile-img-container">
                        <img src="maharaja.jpeg" alt="Foto Profil" class="profile-img">
                        <div class="status-dot"></div>
                    </div>

                    <h2 class="mt-4"><?php echo $nama; ?></h2>
                    <p class="role-text"><?php echo $role; ?></p>
                    <hr class="border-secondary my-4">
                    <p class="bio text-secondary"><?php echo $deskripsi_singkat; ?></p>

                    <div class="social-links mt-4">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>

                    <div class="mt-4">
                        <a href="cv-arfan.pdf" download class="btn-custom w-100">
                            <i class="fas fa-download me-2"></i> Download CV
                        </a>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-lg-8">
                <!-- HOME -->
                <section id="home" class="content-section active">
                    <div class="glass-card h-100 d-flex flex-column" data-aos="zoom-in">
                        <div class="home-content flex-grow-1">
                            <span class="badge-welcome mb-3">🚀 Welcome to my Digital Space</span>
                            <h1 class="hero-title">Halo, Saya <span class="text-gradient">Arfan</span></h1>
                            <h3 class="typing-text">I am a <span id="typed"></span></h3>

                            <p class="lead text-secondary mt-3">
                                Mengubah baris kode menjadi solusi digital yang elegan. Berfokus pada arsitektur
                                <strong>Frontend</strong> dan pengalaman <strong>UI/UX</strong> yang modern.
                            </p>

                            <div class="home-stats mt-4 d-flex flex-wrap gap-4">
                                <div class="stat-item">
                                    <span class="fw-bold text-primary">10+</span>
                                    <p class="small text-secondary">Projects Done</p>
                                </div>
                                <div class="stat-item">
                                    <span class="fw-bold text-primary">Learning</span>
                                    <p class="small text-secondary">Laravel 11</p>
                                </div>
                                <div class="stat-item">
                                    <span class="fw-bold text-primary">Creative</span>
                                    <p class="small text-secondary">UI Builder</p>
                                </div>
                            </div>
                        </div>

                        <div class="music-wide-container mt-5">
                            <div class="music-header-inline">
                                <span class="live-dot"></span>
                                <small>Now Playing on Spotify</small>
                            </div>
                            <iframe style="border-radius:12px"
                                src="https://open.spotify.com/embed/track/1fDFHXcykq4iw8Gg7s5hG9?utm_source=generator"
                                width="100%" height="152" frameBorder="0"
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </section>

                <!-- ABOUT -->
                <section id="about" class="content-section">
                    <div class="glass-card h-100" data-aos="fade-up">
                        <h3 class="section-title mb-4">Tentang Saya</h3>
                        <p class="text-secondary">
                            Saya adalah siswa SMKN 1 BANGSRI yang memiliki gairah tinggi dalam pengembangan web,
                            khususnya di sisi Frontend. Saya senang membuat pengalaman pengguna yang menarik dan intuitif.
                        </p>

                        <div class="row mt-4 g-4">
                            <div class="col-md-6">
                                <div class="mini-card h-100">
                                    <h5 class="mb-3"><i class="fas fa-code text-primary me-2"></i> Keahlian Dasar</h5>
                                    <div class="skill-tags">
                                        <span>PHP</span>
                                        <span>Laravel</span>
                                        <span>MySQL</span>
                                        <span>HTML & CSS</span>
                                        <span>UI/UX Design</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mini-card h-100">
                                    <h5 class="mb-3"><i class="fas fa-users text-primary me-2"></i> Organisasi</h5>
                                    <div class="org-item">
                                        <p class="mb-1 fw-bold">Webdev Taksan Nawasena</p>
                                        <small class="text-secondary">Anggota aktif dengan fokus pada logika web dan struktur database.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mini-card mt-4">
                            <h5 class="mb-3"><i class="fas fa-laptop-code text-primary me-2"></i> Fokus Saat Ini</h5>
                            <p class="small text-secondary mb-0">
                                Saat ini saya sedang mendalami framework Laravel untuk membangun aplikasi yang lebih scalable,
                                aman, dan nyaman digunakan.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- PROJECTS -->
                <section id="projects" class="content-section">
                    <div class="glass-card h-100" data-aos="fade-up">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                            <div>
                                <h3 class="section-title mb-1">Project Saya</h3>
                                <p class="text-secondary small mb-0">Beberapa project yang pernah saya kerjakan.</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            <?php foreach ($projects as $project): ?>
                                <div class="col-md-6">
                                    <div class="project-card h-100">
                                        <img src="<?php echo $project['gambar']; ?>" class="project-img" alt="<?php echo $project['judul']; ?>">
                                        <div class="project-body">
                                            <span class="project-badge">Featured</span>
                                            <h4 class="mt-3"><?php echo $project['judul']; ?></h4>
                                            <p class="text-secondary small"><?php echo $project['deskripsi']; ?></p>
                                            <p class="project-tech"><?php echo $project['teknologi']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- CONTACT -->
                <section id="contact" class="content-section">
                    <div class="glass-card h-100" data-aos="fade-up">
                        <h3 class="section-title mb-4">Hubungi Saya</h3>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="contact-card h-100">
                                    <i class="fas fa-envelope"></i>
                                    <h6>Email</h6>
                                    <p><?php echo $email; ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-card h-100">
                                    <i class="fas fa-phone"></i>
                                    <h6>Telepon</h6>
                                    <p><?php echo $phone; ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-card h-100">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <h6>Lokasi</h6>
                                    <p><?php echo $alamat; ?></p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">

                        <a href="mailto:<?php echo $email; ?>" class="btn-custom py-3 d-block text-center text-decoration-none">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Pesan Cepat
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        new Typed('#typed', {
            strings: ['Frontend Developer', 'UI/UX Designer', 'Laravel Learner', 'PHP Enthusiast'],
            typeSpeed: 50,
            backSpeed: 30,
            loop: true
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    e.preventDefault();
                    document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
                    targetSection.classList.add('active');
                    document.getElementById('check').checked = false;
                    AOS.refresh();
                }
            });
        });

        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 50
                },
                opacity: {
                    value: 0.1
                },
                size: {
                    value: 2
                },
                move: {
                    speed: 1.5
                }
            }
        });
    </script>
</body>

</html>