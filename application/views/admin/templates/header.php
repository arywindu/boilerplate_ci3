<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px; /* Lebar sidebar */
            --navbar-height: 56px;
            --main-bg-color: #f0f2f5; /* Warna latar belakang utama */
            --content-bg-color: #ffffff; /* Warna latar belakang konten */
            --sidebar-bg-color: #2c3e50; /* Dark blue/grey */
            --sidebar-link-color: #ecf0f1; /* Light grey text */
            --sidebar-link-hover-bg: #34495e; /* Darker blue/grey on hover */
            --sidebar-link-active-bg: #1abc9c; /* Green/Turquoise */
            --sidebar-link-active-color: #ffffff;
            --card-border-color: #e0e0e0;
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--main-bg-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Untuk menempatkan footer di paling bawah */
        }

        /* Navbar top */
        .navbar-admin {
            background-color: var(--content-bg-color) !important;
            border-bottom: 1px solid var(--card-border-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            z-index: 1030; /* Lebih tinggi dari sidebar */
        }
        .navbar-admin .navbar-brand {
            color: var(--sidebar-bg-color) !important;
            font-weight: 700;
            font-size: 1.25rem;
        }
        .navbar-admin .nav-link {
            color: #555 !important;
        }
        .navbar-admin .nav-link:hover {
            color: var(--sidebar-link-active-bg) !important;
        }

        /* Sidebar */
        .sidebar-wrapper {
            position: fixed;
            top: var(--navbar-height);
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg-color);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding-top: 1rem;
            overflow-y: auto; /* Untuk scroll jika menu banyak */
            z-index: 1020; /* Lebih rendah dari navbar */
        }
        .sidebar-nav .nav-item {
            margin-bottom: 5px;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: var(--sidebar-link-color);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0.25rem;
            margin: 0 10px; /* Padding samping */
        }
        .sidebar-nav .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        .sidebar-nav .nav-link:hover {
            background-color: var(--sidebar-link-hover-bg);
            color: var(--sidebar-link-active-color);
        }
        .sidebar-nav .nav-link.active {
            background-color: var(--sidebar-link-active-bg);
            color: var(--sidebar-link-active-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            font-weight: 600;
        }
        
        /* Dropdown (Sub-menu) for sidebar - using Bootstrap's own collapse/dropdown */
        .sidebar-nav .nav-item .collapse .nav-link {
            padding-left: 35px; /* Indent sub-menu items */
            font-size: 0.95rem;
            background-color: var(--sidebar-link-hover-bg);
            border-left: 3px solid var(--sidebar-link-active-bg); /* Little highlight */
            margin: 0 10px 0 10px;
            border-radius: 0;
            color: rgba(255, 255, 255, .85);
        }
        .sidebar-nav .nav-item .collapse .nav-link.active {
            background-color: var(--sidebar-link-active-bg);
            color: var(--sidebar-link-active-color);
            box-shadow: none;
        }


        /* Main Content Area */
        .main-content-wrapper {
            margin-left: var(--sidebar-width); /* Beri ruang untuk sidebar */
            padding-top: var(--navbar-height); /* Beri ruang untuk navbar */
            flex-grow: 1; /* Agar mengisi sisa ruang */
            display: flex;
            flex-direction: column;
        }
        .main-content-area {
            background-color: var(--content-bg-color);
            padding: 1.5rem;
            margin: 1.5rem; /* Jarak dari sisi layar */
            border-radius: 0.75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            min-height: calc(100vh - var(--navbar-height) - 3rem - 60px); /* Menyesuaikan tinggi dengan footer dan margin */
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--card-border-color);
        }
        .page-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 0;
        }
        .page-header .breadcrumb {
            margin-bottom: 0;
        }
        
        /* Pagination Styling (FINAL CLEAN LOOK - BOOTSTRAP 5 STANDARD) */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        padding-bottom: 1rem;
    }
    .pagination {
        /* Bootstrap 5 default margins are good, no need to reset unless specific conflict */
        margin-bottom: 0;
    }
    .pagination .page-item {
        /* No extra margins needed here, controlled by .page-link */
    }
    .pagination .page-item .page-link {
        /* Remove Bootstrap's default inner borders to avoid double borders */
        border: 1px solid var(--card-border-color); /* Single border */
        border-radius: 0.25rem; /* Standard rounded corners */
        margin: 0 4px; /* Jarak antar tombol */
        
        color: var(--font-color-dark);
        background-color: var(--content-bg-color); /* White background */
        transition: all 0.2s ease;
        min-width: 40px; /* Seragamkan lebar */
        height: 40px; /* Seragamkan tinggi */
        display: flex; /* Untuk tengah konten */
        align-items: center;
        justify-content: center;
        font-weight: 500;
        text-decoration: none;
        outline: none; /* Hapus outline saat focus */
        box-shadow: none; /* Hapus bayangan default */
    }
    /* Pastikan border-radius pada item pertama dan terakhir benar */
    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem; /* Ensure individual radius */
        border-bottom-right-radius: 0.25rem;
    }
    .pagination .page-item:last-child .page-link {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .pagination .page-item .page-link:hover:not(.active) {
        background-color: var(--main-bg-color);
        border-color: #0d6efd;
        color: var(--font-color-dark);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--sidebar-link-active-bg);
        border-color: var(--sidebar-link-active-bg);
        color: #fff;
        box-shadow: 0 2px 5px rgba(13, 110, 253, 0.3);
        font-weight: 600;
        z-index: 2; /* Agar aktif di atas border item lain */
    }
    .pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: var(--card-border-color);
        color: #6c757d;
        cursor: not-allowed;
        box-shadow: none;
    }

        /* Flashdata Alerts */
        .alert-fixed {
            position: sticky; /* Or fixed, but sticky is better for scrolling */
            top: calc(var(--navbar-height) + 15px); /* Position below navbar */
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - var(--sidebar-width) - 3rem - 30px); /* Adjusted width */
            z-index: 1040; /* Above everything else */
            margin: 0 auto; /* Center it */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 0.5rem;
        }

        /* Footer */
        .main-footer-admin {
            background-color: var(--sidebar-bg-color); /* Dark footer */
            color: var(--sidebar-link-color);
            padding: 1rem;
            text-align: center;
            margin-left: var(--sidebar-width); /* Beri ruang untuk sidebar */
            border-top: 1px solid var(--card-border-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) { /* Small screens */
            .sidebar-wrapper {
                left: -var(--sidebar-width); /* Sembunyikan sidebar di luar layar */
                transition: left 0.3s ease;
            }
            .sidebar-wrapper.show { /* Tampilkan saat tombol hamburger diklik */
                left: 0;
            }
            .main-content-wrapper {
                margin-left: 0; /* Content takes full width */
            }
            .navbar-admin .navbar-toggler {
                display: block; /* Tampilkan toggler */
            }
            .alert-fixed {
                width: calc(100% - 3rem - 30px); /* Full width minus padding */
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-admin fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo site_url('admin'); ?>">
            <i class="fas fa-cubes me-2"></i> Admin Panel
        </a>
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="topNavbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>" target="_blank">
                        <i class="fas fa-fw fa-globe me-1"></i> Lihat Situs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar-wrapper collapse d-md-block" id="sidebarMenu">
    <nav class="sidebar-nav pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <?php
                    $current_class = $this->router->fetch_class();
                    $current_method = $this->router->fetch_method();
                    $dashboard_active = ($current_class == 'Admin' && $current_method == 'index') ? 'active' : '';
                ?>
                <a class="nav-link <?php echo $dashboard_active; ?>" href="<?php echo site_url('admin'); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <?php
                    $artikel_main_active = '';
                    $artikel_collapse_show = '';
                    if ($current_class == 'Admin' && in_array($current_method, ['artikel_list', 'tambah', 'edit'])) {
                        $artikel_main_active = 'active'; // Menandai menu utama Artikel
                        $artikel_collapse_show = 'show'; // Membuka sub-menu jika di salah satu halaman artikel
                    }
                ?>
                <a class="nav-link <?php echo $artikel_main_active; ?>" data-bs-toggle="collapse" href="#artikelSubmenu" role="button" aria-expanded="<?php echo ($artikel_collapse_show == 'show') ? 'true' : 'false'; ?>" aria-controls="artikelSubmenu">
                    <i class="fas fa-newspaper"></i> Artikel <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="collapse <?php echo $artikel_collapse_show; ?> pt-1" id="artikelSubmenu">
                    <ul class="nav flex-column ps-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_class == 'Admin' && $current_method == 'artikel_list') ? 'active' : ''; ?>" href="<?php echo site_url('admin/artikel_list'); ?>">
                                <i class="fas fa-list"></i> Semua Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_class == 'Admin' && $current_method == 'tambah') ? 'active' : ''; ?>" href="<?php echo site_url('admin/tambah'); ?>">
                                <i class="fas fa-plus"></i> Tambah Baru
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <?php
                    $kategori_active = ($current_class == 'kategori_admin') ? 'active' : '';
                ?>
                <a class="nav-link <?php echo $kategori_active; ?>" href="<?php echo site_url('kategori_admin'); ?>">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            </li>

            <li class="nav-item">
                <?php
                    $settings_main_active = '';
                    $settings_collapse_show = '';
                    if (/* $current_class == 'Auth' &&  */($current_method == 'ubah_password')) { // Jika ada setting lain bisa ditambahkan di array
                        //$settings_main_active = 'active';
                        $settings_collapse_show = 'show';
                    }
                ?>
                <a class="nav-link <?php echo $settings_main_active; ?>" data-bs-toggle="collapse" href="#settingsSubmenu" role="button" aria-expanded="<?php echo ($settings_collapse_show == 'show') ? 'true' : 'false'; ?>" aria-controls="settingsSubmenu">
                    <i class="fas fa-cog"></i> Pengaturan <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="collapse <?php echo $settings_collapse_show; ?>" id="settingsSubmenu">
                    <ul class="nav flex-column ps-3">
                        <li class="nav-item">
                            <?php
                                $ubah_password_active = (/* $current_class == 'Auth' && */ $current_method == 'ubah_password') ? 'active' : '';
                            ?>
                            <a class="nav-link <?php echo $ubah_password_active; ?>" href="<?php echo site_url('ubah_password'); ?>">
                                <i class="fas fa-key"></i> Ubah Password
                            </a>
                        </li>
                        </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>

<div class="main-content-wrapper">
    <div class="main-content-area">
        <div class="page-header">
            <h1><?php echo $title; ?></h1>
            </div>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show alert-fixed" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error_upload')): ?>
            <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
                <?php echo $this->session->flashdata('error_upload'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>