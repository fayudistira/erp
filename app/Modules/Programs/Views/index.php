<?= $this->extend('layouts/dasboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1"><?= $title ?></h4>
        <p class="text-muted small mb-0">Kelola dan pantau semua program pendidikan yang tersedia.</p>

        <div class="btn-group mt-3 shadow-sm">
            <a href="<?= base_url('programs?status=active') ?>" class="btn btn-sm <?= ($status !== 'deleted') ? 'btn-primary' : 'btn-outline-primary' ?>">
                <i class="bi bi-check-circle me-1"></i> Aktif
            </a>
            <a href="<?= base_url('programs?status=deleted') ?>" class="btn btn-sm <?= ($status === 'deleted') ? 'btn-danger' : 'btn-outline-danger' ?>">
                <i class="bi bi-trash me-1"></i> Sampah (Trash)
            </a>
        </div>
    </div>

    <div class="d-flex gap-2">
        <?php if ($status !== 'deleted'): ?>
            <button type="button" class="btn btn-outline-success btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="bi bi-file-earmark-spreadsheet me-1"></i> Bulk Import CSV
            </button>

            <a href="<?= base_url('programs/create') ?>" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Program Baru
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-dark">
                    <tr>
                        <th class="ps-4" style="width: 120px;">Thumbnail</th>
                        <th>Informasi Program</th>
                        <th>Biaya (IDR)</th>
                        <th>Fasilitas & Fitur</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($programs)) : ?>
                        <?php foreach ($programs as $item) : ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="program-img-container shadow-sm border rounded overflow-hidden" style="width: 100px; height: 65px; background: #f8f9fa;">
                                        <?php if ($item['thumbnails']): ?>
                                            <img src="<?= base_url('uploads/programs/' . (string)$item['thumbnails']) ?>" alt="Thumb" style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="text-muted d-flex align-items-center justify-content-center h-100 small" style="font-size: 10px;">
                                                No Image
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-info text-info mb-1" style="background-color: #e0f2fe;"><?= esc($item['category']) ?></span><br>
                                    <strong class="text-dark d-block"><?= esc($item['title']) ?></strong>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <?= esc($item['language']) ?> • <?= esc($item['classtype']) ?> • <?= esc($item['duration']) ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold text-success"><?= number_format($item['tuition'], 0, ',', '.') ?></div>
                                    <small class="text-muted" style="font-size: 0.75rem;">Regis: <?= number_format($item['registrationfee'], 0, ',', '.') ?></small>
                                </td>
                                <td>
                                    <div style="max-width: 250px;">
                                        <small class="d-block text-truncate">
                                            <strong>Fas:</strong> <?= (isset($item['facilities']) && is_array($item['facilities'])) ? esc(implode(', ', $item['facilities'])) : '-' ?>
                                        </small>
                                        <small class="d-block text-truncate text-muted">
                                            <strong>Fit:</strong> <?= (isset($item['features']) && is_array($item['features'])) ? esc(implode(', ', $item['features'])) : '-' ?>
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group shadow-sm">
                                        <?php if ($status === 'deleted') : ?>
                                            <a href="<?= base_url('programs/restore/' . $item['id']) ?>" class="btn btn-white btn-sm border text-success" title="Restore Data">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Restore
                                            </a>
                                            <a href="<?= base_url('programs/purge/' . $item['id']) ?>" class="btn btn-white btn-sm border text-danger" title="Hapus Permanen"
                                                onclick="return confirm('Hapus permanen program ini? Data tidak bisa dikembalikan!')">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('programs/show/' . $item['id']) ?>" class="btn btn-white btn-sm border" title="Lihat Detail"><i class="bi bi-eye text-primary"></i></a>
                                            <a href="<?= base_url('programs/edit/' . $item['id']) ?>" class="btn btn-white btn-sm border" title="Edit"><i class="bi bi-pencil-square text-warning"></i></a>
                                            <a href="<?= base_url('programs/delete/' . $item['id']) ?>"
                                                class="btn btn-white btn-sm border"
                                                title="Pindahkan ke Sampah"
                                                onclick="return confirm('Pindahkan program ini ke folder sampah?')">
                                                <i class="bi bi-trash text-danger"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x display-4 d-block mb-2 text-light"></i>
                                Tidak ada data program <?= ($status === 'deleted') ? 'di tempat sampah' : '' ?>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('programs/bulkUpload') ?>" method="post" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
            <?= csrf_field() ?>
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-upload me-2"></i>Bulk Import Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase">File CSV</label>
                    <input type="file" name="file_csv" class="form-control" accept=".csv" required>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="text-muted">Format: .csv (Comma Separated)</small>
                        <a href="<?= base_url('programs/downloadTemplate') ?>" class="small text-decoration-none fw-bold text-success">
                            <i class="bi bi-download"></i> Download Template
                        </a>
                    </div>
                </div>

                <div class="card bg-light border-0 rounded-3">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-2 small"><i class="bi bi-info-circle-fill me-1 text-primary"></i>Panduan:</h6>
                        <ul class="mb-0 ps-3 small text-muted" style="line-height: 1.6; font-size: 0.75rem;">
                            <li><strong>Kolom Dinamis:</strong> Gunakan <code>|</code> untuk memisahkan item (Fasilitas/Fitur).</li>
                            <li><strong>Struktur Kurikulum:</strong> <code>Bab: Materi; Materi | Bab2: Materi</code>.</li>
                            <li><strong>Harga:</strong> Hanya angka tanpa simbol Rp atau titik.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-sm px-4">Proses Import</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>