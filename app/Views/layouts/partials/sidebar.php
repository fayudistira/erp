<aside
    id="sidebar"
    class="glass-sidebar text-white transition-all duration-300 lg:translate-x-0 -translate-x-full lg:sticky lg:top-0 lg:h-screen lg:w-60 w-60 fixed inset-y-0 left-0 z-50 border-r border-white/10 shadow-2xl">

    <div class="flex items-center h-16 px-6 border-b border-white/10 bg-black/10">
        <div class="relative flex items-center justify-center w-8 h-8 bg-white rounded-lg mr-3 shadow-lg shadow-red-500/20">
            <i class="fa-solid fa-graduation-cap text-red-600 text-base"></i>
            <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-red-700 pulse-animation"></div>
        </div>
        <span class="logo-text text-lg font-black tracking-tighter">SOSCT <span class="text-red-400">ADMIN</span></span>
    </div>

    <nav class="flex-1 px-3 py-6 overflow-y-auto custom-scrollbar">
        <p class="px-4 mb-2 text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Main Menu</p>
        <ul class="space-y-1.5">
            <?php
            // Contoh logika sederhana untuk active link
            $menus = [
                ['name' => 'Dashboard', 'icon' => 'fa-chart-line', 'url' => '#'],
                ['name' => 'Students', 'icon' => 'fa-user-graduate', 'url' => '#'],
                ['name' => 'Teachers', 'icon' => 'fa-chalkboard-user', 'url' => '#'],
                ['name' => 'Courses', 'icon' => 'fa-book-open', 'url' => '#'],
                ['name' => 'Schedule', 'icon' => 'fa-calendar-days', 'url' => '#'],
                ['name' => 'Finance', 'icon' => 'fa-file-invoice-dollar', 'url' => '#'],
            ];

            foreach ($menus as $menu):
            ?>
                <li>
                    <a href="<?= $menu['url'] ?>"
                        class="flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 group border border-transparent hover:border-white/5 active:scale-95">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-white/60 group-hover:text-red-400 transition-colors">
                            <i class="fa-solid <?= $menu['icon'] ?> text-sm"></i>
                        </div>
                        <span class="link-text font-bold text-sm tracking-tight group-hover:translate-x-1 transition-transform"><?= $menu['name'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="p-4 mx-3 mb-4 rounded-2xl border border-white/10 bg-black/20 backdrop-blur-md">
        <div class="flex items-center">
            <div class="relative">
                <img src="https://picsum.photos/seed/adminUser/100/100.jpg"
                    alt="Admin"
                    class="w-10 h-10 rounded-xl object-cover border border-white/20 mr-3" />
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-[#1a0000]"></div>
            </div>
            <div class="user-info overflow-hidden">
                <div class="font-bold text-xs truncate uppercase tracking-wider">Jane Doe</div>
                <div class="text-[10px] text-red-400 font-black uppercase">Super Admin</div>
            </div>
            <button class="ml-auto text-white/40 hover:text-white transition-colors">
                <i class="fa-solid fa-right-from-bracket text-xs"></i>
            </button>
        </div>
    </div>
</aside>