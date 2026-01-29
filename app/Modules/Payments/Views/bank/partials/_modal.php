<dialog id="bankModal" class="relative z-50 rounded-2xl p-0 w-full max-w-md shadow-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-white backdrop:bg-black/50 backdrop:backdrop-blur-sm">

    <div class="flex justify-between items-center p-6 border-b border-gray-100 dark:border-gray-800">
        <h3 id="modalTitle" class="text-xl font-bold flex items-center">
            <i class="fas fa-university mr-3 text-blue-600"></i>
            <span>Tambah Bank Baru</span>
        </h3>
        <button onclick="document.getElementById('bankModal').close()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <form id="bankForm" action="<?= base_url('banks/store') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
        <?= csrf_field() ?>

        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Bank</label>
            <input type="text" name="bank_name" id="f_bank_name" required
                placeholder="Contoh: BNI, BCA, BRI"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">No. Rekening</label>
                <input type="text" name="account_number" id="f_account_number" required
                    placeholder="009381xxxx"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>
            <div class="col-span-1">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="is_active" id="f_is_active"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Pemilik (A/N)</label>
            <input type="text" name="account_holder" id="f_account_holder" required
                placeholder="Nama lengkap sesuai buku tabungan"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Logo Bank</label>
            <div class="relative group">
                <input type="file" name="bank_logo" id="f_bank_logo" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/30 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 transition-all cursor-pointer">
            </div>
            <p class="mt-2 text-xs text-gray-400">Rekomendasi ukuran: 200x100px (PNG Transparan)</p>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800 mt-6">
            <button type="button" onclick="document.getElementById('bankModal').close()"
                class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white transition-colors">
                Batal
            </button>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-500/30 transition-all active:scale-95">
                <i class="fas fa-save mr-2"></i> Simpan Rekening
            </button>
        </div>
    </form>
</dialog>

<style>
    /* Styling khusus untuk transisi masuk modal */
    #bankModal[open] {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
</style>