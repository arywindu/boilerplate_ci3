<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php
        // Cek apakah variabel $artikel ada dan bukan array kosong (berarti ini halaman detail artikel)
        if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)) {
            // Gunakan meta_title jika ada, kalau tidak pakai judul artikel
            echo !empty($artikel['meta_title']) ? html_escape($artikel['meta_title']) : html_escape($artikel['judul']);
        } else {
            // Untuk halaman lain (Home, daftar, dll.)
            echo html_escape($title); // Gunakan $title dari controller
        }
    ?></title>

    <meta name="description" content="<?php
        if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('isi', $artikel)) {
            // Gunakan meta_description jika ada, kalau tidak pakai potongan isi artikel
            echo !empty($artikel['meta_description']) ? html_escape($artikel['meta_description']) : html_escape(word_limiter(strip_tags($artikel['isi']), 25));
        } else {
            // Deskripsi default untuk halaman non-artikel
            echo 'Temukan berita dan artikel terbaru seputar teknologi, gaya hidup, dan banyak lagi.'; // Sesuaikan deskripsi default Anda
        }
    ?>">

    <?php
    $current_keywords = '';
    if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)) {
        // Jika ada artikel dan ada meta_keywords
        if (!empty($artikel['meta_keywords'])) {
            $current_keywords = html_escape($artikel['meta_keywords']);
        } else {
            // Fallback keywords dari judul dan kategori
            $fallback_keywords_artikel = html_escape(str_replace(' ', ', ', $artikel['judul']));
            if (isset($artikel['nama_kategori'])) { // Pastikan kategori juga diambil di Artikel_model
                $fallback_keywords_artikel .= ', ' . html_escape($artikel['nama_kategori']);
            }
            $current_keywords = $fallback_keywords_artikel;
        }
    } else {
        // Keywords default untuk halaman non-artikel
        $current_keywords = 'berita, artikel, teknologi, lifestyle, informasi, terbaru'; // Keywords umum Anda
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
        <meta property="og:site_name" content="Nama Situs Berita Anda"> <?php endif; ?>

    <?php if (isset($artikel) && is_array($artikel) && !empty($artikel) && array_key_exists('judul', $artikel)): ?>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="<?php echo current_url(); ?>">
        <meta name="twitter:title" content="<?php echo !empty($artikel['meta_title']) ? html_escape($artikel['meta_title']) : html_escape($artikel['judul']); ?>">
        <meta name="twitter:description" content="<?php echo !empty($artikel['meta_description']) ? html_escape($artikel['meta_description']) : html_escape(word_limiter(strip_tags($artikel['isi']), 25)); ?>">
        <?php if (!empty($artikel['gambar'])): ?>
            <meta name="twitter:image" content="<?php echo base_url('uploads/' . $artikel['gambar']); ?>">
        <?php endif; ?>
        <?php endif; ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 20px; }
        .container { max-width: 960px; }
        .card-img-top { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Web Berita Anda</a> <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('admin'); ?>">Admin Panel</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="mb-4"><?php echo $title; ?></h1>
        <hr>