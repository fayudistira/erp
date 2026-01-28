<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <form action="<?= base_url('programs/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi Dasar</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Program</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Mandarin for Business" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan detail program..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Fitur (1 per baris)</label>
                                <textarea name="features" class="form-control" rows="4" placeholder="Sertifikat&#10;Modul Digital&#10;Ujian Akhir"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Fasilitas (1 per baris)</label>
                                <textarea name="facilities" class="form-control" rows="4" placeholder="Ruang AC&#10;WiFi Gratis&#10;Audio Lab"></textarea>
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
                            <div class="card border-light bg-light mb-3 chapter-item">
                                <div class="card-body">
                                    <div class="mb-2 d-flex">
                                        <input type="text" name="curriculum[0][chapter]" class="form-control form-control-sm me-2 fw-bold" placeholder="Nama Chapter (Contoh: Introduction)" required>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.chapter-item').remove()"><i class="bi bi-trash"></i></button>
                                    </div>
                                    <textarea name="curriculum[0][content]" class="form-control form-control-sm bg-white" rows="3" placeholder="Isi materi (Gunakan enter untuk baris baru)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Bahasa</label>
                            <select name="language" class="form-select">
                                <option value="Inggris">Inggris</option>
                                <option value="Mandarin">Mandarin</option>
                                <option value="Jepang">Jepang</option>
                                <option value="Korea">Korea</option>
                                <option value="Jerman">Jerman</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="Reguler">Reguler</option>
                                <option value="Privat">Privat</option>
                                <option value="Paket">Paket</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Tipe Kelas</label>
                            <select name="classtype" class="form-select">
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Durasi</label>
                            <input type="text" name="duration" class="form-control" placeholder="Contoh: 3 Bulan / 24 Sesi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Biaya Registrasi (IDR)</label>
                            <input type="number" name="registrationfee" class="form-control" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Biaya Kursus (IDR)</label>
                            <input type="number" name="tuition" class="form-control" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-primary">Thumbnail Program</label>
                            <input type="file" name="thumbnails" class="form-control form-control-sm">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="bi bi-cloud-arrow-up me-2"></i>SIMPAN PROGRAM
                        </button>
                        <a href="<?= base_url('programs') ?>" class="btn btn-link w-100 mt-2 text-muted text-decoration-none small">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let chapterIndex = 1;

    function addChapter() {
        const container = document.getElementById('curriculum-container');
        const html = `
        <div class="card border-light bg-light mb-3 chapter-item">
            <div class="card-body">
                <div class="mb-2 d-flex">
                    <input type="text" name="curriculum[${chapterIndex}][chapter]" class="form-control form-control-sm me-2 fw-bold" placeholder="Nama Chapter" required>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.chapter-item').remove()"><i class="bi bi-trash"></i></button>
                </div>
                <textarea name="curriculum[${chapterIndex}][content]" class="form-control form-control-sm bg-white" rows="3" placeholder="Isi materi"></textarea>
            </div>
        </div>
    `;
        container.insertAdjacentHTML('beforeend', html);
        chapterIndex++;
    }
</script>
<?= $this->endSection() ?>