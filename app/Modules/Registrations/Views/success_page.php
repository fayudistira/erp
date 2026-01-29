<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-slate-50 py-12 px-4 font-sans">
    <div class="max-w-2xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <a href="<?= base_url('dashboard') ?>" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
            <button onclick="window.print()" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                <i class="fas fa-print mr-1"></i> Cetak Halaman
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100 relative">

            <div class="h-2 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-slate-900 uppercase italic">SOS <span class="text-blue-600">Course</span></h1>
                        <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest font-semibold">Payment Instructions</p>
                    </div>
                    <div class="text-left md:text-right">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse mr-2"></span>
                            Waiting for Payment
                        </span>
                        <p class="text-xs text-slate-400 mt-2 italic">Diterbitkan pada: <?= date('d M Y, H:i') ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8 mb-10">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Ditujukan Untuk</p>
                        <h3 class="font-bold text-slate-800 text-lg"><?= esc($registration['nama_lengkap'] ?? 'Pelanggan') ?></h3>
                        <p class="text-sm text-slate-500">Reg No: <?= esc($registration['reg_num']) ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Nomor Invoice</p>
                        <h3 class="font-mono font-bold text-slate-800 text-lg">#<?= esc($invoice['invoice_number']) ?></h3>
                        <button onclick="copyToClipboard('invoiceNumber', 'Nomor Invoice')" id="invoiceNumber" class="hidden"><?= esc($invoice['invoice_number']) ?></button>
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Detail Program</p>
                    <div class="border border-slate-100 rounded-2xl overflow-hidden">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-3">Deskripsi Tagihan</th>
                                    <th class="px-6 py-3 text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php if (!empty($invoice['invoice_items'])): ?>
                                    <?php foreach ($invoice['invoice_items'] as $item): ?>
                                        <tr>
                                            <td class="px-6 py-4 text-slate-700">
                                                <div class="font-semibold"><?= esc($item['desc']) ?></div>
                                                <div class="text-[10px] text-slate-400 italic">Program: <?= esc($program['title']) ?></div>
                                            </td>
                                            <td class="px-6 py-4 text-right font-mono font-semibold text-slate-700">
                                                Rp <?= number_format($item['amount'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-900 text-white">
                                    <td class="px-6 py-5 font-bold text-lg italic uppercase tracking-tight">Total Amount</td>
                                    <td class="px-6 py-5 text-right font-black text-xl font-mono text-blue-400">
                                        Rp <?= number_format($invoice['total_amount'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-blue-50/50 rounded-2xl p-6 border border-blue-100 mb-10">
                    <h5 class="text-sm font-bold text-blue-900 mb-4 flex items-center">
                        <i class="fas fa-university mr-2"></i> Metode Pembayaran Transfer Bank
                    </h5>
                    <div class="space-y-4">
                        <?php foreach ($bankAccounts as $index => $bank): ?>
                            <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-blue-100">
                                <div class="flex items-center gap-4">
                                    <img src="<?= base_url('uploads/images/' . ($bank['bank_logo'] ?: 'bank.png')) ?>" class="h-6 w-auto grayscale">
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight"><?= esc($bank['bank_name']) ?></p>
                                        <h4 class="font-mono font-bold text-slate-800 tracking-wider" id="bankAcc_<?= $index ?>"><?= esc($bank['account_number']) ?></h4>
                                        <p class="text-[11px] font-medium text-slate-500">A/N <?= esc($bank['account_holder']) ?></p>
                                    </div>
                                </div>
                                <button onclick="copyToClipboard('bankAcc_<?= $index ?>', 'Nomor Rekening')" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-4 flex items-start gap-3 text-[11px] text-blue-700 leading-relaxed italic">
                        <i class="fas fa-info-circle mt-0.5"></i>
                        <p>Mohon transfer tepat sampai 3 digit terakhir untuk memudahkan verifikasi otomatis oleh sistem.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="<?= base_url('daftar/invoice-pdf/' . $registration['id']) ?>"
                        class="flex justify-center items-center px-6 py-4 border border-slate-200 rounded-2xl font-bold text-slate-600 hover:bg-slate-50 transition-all text-sm uppercase tracking-wide">
                        <i class="fas fa-file-pdf mr-2"></i> Download Receipt
                    </a>
                    <?php
                    $custName = $registration['nama_lengkap'] ?? 'Pelanggan';
                    $waMsg = urlencode("Halo Admin SOS Course,\nSaya ingin konfirmasi pembayaran:\n\nNo Invoice: #{$invoice['invoice_number']}\nNama: {$custName}\nTotal: Rp " . number_format($invoice['total_amount'], 0, ',', '.'));
                    ?>
                    <a href="https://wa.me/<?= esc($whatsappAdmin) ?>?text=<?= $waMsg ?>" target="_blank"
                        class="flex justify-center items-center px-6 py-4 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-bold shadow-lg shadow-green-100 transition-all text-sm uppercase tracking-wide">
                        <i class="fab fa-whatsapp mr-2 text-lg"></i> Confirm on WhatsApp
                    </a>
                </div>
            </div>

            <div class="p-6 bg-slate-50 text-center border-t border-slate-100">
                <p class="text-[10px] text-slate-400 font-medium tracking-widest uppercase">Thank you for choosing SOS Course & Training</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function copyToClipboard(elementId, label) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert(label + ' berhasil disalin ke clipboard!');
        });
    }
</script>
<?= $this->endSection() ?>