<div class="main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $title; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?php echo site_url('kategori_admin/tambah'); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $start + 1; // Inisialisasi nomor urut, disesuaikan dengan paginasi ?>
                <?php if (!empty($kategori)): // Pastikan $kategori tidak kosong sebelum looping ?>
                    <?php foreach ($kategori as $item): // <-- Variabel di sini HARUS $kategori, dan elemen loop $item atau nama lain ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $item['nama_kategori']; ?></td>
                            <td><?php echo $item['slug_kategori']; ?></td>
                            <td>
                                <a href="<?php echo site_url('kategori_admin/edit/' . $item['id']); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('kategori_admin/hapus/' . $item['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus kategori ini?');">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada kategori ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo $pagination_links; ?>

</div>