<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $title ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Bank</li>
    </ol>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <div>
                <i class="fas fa-university me-1"></i>
                Daftar Rekening Pembayaran
            </div>
            <div>
                <a href="<?= base_url('banks/trash') ?>" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-trash-restore"></i> Sampah
                </a>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalBank">
                    <i class="fas fa-plus"></i> Tambah Bank
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Logo</th>
                            <th>Nama Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Pemilik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banks as $bank) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('uploads/images/' . ($bank['bank_logo'] ?: 'default.png')) ?>"
                                        alt="Logo" style="height: 30px; width: auto; object-fit: contain;">
                                </td>
                                <td class="fw-bold"><?= esc($bank['bank_name']) ?></td>
                                <td><code><?= esc($bank['account_number']) ?></code></td>
                                <td><?= esc($bank['account_holder']) ?></td>
                                <td>
                                    <span class="badge <?= $bank['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $bank['is_active'] ? 'Aktif' : 'Non-Aktif' ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white btn-edit"
                                        data-id="<?= $bank['id'] ?>"
                                        data-name="<?= $bank['bank_name'] ?>"
                                        data-number="<?= $bank['account_number'] ?>"
                                        data-holder="<?= $bank['account_holder'] ?>"
                                        data-active="<?= $bank['is_active'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('banks/delete/' . $bank['id']) ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Pindahkan ke tempat sampah?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('banks/store') ?>" method="POST" enctype="multipart/form-data" id="formBank">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Bank Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Bank</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Contoh: BNI" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Rekening</label>
                        <input type="text" name="account_number" id="account_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Pemilik (A/N)</label>
                        <input type="text" name="account_holder" id="account_holder" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Logo Bank</label>
                        <input type="file" name="bank_logo" class="form-control" accept="image/*">
                        <small class="text-muted italic">Format: PNG/JPG/SVG. Kosongkan jika tidak ingin mengubah logo.</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <label class="form-check-label">Status Aktif</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Logika Ganti Mode Tambah ke Edit
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            $('#modalTitle').text('Edit Data Bank');
            $('#formBank').attr('action', '<?= base_url('banks/update') ?>/' + id);

            $('#bank_name').val($(this).data('name'));
            $('#account_number').val($(this).data('number'));
            $('#account_holder').val($(this).data('holder'));
            $('#is_active').prop('checked', $(this).data('active') == 1);

            $('#modalBank').modal('show');
        });

        // Reset modal saat ditutup
        $('#modalBank').on('hidden.bs.modal', function() {
            $('#formBank').attr('action', '<?= base_url('banks/store') ?>');
            $('#modalTitle').text('Tambah Bank Baru');
            $('#formBank')[0].reset();
        });
    });
</script>
<?= $this->endSection() ?>