<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login');
        }
        $this->load->model('Artikel_model');
        $this->load->model('Kategori_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pagination');
        // Pastikan library 'upload' juga dimuat jika belum di autoload
        $this->load->library('upload'); 
    }

    public function index()
    {
        $data['title'] = 'Daftar Artikel';
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();

        // --- Bagian Perbaikan Pencarian ---
        // Ambil keyword pencarian dari URL parameter (GET)
        $keyword = $this->input->get('keyword', TRUE); // TRUE untuk XSS filtering
        $data['keyword'] = $keyword; // Teruskan keyword ini ke view agar form pencarian bisa mengisi kembali nilai inputnya
        // --- Akhir Bagian Perbaikan Pencarian ---

        // Konfigurasi Paginasi
        $config['base_url'] = site_url('admin/index');
        $config['per_page'] = 5; // Jumlah artikel per halaman
        $config['uri_segment'] = 3; // Segment URL yang berisi nomor halaman (misal: admin/index/5)

        // --- Penyesuaian Paginasi untuk Pencarian ---
        // Jika ada keyword, tambahkan ke base_url paginasi sebagai suffix
        if ($keyword) {
            $config['suffix'] = '?keyword=' . urlencode($keyword);
            $config['first_url'] = $config['base_url'] . $config['suffix']; // Atur link halaman pertama dengan suffix
        }
        // --- Akhir Penyesuaian Paginasi ---

        // Hitung total baris berdasarkan keyword (jika ada)
        // Fungsi count_all_artikel di model harus menerima parameter keyword
        $config['total_rows'] = $this->Artikel_model->count_all_artikel($keyword); 

        // Gaya Bootstrap untuk Paginasi
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        $config['attributes'] = array('class' => 'page-link'); // Tambahkan class ke link

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment($config['uri_segment']); // Ambil offset
        // Ambil artikel sesuai paginasi DAN keyword
        $data['artikel'] = $this->Artikel_model->get_artikel_pagination($config['per_page'], $data['start'], $keyword);
        $data['pagination_links'] = $this->pagination->create_links(); // Buat link paginasi

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/artikel/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Artikel';
        $data['kategori_list'] = $this->Kategori_model->get_all_kategori();

        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('isi', 'Isi Artikel', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/artikel/form_tambah', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $judul = $this->input->post('judul');
            $slug = url_title($judul, 'dash', TRUE);
            $isi = $this->input->post('isi');
            $id_kategori = $this->input->post('id_kategori');

            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = $slug . '_' . time();

            $this->upload->initialize($config); // Inisialisasi upload dengan config

            $gambar = NULL;
            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            } else {
                // Jangan tampilkan error "You did not select a file to upload."
                if ($this->upload->display_errors('', '') != 'You did not select a file to upload.') {
                    $this->session->set_flashdata('error_upload', $this->upload->display_errors());
                }
            }

            $data_insert = array(
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'gambar' => $gambar,
                'id_kategori' => $id_kategori
            );

            $this->Artikel_model->tambah_artikel($data_insert);
            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
            redirect('admin');
        }
    }

    public function edit($id = NULL)
    {
        if ($id === NULL) {
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

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/artikel/form_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $judul = $this->input->post('judul');
            $slug = url_title($judul, 'dash', TRUE);
            $isi = $this->input->post('isi');
            $id_kategori = $this->input->post('id_kategori');

            $data_update = array(
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'id_kategori' => $id_kategori
            );

            // Handle upload gambar jika ada perubahan
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['file_name']     = $slug . '_' . time();

            $this->upload->initialize($config); // Inisialisasi upload dengan config

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if (!empty($data['artikel']['gambar']) && file_exists('./uploads/' . $data['artikel']['gambar'])) {
                    unlink('./uploads/' . $data['artikel']['gambar']);
                }
                $upload_data = $this->upload->data();
                $data_update['gambar'] = $upload_data['file_name'];
            } else {
                // Jangan tampilkan error "You did not select a file to upload."
                if ($this->upload->display_errors('', '') != 'You did not select a file to upload.') {
                    $this->session->set_flashdata('error_upload', $this->upload->display_errors());
                }
            }

            $this->Artikel_model->update_artikel($id, $data_update);
            $this->session->set_flashdata('success', 'Artikel berhasil diperbarui!');
            redirect('admin');
        }
    }

    public function hapus($id = NULL)
    {
        if ($id === NULL) {
            show_404();
        }

        $artikel = $this->Artikel_model->get_artikel_by_id($id);

        if (empty($artikel)) {
            show_404();
        }

        // Hapus gambar terkait jika ada
        if (!empty($artikel['gambar']) && file_exists('./uploads/' . $artikel['gambar'])) {
            unlink('./uploads/' . $artikel['gambar']);
        }

        $this->Artikel_model->delete_artikel($id);
        $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        redirect('admin');
    }
}