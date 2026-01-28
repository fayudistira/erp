<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar FAQ</h1>
        <a href="<?= base_url('faq/create') ?>" class="btn btn-primary btn-sm">Tambah FAQ</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($faqs as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="font-weight-bold text-dark">
                                        <?= esc($row['question']) ?>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <?= word_limiter(strip_tags($row['answer']), 10) ?>
                                    </small>
                                </td>
                                <td><?= esc($row['category']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $row['status'] == 'publish' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('faq/edit/' . $row['id']) ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('faq/delete/' . $row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>