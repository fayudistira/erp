<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Kursus Bahasa Asing - Kampung Inggris Pare') ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles dari kursusbahasa.org -->
    <style>
        :root {
            --primary-yellow: #ffd700;
            --dark-yellow: #ffc107;
            --black: #212529;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
        }

        /* Top Navigation - STICKY */
        .top-navigation {
            position: sticky;
            top: 0;
            z-index: 1030;
            background-color: var(--black);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
            border-bottom: 2px solid var(--primary-yellow);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .nav-brand .highlight {
            color: var(--primary-yellow);
        }

        /* Social Media Styles untuk Navigation */
        .nav-social {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .social-link {
            color: var(--primary-yellow);
            text-decoration: none;
            font-size: 0.85rem;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            background-color: transparent;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .social-link:hover {
            color: var(--black);
            background-color: var(--primary-yellow);
            border-color: var(--primary-yellow);
            transform: translateY(-1px);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--black);
            color: white;
            padding: 4rem 0;
        }

        /* Custom Styles dari kursusbahasa.org */
        .bg-primary-yellow {
            background-color: var(--primary-yellow) !important;
        }

        .text-primary-yellow {
            color: var(--primary-yellow) !important;
        }

        .btn-primary-yellow {
            background-color: var(--primary-yellow);
            border-color: var(--primary-yellow);
            color: var(--black);
        }

        .btn-primary-yellow:hover {
            background-color: var(--dark-yellow);
            border-color: var(--dark-yellow);
            color: var(--black);
        }

        .btn-outline-yellow {
            color: var(--primary-yellow);
            border-color: var(--primary-yellow);
        }

        .btn-outline-yellow:hover {
            background-color: var(--primary-yellow);
            color: var(--black);
        }

        .border-yellow {
            border-color: var(--primary-yellow) !important;
        }

        /* Card Styles dari kursusbahasa.org */
        .program-card {
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            height: 100%;
        }

        .program-card:hover {
            border-color: var(--primary-yellow);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .program-img-wrapper {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
        }

        .program-img-wrapper img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .program-card:hover .program-img-wrapper img {
            transform: scale(1.1);
        }

        /* Badge Style */
        .badge-category {
            background: rgba(255, 215, 0, 0.1);
            color: var(--dark-gray);
            font-size: 0.75rem;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        /* Filter Sidebar */
        .filter-sidebar {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: #fff;
            padding: 1.5rem;
        }

        /* Section Title */
        .section-title {
            font-weight: 800;
            color: var(--black);
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .section-title::after {
            content: "";
            width: 50px;
            height: 4px;
            background: var(--primary-yellow);
            position: absolute;
            bottom: -10px;
            left: 0;
            transform: none;
            border-radius: 2px;
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3em;
        }

        /* Hero Section - mirip dengan kursusbahasa.org */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)),
                url("https://kursusbahasa.org/assets/img/gallery/kampung-inggris-pare.webp");
            background-size: cover;
            background-position: center;
            color: white;
            padding: 4rem 0;
            min-height: 60vh;
            overflow: hidden;
        }

        .hero-main-title {
            font-size: 2.5rem;
            line-height: 1.1;
        }

        /* Stats Card */
        .stats-card-container {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .stats-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-content {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }

            .nav-social {
                gap: 6px;
            }

            .social-link {
                width: 26px;
                height: 26px;
                font-size: 0.8rem;
            }

            .hero-main-title {
                font-size: 2rem;
            }

            .hero-section {
                padding: 2.5rem 0;
            }
        }

        @media (max-width: 576px) {
            .nav-content {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }

            .nav-social {
                gap: 5px;
            }

            .social-link {
                width: 24px;
                height: 24px;
                font-size: 0.75rem;
            }

            .hero-main-title {
                font-size: 1.6rem;
            }
        }
    </style>

    <?= $this->renderSection('style') ?>
</head>

<body>
    <!-- Top Navigation - STICKY (dari kursusbahasa.org) -->
    <nav class="top-navigation" aria-label="Main Navigation">
        <div class="container">
            <div class="nav-content">
                <div class="nav-brand">
                    <a href="<?= base_url('/') ?>" style="text-decoration: none; color: #f8f9fa">
                        <span class="text-primary-yellow">kursus</span>bahasa.org
                    </a>
                </div>
                <div class="nav-social">
                    <!-- Link ke berbagai program bahasa -->
                    <a href="<?= base_url('/?category=Mandarin') ?>" class="social-link" title="Program Mandarin">
                        <img
                            src="https://hatscripts.github.io/circle-flags/flags/cn.svg"
                            width="20"
                            height="20"
                            alt="Mandarin"
                            style="border-radius: 50%;" />
                    </a>
                    <a href="<?= base_url('/?category=Jepang') ?>" class="social-link" title="Program Jepang">
                        <img
                            src="https://hatscripts.github.io/circle-flags/flags/jp.svg"
                            width="20"
                            height="20"
                            alt="Jepang"
                            style="border-radius: 50%;" />
                    </a>
                    <a href="<?= base_url('/?category=Korea') ?>" class="social-link" title="Program Korea">
                        <img
                            src="https://hatscripts.github.io/circle-flags/flags/kr.svg"
                            width="20"
                            height="20"
                            alt="Korea"
                            style="border-radius: 50%;" />
                    </a>
                    <a href="<?= base_url('/?category=Jerman') ?>" class="social-link" title="Program Jerman">
                        <img
                            src="https://hatscripts.github.io/circle-flags/flags/de.svg"
                            width="20"
                            height="20"
                            alt="Jerman"
                            style="border-radius: 50%;" />
                    </a>
                    <a href="<?= base_url('/?category=Inggris') ?>" class="social-link" title="Program Inggris">
                        <img
                            src="https://hatscripts.github.io/circle-flags/flags/gb.svg"
                            width="20"
                            height="20"
                            alt="Inggris"
                            style="border-radius: 50%;" />
                    </a>
                    <a href="<?= base_url('/') ?>" class="social-link" title="Beranda">
                        <i class="fas fa-home"></i>
                    </a>
                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $label => $url): ?>
                            <a href="<?= esc($url) ?>" class="social-link" title="<?= ucfirst($label) ?>">
                                <i class="fas fa-<?= strtolower($label) ?>"></i>
                            </a>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer (dari kursusbahasa.org) -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold">
                        <a href="<?= base_url('/') ?>" style="text-decoration: none; color: white">
                            <span class="text-primary-yellow">kursus</span>bahasa.org
                        </a>
                    </h5>
                    <p>
                        Lembaga kursus bahasa asing terpercaya dengan metode Kampung
                        Inggris untuk lima bahasa: Mandarin, Jepang, Korea, Jerman, dan
                        Inggris.
                    </p>
                    <p class="small">
                        SK Diknas: Nomor 421.9/1885/418.20/2023<br />
                        SK KEMENKUMHAM Nomor AHU-0015725.AH.01.07.TAHUN 2018
                    </p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h5 class="fw-bold">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?= base_url('/') ?>" class="text-white text-decoration-none">Home</a>
                        </li>
                        <?php if (!empty($menu)): ?>
                            <?php foreach ($menu as $label => $url): ?>
                                <li>
                                    <a href="<?= esc($url) ?>" class="text-white text-decoration-none">
                                        <?= ucfirst($label) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold">Kontak</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i> Perum GPR 1 Blok C
                            No.4, Jl. Veteran Tulungrejo, Pare, Kediri 64212
                        </li>
                        <li><i class="fas fa-phone me-2"></i> 0858 1031 0950</li>
                        <li>
                            <i class="fas fa-envelope me-2"></i> info@kursusbahasa.org
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-3" />
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        &copy; <?= date('Y') ?> kursusbahasa.org. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="https://wa.me/6285810310950" class="text-white me-3" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.youtube.com/@kursusbahasa" class="text-white me-3" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.facebook.com/kursusbahasa" class="text-white me-3" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.tiktok.com/@kursusbahasa" class="text-white me-3" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://www.instagram.com/kursusbahasa" class="text-white" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>