<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Artikel
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $total_artikel; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Kategori
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $total_kategori; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php /*
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Pengguna
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo isset($total_users) ? $total_users : 'N/A'; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Komentar
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo isset($total_komentar) ? $total_komentar : 'N/A'; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    */ ?>
</div>

<div class="row">
    <!-- <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Artikel Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($latest_articles)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($latest_articles as $artikel): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo site_url('admin/edit/' . $artikel['id']); ?>">
                                    <?php echo $artikel['judul']; ?>
                                </a>
                                <span class="badge bg-light text-muted">
                                    <?php echo date('d M Y', strtotime($artikel['tanggal_publikasi'])); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-center">Belum ada artikel terbaru.</p>
                <?php endif; ?>
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo site_url('admin/artikel_list'); ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua Artikel <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div> -->

    <?php /*
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Komentar Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($latest_comments)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($latest_comments as $comment): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo html_escape($comment['nama_pengirim']); ?></strong> pada <a href="<?php echo site_url('artikel/' . $comment['artikel_slug']); ?>"><?php echo html_escape(word_limiter($comment['artikel_judul'], 5)); ?></a>
                                    <p class="mb-0 text-muted small"><?php echo html_escape(word_limiter($comment['isi_komentar'], 10)); ?></p>
                                </div>
                                <span class="badge bg-light text-muted">
                                    <?php echo date('d M Y', strtotime($comment['tanggal_komentar'])); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-center">Belum ada komentar terbaru.</p>
                <?php endif; ?>
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo site_url('admin/komentar_list'); ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua Komentar <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
    */ ?>
</div>