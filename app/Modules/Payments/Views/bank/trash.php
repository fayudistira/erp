<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Tong Sampah</h1>
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="<?= base_url('banks') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white py-3">
            <i class="fas fa-trash me-1"></i> Data Bank yang Dihapus
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nama Bank</th>
                        <th>No. Rekening</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($banks)): ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data di sampah.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($banks as $bank) : ?>
                        <tr>
                            <td><?= esc($bank['bank_name']) ?></td>
                            <td><?= esc($bank['account_number']) ?></td>
                            <td><?= $bank['deleted_at'] ?></td>
                            <td>
                                <a href="<?= base_url('banks/restore/' . $bank['id']) ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-undo"></i> Pulihkan
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>