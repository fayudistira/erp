<header class="glass-nav dark:glass-nav-dark sticky top-0 z-40 border-b border-white/20 dark:border-white/5">
    <div class="flex items-center justify-between h-16 px-6">

        <div class="flex items-center gap-4">
            <button id="sidebarCollapse"
                class="lg:hidden text-gray-900 dark:text-white glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center border border-white/20">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="relative w-64 hidden md:block">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-900 dark:text-gray-100 text-sm"></i>
                <input type="text" placeholder="Search..."
                    class="w-full pl-10 pr-3 py-2.5 glass-card dark:glass-card-dark border border-white/20 rounded-xl focus:border-red-500 outline-none text-sm text-gray-900 dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400" />
            </div>
        </div>

        <div class="flex items-center space-x-3">

            <button onclick="toggleTheme()"
                class="w-10 h-10 flex items-center justify-center rounded-xl glass-card dark:glass-card-dark border border-white/20 shadow-sm transition-all group">
                <i id="theme-icon" class="fa-solid fa-moon text-gray-900 dark:text-yellow-400 text-base group-hover:text-red-600"></i>
            </button>

            <button class="relative glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 group"
                onclick="showToast('You have 3 new notifications')">
                <i class="fa-regular fa-bell text-gray-900 dark:text-white text-base group-hover:text-red-600"></i>
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-600 rounded-full border-2 border-white dark:border-gray-900 flex items-center justify-center text-[10px] text-white font-black shadow-lg">3</span>
            </button>

            <div class="flex items-center gap-3 pl-4 ml-2 border-l border-gray-400/20">
                <div class="hidden sm:block text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest text-red-600 dark:text-red-500 leading-none mb-1">Administrator</p>
                    <p class="text-xs font-bold text-gray-900 dark:text-white leading-none">Crimson User</p>
                </div>
                <div class="relative group">
                    <img src="https://picsum.photos/seed/adminUser/100/100.jpg"
                        class="w-10 h-10 rounded-xl object-cover border-2 border-red-600 shadow-lg shadow-red-500/20" />
                </div>
            </div>
        </div>
    </div>
</header>