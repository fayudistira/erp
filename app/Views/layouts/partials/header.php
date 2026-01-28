<header class="glass-nav dark:glass-nav-dark sticky top-0 z-40">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center">
            <button
                id="sidebarCollapse"
                class="lg:hidden text-gray-700 dark:text-gray-300 focus:outline-none mr-4 glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="relative w-64 hidden md:block">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm"></i>
                <input
                    type="text"
                    placeholder="Search students, classes..."
                    class="w-full pl-10 pr-3 py-2.5 glass-card dark:glass-card-dark border-transparent rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:focus:ring-red-800/30 outline-none transition text-sm" />
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <button
                onclick="toggleTheme()"
                class="glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-red-600 transition-colors">
                <i class="fa-solid fa-moon" id="theme-icon"></i>
            </button>
            <button
                class="relative glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-red-600 transition-colors"
                onclick="showToast('You have 3 new notifications')">
                <i class="fa-regular fa-bell"></i>
                <span
                    class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white dark:border-gray-900 flex items-center justify-center text-xs text-white font-bold">3</span>
            </button>
            <div class="relative group">
                <img
                    src="https://picsum.photos/seed/adminUser/100/100.jpg"
                    alt="Profile"
                    class="w-10 h-10 rounded-full object-cover cursor-pointer border-2 border-yellow-300"
                    onclick="showToast('Profile clicked')" />
                <div
                    class="absolute -bottom-1 -right-1 glass-card dark:glass-card-dark w-5 h-5 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>
    </div>
</header>