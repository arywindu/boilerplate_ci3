<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<?php echo form_open_multipart('admin/edit/' . $artikel['id']); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Artikel</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul', $artikel['judul']); ?>" required placeholder="Masukkan judul artikel">
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>" <?php echo set_select('id_kategori', $kategori['id'], ($artikel['id_kategori'] == $kategori['id'])); ?>>
                                    <?php echo $kategori['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="isi" name="isi" rows="15" required placeholder="Tulis isi artikel di sini"><?php echo set_value('isi', $artikel['isi']); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Pengaturan SEO (Opsional)</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="meta_title" class="form-label">Meta Title (Judul SEO)</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo set_value('meta_title', $artikel['meta_title']); ?>" placeholder="Judul yang akan muncul di mesin pencari" maxlength="60">
                        <small class="form-text text-muted">Maksimal sekitar 50-60 karakter untuk tampilan optimal di Google.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description (Deskripsi SEO)</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Deskripsi singkat artikel untuk mesin pencari" maxlength="160"><?php echo set_value('meta_description', $artikel['meta_description']); ?></textarea>
                        <small class="form-text text-muted">Maksimal sekitar 150-160 karakter untuk tampilan optimal di Google.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords (Kata Kunci SEO)</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?php echo set_value('meta_keywords', $artikel['meta_keywords']); ?>" placeholder="pisahkan dengan koma, contoh: berita, teknologi, terbaru">
                        <small class="form-text text-muted">Kata kunci relevan yang dipisahkan koma.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Gambar Artikel</h5>
                </div>
                <div class="card-body">
                    <?php if (! empty($artikel['gambar'])): ?>
                        <div class="mb-3 text-center">
                            <label class="form-label">Gambar Saat Ini:</label><br>
                            <img src="<?php echo base_url('uploads/' . $artikel['gambar']); ?>" alt="Gambar Artikel" class="img-fluid rounded mb-2" style="max-width: 100%; height: auto; max-height: 150px; object-fit: contain;">
                        </div>
                    <?php endif; ?>
                    <div class="form-group mb-3">
                        <label for="gambar" class="form-label"><?php echo (!empty($artikel['gambar'])) ? 'Ganti Gambar (Opsional)' : 'Upload Gambar (Opsional)'; ?></label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                        <small class="form-text text-muted">Max 2MB, format: jpg, jpeg, png, gif</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fas fa-sync-alt me-2"></i> Update Artikel
                    </button>
                    <a href="<?php echo site_url('admin'); ?>" class="btn btn-secondary btn-lg w-100">
                        <i class="fas fa-times-circle me-2"></i> Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

<script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js'); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#isi', // ID dari textarea yang ingin dijadikan editor
            plugins: 'advlist autolink lists link image charmap print preview anchor code visualblocks',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image | code | help',
            height: 400,
            menubar: 'file edit view insert format tools table help'
        });
    });
</script>