<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<?php echo form_open_multipart('admin/edit/' . $artikel['id']); ?>
    <div class="form-group">
        <label for="judul">Judul Artikel</label>
        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul', $artikel['judul']); ?>" required>
    </div>
    <div class="form-group">
        <label for="id_kategori">Kategori</label>
        <select class="form-control" id="id_kategori" name="id_kategori" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori_list as $kategori): ?>
                <option value="<?php echo $kategori['id']; ?>" <?php echo set_select('id_kategori', $kategori['id'], ($artikel['id_kategori'] == $kategori['id'])); ?>>
                    <?php echo $kategori['nama_kategori']; ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="isi">Isi Artikel</label>
        <textarea class="form-control" id="isi" name="isi" rows="10" required><?php echo set_value('isi', $artikel['isi']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar (Kosongkan jika tidak ingin mengubah)</label>
        <input type="file" class="form-control-file" id="gambar" name="gambar">
        <small class="form-text text-muted">Max 2MB, format: jpg, jpeg, png, gif</small>
        <?php if (! empty($artikel['gambar'])): ?>
            <p class="mt-2">Gambar saat ini: <img src="<?php echo base_url('uploads/' . $artikel['gambar']); ?>" alt="Gambar Artikel" width="150"></p>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Update Artikel</button>
    <a href="<?php echo site_url('admin'); ?>" class="btn btn-secondary">Batal</a>
<?php echo form_close(); ?>

<script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: '#isi', // ID dari textarea yang ingin dijadikan editor
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });
</script>