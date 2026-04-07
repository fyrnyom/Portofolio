<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
$totalProject = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM projects"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frynn - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="container navbar">
            <a href="#" class="logo">Fly<span>Frynn</span></a>

            <button class="menu-toggle" id="menuToggle">☰</button>

            <nav id="mobileMenu">
                <ul class="nav-links">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#projects">Project</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <li><a href="admin/login.php" class="admin-link">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">

        <!-- HERO -->
        <section class="hero-section reveal" id="home">
            <div class="container hero-container">
                <div class="hero-left">
                    <span class="hero-badge">🚀 Portfolio Digital</span>
                    <h1 class="hero-title">Halo, Aku <span>Frynn</span></h1>
                    <p class="hero-role">Creative Developer • Designer • Content Creator</p>
                    <p class="hero-desc">
                        Aku membangun website, visual, dan project digital yang modern, clean,
                        serta punya identitas kuat. Portfolio ini berisi hasil karya dan project
                        yang sedang aku kembangkan.
                    </p>

                    <div class="hero-buttons">
                        <a href="#projects" class="hero-btn primary-hero-btn">Lihat Project</a>
                        <a href="#contact" class="hero-btn secondary-hero-btn">Hubungi Aku</a>
                    </div>

                    <div class="hero-mini-stats">
                        <div class="hero-stat">
                            <h3><?php echo $totalProject; ?>+</h3>
                            <p>Total Project</p>
                        </div>
                        <div class="hero-stat">
                            <h3>100%</h3>
                            <p>Creative Process</p>
                        </div>
                        <div class="hero-stat">
                            <h3>Online</h3>
                            <p>Available</p>
                        </div>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="hero-card">
                        <div class="hero-glow"></div>

                        <!-- FOTO HERO / PROFIL -->
                        <!-- kalau foto kamu manual, taruh di folder img -->
                        <img src="img/profil-2.jpg" alt="Frynn" class="hero-image">

                        <div class="hero-card-content">
                            <h3>Building Visual Identity</h3>
                            <p>
                                Fokus pada pengembangan portfolio, branding personal,
                                project digital, dan karya visual yang modern serta profesional.
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
                    <span class="section-badge">Tentang Saya</span>
                    <h2 class="section-title">Siapa Aku?</h2>
                    <p class="section-subtitle">
                        Aku suka membangun hal-hal kreatif yang bisa dilihat, dipakai, dan dinikmati orang lain.
                    </p>
                </div>

                <div class="about-grid">
                    <div class="about-card large-card">
                        <h3>Perkenalan</h3>
                        <p>
                            Aku adalah seorang kreator digital yang tertarik pada pengembangan website,
                            desain visual, branding, serta project kreatif yang bisa berkembang menjadi
                            sesuatu yang lebih besar.
                        </p>
                    </div>

                    <div class="about-card">
                        <h3>Fokus</h3>
                        <ul class="about-list">
                            <li>Website Development</li>
                            <li>UI / Visual Design</li>
                            <li>Creative Branding</li>
                            <li>Digital Project Building</li>
                        </ul>
                    </div>

                    <div class="about-card">
                        <h3>Skill & Tools</h3>
                        <div class="about-tags">
                            <span>PHP</span>
                            <span>MySQL</span>
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>JavaScript</span>
                            <span>Canva</span>
                            <span>Figma</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROJECTS -->
        <section class="projects-section reveal" id="projects">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">Portfolio</span>
                    <h2 class="section-title">Project Saya</h2>
                    <p class="section-subtitle">
                        Beberapa hasil karya dan project yang sudah dibuat dan terus dikembangkan.
                    </p>
                </div>

                <div class="projects-grid">
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>

                            <?php
                            $gambar = !empty($data['gambar']) ? htmlspecialchars($data['gambar']) : 'default.jpg';
                            $gambarPath = "uploads/" . $gambar;
                            ?>

                            <div class="project-card reveal">
                                <div class="project-image-wrap">
                                    <img src="<?php echo $gambarPath; ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>" class="project-image">
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
                                        <?php if (!empty($data['link_demo'])): ?>
                                            <a href="<?php echo htmlspecialchars($data['link_demo']); ?>" target="_blank" class="project-btn primary-btn">Live Demo</a>
                                        <?php endif; ?>

                                        <?php if (!empty($data['link_github'])): ?>
                                            <a href="<?php echo htmlspecialchars($data['link_github']); ?>" target="_blank" class="project-btn secondary-btn">GitHub</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="empty-project">
                            <h3>Belum Ada Project</h3>
                            <p>Project yang kamu tambahkan dari dashboard admin akan muncul di sini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section class="contact-section reveal" id="contact">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">Kontak</span>
                    <h2 class="section-title">Hubungi Aku</h2>
                    <p class="section-subtitle">
                        Kalau kamu ingin kerja sama, diskusi project, atau sekadar ngobrol soal ide kreatif.
                    </p>
                </div>

                <div class="contact-grid">
                    <div class="contact-card">
                        <span class="contact-label">Email</span>
                        <h3>Email</h3>
                        <p>yourmail@email.com</p>
                    </div>

                    <div class="contact-card">
                        <span class="contact-label">Instagram</span>
                        <h3>Instagram</h3>
                        <p>@usernamekamu</p>
                    </div>

                    <div class="contact-card">
                        <span class="contact-label">WhatsApp</span>
                        <h3>WhatsApp</h3>
                        <p>08xxxxxxxxxx</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#" class="footer-logo">Fly<span>Frynn</span></a>
                    <p>
                        Personal portfolio yang menampilkan project, karya digital,
                        dan perjalanan kreatif dalam membangun identitas visual serta web modern.
                    </p>
                </div>

                <div class="footer-links">
                    <h3>Navigasi</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">Tentang</a></li>
                        <li><a href="#projects">Project</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h3>Kontak</h3>
                    <ul>
                        <li><a href="mailto:yourmail@email.com">yourmail@email.com</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">WhatsApp</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>© <?php echo date('Y'); ?> FlyFrynn. All rights reserved.</p>
                    <p class="footer-made">Built with passion & creativity.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script>
        const menuToggle = document.getElementById("menuToggle");
        const mobileMenu = document.getElementById("mobileMenu");

        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("show");
        });

        const reveals = document.querySelectorAll(".reveal");

        function revealOnScroll() {
            reveals.forEach((el) => {
                const windowHeight = window.innerHeight;
                const elementTop = el.getBoundingClientRect().top;
                const revealPoint = 100;

                if (elementTop < windowHeight - revealPoint) {
                    el.classList.add("show-reveal");
                }
            });
        }

        window.addEventListener("scroll", revealOnScroll);
        revealOnScroll();
    </script>

</body>

</html>