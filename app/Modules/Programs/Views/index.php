<?= $this->extend('layouts/dasboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1"><?= esc($title) ?></h4>
        <p class="text-muted small mb-0">Kelola dan pantau semua program pendidikan yang tersedia.</p>

        <div class="btn-group mt-3 shadow-sm">
            <a href="<?= base_url('programs?status=active') ?>"
                class="btn btn-sm <?= ($status !== 'deleted') ? 'btn-primary' : 'btn-outline-primary' ?>">
                Aktif
            </a>
            <a href="<?= base_url('programs?status=deleted') ?>"
                class="btn btn-sm <?= ($status === 'deleted') ? 'btn-danger' : 'btn-outline-danger' ?>">
                Sampah
            </a>
        </div>
    </div>

    <?php if ($status !== 'deleted'): ?>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-success btn-sm"
                data-bs-toggle="modal" data-bs-target="#uploadModal">
                Bulk Import CSV
            </button>

            <a href="<?= base_url('programs/create') ?>" class="btn btn-primary btn-sm">
                Tambah Program
            </a>
        </div>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width:120px">Thumbnail</th>
                    <th>Program</th>
                    <th>Biaya</th>
                    <th>Fitur</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($programs): foreach ($programs as $item): ?>
                        <tr>
                            <td>
                                <?php if (!empty($item['thumbnails'])): ?>
                                    <img src="<?= base_url('uploads/programs/' . esc($item['thumbnails'])) ?>"
                                        class="img-fluid rounded" style="max-height:65px">
                                <?php else: ?>
                                    <small class="text-muted">No Image</small>
                                <?php endif; ?>
                            </td>

                            <td>
                                <strong><?= esc($item['title']) ?></strong><br>
                                <small class="text-muted">
                                    <?= esc($item['language']) ?> •
                                    <?= esc($item['classtype']) ?> •
                                    <?= esc($item['duration']) ?>
                                </small>
                            </td>

                            <td>
                                <strong class="text-success">
                                    <?= number_format($item['tuition'], 0, ',', '.') ?>
                                </strong><br>
                                <small class="text-muted">
                                    Regis: <?= number_format($item['registrationfee'], 0, ',', '.') ?>
                                </small>
                            </td>

                            <td>
                                <small>
                                    <strong>Fas:</strong>
                                    <?= is_array($item['facilities']) ? esc(implode(', ', $item['facilities'])) : '-' ?>
                                </small><br>
                                <small class="text-muted">
                                    <strong>Fit:</strong>
                                    <?= is_array($item['features']) ? esc(implode(', ', $item['features'])) : '-' ?>
                                </small>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    <?php if ($status === 'deleted'): ?>

                                        <form action="<?= base_url('programs/restore/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-outline-success"
                                                onclick="return confirm('Restore program ini?')">
                                                Restore
                                            </button>
                                        </form>

                                        <form action="<?= base_url('programs/purge/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus permanen?')">
                                                Purge
                                            </button>
                                        </form>

                                    <?php else: ?>

                                        <a href="<?= base_url('programs/show/' . $item['id']) ?>"
                                            class="btn btn-sm btn-outline-primary">View</a>

                                        <a href="<?= base_url('programs/edit/' . $item['id']) ?>"
                                            class="btn btn-sm btn-outline-warning">Edit</a>

                                        <form action="<?= base_url('programs/delete/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Pindahkan ke sampah?')">
                                                Delete
                                            </button>
                                        </form>

                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            Tidak ada data.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL BULK UPLOAD -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('programs/bulkUpload') ?>" method="post"
            enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Bulk Import CSV</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="file" name="file_csv" class="form-control" required>
                <small class="text-muted d-block mt-2">
                    <a href="<?= base_url('programs/downloadTemplate') ?>">Download Template CSV</a>
                </small>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-sm">Import</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>