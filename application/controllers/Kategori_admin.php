<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_admin extends CI_Controller { // Nama kelas tetap sama

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->helper('url');

        // Proteksi Halaman Admin
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login'); // Atau 'login' jika Anda meroutingnya
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Kategori';

        // Konfigurasi Paginasi
        // UBAH BASE_URL KEMBALI KE 'kategori_admin/index'
        $config['base_url'] = site_url('kategori_admin/index');
        $config['total_rows'] = $this->Kategori_model->count_all_kategori();
        $config['per_page'] = 10;
        // UBAH URI_SEGMENT KEMBALI KE 4
        $config['uri_segment'] = 4; // kategori_admin/index/HALAMAN

        // Gaya Bootstrap 5 untuk Paginasi (tetap sama)
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="visually-hidden">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment($config['uri_segment']);
        $data['kategori'] = $this->Kategori_model->get_kategori_pagination($config['per_page'], $data['start']);
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kategori Baru';

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[kategori.nama_kategori]',
            array(
                'required' => '%s harus diisi.',
                'is_unique' => '%s sudah ada, gunakan nama lain.'
            )
        );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/kategori/tambah');
            $this->load->view('admin/templates/footer');
        } else {
            $nama_kategori = $this->input->post('nama_kategori', TRUE);
            $slug_kategori = url_title($nama_kategori, 'dash', TRUE);

            $data_kategori = array(
                'nama_kategori' => $nama_kategori,
                'slug_kategori' => $slug_kategori
            );

            $this->Kategori_model->add_kategori($data_kategori);
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
            // UBAH REDIRECT KEMBALI KE 'kategori_admin'
            redirect('kategori_admin');
        }
    }

    public function edit($id = NULL)
    {
        if ($id === NULL) {
            // UBAH REDIRECT KEMBALI KE 'kategori_admin'
            redirect('kategori_admin');
        }

        $data['title'] = 'Edit Kategori';
        $data['kategori'] = $this->Kategori_model->get_kategori_by_id($id);

        if (empty($data['kategori'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|callback_nama_kategori_check',
            array(
                'required' => '%s harus diisi.'
            )
        );
        $this->form_validation->set_message('nama_kategori_check', '%s sudah ada, gunakan nama lain.');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/kategori/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $nama_kategori = $this->input->post('nama_kategori', TRUE);
            $slug_kategori = url_title($nama_kategori, 'dash', TRUE);

            $data_kategori = array(
                'nama_kategori' => $nama_kategori,
                'slug_kategori' => $slug_kategori
            );

            $this->Kategori_model->update_kategori($id, $data_kategori);
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
            // UBAH REDIRECT KEMBALI KE 'kategori_admin'
            redirect('kategori_admin');
        }
    }

    public function nama_kategori_check($nama_kategori)
    {
        $id = $this->input->post('id_kategori_hidden');
        $kategori_exist = $this->Kategori_model->get_kategori_by_name($nama_kategori);

        if ($kategori_exist && $kategori_exist['id'] != $id) {
            return FALSE;
        }
        return TRUE;
    }

    public function hapus($id = NULL)
    {
        if ($id === NULL) {
            // UBAH REDIRECT KEMBALI KE 'kategori_admin'
            redirect('kategori_admin');
        }

        $kategori = $this->Kategori_model->get_kategori_by_id($id);

        if (empty($kategori)) {
            show_404();
        }

        $this->Kategori_model->delete_kategori($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        // UBAH REDIRECT KEMBALI KE 'kategori_admin'
        redirect('kategori_admin');
    }
}