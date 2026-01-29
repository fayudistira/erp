<?php if (empty($banks)): ?>
    <tr>
        <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
            <div class="flex flex-col items-center">
                <i class="fas fa-trash-arrow-up text-3xl mb-2 opacity-20"></i>
                <p>Tong sampah kosong.</p>
            </div>
        </td>
    </tr>
<?php else: ?>
    <?php foreach ($banks as $bank) : ?>
        <tr class="hover:bg-red-50/50 dark:hover:bg-red-900/10 transition-colors border-l-4 border-transparent hover:border-red-400">
            <td class="px-6 py-4 text-center">
                <img src="<?= base_url('uploads/images/' . ($bank['bank_logo'] ?: 'bank.png')) ?>"
                    class="h-8 w-auto mx-auto object-contain rounded opacity-50 grayscale"
                    alt="Logo">
            </td>
            <td class="px-6 py-4">
                <div class="font-bold text-gray-900 dark:text-white"><?= esc($bank['bank_name']) ?></div>
                <div class="text-xs text-gray-500 italic">A/N: <?= esc($bank['account_holder']) ?></div>
            </td>
            <td class="px-6 py-4 font-mono text-gray-400">
                <?= esc($bank['account_number']) ?>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-full bg-gray-100 text-gray-500 opacity-70">
                    <?= $bank['is_active'] ? 'Aktif' : 'Non-Aktif' ?>
                </span>
            </td>
            <td class="px-6 py-4 text-center">
                <div class="flex justify-center gap-2">
                    <button onclick="restoreBank(<?= $bank['id'] ?>)"
                        class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 hover:bg-green-600 hover:text-white text-xs font-semibold rounded transition-all">
                        <i class="fas fa-undo mr-1"></i> Pulihkan
                    </button>

                    <button onclick="forceDeleteBank(<?= $bank['id'] ?>)"
                        class="inline-flex items-center px-3 py-1 bg-gray-100 text-red-600 hover:bg-red-600 hover:text-white text-xs font-semibold rounded transition-all">
                        <i class="fas fa-circle-xmark mr-1"></i> Hapus Permanen
                    </button>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>