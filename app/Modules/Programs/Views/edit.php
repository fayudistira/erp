<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <form action="<?= base_url('programs/update/' . $program['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Informasi Dasar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Program</label>
                            <input type="text" name="title" class="form-control" value="<?= esc($program['title']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4"><?= esc($program['description']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Fitur (1 per baris)</label>
                                <textarea name="features" class="form-control" rows="4"><?= is_array($program['features']) ? implode("\n", $program['features']) : '' ?></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Fasilitas (1 per baris)</label>
                                <textarea name="facilities" class="form-control" rows="4"><?= is_array($program['facilities']) ? implode("\n", $program['facilities']) : '' ?></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2 text-primary"></i>Struktur Kurikulum</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addChapter()">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Chapter
                            </button>
                        </div>

                        <div id="curriculum-container">
                            <?php if (!empty($program['curriculum']) && is_array($program['curriculum'])) : ?>
                                <?php foreach ($program['curriculum'] as $index => $curr) : ?>
                                    <div class="card border-light bg-light mb-3 chapter-item">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex">
                                                <input type="text" name="curriculum[<?= $index ?>][chapter]" class="form-control form-control-sm me-2 fw-bold" value="<?= esc($curr['chapter']) ?>" required>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.chapter-item').remove()">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <textarea name="curriculum[<?= $index ?>][content]" class="form-control form-control-sm bg-white" rows="3"><?= is_array($curr['content']) ? implode("\n", $curr['content']) : '' ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Bahasa</label>
                            <select name="language" class="form-select">
                                <?php $langs = ['Inggris', 'Mandarin', 'Jepang', 'Korea', 'Jerman']; ?>
                                <?php foreach ($langs as $l) : ?>
                                    <option value="<?= $l ?>" <?= $program['language'] == $l ? 'selected' : '' ?>><?= $l ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Kategori</label>
                            <select name="category" class="form-select">
                                <?php $cats = ['Reguler', 'Privat', 'Paket']; ?>
                                <?php foreach ($cats as $c) : ?>
                                    <option value="<?= $c ?>" <?= $program['category'] == $c ? 'selected' : '' ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Tipe Kelas</label>
                            <select name="classtype" class="form-select">
                                <option value="Online" <?= $program['classtype'] == 'Online' ? 'selected' : '' ?>>Online</option>
                                <option value="Offline" <?= $program['classtype'] == 'Offline' ? 'selected' : '' ?>>Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Durasi</label>
                            <input type="text" name="duration" class="form-control" value="<?= esc($program['duration']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Biaya Registrasi (IDR)</label>
                            <input type="number" name="registrationfee" class="form-control" value="<?= $program['registrationfee'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Biaya Kursus (IDR)</label>
                            <input type="number" name="tuition" class="form-control" value="<?= $program['tuition'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-primary">Thumbnail</label>
                            <?php if ($program['thumbnails']) : ?>
                                <div class="position-relative mb-2 mt-1">
                                    <img src="<?= base_url('uploads/programs/' . $program['thumbnails']) ?>" class="img-thumbnail rounded shadow-sm" style="max-height: 120px; width: 100%; object-fit: cover;">
                                    <div class="small text-muted mt-1">Gambar saat ini</div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="thumbnails" class="form-control form-control-sm">
                            <div class="form-text text-info small" style="font-size: 0.7rem;">*Kosongkan jika tidak ingin mengubah gambar</div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-warning w-100 py-2 fw-bold shadow-sm">
                            <i class="bi bi-check-circle me-2"></i>UPDATE PROGRAM
                        </button>
                        <a href="<?= base_url('programs') ?>" class="btn btn-link w-100 mt-2 text-muted text-decoration-none small">Batal / Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // chapterIndex dilanjutkan dari jumlah data yang sudah ada
    let chapterIndex = <?= !empty($program['curriculum']) ? count($program['curriculum']) : 0 ?>;

    function addChapter() {
        const container = document.getElementById('curriculum-container');
        const html = `
        <div class="card border-light bg-light mb-3 chapter-item shadow-sm">
            <div class="card-body">
                <div class="mb-2 d-flex">
                    <input type="text" name="curriculum[${chapterIndex}][chapter]" class="form-control form-control-sm me-2 fw-bold" placeholder="Nama Chapter Baru" required>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.chapter-item').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <textarea name="curriculum[${chapterIndex}][content]" class="form-control form-control-sm bg-white" rows="3" placeholder="Isi materi..."></textarea>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        chapterIndex++;
    }
</script>
<?= $this->endSection() ?>