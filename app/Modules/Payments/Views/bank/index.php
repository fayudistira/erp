<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold">Manajemen Bank</h1>
        <nav class="flex space-x-4 mt-4" aria-label="Tabs">
            <button onclick="switchTab('active', this)" class="tab-btn active-tab px-3 py-2 font-medium text-sm rounded-md bg-blue-100 text-blue-700" id="tab-active">
                Rekening Aktif
            </button>
            <button onclick="switchTab('trash', this)" class="tab-btn px-3 py-2 font-medium text-sm text-gray-500 hover:text-gray-700 rounded-md" id="tab-trash">
                Tong Sampah
            </button>
        </nav>
    </div>
    <button onclick="openAddModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        <i class="fas fa-plus mr-2"></i> Tambah Bank
    </button>
</div>

<div class="glass-card dark:glass-card-dark overflow-hidden shadow-xl rounded-xl">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 dark:bg-gray-800/50 text-gray-600 dark:text-gray-400">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold uppercase">Logo</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase">Bank & Atas Nama</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase">Rekening</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-center">Status</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-center">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-content" class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr id="loading-row">
                <td colspan="4" class="p-10 text-center">Memuat data...</td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->include('Modules\Payments\Views\bank\partials\_modal') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let currentType = 'active';

    // Panggil data pertama kali saat halaman load
    document.addEventListener('DOMContentLoaded', () => {
        loadData('active');
    });

    function switchTab(type, el) {
        // Reset style tab
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-100', 'text-blue-700');
            btn.classList.add('text-gray-500');
        });
        // Set active style
        el.classList.add('bg-blue-100', 'text-blue-700');
        el.classList.remove('text-gray-500');

        loadData(type);
    }

    function loadData(type) {
        currentType = type;
        const container = document.getElementById('table-content');
        container.innerHTML = '<tr><td colspan="4" class="p-10 text-center"><i class="fas fa-spinner fa-spin mr-2"></i>Memuat...</td></tr>';

        fetch(`<?= base_url('banks/fetch') ?>/${type}`)
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(err => {
                container.innerHTML = '<tr><td colspan="4" class="p-10 text-center text-red-500">Gagal memuat data.</td></tr>';
            });
    }

    // Fungsi delete via AJAX agar tidak reload
    function deleteBank(id) {
        if (confirm('Pindahkan ke sampah?')) {
            fetch(`<?= base_url('banks/delete') ?>/${id}`)
                .then(() => {
                    loadData(currentType); // Refresh tabel
                    showToast('Berhasil dihapus');
                });
        }
    }

    function restoreBank(id) {
        fetch(`<?= base_url('banks/restore') ?>/${id}`)
            .then(() => {
                loadData(currentType); // Refresh tabel
                showToast('Berhasil dipulihkan');
            });
    }
</script>
<?= $this->endSection() ?>