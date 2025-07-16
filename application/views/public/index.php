<div class="row">
    <?php if (empty($artikel)): ?>
        <div class="col-12">
            <p class="text-center">Belum ada artikel yang dipublikasikan.</p>
        </div>
    <?php else: ?>
        <?php foreach ($artikel as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if (! empty($item['gambar'])): ?>
                        <img src="<?php echo base_url('uploads/' . $item['gambar']); ?>" class="card-img-top" alt="<?php echo $item['judul']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['judul']; ?></h5>
                        <p class="card-text text-muted small"><?php echo date('d M Y H:i', strtotime($item['tanggal_publikasi'])); ?></p>
                        <p class="card-text"><?php echo word_limiter(strip_tags($item['isi']), 20); ?></p>
                        <a href="<?php echo site_url('artikel/' . $item['slug']); ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>