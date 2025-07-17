<section class="detail-hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="mb-3"><?php echo html_escape($artikel['judul']); ?></h1>
                <p class="post-meta">
                    <span class="badge bg-primary me-2"><i class="fas fa-tag"></i> <?php echo html_escape($artikel['nama_kategori']); ?></span>
                    <span><i class="far fa-calendar-alt"></i> Dipublikasikan: <?php echo date('d M Y H:i', strtotime($artikel['tanggal_publikasi'])); ?></span>
                </p>
            </div>
        </div>
    </div>
    <?php if (!empty($artikel['gambar'])): ?>
        <div class="featured-image-container">
            <img src="<?php echo base_url('uploads/' . $artikel['gambar']); ?>" class="img-fluid" alt="<?php echo html_escape($artikel['judul']); ?>">
        </div>
    <?php endif; ?>
</section>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body detail-content-body">
                    <?php echo $artikel['isi']; ?> </div>
            </div>

            <div class="d-flex justify-content-center mt-4 mb-4">
                <a href="<?php echo base_url(); ?>" class="btn btn-secondary btn-lg rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <div class="post-sidebar">
                <?php if (!empty($related_articles)): ?>
                <div class="card mb-4">
                    <div class="card-header">Artikel Terkait</div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($related_articles as $related): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo site_url('artikel/' . $related['slug']); ?>" class="d-block fw-bold"><?php echo html_escape($related['judul']); ?></a>
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> <?php echo date('d M Y', strtotime($related['tanggal_publikasi'])); ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

              

                <?php if (!empty($other_articles_choice)): ?>
                <div class="card mb-4">
                    <div class="card-header">Artikel Pilihan Lainnya</div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($other_articles_choice as $other_article): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo site_url('artikel/' . $other_article['slug']); ?>" class="d-block fw-bold"><?php echo html_escape($other_article['judul']); ?></a>
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> <?php echo date('d M Y', strtotime($other_article['tanggal_publikasi'])); ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!-- <div class="card mb-4 bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Ruang Iklan Anda</h5>
                        <img src="https://via.placeholder.com/300x250/cccccc/ffffff?text=Your+Ad+Here" class="img-fluid rounded mb-3" alt="Your Ad">
                        <p class="card-text small">Promosikan produk atau layanan Anda di sini!</p>
                        <a href="#" class="btn btn-info btn-sm rounded-pill">Info Lebih Lanjut</a>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>