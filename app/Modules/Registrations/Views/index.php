<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">Registration List</h5>
            <div class="text-muted small">Total: <?= count($registrations) ?> Students</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Student & Reg Num</th>
                            <th>Program</th>
                            <th>Batch Details</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($registrations)): ?>
                            <?php foreach ($registrations as $reg): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= esc((string)($reg['student_name'] ?? 'Guest/User')) ?></div>
                                        <code class="small text-primary"><?= esc((string)$reg['reg_num']) ?></code>
                                    </td>
                                    <td>
                                        <span class="text-secondary"><?= esc((string)($reg['program_name'] ?? 'N/A')) ?></span>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <i class="far fa-calendar-alt text-muted me-1"></i>
                                            <?= esc((string)($reg['start_date'] ?? 'TBA')) ?>
                                            <span class="text-muted ms-1">(Batch <?= esc((string)($reg['batch'] ?? '1')) ?>)</span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $status = (string)$reg['status'];
                                        $badgeClass = match ($status) {
                                            'active'  => 'success',
                                            'pending' => 'warning',
                                            'expired' => 'danger',
                                            default   => 'secondary'
                                        };
                                        ?>
                                        <span class="badge rounded-pill bg-<?= $badgeClass ?>">
                                            <?= strtoupper(esc($status)) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= date('d M Y', strtotime($reg['created_at'])) ?></small>
                                    </td>
                                    <td class="text-center pe-3">
                                        <div class="btn-group shadow-sm">
                                            <a href="<?= base_url('daftar/success/' . $reg['id']) ?>" class="btn btn-sm btn-light border" title="View Detail">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                            <a href="<?= base_url('daftar/invoice-pdf/' . $reg['id']) ?>" class="btn btn-sm btn-light border text-danger" target="_blank" title="Invoice PDF">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-muted mb-0">No registration records found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>