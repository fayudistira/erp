<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* Header dengan Background Thumbnail yang didekorasi */
        .course-header {
            position: relative;
            background-color: #1c1d1f;
            color: white;
            padding: 60px 0;
            overflow: hidden;
        }

        .header-bg-blur {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('<?= base_url("uploads/programs/" . (string)$program["thumbnails"]) ?>');
            background-size: cover;
            background-position: center;
            filter: blur(8px) brightness(0.3);
            transform: scale(1.1);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        /* Perbaikan Rasio Gambar Thumbnail Sidebar */
        .program-img-container {
            width: 100%;
            aspect-ratio: 16 / 9;
            /* Mengunci rasio 16:9 */
            overflow: hidden;
            background-color: #f0f0f0;
        }

        .program-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Gambar memenuhi area tanpa stretch */
            object-position: center;
            transition: transform 0.5s ease;
        }

        .sticky-card:hover .program-img-container img {
            transform: scale(1.05);
        }

        .sticky-card {
            position: sticky;
            top: 20px;
            z-index: 100;
            border-radius: 12px;
            overflow: hidden;
        }

        .badge-category {
            background-color: #cec0fc;
            color: #3c1d4a;
            font-weight: bold;
        }

        .description-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #333;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
    </style>
</head>

<body class="bg-white">

    <header class="course-header">
        <div class="header-bg-blur"></div>
        <div class="container header-content">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb text-white mb-3 small">
                            <li class="breadcrumb-item"><a href="<?= base_url('programs') ?>" class="text-info text-decoration-none">Programs</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page"><?= esc((string)$program['category']) ?></li>
                        </ol>
                    </nav>
                    <h1 class="fw-bold display-5"><?= esc((string)$program['title']) ?></h1>
                    <div class="d-flex align-items-center gap-4 mt-4">
                        <span class="badge badge-category p-2 px-3"><?= esc((string)$program['language']) ?></span>
                        <span><i class="bi bi-person-video3 me-1"></i> <?= esc((string)$program['classtype']) ?></span>
                        <span><i class="bi bi-clock-history me-1"></i> <?= esc((string)$program['duration']) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-8">

                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Tentang Program Ini</h4>
                    <div class="description-text">
                        <?= nl2br(esc((string)$program['description'])) ?>
                    </div>
                </div>

                <div class="card mb-5 border-0 bg-light rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Apa yang akan Anda dapatkan</h4>
                        <div class="row">
                            <?php if (!empty($program['features']) && is_array($program['features'])) : ?>
                                <?php foreach ($program['features'] as $feature) : ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                            <span><?= esc((string)$feature) ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12 text-muted small">Fitur program belum ditambahkan.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <h4 class="fw-bold mb-3">Kurikulum Program</h4>
                <div class="accordion mb-5 shadow-sm border-0" id="curriculumAccordion">
                    <?php if (!empty($program['curriculum']) && is_array($program['curriculum'])) : ?>
                        <?php foreach ($program['curriculum'] as $index => $chapter) : ?>
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?> bg-white fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#chapter<?= $index ?>">
                                        <div class="d-flex justify-content-between w-100 align-items-center">
                                            <span><?= esc((string)$chapter['chapter']) ?></span>
                                            <small class="text-muted fw-normal me-3"><?= count($chapter['content'] ?? []) ?> Materi</small>
                                        </div>
                                    </button>
                                </h2>
                                <div id="chapter<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body bg-light py-2">
                                        <ul class="list-group list-group-flush bg-transparent">
                                            <?php if (!empty($chapter['content']) && is_array($chapter['content'])) : ?>
                                                <?php foreach ($chapter['content'] as $content) : ?>
                                                    <li class="list-group-item d-flex align-items-center border-0 bg-transparent px-2 py-2">
                                                        <i class="bi bi-play-circle me-3 text-primary"></i>
                                                        <?= esc((string)$content) ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-light border small text-muted">Struktur kurikulum belum tersedia.</div>
                    <?php endif; ?>
                </div>

                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Fasilitas Penunjang</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <?php if (!empty($program['facilities']) && is_array($program['facilities'])) : ?>
                            <?php foreach ($program['facilities'] as $facility) : ?>
                                <span class="badge rounded-pill border text-dark p-2 px-3 bg-white shadow-sm">
                                    <i class="bi bi-building-check me-2 text-primary"></i><?= esc((string)$facility) ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card sticky-card shadow-lg border-0">
                    <div class="program-img-container">
                        <img src="<?= base_url('uploads/programs/' . (string)$program['thumbnails']) ?>"
                            alt="<?= esc((string)$program['title']) ?>">
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-2">
                            <span class="text-muted small">Investasi Program:</span>
                            <h2 class="fw-bold text-primary mb-0">IDR <?= number_format($program['tuition'], 0, ',', '.') ?></h2>
                        </div>
                        <p class="text-muted small mb-4">
                            <i class="bi bi-info-circle me-1"></i> Biaya pendaftaran: IDR <?= number_format($program['registrationfee'], 0, ',', '.') ?>
                        </p>

                        <a href="<?= base_url('daftar/' . $program['id']) ?>" class="btn btn-primary w-100 py-3 fw-bold shadow-sm mb-3">DAFTAR SEKARANG</a>

                        <div class="text-center">
                            <p class="small text-muted mb-2">Butuh konsultasi program?</p>
                            <a href="https://wa.me/6289509778659?text=Halo%20Admin,%20saya%20ingin%20tanya%20tentang%20program%20<?= rawurlencode((string)$program['title']) ?>"
                                target="_blank"
                                class="btn btn-outline-success btn-sm w-100 fw-bold py-2">
                                <i class="bi bi-whatsapp me-2"></i> Tanya Admin via WhatsApp
                            </a>
                        </div>

                        <div class="mt-4 pt-4 border-top">
                            <?php if (auth()->loggedIn()): ?>
                                <?php if (auth()->user()->inGroup('superadmin', 'admin')): ?>
                                    <div class="d-flex gap-2">
                                        <a href="<?= base_url('programs/edit/' . (string)$program['id']) ?>"
                                            class="btn btn-light btn-sm flex-grow-1 border">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <a href="<?= base_url('programs/delete/' . (string)$program['id']) ?>"
                                            class="btn btn-outline-danger btn-sm px-3"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>