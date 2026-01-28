<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? $title . ' | ' : '' ?>SOSCT Admin</title>

    <!-- Meta Tags -->
    <meta name="description" content="<?= isset($meta_description) ? $meta_description : 'School Administration Dashboard' ?>">
    <meta name="author" content="Crimson Edu">
    <meta name="keywords" content="<?= isset($meta_keywords) ? $meta_keywords : 'education, dashboard, school, admin' ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome 6 -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet" />

    <!-- Google Fonts: Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

    <!-- Page-specific CSS -->
    <?= $this->renderSection('styles') ?>
</head>

<body
    class="text-gray-900 dark:text-gray-100 min-h-screen font-sans antialiased text-sm">
    <!-- Animated Background -->
    <div class="animated-bg dark:animated-bg-dark"></div>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <?= $this->include('layouts/partials/sidebar') ?>

        <!-- Mobile overlay -->
        <div
            id="sidebar-overlay"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden hidden"
            onclick="toggleSidebar()"></div>

        <!-- Content Wrapper -->
        <div class="content-wrapper flex-1">
            <!-- Top Navbar -->
            <?= $this->include('layouts/partials/header') ?>

            <!-- Page Content -->
            <main class="p-4 flex-1">
                <!-- Page Title and Breadcrumb -->
                <div class="mb-6">
                    <?php if (isset($breadcrumbs)): ?>
                        <nav class="flex mb-3" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <a href="/dashboard" class="inline-flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-red-600">
                                        <i class="fa-solid fa-home mr-2"></i>
                                        Home
                                    </a>
                                </li>
                                <?= $breadcrumbs ?>
                            </ol>
                        </nav>
                    <?php endif; ?>

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-bold gradient-text dark:gradient-text-dark">
                                <?= isset($page_title) ? $page_title : 'Dashboard' ?>
                            </h1>
                            <?php if (isset($page_subtitle)): ?>
                                <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">
                                    <?= $page_subtitle ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Page-specific actions/buttons -->
                        <?= $this->renderSection('page_actions') ?>
                    </div>
                </div>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 glass-card dark:glass-card-dark border-l-4 border-green-500 p-4 flex items-center">
                        <i class="fa-solid fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 glass-card dark:glass-card-dark border-l-4 border-red-500 p-4 flex items-center">
                        <i class="fa-solid fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium"><?= session()->getFlashdata('error') ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('warning')): ?>
                    <div class="mb-6 glass-card dark:glass-card-dark border-l-4 border-yellow-500 p-4 flex items-center">
                        <i class="fa-solid fa-exclamation-triangle text-yellow-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium"><?= session()->getFlashdata('warning') ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Content Section -->
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Footer -->
            <?= $this->include('layouts/partials/footer') ?>
        </div>
    </div>

    <!-- Toast Container -->
    <div
        id="toastContainer"
        class="fixed bottom-4 right-4 z-50 space-y-2"></div>

    <!-- Dashboard JavaScript -->
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>

    <!-- Page-specific JavaScript -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>