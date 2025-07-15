<a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-primary mb-3">Tambah Artikel Baru</a>

<a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-primary mb-3">Tambah Artikel Baru</a>

<div class="row mb-3">
    <div class="col-md-6">
        <?php echo form_open(site_url('admin/index'), ['method' => 'get']); ?>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari artikel..." name="keyword" value="<?php echo html_escape($keyword); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    <?php if ($keyword): ?>
                        <a href="<?php echo site_url('admin'); ?>" class="btn btn-outline-danger">Reset</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<table class="table table-bordered table-striped">

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th> <th>Tanggal Publikasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($artikel)): ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada artikel.</td> </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($artikel as $item): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $item['judul']; ?></td>
                    <td>
                        <?php
                        // Cari nama kategori berdasarkan id_kategori
                        $kategori_nama = 'Tidak Berkategori';
                        foreach ($kategori_list as $kategori_item) {
                            if ($kategori_item['id'] == $item['id_kategori']) {
                                $kategori_nama = $kategori_item['nama_kategori'];
                                break;
                            }
                        }
                        echo $kategori_nama;
                        ?>
                    </td> <td><?php echo date('d M Y H:i', strtotime($item['tanggal_publikasi'])); ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/edit/' . $item['id']); ?>" class="btn btn-warning btn-sm btn-action">Edit</a>
                        <a href="<?php echo site_url('admin/hapus/' . $item['id']); ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php echo $pagination_links; ?> ```
Untuk melihat hasilnya, Anda mungkin perlu menambahkan lebih banyak artikel di database (lebih dari 5, karena `per_page` kita atur 5).