<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('style') ?>
<style>
    .success-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .invoice-box {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        border: 1px dashed #dee2e6;
    }

    .bank-card {
        border: 2px solid #eee;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s;
    }

    .bank-card:hover {
        border-color: var(--primary-yellow);
    }

    .step-number {
        width: 30px;
        height: 30px;
        background: var(--primary-yellow);
        color: #000;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="success-card shadow-lg bg-white">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-5x"></i>
                    </div>

                    <h2 class="fw-bold mb-2">Pendaftaran Berhasil!</h2>
                    <p class="text-muted">Nomor Registrasi Anda: <span class="fw-bold text-dark"><?= esc($registration['reg_num']) ?></span></p>

                    <div class="alert alert-info py-2 d-inline-block">
                        <span class="status-badge bg-warning text-dark">Menunggu Pembayaran</span>
                    </div>

                    <hr class="my-5">

                    <div class="text-start mb-5">
                        <h5 class="fw-bold mb-4"><i class="fas fa-file-invoice-dollar me-2"></i>Ringkasan Tagihan</h5>
                        <div class="invoice-box">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Nomor Invoice:</span>
                                <div>
                                    <span id="invoiceNumber" class="fw-bold"><?= esc($invoice['invoice_number']) ?></span>
                                    <button onclick="copyInvoice()" class="btn btn-sm btn-outline-secondary ms-2">
                                        Copy
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Program:</span>
                                <span class="fw-bold text-end"><?= esc($program['title']) ?></span>
                            </div>
                            <hr>
                            <?php if (isset($invoice['invoice_items']) && is_array($invoice['invoice_items'])): ?>
                                <?php foreach ($invoice['invoice_items'] as $item): ?>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span><?= esc($item['desc'] ?? '') ?></span>
                                        <span>Rp <?= number_format($item['amount'] ?? 0, 0, ',', '.') ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Total Bayar:</span>
                                <span class="h4 mb-0 fw-bold text-primary-yellow">Rp <?= number_format($invoice['total_amount'] ?? 0, 0, ',', '.') ?></span>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <a href="<?= base_url('daftar/invoice-pdf/' . $registration['id']) ?>"
                                target="_blank"
                                class="btn btn-outline-dark btn-sm">
                                Unduh PDF
                            </a>
                        </div>

                    </div>

                    <div class="text-start">
                        <h5 class="fw-bold mb-4"><i class="fas fa-university me-2"></i>Instruksi Pembayaran</h5>

                        <?php if (!empty($bankAccounts)): ?>
                            <?php foreach ($bankAccounts as $bank): ?>
                                <div class="bank-card mb-4 bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-3 col-md-2">
                                            <?php
                                            $bankLogo = '';
                                            switch (strtoupper($bank['bank'])) {
                                                case 'BCA':
                                                    $bankLogo = 'https://upload.wikimedia.org/wikipedia/id/thumb/e/e0/BCA_logo.svg/1280px-BCA_logo.svg.png';
                                                    break;
                                                case 'MANDIRI':
                                                    $bankLogo = 'https://upload.wikimedia.org/wikipedia/id/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1280px-Bank_Mandiri_logo_2016.svg.png';
                                                    break;
                                                case 'BNI':
                                                    $bankLogo = 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1280px-BNI_logo.svg.png';
                                                    break;
                                                case 'BRI':
                                                    $bankLogo = 'https://upload.wikimedia.org/wikipedia/id/thumb/5/5e/Bank_BRI_logo_2022.svg/1280px-Bank_BRI_logo_2022.svg.png';
                                                    break;
                                            }
                                            ?>
                                            <?php if ($bankLogo): ?>
                                                <img src="<?= esc($bankLogo) ?>" class="img-fluid" alt="<?= esc($bank['bank']) ?>">
                                            <?php else: ?>
                                                <div class="bg-dark text-white p-2 rounded text-center">
                                                    <?= esc(substr($bank['bank'], 0, 3)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-9 col-md-10">
                                            <small class="text-muted d-block"><?= esc($bank['bank']) ?></small>
                                            <h4 class="fw-bold mb-0"><?= esc($bank['number'] ?? '') ?></h4>
                                            <small class="fw-bold">A/N <?= esc($bank['name'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                Informasi rekening bank belum tersedia. Silakan hubungi admin.
                            </div>
                        <?php endif; ?>

                        <div class="payment-steps small text-muted">
                            <div class="mb-2"><span class="step-number">1</span> Transfer sesuai nominal hingga 3 digit terakhir (jika ada).</div>
                            <div class="mb-2"><span class="step-number">2</span> Sertakan Nomor Invoice <strong><?= esc($invoice['invoice_number']) ?></strong> di berita transfer.</div>
                            <div class="mb-2"><span class="step-number">3</span> Foto bukti transfer Anda.</div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-dark w-100 btn-lg rounded-pill">
                                    <i class="fas fa-user-circle me-2"></i>Halaman Saya
                                </a>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $whatsappMessage = urlencode("Konfirmasi Invoice " . $invoice['invoice_number']);
                                ?>
                                <a href="https://wa.me/<?= esc($whatsappAdmin) ?>?text=<?= $whatsappMessage ?>"
                                    class="btn btn-success w-100 btn-lg rounded-pill"
                                    target="_blank">
                                    <i class="fab fa-whatsapp me-2"></i>Konfirmasi WA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-muted mt-4 small">
                Butuh bantuan? Hubungi kami di <a href="mailto:support@kursus.com">support@kursus.com</a>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    function copyInvoice() {
        const text = document.getElementById('invoiceNumber').innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor invoice disalin');
        });
    }
</script>
<?= $this->endSection() ?>