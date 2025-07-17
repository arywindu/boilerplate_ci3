<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php
        if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)) {
            echo !empty($artikel['meta_title']) ? html_escape($artikel['meta_title']) : html_escape($artikel['judul']);
        } else {
            echo html_escape($title);
        }
    ?></title>

    <meta name="description" content="<?php
        if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('isi', $artikel)) {
            echo !empty($artikel['meta_description']) ? html_escape($artikel['meta_description']) : html_escape(word_limiter(strip_tags($artikel['isi']), 25));
        } else {
            echo 'Temukan berita dan artikel terbaru seputar teknologi, gaya hidup, dan banyak lagi.'; // Default description
        }
    ?>">

    <?php
    $current_keywords = '';
    if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)) {
        if (!empty($artikel['meta_keywords'])) {
            $current_keywords = html_escape($artikel['meta_keywords']);
        } else {
            $fallback_keywords_artikel = html_escape(str_replace(' ', ', ', $artikel['judul']));
            if (isset($artikel['nama_kategori'])) {
                $fallback_keywords_artikel .= ', ' . html_escape($artikel['nama_kategori']);
            }
            $current_keywords = $fallback_keywords_artikel;
        }
    } else {
        $current_keywords = 'berita, artikel, teknologi, lifestyle, informasi, terbaru'; // Default keywords
    }
    echo '<meta name="keywords" content="' . $current_keywords . '">';
    ?>

    <?php if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)): ?>
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo current_url(); ?>">
        <meta property="og:title" content="<?php echo !empty($artikel['meta_title']) ? html_escape($artikel['meta_title']) : html_escape($artikel['judul']); ?>">
        <meta property="og:description" content="<?php echo !empty($artikel['meta_description']) ? html_escape($artikel['meta_description']) : html_escape(word_limiter(strip_tags($artikel['isi']), 25)); ?>">
        <?php if (!empty($artikel['gambar'])): ?>
            <meta property="og:image" content="<?php echo base_url('uploads/' . $artikel['gambar']); ?>">
        <?php endif; ?>
        <meta property="og:site_name" content="Nama Situs Berita Anda">
    <?php endif; ?>

    <?php if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)): ?>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="<?php echo current_url(); ?>">
        <meta name="twitter:title" content="<?php echo !empty($artikel['meta_title']) ? html_escape($artikel['meta_title']) : html_escape($artikel['judul']); ?>">
        <meta name="twitter:description" content="<?php echo !empty($artikel['meta_description']) ? html_escape($artikel['meta_description']) : html_escape(word_limiter(strip_tags($artikel['isi']), 25)); ?>">
        <?php if (!empty($artikel['gambar'])): ?>
            <meta name="twitter:image" content="<?php echo base_url('uploads/' . $artikel['gambar']); ?>">
        <?php endif; ?>
    <?php endif; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Custom styles for a modern look */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f2f5; /* Light grey background */
            color: #333;
            scroll-behavior: smooth; /* Enable smooth scrolling for anchor links */
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
            background-color: #fff !important; /* White navbar */
            border-bottom: 1px solid #e0e0e0;
        }
        .navbar-brand {
            font-weight: 700;
            color: #333 !important;
            font-size: 1.5rem;
        }
        .nav-link {
            font-weight: 500;
            color: #555 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #007bff !important; /* Primary blue on hover */
        }
        .section-padding {
            padding: 60px 0; /* Consistent padding for sections */
        }
        .bg-light-gray {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center; /* News related image */
            background-size: cover;
            color: white;
            padding: 100px 0; /* More padding for hero */
            text-align: center;
            margin-bottom: 0; /* No margin-bottom, sections will handle spacing */
            border-radius: 0; /* No rounded corners for full width */
        }
        .hero-section h1 {
            font-size: 3.8rem; /* Larger font for hero title */
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .hero-section p {
            font-size: 1.35rem;
            max-width: 800px;
            margin: 0 auto 2.5rem auto;
            opacity: 0.95;
        }
        .card {
            border: none;
            border-radius: .75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.05);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,.1);
        }
        .card-img-top {
            border-top-left-radius: .75rem;
            border-top-right-radius: .75rem;
            height: 220px; /* Consistent image height */
            object-fit: cover;
            width: 100%;
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            min-height: 50px; /* Ensure consistent height for titles */
        }
        .card-text.text-muted {
            font-size: 0.85rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .read-more-btn {
            font-weight: 600;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }
        .read-more-btn:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        footer {
            background-color: #333; /* Dark footer */
            color: #f0f2f5;
            padding: 2.5rem 0;
            margin-top: 0; /* Sections will handle spacing */
        }
        footer p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        /* Custom padding for main content if using fixed navbar */
        body { padding-top: 70px; } /* Adjust based on navbar height */

        /* Custom CSS for Detail Page */
        .detail-hero-section {
            background-color: #f8f9fa; /* Light background for hero */
            padding: 4rem 0 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .detail-hero-section h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        .detail-hero-section .post-meta {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .detail-hero-section .post-meta span {
            margin: 0 8px;
            display: inline-flex; /* Untuk sejajarkan ikon */
            align-items: center;
        }
        .detail-hero-section .post-meta i {
            margin-right: 5px;
            color: #adb5bd;
        }
        .featured-image-container {
            max-width: 800px;
            margin: 0 auto 2rem auto;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .featured-image-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .detail-content-body {
            font-family: 'Georgia', serif; /* Font klasik untuk konten */
            font-size: 1.15rem; /* Ukuran font lebih besar untuk kenyamanan membaca */
            line-height: 1.8; /* Tinggi baris lebih lebar */
            color: #333;
        }
        .detail-content-body p {
            margin-bottom: 1.5rem;
        }
        .detail-content-body h1, .detail-content-body h2, .detail-content-body h3, .detail-content-body h4, .detail-content-body h5, .detail-content-body h6 {
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .detail-content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 1.5rem auto; /* Tengah gambar */
            display: block; /* Agar margin auto bekerja */
        }
        /* Responsive Video Embeds (must be in public/templates/header.php) */
        .responsive-video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            margin: 1.5rem 0;
            border-radius: 0.5rem;
        }
        .responsive-video-container iframe,
        .responsive-video-container object,
        .responsive-video-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .note-video-clip { /* Style from Summernote */
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Post Sidebar */
        .post-sidebar {
            padding-left: 1.5rem;
            /* border-left: 1px solid #eee; */ /* Optional border */
        }
        .post-sidebar .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
            border-radius: 0.75rem;
        }
        .post-sidebar .card-header {
            background-color: #f8f9fa;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }
        .post-sidebar .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
            padding: 0.75rem 0;
        }
        .post-sidebar .list-group-item:last-child {
            border-bottom: none;
        }
        .post-sidebar .list-group-item a {
            color: #343a40;
            text-decoration: none;
            font-weight: 500;
        }
        .post-sidebar .list-group-item a:hover {
            color: #007bff;
            text-decoration: underline;
        }
        .post-sidebar .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.7em;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <i class="fas fa-bullhorn"></i> Boilerplate CI 3
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>#articles">Artikel Terbaru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>#about">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>#contact">Kontak</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white ms-lg-3 px-3 rounded-pill" href="<?php echo site_url('admin'); ?>">Admin Panel</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>