<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-size: 0.9rem;
            background-color: #f4f7f6;
        }

        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
            width: 250px;
            position: fixed;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            margin: 2px 10px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #34495e;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .navbar-admin {
            background: white;
            border-bottom: 1px solid #e3e6f0;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        /* Style Global untuk Detail Program */
        .program-img-container {
            width: 100%;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #eee;
            border-radius: 8px;
        }

        .program-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>

<body>
    <div class="sidebar d-none d-md-block">
        <div class="p-4">
            <h5 class="fw-bold"><i class="bi bi-rocket-takeoff me-2"></i>EduAdmin</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= url_is('admin/dashboard') ? 'active' : '' ?>" href="#">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= url_is('programs*') ? 'active' : '' ?>" href="<?= base_url('programs') ?>">
                    <i class="bi bi-journal-bookmark me-2"></i> Master Program
                </a>
            </li>
            <li class="nav-item mt-4 px-3 small text-uppercase text-muted">User Management</li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-people me-2"></i> Siswa</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand navbar-admin py-3 px-4">
            <div class="container-fluid">
                <span class="navbar-text fw-bold text-dark"><?= $title ?></span>
                <div class="collapse navbar-collapse justify-content-end">
                    <div class="dropdown">
                        <a href="#" class="text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> <?= auth()->user()->username ?? 'Admin' ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="p-4">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="bi bi-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>