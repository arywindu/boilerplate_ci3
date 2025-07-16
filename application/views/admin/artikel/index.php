<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $title; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Tambah Artikel Baru
        </a>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>
<?php endif; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        Filter & Pencarian
    </div>
    <div class="card-body">
        <form class="d-flex" action="<?php echo site_url('admin/index'); ?>" method="get"> <div class="input-group flex-fill me-2"> <input type="text" class="form-control" name="keyword" placeholder="Cari Judul atau Isi Artikel..." value="<?php echo html_escape($keyword); ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
            <?php if (! empty($keyword)): ?>
                <a href="<?php echo site_url('admin'); ?>" class="btn btn-outline-danger"><i class="fas fa-times"></i> Reset</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        Daftar Artikel
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Tanggal Publikasi</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($artikel)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada artikel ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = $start + 1; ?>
                        <?php foreach ($artikel as $item): ?>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo html_escape($item['judul']); ?></td>
                                <td><?php echo html_escape($item['nama_kategori'] ?: 'Tidak Berkategori'); ?></td>
                                <td>
                                    <?php if (! empty($item['gambar'])): ?>
                                        <img src="<?php echo base_url('uploads/' . $item['gambar']); ?>" alt="Gambar" width="50">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak Ada</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d M Y H:i', strtotime($item['tanggal_publikasi'])); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo site_url('admin/edit/' . $item['id']); ?>" class="btn btn-warning btn-sm mx-1" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?php echo site_url('admin/hapus/' . $item['id']); ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Anda yakin ingin menghapus artikel ini?');" title="Hapus">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <?php echo $pagination_links; ?>
        </div>
    </div>
</div>