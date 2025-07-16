<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40JuKCgxdlJvoNukFQwABnJqmtxZ9sTMlIeVAPcKWvRk4N2p9Q4/Bqf/Nf0gYn8Jd5z2R+E6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #f8f9fa; /* Latar belakang halaman */
        }
        #main-wrapper {
            flex: 1; /* Agar konten utama memenuhi sisa tinggi */
            padding-top: 56px; /* Offset for fixed navbar */
        }
        .sidebar {
            position: fixed;
            top: 56px; /* Tinggi navbar */
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 1rem; /* Menggunakan rem untuk konsistensi Bootstrap 5 */
            overflow-x: hidden;
            overflow-y: auto;
            background-color: #343a40; /* Warna sidebar gelap */
            border-right: 1px solid #dee2e6; /* Garis pemisah sidebar */
            color: #fff; /* Teks default sidebar */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, .75);
            padding: 0.6rem 1rem; /* Menggunakan rem */
            border-radius: 0.25rem; /* Menggunakan rem */
            display: flex; /* Untuk ikon dan teks sejajar */
            align-items: center;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem; /* Menggunakan rem */
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd; /* Warna aktif Bootstrap 5 blue */
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #0a58ca; /* Hover warna biru lebih gelap */
        }
        .main-content {
            padding: 1.5rem; /* Menggunakan rem */
            background-color: #fff; /* Latar belakang konten utama putih */
            min-height: calc(100vh - 120px); /* Menyesuaikan tinggi dengan footer */
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
            border-radius: .25rem;
        }
        .main-footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 1rem 0; /* Menggunakan rem */
            text-align: center;
        }
        /* Penyesuaian untuk kolum konten utama agar tidak tumpang tindih dengan sidebar */
        /* col-md-3 untuk sidebar, col-md-9 untuk konten */
        @media (min-width: 768px) {
            .main-content-col {
                margin-left: 25%; /* Lebar col-md-3 */
            }
        }
        /* col-lg-2 untuk sidebar, col-lg-10 untuk konten */
        @media (min-width: 992px) {
            .sidebar {
                width: 16.666667%; /* col-lg-2 */
            }
            .main-content-col {
                margin-left: 16.666667%; /* Sesuaikan dengan col-lg-2 */
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo site_url('admin'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i> Admin Panel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>" target="_blank">
                        <i class="fas fa-fw fa-globe"></i> Lihat Situs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="main-wrapper" class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky pt-3">
               <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->router->fetch_class() == 'Admin') ? 'active' : ''; ?>" href="<?php echo site_url('admin'); ?>">
                        <i class="fas fa-fw fa-newspaper"></i> Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->router->fetch_class() == 'Kategori_admin') ? 'active' : ''; ?>" href="<?php echo site_url('kategori_admin'); ?>">
                        <i class="fas fa-fw fa-list"></i> Kategori
                    </a>
                </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($this->router->fetch_class() == 'Auth' && $this->router->fetch_method() == 'ubah_password') ? 'active' : ''; ?>" href="<?php echo site_url('ubah_password'); ?>">
                    <i class="fas fa-fw fa-key"></i> Ubah Password
                </a>
            </li>
            </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <div class="main-content">
                