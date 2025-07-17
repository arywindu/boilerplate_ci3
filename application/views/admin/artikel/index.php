<style>
    /* Custom CSS for Article List Page - place in admin/templates/header.php or global CSS file */
    /* Pastikan CSS ini ada di header.php jika ingin diterapkan global */
    .filter-card .card-header {
        background-color: var(--main-bg-color) !important; /* Match body background */
        color: var(--font-color-dark) !important;
        font-weight: 600;
        border-bottom: 1px solid var(--card-border-color);
    }
    .filter-card .btn-outline-secondary {
        border-color: var(--card-border-color);
        color: var(--font-color-dark);
    }
    .filter-card .btn-outline-secondary:hover {
        background-color: var(--sidebar-link-active-bg);
        color: #fff;
    }
    .filter-card .input-group .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* Primary color shadow */
        border-color: #0d6efd;
    }
    .table thead th {
        background-color: var(--main-bg-color); /* Lighter header for table */
        color: var(--font-color-dark);
        border-bottom: 2px solid var(--card-border-color);
        padding: 0.75rem 1rem; /* Tambah padding */
    }
    .table tbody td {
        padding: 0.75rem 1rem; /* Tambah padding */
        vertical-align: middle; /* Tengah vertikal */
    }
    .table tbody tr:hover {
        background-color: #f5f5f5; /* Light hover effect for rows */
    }
    .table img {
        border-radius: 0.25rem;
        object-fit: cover; /* Pastikan gambar proporsional */
        display: block; /* Hilangkan spasi bawah */
    }
    /* Action buttons in table */
    .table .btn-warning, .table .btn-danger {
        width: auto;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem; /* Sedikit lebih kecil */
    }
    .table .btn-warning i, .table .btn-danger i {
        margin-right: 5px;
    }
    .table .btn-warning { background-color: #ffc107; border-color: #ffc107; color: #212529; }
    .table .btn-warning:hover { background-color: #e0a800; border-color: #e0a800; color: #212529; }
    .table .btn-danger { background-color: #dc3545; border-color: #dc3545; color: #fff; }
    .table .btn-danger:hover { background-color: #c82333; border-color: #bd2130; color: #fff; }

    /* Pagination Styling (Refined) */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem; /* Jarak atas dari tabel */
        padding-bottom: 1rem; /* Jarak bawah */
    }
    .pagination .page-item .page-link {
         /* Sudut membulat sedikit */
        margin: 0 3px; /* Jarak antar nomor halaman */
        color: var(--font-color-dark); /* Warna teks default */
        border: 1px solid var(--card-border-color); /* Border tipis */
        transition: all 0.2s ease;
    }
    .pagination .page-item .page-link:hover {
        background-color: #e9ecef; /* Lighter hover background */
        color: var(--sidebar-link-active-bg);
    }
    .pagination .page-item.active .page-link {
        background-color: var(--sidebar-link-active-bg); /* Warna aktif */
        border-color: var(--sidebar-link-active-bg);
        color: #fff;
        box-shadow: 0 2px 5px rgba(13, 110, 253, 0.2); /* Subtle shadow for active */
    }
    .pagination .page-item.disabled .page-link {
        background-color: #e9ecef;
        border-color: var(--card-border-color);
        color: #6c757d;
        cursor: not-allowed;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Daftar Artikel</h1>
    <a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-primary btn-lg rounded-pill px-4">
        <i class="fas fa-plus me-2"></i> Tambah Artikel Baru
    </a>
</div>

<?php /* ... (Flashdata comments as before) ... */ ?>

<div class="card shadow-sm mb-4 filter-card">
    <div class="card-header d-flex align-items-center">
        <i class="fas fa-filter me-2"></i> Filter & Pencarian
    </div>
    <div class="card-body">
        <form class="d-flex" action="<?php echo site_url('admin/artikel_list'); ?>" method="get">
            <div class="input-group flex-grow-1 me-2">
                <input type="text" class="form-control" name="keyword" placeholder="Cari Judul atau Isi Artikel..." value="<?php echo html_escape($keyword); ?>">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search me-1"></i> Cari</button>
            </div>
            <?php if (! empty($keyword)): ?>
                <a href="<?php echo site_url('admin/artikel_list'); ?>" class="btn btn-outline-secondary"><i class="fas fa-times me-1"></i> Reset</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header d-flex align-items-center">
        <i class="fas fa-list me-2"></i> Daftar Artikel
    </div>
    <div class="card-body p-0"> <div class="table-responsive">
            <table class="table table-hover table-striped mb-0"> <thead>
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
                            <td colspan="6" class="text-center py-4">Tidak ada artikel ditemukan. <br><a href="<?php echo site_url('admin/tambah'); ?>" class="btn btn-sm btn-outline-primary mt-2">Tambah Artikel Pertama</a></td>
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
                                        <img src="<?php echo base_url('uploads/' . $item['gambar']); ?>" alt="<?php echo html_escape($item['judul']); ?>" width="70" height="50">
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d M Y H:i', strtotime($item['tanggal_publikasi'])); ?></td>
                                <td class="text-center text-nowrap">
                                    <a href="<?php echo site_url('admin/edit/' . $item['id']); ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?php echo site_url('admin/hapus/' . $item['id']); ?>" class="btn btn-danger btn-sm ms-1" onclick="return confirm('Anda yakin ingin menghapus artikel ini?');" title="Hapus">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            <?php echo $pagination_links; ?>
        </div>
    </div>
</div>