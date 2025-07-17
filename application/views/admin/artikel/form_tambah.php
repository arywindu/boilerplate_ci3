<?php echo validation_errors('<div class="alert alert-danger mb-4">', '</div>'); ?>

<?php echo form_open_multipart('admin/tambah', ['id' => 'formArtikel']); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 border-primary shadow-lg">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-fw fa-pencil-alt me-2"></i>
                    <h5 class="mb-0">Detail Artikel</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label d-block">
                            Judul Artikel <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="judul" name="judul" value="<?php echo set_value('judul'); ?>" required placeholder="Masukkan judul artikel yang menarik">
                        <div class="form-text">Judul utama artikel Anda yang akan ditampilkan di website. Contoh: 10 Tren Teknologi Terbaru di Tahun 2024.</div>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label d-block">
                            Kategori <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>" <?php echo set_select('id_kategori', $kategori['id']); ?>>
                                    <?php echo html_escape($kategori['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Pilih kategori yang paling sesuai untuk artikel ini.</div>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label d-block">
                            Isi Artikel <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="isi" name="isi" rows="15" required placeholder="Mulai tulis artikel Anda..."><?php echo set_value('isi'); ?></textarea>
                        <div class="form-text">Tulis konten lengkap artikel Anda di sini. Gunakan editor di atas untuk formatting dan menyisipkan media.</div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 border-info shadow-lg">
                <div class="card-header bg-info text-white d-flex align-items-center">
                    <i class="fas fa-fw fa-search me-2"></i>
                    <h5 class="mb-0">Pengaturan SEO <small class="text-white-50">(Opsional)</small></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Optimalkan artikel Anda untuk mesin pencari dengan mengisi informasi SEO di bawah ini.</p>
                    <div class="mb-3">
                        <label for="meta_title" class="form-label d-block">
                            Meta Title (Judul SEO)
                        </label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo set_value('meta_title'); ?>" placeholder="Judul optimasi SEO" maxlength="60">
                        <div class="form-text">Judul yang akan muncul di tab browser dan hasil pencarian Google. Maksimal sekitar 50-60 karakter.</div>
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label d-block">
                            Meta Description (Deskripsi SEO)
                        </label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Deskripsi singkat artikel untuk mesin pencari" maxlength="160"><?php echo set_value('meta_description'); ?></textarea>
                        <div class="form-text">Ringkasan singkat artikel yang muncul di bawah judul di hasil pencarian. Maksimal sekitar 150-160 karakter.</div>
                    </div>
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label d-block">
                            Meta Keywords (Kata Kunci SEO)
                        </label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?php echo set_value('meta_keywords'); ?>" placeholder="contoh: berita, teknologi, terbaru">
                        <div class="form-text">Kata kunci relevan yang menggambarkan isi artikel. Pisahkan dengan koma (misal: "berita, teknologi, terbaru").</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 border-success shadow-lg">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="fas fa-fw fa-image me-2"></i>
                    <h5 class="mb-0">Gambar Artikel <small class="text-white-50">(Opsional)</small></h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="gambar" class="form-label d-block">
                            Upload Gambar Utama
                        </label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <div class="form-text">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-save me-2"></i> Simpan Artikel
                    </button>
                    <a href="<?php echo site_url('admin/artikel_list'); ?>" class="btn btn-secondary btn-lg w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-times-circle me-2"></i> Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>