<div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title"><?php echo $artikel['judul']; ?></h2>
        <p class="card-text text-muted small">Dipublikasikan pada: <?php echo date('d M Y H:i', strtotime($artikel['tanggal_publikasi'])); ?></p>
        <?php if (! empty($artikel['gambar'])): ?>
            <img src="<?php echo base_url('uploads/' . $artikel['gambar']); ?>" class="img-fluid mb-3" alt="<?php echo $artikel['judul']; ?>">
        <?php endif; ?>
        <div class="card-text">
            <?php echo $artikel['isi']; ?>
        </div>
    </div>
</div>
<a href="<?php echo base_url(); ?>" class="btn btn-secondary">Kembali ke Daftar Artikel</a>