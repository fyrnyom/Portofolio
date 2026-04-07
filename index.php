<?php
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frynn Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="#" class="logo">Frynn.<span>.</span></a>

            <nav class="nav-links" id="navLinks">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#projects">Projects</a>
                <a href="#contact">Contact</a>
                <a href="login.php" class="admin-btn">Admin login</a>
            </nav>

            <div class="menu-toggle" id="menuToggle">
                ☰
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-section" id="home">
        <div class="container hero-grid">
            <div class="hero-left">
                <div class="hero-top-profile">
                    <img src="img/profil-2.jpg" alt="Foto Profil Frynn" class="hero-profile-mini">
                    <div>
                        <span class="hero-badge">Creative Portfolio</span>
                        <h1 class="hero-title">
                            Halo, Aku <span>Arfan</span>
                        </h1>
                        <p class="hero-role">Pelajar • Designer • Creative Developer</p>
                    </div>
                </div>
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
                    <div class="hero-profile">
                        <h3>Arfan Achmad A</h3>
                        <p>Creative Portfolio Owner</p>
                    </div>
                    <div class="hero-info-boxes">
                        <div class="info-box">
                            <span>Focus</span>
                            <h4>Creative Web</h4>
                        </div>
                        <div class="info-box">
                            <span>Style</span>
                            <h4>Modern Premium</h4>
                        </div>
                        <div class="info-box">
                            <span>Status</span>
                            <h4>Available</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section about-section" id="about">
        <div class="container">
            <div class="section-heading">
                <span class="section-badge">About Me</span>
                <h2 class="section-title">Tentang Saya</h2>
                <p class="section-subtitle">
                    Sedikit gambaran tentang siapa saya, apa yang saya pelajari, dan fokus yang sedang saya kembangkan.
                </p>
            </div>

            <div class="about-grid">
                <div class="about-card large-card">
                    <h3>Siapa Aku?</h3>
                    <p>
                        Aku adalah seorang pelajar dari SMKN 1 bangsri yang tertarik di dunia desain, teknologi,
                        dan pengembangan karya digital. Aku suka membangun sesuatu dari ide sederhana
                        menjadi hasil visual yang lebih rapi, menarik, dan punya nilai presentasi yang kuat.
                    </p>
                </div>

                <div class="about-card">
                    <h3>Skill</h3>
                    <ul class="about-list">
                        <li>UI / Visual Design</li>
                        <li>HTML, CSS, PHP Dasar</li>
                        <li>Laravel Framework</li>
                    </ul>
                </div>

                <div class="about-card">
                    <h3>Fokus Saat Ini</h3>
                    <div class="about-tags">
                        <span>Portfolio Website</span>
                        <span>Frontend Practice</span>
                        <span>Visual Project</span>
                        <span>Digital Creation</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section class="section projects-section" id="projects">
        <div class="container">
            <div class="section-heading">
                <span class="section-badge">Featured Work</span>
                <h2 class="section-title">My Projects</h2>
                <p class="section-subtitle">
                    Beberapa project yang saya kerjakan untuk mengasah skill, kreativitas, dan kemampuan membangun tampilan digital.
                </p>
            </div>

            <div class="projects-grid">
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($data = mysqli_fetch_assoc($query)): ?>
                        <div class="project-card">
                            <div class="project-image-wrapper">
                                <img src="img/<?php echo htmlspecialchars($data['gambar']); ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>" class="project-image">
                            </div>
                            <div class="project-content">
                                <span class="project-label">Project</span>
                                <h3><?php echo htmlspecialchars($data['judul']); ?></h3>
                                <p><?php echo htmlspecialchars($data['deskripsi']); ?></p>
                                <div class="tech-stack">
                                    <?php
                                    $teknologi = explode(",", $data['teknologi']);
                                    foreach ($teknologi as $tech):
                                    ?>
                                        <span><?php echo trim(htmlspecialchars($tech)); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-projects">
                        <h3>Belum ada project</h3>
                        <p>Tambahkan project melalui dashboard admin agar tampil di sini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section contact-section" id="contact">
        <div class="container">
            <div class="section-heading">
                <span class="section-badge">Get In Touch</span>
                <h2 class="section-title">Contact Me</h2>
                <p class="section-subtitle">
                    Jika ingin berkomunikasi, berdiskusi, atau sekadar menyapa, kamu bisa menghubungi saya lewat beberapa platform berikut.
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

    <!-- Footer -->
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

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const navLinks = document.getElementById("navLinks");

        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
        });
    </script>

</body>

</html>