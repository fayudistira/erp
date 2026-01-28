<aside
    id="sidebar"
    class="glass-sidebar text-white transition-all duration-300 lg:translate-x-0 -translate-x-full lg:sticky lg:top-0 lg:h-screen lg:w-56 w-56 fixed inset-y-0 left-0 z-50">
    <div class="flex items-center h-16 px-4 border-b border-red-300/30">
        <div class="relative">
            <i
                class="fa-solid fa-graduation-cap text-yellow-300 text-xl mr-3"></i>
            <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-yellow-400 rounded-full pulse-animation"></div>
        </div>
        <span class="logo-text text-lg font-bold tracking-wide">SOSCT</span>
    </div>
    <nav class="flex-1 px-2 py-6 overflow-y-auto">
        <ul class="space-y-1">
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-chart-line text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Dashboard</span>
                </a>
            </li>
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-user-graduate text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Students</span>
                </a>
            </li>
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-chalkboard-user text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Teachers</span>
                </a>
            </li>
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-book-open text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Courses</span>
                </a>
            </li>
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-calendar-days text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Schedule</span>
                </a>
            </li>
            <li>
                <a
                    href="#"
                    class="flex items-center px-3 py-2.5 rounded-xl hover:bg-red-500/30 transition-all duration-300 border border-transparent hover:border-red-300/30 group"
                    onclick="setActive(this)">
                    <div
                        class="glass-card w-8 h-8 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-400/20">
                        <i class="fa-solid fa-file-invoice-dollar text-sm"></i>
                    </div>
                    <span class="link-text font-medium text-sm">Finance</span>
                </a>
            </li>
        </ul>
    </nav>
    <div
        class="p-4 border-t border-red-300/30 flex items-center bg-red-900/20">
        <div class="relative">
            <img
                src="https://picsum.photos/seed/adminUser/100/100.jpg"
                alt="Admin"
                class="w-10 h-10 rounded-full object-cover border-2 border-yellow-300 mr-3" />
            <div
                class="absolute bottom-0 right-3 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white"></div>
        </div>
        <div class="user-info">
            <div class="font-semibold text-sm">Jane Doe</div>
            <div class="text-xs opacity-90">Administrator</div>
        </div>
    </div>
</aside>