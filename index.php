<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Arfan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================= -->
    <header class="site-header">
        <div class="container navbar">
            <a href="#home" class="logo">Arfan<span>.Dev</span></a>

            <button class="menu-toggle" id="menuToggle">&#9776;</button>

            <nav id="mobileNav">
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#projects">Project</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <li><a href="login.php" class="admin-link">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">

        <!-- =========================
             HERO SECTION
        ========================= -->
        <section class="hero-section reveal" id="home">
            <div class="container hero-container">
                <div class="hero-left">
                    <span class="hero-badge">Creative Portfolio</span>
                    <h1 class="hero-title">
                        Halo, Aku <span>Arfan</span>
                    </h1>
                    <p class="hero-role">Pelajar • Designer • Creative Developer</p>
                    <p class="hero-desc">
                        Aku membangun project digital yang menggabungkan kreativitas, visual yang rapi,
                        dan proses belajar yang terus berkembang. Portfolio ini menjadi tempat untuk
                        menampilkan karya, eksperimen, dan perjalanan skill-ku di dunia digital.
                    </p>

                    <div class="hero-buttons">
                        <a href="#projects" class="hero-btn primary-hero-btn">Lihat Project</a>
                        <a href="#contact" class="hero-btn secondary-hero-btn">Hubungi Aku</a>
                        <a href="cv/cv-frynn.pdf" class="hero-btn cv-btn" download>Download CV</a>
                    </div>
                    <div class="hero-mini-stats">
                        <div class="hero-stat">
                            <h3>Creative</h3>
                            <p>Visual & Design</p>
                        </div>
                        <div class="hero-stat">
                            <h3>Web</h3>
                            <p>HTML • CSS • PHP</p>
                        </div>
                        <div class="hero-stat">
                            <h3>Growth</h3>
                            <p>Belajar & Berkembang</p>
                        </div>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="hero-card">
                        <div class="hero-glow"></div>
                        <img src="uploads/profil.jpg" alt="Profile Arfan" class="hero-image">
                        <div class="hero-card-content">
                            <h3>Creative Mindset</h3>
                            <p>
                                Fokus pada pengembangan karya visual, website, dan ide kreatif
                                yang bisa berkembang menjadi project nyata dan profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================
             ABOUT SECTION
        ========================= -->
        <section class="about-section reveal" id="about">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">Tentang Aku</span>
                    <h2 class="section-title">Sedikit Tentang Aku</h2>
                    <p class="section-subtitle">
                        Aku suka membuat sesuatu yang kreatif, visual, dan menarik.
                        Mulai dari desain, coding sederhana, sampai project digital yang bisa berkembang lebih jauh.
                    </p>
                </div>

                <div class="about-grid">
                    <div class="about-card large-card">
                        <h3>Siapa Aku?</h3>
                        <p>
                            Aku adalah seorang pelajar yang tertarik di dunia desain, teknologi,
                            dan pengembangan karya digital. Aku suka membangun sesuatu dari ide sederhana
                            menjadi hasil visual yang lebih rapi, menarik, dan punya nilai presentasi yang kuat.
                        </p>
                    </div>

                    <div class="about-card">
                        <h3>Skill</h3>
                        <ul class="about-list">
                            <li>UI / Visual Design</li>
                            <li>HTML, CSS, PHP Dasar</li>
                            <li>Creative Thinking</li>
                            <li>Editing & Branding Visual</li>
                        </ul>
                    </div>

                    <div class="about-card">
                        <h3>Fokus Saat Ini</h3>
                        <div class="about-tags">
                            <span>Portfolio Website</span>
                            <span>Creative Branding</span>
                            <span>Frontend Practice</span>
                            <span>Visual Project</span>
                            <span>Digital Creation</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================
             PROJECT SECTION
        ========================= -->
        <section class="projects-section reveal" id="projects">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">My Projects</span>
                    <h2 class="section-title">Project Pilihan</h2>
                    <p class="section-subtitle">
                        Kumpulan project yang menampilkan proses belajar, kreativitas, dan pengembangan skill
                        di bidang desain, web, dan digital creation.
                    </p>
                </div>

                <div class="projects-grid">
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                            <div class="project-card">
                                <div class="project-image-wrap">
                                    <img src="img/<?php echo htmlspecialchars($data['gambar']); ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>" class="project-image">
                                    <div class="project-overlay"></div>
                                </div>

                                <div class="project-content">
                                    <span class="project-category">Featured Project</span>
                                    <h3><?php echo htmlspecialchars($data['judul']); ?></h3>
                                    <p><?php echo htmlspecialchars($data['deskripsi']); ?></p>

                                    <div class="project-tech">
                                        <?php
                                        $teknologi = explode(',', $data['teknologi']);
                                        foreach ($teknologi as $tech):
                                        ?>
                                            <span class="tech-badge"><?php echo trim(htmlspecialchars($tech)); ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="project-links">
                                        <a href="#" class="project-btn primary-btn">Lihat Detail</a>
                                        <a href="#" class="project-btn secondary-btn">Live Preview</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="empty-project">
                            <h3>Belum Ada Project</h3>
                            <p>Tambahkan project dari dashboard admin supaya tampil di sini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- =========================
             CONTACT SECTION
        ========================= -->
        <section class="contact-section reveal" id="contact">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">Contact</span>
                    <h2 class="section-title">Hubungi Aku</h2>
                    <p class="section-subtitle">
                        Kalau ingin bekerja sama, bertanya, atau sekadar melihat perkembangan project-ku,
                        kamu bisa menghubungi lewat beberapa platform berikut.
                    </p>
                </div>

                <div class="contact-grid">
                    <div class="contact-card">
                        <span class="contact-label">Social</span>
                        <h3>Instagram</h3>
                        <p>@frynn</p>
                    </div>

                    <div class="contact-card">
                        <span class="contact-label">Mail</span>
                        <h3>Email</h3>
                        <p>frynn@example.com</p>
                    </div>

                    <div class="contact-card">
                        <span class="contact-label">Direct</span>
                        <h3>WhatsApp</h3>
                        <p>08xxxxxxxxxx</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- =========================
         FOOTER
    ========================= -->
    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-left">
                <h3>Frynn<span>.</span></h3>
                <p>Creative portfolio yang dibangun untuk menampilkan karya, proses belajar, dan perkembangan skill digital.</p>
            </div>

            <div class="footer-right">
                <p>© <?php echo date("Y"); ?> Frynn Portfolio</p>
                <p class="footer-note">Built with HTML, CSS, PHP, and creativity.</p>
            </div>
        </div>
    </footer>

    <!-- =========================
         SCRIPT
    ========================= -->
    <script>
        // Hamburger menu
        const menuToggle = document.getElementById('menuToggle');
        const mobileNav = document.getElementById('mobileNav');

        if (menuToggle && mobileNav) {
            menuToggle.addEventListener('click', function() {
                mobileNav.classList.toggle('show');
            });
        }

        // Reveal scroll
        const reveals = document.querySelectorAll('.reveal');

        function revealOnScroll() {
            for (let i = 0; i < reveals.length; i++) {
                let windowHeight = window.innerHeight;
                let elementTop = reveals[i].getBoundingClientRect().top;
                let revealPoint = 100;

                if (elementTop < windowHeight - revealPoint) {
                    reveals[i].classList.add('show-reveal');
                }
            }
        }

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>

</body>

</html>