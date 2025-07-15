<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        // Jika sudah login, redirect ke halaman admin
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }

        $data['title'] = 'Login Admin';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Tampilkan form login jika validasi gagal atau belum submit
            $this->load->view('auth/login', $data);
        } else {
            // Proses login
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username($username);

            if ($user) {
    // Verifikasi password yang di-input dengan hash MD5 di database
    if (md5($password) === $user['password']) { // UBAH BARIS INI
        // Password cocok, buat session
        $userdata = array(
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'logged_in'  => TRUE
        );
        $this->session->set_userdata($userdata);
        $this->session->set_flashdata('success', 'Berhasil login sebagai ' . $user['username'] . '!');
        redirect('admin');
    } else {
        // Password tidak cocok
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth/login');
    }
    } else {
        // User tidak ditemukan
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth/login');
    }
        }
    }

    public function logout()
    {
        // Hapus semua data session yang terkait login
        $this->session->unset_userdata(array('user_id', 'username', 'nama_lengkap', 'logged_in'));
        $this->session->sess_destroy(); // Hancurkan seluruh session
        $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
        redirect('auth/login');
    }
}