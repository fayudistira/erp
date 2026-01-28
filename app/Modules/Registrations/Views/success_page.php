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
        border-color: #ffc107;
        /* Sesuaikan dengan primary-yellow */
        background-color: #fff !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .step-number {
        width: 30px;
        height: 30px;
        background: #ffc107;
        color: #000;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-copy {
        font-size: 0.75rem;
        padding: 2px 8px;
        text-decoration: none;
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
                                    <button onclick="copyToClipboard('invoiceNumber', 'Nomor Invoice')" class="btn btn-sm btn-outline-secondary ms-2 btn-copy">
                                        <i class="far fa-copy"></i> Copy
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Program:</span>
                                <span class="fw-bold text-end"><?= esc($program['title']) ?></span>
                            </div>
                            <hr>
                            <?php if (!empty($invoice['invoice_items'])): ?>
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
                                <span class="h4 mb-0 fw-bold text-warning">Rp <?= number_format($invoice['total_amount'] ?? 0, 0, ',', '.') ?></span>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <a href="<?= base_url('daftar/invoice-pdf/' . $registration['id']) ?>" target="_blank" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-download me-1"></i> Unduh PDF
                            </a>
                        </div>
                    </div>

                    <div class="text-start">
                        <h5 class="fw-bold mb-4"><i class="fas fa-university me-2"></i>Instruksi Pembayaran</h5>

                        <?php if (!empty($bankAccounts)): ?>
                            <?php foreach ($bankAccounts as $index => $bank): ?>
                                <div class="bank-card mb-4 bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-3 col-md-2">
                                            <?php
                                            // Logika mapping logo bank lokal
                                            $bankKey = strtoupper($bank['bank']);
                                            $logoMap = [
                                                'BNI'     => 'bank.png', // Sesuai permintaan anda ke public/uploads/images/bank.png
                                                'BCA'     => 'bca.png',
                                                'MANDIRI' => 'mandiri.png',
                                                'BRI'     => 'bri.png'
                                            ];
                                            $logoName = $logoMap[$bankKey] ?? 'default_bank.png';
                                            ?>
                                            <img src="<?= base_url('uploads/images/' . $logoName) ?>"
                                                class="img-fluid"
                                                alt="<?= esc($bank['bank']) ?>"
                                                onerror="this.src='https://via.placeholder.com/100x50?text=BANK'">
                                        </div>
                                        <div class="col-9 col-md-10">
                                            <small class="text-muted d-block"><?= esc($bank['bank']) ?></small>
                                            <div class="d-flex align-items-center">
                                                <h4 class="fw-bold mb-0" id="bankAcc_<?= $index ?>"><?= esc($bank['number'] ?? '') ?></h4>
                                                <button onclick="copyToClipboard('bankAcc_<?= $index ?>', 'Nomor Rekening')" class="btn btn-link text-primary p-0 ms-3 btn-copy">
                                                    <i class="far fa-copy"></i> Salin
                                                </button>
                                            </div>
                                            <small class="fw-bold">A/N <?= esc($bank['name'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">Informasi rekening bank belum tersedia.</div>
                        <?php endif; ?>

                        <div class="payment-steps small text-muted">
                            <div class="mb-2"><span class="step-number">1</span> Transfer sesuai nominal hingga 3 digit terakhir.</div>
                            <div class="mb-2"><span class="step-number">2</span> Sertakan No. Invoice <strong id="invText"><?= esc($invoice['invoice_number']) ?></strong> di berita transfer.</div>
                            <div class="mb-2"><span class="step-number">3</span> Simpan atau foto bukti transfer Anda.</div>
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
                                <?php $whatsappMessage = urlencode("Halo Admin, saya ingin konfirmasi pembayaran Invoice: " . $invoice['invoice_number']); ?>
                                <a href="https://wa.me/<?= esc($whatsappAdmin) ?>?text=<?= $whatsappMessage ?>" class="btn btn-success w-100 btn-lg rounded-pill" target="_blank">
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
    /**
     * Fungsi universal untuk menyalin teks ke clipboard
     * @param {string} elementId - ID dari elemen yang teksnya akan diambil
     * @param {string} label - Nama label untuk notifikasi (misal: 'Nomor Rekening')
     */
    function copyToClipboard(elementId, label) {
        const text = document.getElementById(elementId).innerText;

        if (navigator.clipboard && window.isSecureContext) {
            // Navigator clipboard API
            navigator.clipboard.writeText(text).then(() => {
                showToast(label + ' berhasil disalin!');
            });
        } else {
            // Fallback untuk browser lama atau koneksi non-HTTPS
            let textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showToast(label + ' berhasil disalin!');
            } catch (err) {
                console.error('Gagal menyalin', err);
            }
            document.body.removeChild(textArea);
        }
    }

    // Fungsi sederhana untuk menggantikan alert agar tidak mengganggu user
    function showToast(message) {
        // Anda bisa mengganti ini dengan library SweetAlert2 atau Toastr
        alert(message);
    }
</script>
<?= $this->endSection() ?>