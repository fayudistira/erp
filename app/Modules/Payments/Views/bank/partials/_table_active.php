<?php foreach ($banks as $bank): ?>
    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
        <td class="px-6 py-4">
            <img src="<?= base_url('uploads/images/' . ($bank['bank_logo'] ?: 'bank.png')) ?>"
                class="h-8 w-auto object-contain rounded" onerror="this.src='https://via.placeholder.com/80x40?text=BANK'">
        </td>
        <td class="px-6 py-4">
            <div class="font-bold text-gray-900 dark:text-white"><?= esc($bank['bank_name']) ?></div>
            <div class="text-xs text-gray-500 italic">A/N: <?= esc($bank['account_holder']) ?></div>
        </td>
        <td class="px-6 py-4">
            <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded text-blue-600 dark:text-blue-400">
                <?= esc($bank['account_number']) ?>
            </span>
        </td>
        <td class="px-6 py-4 text-center">
            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-full <?= $bank['is_active'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= $bank['is_active'] ? 'Aktif' : 'Non-Aktif' ?>
            </span>
        </td>
        <td class="px-6 py-4 text-center">
            <div class="flex justify-center gap-3">
                <button onclick='openEditModal(<?= json_encode($bank) ?>)' class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="deleteBank(<?= $bank['id'] ?>)" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </td>
    </tr>
<?php endforeach; ?>