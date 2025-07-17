<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login
        if (! $this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login');
        }
        $this->load->model('Artikel_model');
        $this->load->model('Kategori_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('upload'); // Pastikan library 'upload' juga dimuat
    }

    public function index() // Ini akan jadi dashboard
{
    $data['title'] = 'Dashboard Admin';

    // Ambil statistik dasar
    $data['total_artikel'] = $this->Artikel_model->count_all_artikel(); // Tanpa keyword
    $data['total_kategori'] = $this->Kategori_model->count_all_kategori();

    // Anda perlu model untuk user dan komentar untuk mendapatkan totalnya
    // Contoh (jika Anda memiliki model User_model dan Komentar_model):
    // $this->load->model('User_model');
    // $this->load->model('Komentar_model');
    // $data['total_users'] = $this->User_model->count_all_users();
    // $data['total_komentar'] = $this->Komentar_model->count_all_komentar();

    // Ambil artikel terbaru (misal 5 artikel terakhir)
    $data['latest_articles'] = $this->Artikel_model->get_latest_articles(5);

    // Ambil komentar terbaru (misal 5 komentar terakhir, jika ada model Komentar_model)
    // $data['latest_comments'] = $this->Komentar_model->get_latest_comments(5);

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/dashboard/index', $data); // View dashboard/index
    $this->load->view('admin/templates/footer');
}

    public function artikel_list()
    {
        $data['title'] = 'Daftar Artikel';
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();

        // Ambil keyword pencarian dari URL parameter (GET)
        $keyword = $this->input->get('keyword', true);
        $data['keyword'] = $keyword;

        // Konfigurasi Paginasi
        $config['base_url'] = site_url('admin/artikel_list');
        $config['per_page'] = 5; // Jumlah artikel per halaman
        $config['uri_segment'] = 3; // Segment URL yang berisi nomor halaman (misal: admin/index/5)

        // Penyesuaian Paginasi untuk Pencarian
        if ($keyword) {
            $config['suffix'] = '?keyword=' . urlencode($keyword);
            $config['first_url'] = $config['base_url'] . $config['suffix'];
        }

        // Hitung total baris berdasarkan keyword (jika ada)
        $config['total_rows'] = $this->Artikel_model->count_all_artikel($keyword);

// Gaya Bootstrap untuk Paginasi (KOREKSI FINAL UNTUK STRUKTUR HTML)
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        // Pastikan link nomor halaman dan prev/next/first/last juga memiliki class 'page-link'
        $config['num_tag_open'] = '<li class="page-item">'; // Membuka li
        $config['num_tag_close'] = '</li>'; // Menutup li

        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link">'; // Untuk halaman aktif, tambahkan a.page-link di dalamnya
        $config['cur_tag_close'] = '</a></li>'; // Tutup a dan li

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link'); // Ini akan diterapkan ke semua tag <a>

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment($config['uri_segment']);
        // Ambil artikel sesuai paginasi DAN keyword
        $data['artikel'] = $this->Artikel_model->get_artikel_pagination($config['per_page'], $data['start'], $keyword);
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/artikel/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function tambah()
{
    $data['title'] = 'Tambah Artikel';
    $data['kategori_list'] = $this->Kategori_model->get_all_kategori();

    // --- Aturan Validasi untuk Semua Field Mandatory ---
    $this->form_validation->set_rules('judul', 'Judul Artikel', 'required|min_length[5]|max_length[255]',
        array('required' => '%s harus diisi.') // Pesan error kustom
    );
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|numeric',
        array('required' => '%s harus dipilih.')
    );
    $this->form_validation->set_rules('isi', 'Isi Artikel', 'required',
        array('required' => '%s harus diisi.')
    );
    // Untuk gambar, kita tidak pakai 'required' karena itu adalah input 'file'
    // CI Form Validation tidak punya aturan 'required' bawaan untuk file input.
    // Penanganan gambar wajib biasanya dilakukan secara manual di logic controller
    // setelah form_validation->run()
    // Atau menggunakan library custom seperti 'form_validation_file_upload' jika diperlukan.

    // Field SEO juga dibuat mandatory
    $this->form_validation->set_rules('meta_title', 'Meta Title', 'required|max_length[255]',
        array('required' => '%s harus diisi.')
    );
    $this->form_validation->set_rules('meta_description', 'Meta Description', 'required|max_length[500]',
        array('required' => '%s harus diisi.')
    );
    $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required|max_length[255]',
        array('required' => '%s harus diisi.')
    );
    // --- Akhir Aturan Validasi ---


    if ($this->form_validation->run() === false) {
        // Jika validasi gagal atau pertama kali form dimuat
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/artikel/form_tambah', $data);
        $this->load->view('admin/templates/footer');
    } else {
        // ... (Kode Anda untuk memproses data input dan upload gambar) ...
        // Tambahan: jika gambar wajib, cek di sini:
        // if (empty($_FILES['gambar']['name'])) {
        //     $this->session->set_flashdata('error_upload', 'Gambar artikel wajib diunggah.');
        //     redirect('admin/tambah'); // Atau reload view dengan error
        //     return;
        // }

        $judul = $this->input->post('judul', TRUE);
        $slug = url_title($judul, 'dash', true);
        $isi = $this->input->post('isi', FALSE);
        $id_kategori = $this->input->post('id_kategori', TRUE);

        $meta_title = $this->input->post('meta_title', TRUE);
        $meta_description = $this->input->post('meta_description', TRUE);
        $meta_keywords = $this->input->post('meta_keywords', TRUE);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $slug . '_' . time();

        $this->upload->initialize($config);

        $gambar = null;
        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $gambar = $upload_data['file_name'];
        } else {
            if ($this->upload->display_errors('', '') != 'You did not select a file to upload.') {
                $this->session->set_flashdata('error_upload', $this->upload->display_errors());
            }
        }

        $data_insert = [
            'judul'             => $judul,
            'slug'              => $slug,
            'isi'               => $isi,
            'gambar'            => $gambar,
            'id_kategori'       => $id_kategori,
            'meta_title'        => $meta_title,
            'meta_description'  => $meta_description,
            'meta_keywords'     => $meta_keywords
        ];

        $this->Artikel_model->tambah_artikel($data_insert);
        $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
        redirect('admin');
    }
}

public function upload_gambar_editor()
{
    // Pastikan ini hanya bisa diakses oleh user yang login
    if (! $this->session->userdata('logged_in')) {
        $this->output->set_status_header(401)->set_output(json_encode(['status' => 'error', 'message' => 'Unauthorized access.']));
        return;
    }

    $config['upload_path']   = './uploads/editor_images/'; // Buat subfolder ini di dalam uploads/
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 5000; // 5MB (Sesuaikan batas ukuran)
    $config['file_name']     = uniqid('img_editor_'); // Nama file unik

    // Pastikan folder uploads/editor_images ada
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777, TRUE); // Buat folder jika belum ada
    }

    $this->upload->initialize($config);

    if ($this->upload->do_upload('file')) { // Nama input file harus 'file' sesuai FormData
        $upload_data = $this->upload->data();
        $file_url = base_url('uploads/editor_images/' . $upload_data['file_name']);
        
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'success', 'url' => $file_url]));
    } else {
        $this->output->set_status_header(500)->set_output(json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]));
    }
}

public function delete_gambar_editor()
{
    // Pastikan ini hanya bisa diakses oleh user yang login
    if (! $this->session->userdata('logged_in')) {
        $this->output->set_status_header(401)->set_output(json_encode(['status' => 'error', 'message' => 'Unauthorized access.']));
        return;
    }

    $file_url = $this->input->post('file_url');
    $file_name = basename($file_url); // Ambil nama file dari URL
    $file_path = './uploads/editor_images/' . $file_name;

    // Pastikan file_path tidak keluar dari folder uploads/editor_images/
    if (strpos(realpath($file_path), realpath('./uploads/editor_images/')) === 0 && file_exists($file_path)) {
        if (unlink($file_path)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'success', 'message' => 'File deleted.']));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Failed to delete file.']));
        }
    } else {
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Invalid file path.']));
    }
}

    public function edit($id = null)
    {
        if ($id === null) {
            show_404();
        }

        $data['title'] = 'Edit Artikel';
        $data['artikel'] = $this->Artikel_model->get_artikel_by_id($id);
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();

        if (empty($data['artikel'])) {
            show_404();
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('isi', 'Isi Artikel', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|numeric');

        // Validasi untuk field SEO (opsional)
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'max_length[255]');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'max_length[500]');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'max_length[255]');


        if ($this->form_validation->run() === false) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/artikel/form_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $judul = $this->input->post('judul', TRUE);
            $slug = url_title($judul, 'dash', true);
            $isi = $this->input->post('isi', FALSE);
            $id_kategori = $this->input->post('id_kategori', TRUE);

            // Ambil data SEO dari form
            $meta_title = $this->input->post('meta_title', TRUE);
            $meta_description = $this->input->post('meta_description', TRUE);
            $meta_keywords = $this->input->post('meta_keywords', TRUE);


            $data_update = [
                'judul'             => $judul,
                'slug'              => $slug,
                'isi'               => $isi,
                'id_kategori'       => $id_kategori,
                'meta_title'        => $meta_title,        // DATA SEO DITAMBAHKAN
                'meta_description'  => $meta_description,  // DATA SEO DITAMBAHKAN
                'meta_keywords'     => $meta_keywords      // DATA SEO DITAMBAHKAN
            ];

            // Handle upload gambar jika ada perubahan
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['file_name'] = $slug . '_' . time();

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if (! empty($data['artikel']['gambar']) && file_exists('./uploads/' . $data['artikel']['gambar'])) {
                    unlink('./uploads/' . $data['artikel']['gambar']);
                }
                $upload_data = $this->upload->data();
                $data_update['gambar'] = $upload_data['file_name'];
            } else {
                // Hanya set flashdata error jika ada error upload selain 'tidak ada file dipilih'
                if ($this->upload->display_errors('', '') != 'You did not select a file to upload.') {
                    $this->session->set_flashdata('error_upload', $this->upload->display_errors());
                }
            }

            $this->Artikel_model->update_artikel($id, $data_update);
            $this->session->set_flashdata('success', 'Artikel berhasil diperbarui!');
            redirect('admin');
        }
    }

    public function hapus($id = null)
    {
        if ($id === null) {
            show_404();
        }

        $artikel = $this->Artikel_model->get_artikel_by_id($id);

        if (empty($artikel)) {
            show_404();
        }

        // Hapus gambar terkait jika ada
        if (! empty($artikel['gambar']) && file_exists('./uploads/' . $artikel['gambar'])) {
            unlink('./uploads/' . $artikel['gambar']);
        }

        $this->Artikel_model->delete_artikel($id);
        $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        redirect('admin');
    }
}