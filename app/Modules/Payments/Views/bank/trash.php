<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('page_actions') ?>
<a href="<?= base_url('banks') ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 transition-colors">
    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Tong Sampah</h1>
    <p class="text-sm text-gray-500">Data rekening yang dihapus sementara (Soft Delete).</p>
</div>

<div class="glass-card dark:glass-card-dark overflow-hidden shadow-xl rounded-xl border border-red-100 dark:border-red-900/30">
    <div class="bg-red-500/10 px-6 py-3 border-b border-red-100 dark:border-red-900/30">
        <span class="text-red-600 dark:text-red-400 font-semibold flex items-center">
            <i class="fas fa-trash-can mr-2"></i> Rekening Terhapus
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 dark:bg-gray-800/50 text-gray-600 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-4 font-semibold uppercase text-xs">Nama Bank</th>
                    <th class="px-6 py-4 font-semibold uppercase text-xs">No. Rekening</th>
                    <th class="px-6 py-4 font-semibold uppercase text-xs text-center">Dihapus Pada</th>
                    <th class="px-6 py-4 font-semibold uppercase text-xs text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php if (empty($banks)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-inbox block text-3xl mb-2 opacity-20"></i>
                            Tidak ada data di tong sampah.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($banks as $bank) : ?>
                        <tr class="hover:bg-red-50/30 dark:hover:bg-red-900/10 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 dark:text-white"><?= esc($bank['bank_name']) ?></div>
                                <div class="text-xs text-gray-500 italic"><?= esc($bank['account_holder']) ?></div>
                            </td>
                            <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">
                                <?= esc($bank['account_number']) ?>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                <?= date('d M Y, H:i', strtotime($bank['deleted_at'])) ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?= base_url('banks/restore/' . $bank['id']) ?>"
                                    class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-md transition-all shadow-sm shadow-green-500/20">
                                    <i class="fas fa-undo mr-1.5"></i> Pulihkan
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-100 dark:border-yellow-900/30">
    <p class="text-xs text-yellow-700 dark:text-yellow-400 flex items-start">
        <i class="fas fa-info-circle mt-0.5 mr-2"></i>
        Data di halaman ini tidak akan muncul di form pendaftaran siswa sebelum dipulihkan.
    </p>
</div>
<?= $this->endSection() ?>