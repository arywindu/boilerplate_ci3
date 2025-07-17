<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<?php echo form_open_multipart('admin/tambah'); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Artikel</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul'); ?>" required placeholder="Masukkan judul artikel">
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>" <?php echo set_select('id_kategori', $kategori['id']); ?>>
                                    <?php echo $kategori['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="isi" name="isi" rows="15" required placeholder="Tulis isi artikel di sini"><?php echo set_value('isi'); ?></textarea>
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
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo set_value('meta_title'); ?>" placeholder="Judul yang akan muncul di mesin pencari" maxlength="60">
                        <small class="form-text text-muted">Maksimal sekitar 50-60 karakter untuk tampilan optimal di Google.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description (Deskripsi SEO)</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Deskripsi singkat artikel untuk mesin pencari" maxlength="160"><?php echo set_value('meta_description'); ?></textarea>
                        <small class="form-text text-muted">Maksimal sekitar 150-160 karakter untuk tampilan optimal di Google.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords (Kata Kunci SEO)</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?php echo set_value('meta_keywords'); ?>" placeholder="pisahkan dengan koma, contoh: berita, teknologi, terbaru">
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
                    <div class="form-group mb-3">
                        <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                        <small class="form-text text-muted">Max 2MB, format: jpg, jpeg, png, gif</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fas fa-save me-2"></i> Simpan Artikel
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
            plugins: 'advlist autolink lists link image charmap print preview anchor code visualblocks fullscreen paste', // Tambah 'fullscreen' dan 'paste'
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image | code | fullscreen | help',
            height: 400, // Tinggi editor
            menubar: 'file edit view insert format tools table help', // Tampilkan menubar
            // Opsional: Pastikan konten disinkronkan saat form disubmit
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // Ini memastikan konten TinyMCE disimpan ke textarea asli
                });
            }
        });

        // Tambahan: Pastikan konten TinyMCE disinkronkan saat form disubmit secara langsung
        // Ini adalah fallback penting jika setup editor.on('change') tidak cukup
        const form = document.querySelector('form'); // Ambil form pertama di halaman
        if (form) {
            form.addEventListener('submit', function() {
                tinymce.triggerSave(); // Memaksa TinyMCE untuk menyimpan konten ke textarea
            });
        }
    });
</script>