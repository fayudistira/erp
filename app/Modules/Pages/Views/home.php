<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('style') ?>
<style>
    /* Spinning Text Styles (dari kursusbahasa.org) */
    .spinning-text-wrapper {
        display: block;
        position: relative;
        margin: 25px 0 20px 0;
    }

    .spinning-text-container {
        display: block;
        position: relative;
        height: 55px;
        text-align: left;
        margin: 0;
        overflow: none;
    }

    .spinning-text {
        display: block;
        width: 100%;
        color: var(--primary-yellow);
        font-weight: bold;
        font-size: 2.5rem;
        position: absolute;
        left: 0;
        right: 0;
        opacity: 0;
        transform: scale(0.8);
        transition: none;
        line-height: 1.1;
        top: 5px;
    }

    .text-zoom-in {
        animation: zoomIn 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .text-fade-out {
        animation: fadeOut 0.7s cubic-bezier(0.55, 0.085, 0.68, 0.53) forwards;
    }

    @keyframes zoomIn {
        0% {
            transform: scale(0.8) translateY(10px);
            opacity: 0;
            filter: blur(2px);
        }

        70% {
            transform: scale(1.05) translateY(0);
            filter: blur(0);
        }

        100% {
            transform: scale(1) translateY(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    @keyframes fadeOut {
        0% {
            transform: scale(1) translateY(0);
            opacity: 1;
            filter: blur(0);
        }

        30% {
            transform: scale(1.1) translateY(-5px);
            filter: blur(1px);
        }

        100% {
            transform: scale(0.8) translateY(10px);
            opacity: 0;
            filter: blur(2px);
        }
    }

    /* Hero Section Styles (dari kursusbahasa.org) */
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

    .hero-line {
        display: block;
        margin-bottom: 1px;
        line-height: 1.2;
    }

    /* Package Card Styles (dari kursusbahasa.org) */
    .package-card {
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        border-color: var(--primary-yellow);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .package-card-body {
        padding: 1.2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .package-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        color: var(--black);
    }

    .package-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 0.8rem;
    }

    .meta-badge {
        background-color: rgba(255, 215, 0, 0.1);
        color: var(--dark-gray);
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        border: 1px solid rgba(255, 215, 0, 0.2);
    }

    .meta-badge.highlight {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border-color: rgba(220, 53, 69, 0.2);
    }

    .package-card-description {
        color: var(--dark-gray);
        font-size: 0.85rem;
        margin-bottom: 1rem;
        line-height: 1.4;
        flex-grow: 1;
    }

    .package-options-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.2rem 0;
        background-color: rgba(248, 249, 250, 0.8);
        border-radius: 6px;
        padding: 0.8rem;
    }

    .package-option-item {
        padding: 0.25rem 0;
        font-size: 0.8rem;
        color: var(--dark-gray);
        display: flex;
        align-items: flex-start;
        gap: 0.4rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .package-option-item:last-child {
        border-bottom: none;
    }

    .package-option-item i {
        color: var(--primary-yellow);
        font-size: 0.7rem;
        margin-top: 0.15rem;
        flex-shrink: 0;
    }

    .package-card-footer {
        padding-top: 0.8rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        margin-top: auto;
    }

    .btn-package-detail {
        background-color: transparent;
        color: var(--primary-yellow);
        border: 1px solid var(--primary-yellow);
        padding: 0.4rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-package-detail:hover {
        background-color: var(--primary-yellow);
        color: var(--black);
    }

    /* Form Control Custom */
    .form-select.custom-select {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        color: var(--dark-gray);
    }

    .form-select.custom-select:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }

    .form-check.custom-radio .form-check-input {
        border: 2px solid rgba(0, 0, 0, 0.25);
    }

    .form-check.custom-radio .form-check-input:checked {
        background-color: var(--primary-yellow);
        border-color: var(--primary-yellow);
    }

    /* Price Styling */
    .original-price {
        font-size: 0.7rem;
        text-decoration: line-through;
        color: var(--dark-gray);
    }

    .current-price {
        font-size: 1.25rem;
        font-weight: bold;
        color: var(--primary-yellow);
    }

    /* Accordion Style */
    .accordion-item {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .accordion-button {
        background-color: white;
        color: var(--black);
        font-weight: 600;
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(255, 215, 0, 0.1);
        color: var(--black);
        border-bottom: 1px solid var(--primary-yellow);
    }

    .accordion-button:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    /* Responsive */
    @media (max-width: 992px) {
        .spinning-text-wrapper {
            margin: 20px 0 15px 0;
        }
    }

    @media (max-width: 768px) {
        .spinning-text-wrapper {
            margin: 15px 0 10px 0;
        }

        .spinning-text-container {
            height: 50px;
            text-align: left;
        }

        .spinning-text {
            font-size: 1.6rem;
        }

        .hero-main-title {
            font-size: 2rem;
            text-align: left;
        }

        .hero-section h1 {
            font-size: 1.8rem;
            text-align: left;
        }

        .package-card-body {
            padding: 1rem;
        }

        .package-card-title {
            font-size: 1rem;
        }

        .stats-card-container {
            margin-top: -40px;
        }
    }

    @media (max-width: 576px) {
        .spinning-text-wrapper {
            margin: 12px 0 8px 0;
        }

        .spinning-text-container {
            height: 45px;
            text-align: left;
        }

        .spinning-text {
            font-size: 1.4rem;
            text-align: left;
        }

        .hero-main-title {
            font-size: 1.6rem;
            text-align: left;
        }

        .hero-section {
            padding: 2.5rem 0;
        }

        .hero-section h1 {
            font-size: 1.5rem;
            text-align: left;
        }

        .package-card {
            margin-bottom: 1.5rem;
        }

        .stats-card-container {
            margin-top: -30px;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section dengan Spinning Text (dari kursusbahasa.org) -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-lg-start mb-4 mb-lg-0">
                <h1 class="display-5 fw-bold hero-main-title">
                    <span class="hero-line d-block">Mau belajar</span>
                    <div class="spinning-text-wrapper">
                        <div class="spinning-text-container">
                            <span class="spinning-text text-zoom-in" id="spinningText">Bahasa Mandarin</span>
                        </div>
                    </div>
                    <span class="hero-line d-block">di Kampung Inggris?</span>
                </h1>
                <p class="lead mb-4">
                    Bergabunglah dengan ribuan siswa yang telah sukses menguasai bahasa asing bersama kami.
                </p>
                <a href="#programs" class="btn btn-primary-yellow btn-lg mt-3">
                    Mulai Belajar <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <div class="animation-3d-system">
                    <div class="animation-logo-container">
                        <img src="https://kursusbahasa.org/assets/img/logo-sos.webp"
                            alt="Logo Kursus Bahasa"
                            class="animation-logo"
                            width="200"
                            height="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Cards -->
<div class="container stats-card-container">
    <div class="card stats-card border-0">
        <div class="card-body py-4">
            <div class="row g-4 text-center">
                <div class="col-md-3 border-end border-secondary">
                    <h3 class="fw-bold text-primary-yellow mb-0">12+</h3>
                    <small class="text-muted text-uppercase fw-semibold">Bahasa Asing</small>
                </div>
                <div class="col-md-3 border-end border-secondary">
                    <h3 class="fw-bold text-primary-yellow mb-0">150+</h3>
                    <small class="text-muted text-uppercase fw-semibold">Mentor Ahli</small>
                </div>
                <div class="col-md-3 border-end border-secondary">
                    <h3 class="fw-bold text-primary-yellow mb-0">98%</h3>
                    <small class="text-muted text-uppercase fw-semibold">Peserta Lulus</small>
                </div>
                <div class="col-md-3">
                    <h3 class="fw-bold text-primary-yellow mb-0">24/7</h3>
                    <small class="text-muted text-uppercase fw-semibold">Akses Materi</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Programs Section -->
<section id="programs" class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="section-title">Program Unggulan Kami</h2>
            <p class="text-muted">Pilih paket belajar yang paling sesuai dengan tujuan karier atau pendidikan Anda.</p>
        </div>

        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="fas fa-filter me-2"></i> Filter Pencarian
                    </h6>
                    <form action="<?= base_url('/') ?>" method="get" id="filterForm">
                        <div class="mb-4">
                            <label class="small fw-bold text-muted mb-2">Kategori Bahasa</label>
                            <select name="category" class="form-select custom-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['category'] ?>" <?= ($filter['category'] ?? '') == $cat['category'] ? 'selected' : '' ?>>
                                        <?= $cat['category'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="small fw-bold text-muted mb-2">Metode Belajar</label>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="classtype" value="" id="typeAll"
                                        <?= empty($filter['classtype']) ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <label class="form-check-label small" for="typeAll">Semua Tipe</label>
                                </div>
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="classtype" value="Online" id="typeOnline"
                                        <?= ($filter['classtype'] ?? '') == 'Online' ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <label class="form-check-label small" for="typeOnline">Online (Zoom/LMS)</label>
                                </div>
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="classtype" value="Offline" id="typeOffline"
                                        <?= ($filter['classtype'] ?? '') == 'Offline' ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <label class="form-check-label small" for="typeOffline">Offline (Tatap Muka)</label>
                                </div>
                            </div>
                        </div>

                        <a href="<?= base_url('/') ?>" class="btn btn-outline-yellow btn-sm w-100 rounded-pill mt-2">
                            <i class="fas fa-redo me-1"></i> Reset Filter
                        </a>
                    </form>
                </div>
            </div>

            <!-- Programs Cards -->
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    <?php if (!empty($programs)): ?>
                        <?php foreach ($programs as $prog): ?>
                            <div class="col">
                                <div class="program-card">
                                    <div class="program-img-wrapper">
                                        <img src="<?= base_url('uploads/programs/' . ($prog['thumbnails'] ?: 'default.jpg')) ?>"
                                            alt="<?= esc($prog['title']) ?>">
                                        <div class="position-absolute top-0 start-0 p-3">
                                            <span class="badge bg-white text-dark shadow-sm rounded-pill fw-bold" style="font-size: 0.7rem;">
                                                <i class="fas fa-fire text-primary-yellow me-1"></i>Populer
                                            </span>
                                        </div>
                                    </div>

                                    <div class="package-card-body">
                                        <div class="package-card-meta">
                                            <span class="badge-category"><?= esc($prog['category']) ?></span>
                                            <span class="meta-badge"><?= esc($prog['duration']) ?></span>
                                            <?php if ($prog['classtype'] == 'Online'): ?>
                                                <span class="meta-badge highlight">Online</span>
                                            <?php endif; ?>
                                        </div>

                                        <h5 class="package-card-title"><?= esc($prog['title']) ?></h5>

                                        <p class="package-card-description text-truncate-2">
                                            <?= strip_tags($prog['description']) ?>
                                        </p>

                                        <div class="package-options-list">
                                            <div class="package-option-item">
                                                <i class="fas fa-check"></i>
                                                <span>Pengajar bersertifikat</span>
                                            </div>
                                            <div class="package-option-item">
                                                <i class="fas fa-check"></i>
                                                <span>Materi lengkap</span>
                                            </div>
                                            <div class="package-option-item">
                                                <i class="fas fa-check"></i>
                                                <span>Sertifikat resmi</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-end mt-auto">
                                            <div>
                                                <small class="original-price d-block">
                                                    IDR <?= number_format($prog['tuition'] * 1.2, 0, ',', '.') ?>
                                                </small>
                                                <h5 class="current-price mb-0">
                                                    IDR <?= number_format($prog['tuition'], 0, ',', '.') ?>
                                                </h5>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i><?= esc($prog['classtype']) ?>
                                            </small>
                                        </div>

                                        <div class="package-card-footer">
                                            <div class="d-flex gap-2">
                                                <a href="<?= base_url('programs/show/' . $prog['id']) ?>"
                                                    class="btn-package-detail">
                                                    <span>DETAIL</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                                <a href="<?= base_url('daftar/' . $prog['id']) ?>"
                                                    class="btn btn-primary-yellow btn-sm flex-grow-1 fw-bold rounded-pill py-2">
                                                    DAFTAR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="fas fa-search display-1 text-light"></i>
                            <h5 class="mt-3 fw-bold">Tidak ditemukan</h5>
                            <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h2 class="section-title">Punya Pertanyaan?</h2>
                <p class="text-muted mt-3">Berikut adalah beberapa jawaban atas keraguan yang sering ditanyakan oleh calon peserta didik kami.</p>
                <div class="mt-4 p-4 bg-black text-white rounded-4">
                    <h6>Masih Bingung?</h6>
                    <p class="small opacity-75">Konsultasikan kebutuhan belajarmu dengan tim ahli kami secara gratis.</p>
                    <a href="https://wa.me/6285810310950"
                        class="btn btn-primary-yellow btn-sm fw-bold px-4 rounded-pill"
                        target="_blank">
                        Chat Admin
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="accordion" id="faqHome">
                    <?php if (!empty($faqs)): ?>
                        <?php foreach ($faqs as $key => $faq): ?>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?= $key === 0 ? '' : 'collapsed' ?> fw-bold py-3"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faq-<?= $faq['id'] ?>"
                                        aria-expanded="<?= $key === 0 ? 'true' : 'false' ?>">
                                        <?= esc($faq['question']) ?>
                                    </button>
                                </h2>
                                <div id="faq-<?= $faq['id'] ?>"
                                    class="accordion-collapse collapse <?= $key === 0 ? 'show' : '' ?>"
                                    data-bs-parent="#faqHome">
                                    <div class="accordion-body text-muted small">
                                        <?= nl2br(esc((string) $faq['answer'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <p class="text-muted italic">Belum ada FAQ tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section (dari kursusbahasa.org) -->
<section id="cta" class="py-5 bg-black text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="fw-bold mb-3">Siap Menguasai Bahasa Asing?</h2>
                <p class="lead mb-4">
                    Daftar sekarang dan dapatkan konsultasi gratis dengan pengajar kami. Mulai perjalanan bahasa Anda bersama kursusbahasa.org!
                </p>
                <a href="https://wa.me/6285810310950?text=Hai,%20saya%20mau%20konsultasi%20mengenai%20program%20kursus%20di%20kursusbahasa.org"
                    target="_blank"
                    class="btn btn-outline-yellow btn-lg mb-2">
                    Konsultasi Gratis
                </a>
                <p class="mt-3 small">info@kursusbahasa.org</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    // Spinning Text Animation (dari kursusbahasa.org)
    document.addEventListener("DOMContentLoaded", function() {
        const spinningText = document.getElementById("spinningText");
        if (spinningText) {
            const languages = [
                "Bahasa Mandarin",
                "Bahasa Jepang",
                "Bahasa Korea",
                "Bahasa Jerman",
                "Bahasa Inggris",
            ];
            let currentIndex = 0;

            function changeText() {
                spinningText.classList.remove("text-zoom-in");
                spinningText.classList.add("text-fade-out");

                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % languages.length;
                    spinningText.textContent = languages[currentIndex];

                    spinningText.classList.remove("text-fade-out");
                    spinningText.classList.add("text-zoom-in");
                }, 700);
            }

            setTimeout(() => {
                setInterval(changeText, 3000);
            }, 1000);
        }

        // Smooth scroll for anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar scroll effect
        const header = document.querySelector(".top-navigation");
        if (header) {
            window.addEventListener("scroll", () => {
                if (window.scrollY > 100) {
                    header.style.boxShadow = "0 5px 15px rgba(0, 0, 0, 0.2)";
                } else {
                    header.style.boxShadow = "0 2px 10px rgba(0, 0, 0, 0.1)";
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>