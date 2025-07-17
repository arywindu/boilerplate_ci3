<section id="home" class="hero-section">
    <div class="container">
        <h1 class="display-4 wow animate__animated animate__fadeInDown">Selamat Datang di <span class="fw-bold text-warning">Boilerplate CI 3</span>!</h1>
        <p class="lead wow animate__animated animate__fadeInUp">Temukan berbagai berita dan artikel terbaru dari berbagai topik menarik setiap hari, serta rekomendasi produk terbaik dari kami.</p>
        <a href="#articles" class="btn btn-light btn-lg rounded-pill px-4 wow animate__animated animate__zoomIn">Baca Artikel Terbaru <i class="fas fa-arrow-down ms-2"></i></a>
    </div>
</section>

<?php if (!empty($featured_articles)): ?>
<section id="featured-articles" class="container section-padding">
    <h2 class="text-center mb-5 display-5 fw-bold wow animate__animated animate__fadeIn">Artikel Unggulan</h2>
    <div id="carouselExampleIndicators" class="carousel slide wow animate__animated animate__fadeInUp" data-bs-ride="carousel" data-wow-delay="0.4s">
        <div class="carousel-indicators">
            <?php foreach ($featured_articles as $key => $item): ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : ''; ?>" aria-current="<?php echo ($key == 0) ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $key + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($featured_articles as $key => $item): ?>
                <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start">
                        <img src="<?php echo base_url('uploads/' . ($item['gambar'] ? $item['gambar'] : 'placeholder-featured.jpg')); ?>" class="d-block w-100 carousel-img" alt="<?php echo html_escape($item['judul']); ?>">
                        <div class="carousel-caption d-none d-md-block text-start">
                            <span class="badge bg-primary mb-2"><?php echo html_escape($item['nama_kategori']); ?></span>
                            <h3 class="display-6 fw-bold"><?php echo html_escape($item['judul']); ?></h3>
                            <p class="lead d-none d-lg-block"><?php echo word_limiter(strip_tags($item['isi']), 30); ?></p>
                            <a href="<?php echo site_url('artikel/' . $item['slug']); ?>" class="btn btn-warning rounded-pill mt-3">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<?php endif; ?>

<section id="articles" class="container section-padding bg-white rounded-3 shadow-sm">
    <h2 class="text-center mb-5 display-5 fw-bold wow animate__animated animate__fadeIn">Berita Terkini</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php if (empty($artikel)): ?>
            <div class="col-12 text-center wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                <p class="lead">Belum ada artikel yang dipublikasikan.</p>
                <a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-primary mt-3">Tambah Artikel Pertama Anda</a>
            </div>
        <?php else: ?>
            <?php foreach ($artikel as $key => $item): ?>
                <div class="col wow animate__animated animate__fadeInUp" data-wow-delay="<?php echo 0.1 * ($key + 1); ?>s">
                    <div class="card h-100">
                        <?php if (! empty($item['gambar'])): ?>
                            <img src="<?php echo base_url('uploads/' . $item['gambar']); ?>" class="card-img-top" alt="<?php echo html_escape($item['judul']); ?>">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/600x400/CCCCCC/FFFFFF?text=No+Image" class="card-img-top" alt="No Image Available">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start"><?php echo html_escape($item['nama_kategori']); ?></span>
                            <h5 class="card-title text-truncate-2"><?php echo html_escape($item['judul']); ?></h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="far fa-calendar-alt me-1"></i> <?php echo date('d M Y', strtotime($item['tanggal_publikasi'])); ?>
                            </p>
                            <p class="card-text flex-grow-1 text-secondary"><?php echo word_limiter(strip_tags($item['isi']), 20); ?></p>
                            <div class="mt-auto">
                                <a href="<?php echo site_url('artikel/' . $item['slug']); ?>" class="read-more-btn">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php
    // if (isset($pagination_links) && !empty($pagination_links)) {
    //     echo '<div class="d-flex justify-content-center mt-5">' . $pagination_links . '</div>';
    // }
    ?>
</section>

<!-- <?php if (!empty($recommended_products)): ?>
<section id="products" class="container section-padding bg-light-gray rounded-3 shadow-sm">
    <h2 class="text-center mb-5 display-5 fw-bold wow animate__animated animate__fadeIn">Produk Rekomendasi Kami</h2>
    <p class="text-center mb-5 lead wow animate__animated animate__fadeIn">Dapatkan penawaran terbaik dari produk-produk pilihan kami melalui link afiliasi terpercaya.</p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php foreach ($recommended_products as $key => $product): ?>
            <div class="col wow animate__animated animate__fadeInUp" data-wow-delay="<?php echo 0.1 * ($key + 1); ?>s">
                <div class="card h-100 product-card">
                    <img src="<?php echo $product['gambar_produk']; ?>" class="card-img-top product-img" alt="<?php echo html_escape($product['nama_produk']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title product-title"><?php echo html_escape($product['nama_produk']); ?></h5>
                        <p class="card-text text-success fw-bold product-price"><?php echo $product['harga_produk']; ?></p>
                        <p class="card-text small flex-grow-1"><?php echo word_limiter(html_escape($product['deskripsi_produk']), 15); ?></p>
                        <div class="mt-auto">
                            <a href="<?php echo $product['link_affiliate']; ?>" target="_blank" rel="nofollow noopener" class="btn btn-warning btn-sm w-100">
                                Beli Sekarang <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-5 wow animate__animated animate__fadeIn">
        <a href="#" class="btn btn-outline-primary btn-lg rounded-pill px-4">Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</section>
<?php endif; ?> -->


<section id="newsletter" class="bg-dark text-white section-padding text-center">
    <div class="container wow animate__animated animate__fadeIn">
        <h2 class="mb-4 display-5 fw-bold">Free Section!</h2>
        <p class="lead mb-4">
            Bebas mau isi apa saja di sini, bisa newsletter, promo, atau lainnya.
        </p>
    </div>
</section>


<section id="about" class="container section-padding">
    <h2 class="text-center mb-5 display-5 fw-bold wow animate__animated animate__fadeIn">Tentang Kami</h2>
    <div class="row align-items-center wow animate__animated animate__fadeInUp">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="https://images.unsplash.com/photo-1542740974-9a008c5d552c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid rounded shadow-lg" alt="Tentang Kami">
        </div>
        <div class="col-md-6 text-center text-md-start">
            <p class="lead">
                Boilerplate CI 3 adalah platform berita dan rekomendasi produk terkemuka yang menyajikan informasi terkini dan analisis mendalam dari berbagai penjuru dunia. Kami juga membantu Anda menemukan produk terbaik melalui link afiliasi terpercaya.
            </p>
            <p class="text-secondary">
                Didirikan pada tahun 2023, kami berkomitmen untuk menjadi sumber informasi terpercaya Anda. Tim jurnalis profesional kami bekerja keras untuk menghadirkan liputan terbaik dan menjaga integritas jurnalistik, sekaligus menyajikan rekomendasi produk yang relevan dan bermanfaat.
            </p>
            <a href="#" class="btn btn-outline-primary mt-3 rounded-pill px-4">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</section>

<section id="contact" class="bg-primary text-white section-padding text-center">
    <div class="container wow animate__animated animate__fadeIn">
        <h2 class="mb-4 display-5 fw-bold">Ada Pertanyaan? Hubungi Kami!</h2>
        <p class="lead mb-4">
            Kami selalu siap membantu. Jangan ragu untuk mengirimkan pertanyaan, kritik, atau saran Anda.
        </p>
        <p class="mb-4">
            Email: <a href="mailto:info@beritakita.com" class="text-white text-decoration-none fw-bold">info@beritakita.com</a><br>
            Telepon: (021) 123-4567
        </p>
        <a href="mailto:info@beritakita.com" class="btn btn-light btn-lg rounded-pill px-4">
            Kirim Email <i class="fas fa-envelope ms-2"></i>
        </a>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>