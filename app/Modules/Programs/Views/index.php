<?= $this->extend('layouts/dashboards/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
    <div class="flex p-1 bg-gray-200/50 dark:bg-gray-800/50 backdrop-blur-md rounded-xl border border-gray-200 dark:border-gray-700">
        <a href="<?= base_url('programs?status=active') ?>"
            class="px-5 py-2 rounded-lg text-xs font-bold transition-all <?= ($status !== 'deleted') ? 'bg-white dark:bg-gray-700 text-red-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' ?>">
            AKTIF
        </a>
        <a href="<?= base_url('programs?status=deleted') ?>"
            class="px-5 py-2 rounded-lg text-xs font-bold transition-all <?= ($status === 'deleted') ? 'bg-white dark:bg-gray-700 text-red-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' ?>">
            SAMPAH
        </a>
    </div>

    <div class="flex items-center gap-3">
        <?php if ($status !== 'deleted'): ?>
            <button type="button"
                class="hidden sm:inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-xl text-xs font-bold uppercase tracking-widest text-gray-700 dark:text-gray-200 bg-white/50 dark:bg-gray-800/50 hover:bg-gray-50 transition-all shadow-sm"
                data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fa-solid fa-file-csv mr-2 text-red-600"></i> Import
            </button>

            <a href="<?= base_url('programs/create') ?>"
                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-md shadow-red-600/20 transition-all">
                <i class="fa-solid fa-plus mr-2"></i> Tambah
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="glass-card dark:glass-card-dark border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-100 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-800/30">
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Media</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Program & Detail</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Investment</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Curriculum Fit</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400 text-center">Manage</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                <?php if ($programs): foreach ($programs as $item): ?>
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="relative w-20 h-12 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                    <?php if (!empty($item['thumbnails'])): ?>
                                        <img src="<?= base_url('uploads/programs/' . esc($item['thumbnails'])) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                            <i class="fa-solid fa-camera text-gray-300"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-1 group-hover:text-red-600 transition-colors uppercase tracking-tight"><?= esc($item['title']) ?></h3>
                                <div class="flex items-center gap-2 text-[10px] font-bold text-gray-500 uppercase">
                                    <span class="text-red-600"><?= esc($item['language']) ?></span>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <span><?= esc($item['classtype']) ?></span>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <span><i class="fa-regular fa-clock mr-1"></i><?= esc($item['duration']) ?></span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-gray-900 dark:text-gray-100 font-black text-sm">
                                    IDR <?= number_format($item['tuition'], 0, ',', '.') ?>
                                </div>
                                <div class="text-[10px] text-gray-400 font-medium mt-0.5 uppercase tracking-tighter">
                                    Registration Fee: IDR <?= number_format($item['registrationfee'], 0, ',', '.') ?>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="max-w-[180px]">
                                    <p class="text-[10px] leading-tight text-gray-500 truncate mb-1">
                                        <span class="text-gray-700 dark:text-gray-300 font-bold mr-1">FAS:</span>
                                        <?= is_array($item['facilities']) ? esc(implode(', ', $item['facilities'])) : '-' ?>
                                    </p>
                                    <p class="text-[10px] leading-tight text-gray-500 truncate">
                                        <span class="text-gray-700 dark:text-gray-300 font-bold mr-1">FIT:</span>
                                        <?= is_array($item['features']) ? esc(implode(', ', $item['features'])) : '-' ?>
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-1">
                                    <?php if ($status === 'deleted'): ?>
                                        <form action="<?= base_url('programs/restore/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-all">
                                                <i class="fa-solid fa-arrow-rotate-left text-xs"></i>
                                            </button>
                                        </form>
                                        <form action="<?= base_url('programs/purge/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all" onclick="return confirm('Hapus permanen?')">
                                                <i class="fa-solid fa-skull text-xs"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <a href="<?= base_url('programs/show/' . $item['id']) ?>" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                        </a>
                                        <a href="<?= base_url('programs/edit/' . $item['id']) ?>" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-all">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <form action="<?= base_url('programs/delete/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all" onclick="return confirm('Pindahkan ke sampah?')">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-24 text-center">
                            <i class="fa-solid fa-folder-open text-3xl text-gray-200 dark:text-gray-700 mb-3"></i>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Database Kosong</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
</div>

<?= $this->endSection() ?>