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
                    <li><a href="login.php" class="admin-link">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">

        <!-- HERO -->
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
                        <img src="img/profil.jpeg" alt="Profile Arfan" class="hero-image">
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

        <!-- ABOUT -->
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

        <!-- PROJECT -->
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
                                    <?php if (!empty($data['gambar']) && file_exists(__DIR__ . '/img/' . $data['gambar'])): ?>
                                        <img src="img/<?php echo htmlspecialchars($data['gambar']); ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>" class="project-image">
                                    <?php else: ?>
                                        <img src="img/profil.jpg" alt="No Image" class="project-image">
                                    <?php endif; ?>
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
                                        <?php if (!empty($data['github'])): ?>
                                            <a href="<?php echo htmlspecialchars($data['github']); ?>" target="_blank" class="project-btn primary-btn">GitHub</a>
                                        <?php endif; ?>

                                        <?php if (!empty($data['demo'])): ?>
                                            <a href="<?php echo htmlspecialchars($data['demo']); ?>" target="_blank" class="project-btn secondary-btn">Live Preview</a>
                                        <?php endif; ?>
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

        <!-- CONTACT -->
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

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-top">
            <div class="footer-brand">
                <a href="#home" class="footer-logo">Arfan<span>.Dev</span></a>
                <p>
                    Portfolio digital kreatif yang menampilkan karya, project, dan proses belajar di dunia web & design.
                </p>
            </div>

            <div class="footer-links">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#projects">Project</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>Connect</h3>
                <ul>
                    <li><a href="https://instagram.com/" target="_blank">Instagram</a></li>
                    <li><a href="https://github.com/" target="_blank">GitHub</a></li>
                    <li><a href="mailto:frynn@example.com">Email</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-content">
                <p>© 2026 Arfan.Dev</p>
                <p class="footer-made">Built with HTML, CSS & PHP</p>
            </div>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mobileNav = document.getElementById('mobileNav');

        if (menuToggle && mobileNav) {
            menuToggle.addEventListener('click', function() {
                mobileNav.classList.toggle('show');
            });
        }

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