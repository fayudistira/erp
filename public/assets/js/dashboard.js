// Dashboard Global JavaScript
(function() {
    'use strict';
    
    // Tailwind Config
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                fontFamily: {
                    sans: ["Inter", "system-ui", "sans-serif"],
                },
                backdropBlur: {
                    xs: '2px',
                }
            },
        },
    };
    
    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize components
        initSidebar();
        initTheme();
        initSearch();
        initAlerts();
        initModals();
        initForms();
        
        // Set current date
        updateCurrentDate();
        
        // Initialize charts if any
        if (typeof window.initCharts === 'function') {
            window.initCharts();
        }
    });
    
    // Sidebar functionality
    function initSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebar-overlay");
        const sidebarBtn = document.getElementById("sidebarCollapse");
        
        if (!sidebarBtn) return;
        
        function toggleSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.toggle("-translate-x-full");
                overlay.classList.toggle("hidden");
            } else {
                sidebar.classList.toggle("collapsed");
                document
                    .querySelectorAll(".link-text, .logo-text, .user-info")
                    .forEach((el) => el.classList.toggle("hidden"));
            }
        }
        
        sidebarBtn.addEventListener("click", toggleSidebar);
        
        // Close sidebar on mobile when clicking overlay
        if (overlay) {
            overlay.addEventListener("click", toggleSidebar);
        }
        
        // Highlight active sidebar link
        highlightActiveSidebarLink();
    }
    
    // Highlight active sidebar link based on current URL
    function highlightActiveSidebarLink() {
        const currentPath = window.location.pathname;
        const sidebarLinks = document.querySelectorAll('#sidebar a');
        
        sidebarLinks.forEach(link => {
            link.classList.remove('bg-red-500/40', 'font-semibold', 'border-red-300/50');
            const linkCard = link.querySelector('.glass-card');
            if (linkCard) linkCard.classList.remove('bg-red-400/30');
            
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.replace(window.baseUrl || '', ''))) {
                link.classList.add('bg-red-500/40', 'font-semibold', 'border-red-300/50');
                const linkCard = link.querySelector('.glass-card');
                if (linkCard) linkCard.classList.add('bg-red-400/30');
            }
        });
    }
    
    // Theme management
    function initTheme() {
        const themeToggle = document.querySelector('[onclick="toggleTheme()"]');
        const themeIcon = document.getElementById("theme-icon");
        
        // Load saved theme
        const savedTheme = localStorage.getItem('dashboard-theme');
        
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
            if (themeIcon) themeIcon.classList.replace("fa-moon", "fa-sun");
        } else if (savedTheme === 'light') {
            document.documentElement.classList.remove('dark');
            if (themeIcon) themeIcon.classList.replace("fa-sun", "fa-moon");
        } else {
            // Default to system preference
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
                if (themeIcon) themeIcon.classList.replace("fa-moon", "fa-sun");
                localStorage.setItem('dashboard-theme', 'dark');
            }
        }
        
        // Add click event to theme toggle button
        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
        }
        
        // Expose toggleTheme globally
        window.toggleTheme = function() {
            document.documentElement.classList.toggle("dark");
            const icon = document.getElementById("theme-icon");
            if (document.documentElement.classList.contains("dark")) {
                icon.classList.replace("fa-moon", "fa-sun");
                localStorage.setItem('dashboard-theme', 'dark');
                showToast("Switched to Dark Mode");
            } else {
                icon.classList.replace("fa-sun", "fa-moon");
                localStorage.setItem('dashboard-theme', 'light');
                showToast("Switched to Light Mode");
            }
        };
    }
    
    // Global search functionality
    function initSearch() {
        const globalSearch = document.getElementById('globalSearch');
        
        if (globalSearch) {
            globalSearch.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = this.value.trim();
                    if (query) {
                        // Implement search functionality
                        console.log('Searching for:', query);
                        showToast(`Searching for "${query}"`, 'info');
                    }
                }
            });
        }
    }
    
    // Auto-hide alerts
    function initAlerts() {
        const autoHideAlerts = document.querySelectorAll('.alert-auto-hide');
        
        autoHideAlerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    }
    
    // Modal management
    function initModals() {
        // Close modal when clicking backdrop
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-backdrop')) {
                hideModal(e.target.nextElementSibling);
            }
        });
        
        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    hideModal(openModal);
                }
            }
        });
        
        // Expose modal functions globally
        window.showModal = function(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop show';
            
            if (modal) {
                modal.parentNode.insertBefore(backdrop, modal);
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        };
        
        window.hideModal = function(modalId) {
            let modal, backdrop;
            
            if (typeof modalId === 'string') {
                modal = document.getElementById(modalId);
            } else {
                modal = modalId;
            }
            
            if (modal) {
                backdrop = modal.previousElementSibling;
                if (backdrop && backdrop.classList.contains('modal-backdrop')) {
                    backdrop.remove();
                }
                modal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };
    }
    
    // Form initialization
    function initForms() {
        // Add loading state to submit buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Processing...';
                    
                    // Store original content to restore if validation fails
                    submitBtn.dataset.originalContent = originalText;
                }
            });
        });
        
        // Reset form button states when form validation fails
        document.addEventListener('invalid', (function() {
            return function(e) {
                const submitBtn = e.target.closest('form').querySelector('button[type="submit"]');
                if (submitBtn && submitBtn.dataset.originalContent) {
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = submitBtn.dataset.originalContent;
                    delete submitBtn.dataset.originalContent;
                }
            };
        })(), true);
    }
    
    // Toast notification system
    window.showToast = function(message, type = 'info', duration = 3000) {
        const container = document.getElementById("toastContainer");
        if (!container) return;
        
        const toast = document.createElement("div");
        const icon = type === 'success' ? 'fa-check-circle' : 
                     type === 'error' ? 'fa-exclamation-circle' : 
                     type === 'warning' ? 'fa-exclamation-triangle' : 'fa-circle-info';
        
        const color = type === 'success' ? 'green' : 
                      type === 'error' ? 'red' : 
                      type === 'warning' ? 'yellow' : 'red';
        
        toast.className =
            `custom-toast glass-card dark:glass-card-dark shadow-2xl rounded-xl p-4 border-l-4 border-${color}-500 flex items-center gap-3 max-w-xs`;
        toast.innerHTML = `
            <div class="glass-card dark:glass-card-dark w-10 h-10 rounded-xl flex items-center justify-center">
                <i class="fa-solid ${icon} text-${color}-500"></i>
            </div>
            <div>
                <span class="font-medium text-sm">${message}</span>
            </div>
        `;
        container.appendChild(toast);
        setTimeout(() => toast.classList.add("show"), 10);
        setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 400);
        }, duration);
    };
    
    // API request helper
    window.apiRequest = async function(url, method = 'GET', data = null) {
        try {
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            };
            
            if (data && (method === 'POST' || method === 'PUT' || method === 'PATCH')) {
                options.body = JSON.stringify(data);
            }
            
            const response = await fetch(url, options);
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Request failed');
            }
            
            return result;
        } catch (error) {
            console.error('API Request Error:', error);
            showToast(error.message || 'An error occurred', 'error');
            throw error;
        }
    };
    
    // Form validation helper
    window.validateForm = function(formId) {
        const form = document.getElementById(formId);
        if (!form) return true;
        
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        return isValid;
    };
    
    // Confirm dialog helper
    window.confirmAction = function(message, callback) {
        if (confirm(message)) {
            if (typeof callback === 'function') {
                callback();
            }
            return true;
        }
        return false;
    };
    
    // Table row delete helper
    window.deleteTableRow = function(btn, url, rowId) {
        confirmAction('Are you sure you want to delete this item?', async () => {
            try {
                const row = btn.closest("tr");
                row.classList.add("opacity-0", "scale-95", "transition-all", "duration-300");
                
                // Send delete request
                const result = await apiRequest(`${url}/${rowId}`, 'DELETE');
                
                setTimeout(() => {
                    row.remove();
                    showToast(result.message || 'Item deleted successfully', 'success');
                }, 300);
            } catch (error) {
                console.error('Delete error:', error);
                showToast('Failed to delete item', 'error');
            }
        });
    };
    
    // Format date helper
    window.formatDate = function(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    };
    
    // Format currency helper
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount);
    };
    
    // Loading state helper
    window.setLoading = function(element, isLoading) {
        if (isLoading) {
            element.classList.add('opacity-50', 'cursor-not-allowed');
            element.disabled = true;
        } else {
            element.classList.remove('opacity-50', 'cursor-not-allowed');
            element.disabled = false;
        }
    };
    
    // Update current date
    function updateCurrentDate() {
        const dateElements = document.querySelectorAll('.current-date');
        if (dateElements.length) {
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            dateElements.forEach(el => {
                el.textContent = formattedDate;
            });
        }
    }
    
    // Initialize simple charts
    window.initAttendanceChart = function(containerId, data) {
        const container = document.getElementById(containerId);
        if (!container) return;
        
        container.innerHTML = '';
        
        data.forEach((item) => {
            const group = document.createElement("div");
            group.className = "flex-1 flex flex-col items-center justify-end h-full";
            
            const bar = document.createElement("div");
            bar.className = "bar w-full max-w-10 rounded-t-xl relative cursor-pointer group";
            
            // Determine bar color based on value
            if (item.value < 50) {
                bar.classList.add("bg-gradient-to-t", "from-gray-400", "to-gray-300", "dark:from-gray-600", "dark:to-gray-500");
            } else if (item.value > 90) {
                bar.classList.add("bg-gradient-to-t", "from-red-500", "to-red-400");
            } else {
                bar.classList.add("bg-gradient-to-t", "from-orange-400", "to-orange-300");
            }
            
            bar.style.height = "0%";
            bar.innerHTML = `
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 glass-card dark:glass-card-dark px-2 py-1 rounded text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    ${item.value}%
                </div>
            `;
            
            const label = document.createElement("div");
            label.className = "mt-2 text-xs font-medium text-gray-700 dark:text-gray-300";
            label.textContent = item.day;
            
            group.appendChild(bar);
            group.appendChild(label);
            container.appendChild(group);
            
            setTimeout(() => {
                bar.style.height = item.value + "%";
            }, 100);
        });
    };
    
    // Export Dashboard object globally
    window.Dashboard = {
        showToast: window.showToast,
        apiRequest: window.apiRequest,
        validateForm: window.validateForm,
        confirmAction: window.confirmAction,
        deleteTableRow: window.deleteTableRow,
        formatDate: window.formatDate,
        formatCurrency: window.formatCurrency,
        setLoading: window.setLoading,
        showModal: window.showModal,
        hideModal: window.hideModal,
        toggleTheme: window.toggleTheme,
        initAttendanceChart: window.initAttendanceChart
    };
    
})();