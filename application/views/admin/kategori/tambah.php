<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $title; ?></h1>
</div>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<?php echo form_open('kategori_admin/tambah'); ?>
    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo set_value('nama_kategori'); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
    <a href="<?php echo site_url('kategori_admin'); ?>" class="btn btn-secondary">Batal</a>
<?php echo form_close(); ?>