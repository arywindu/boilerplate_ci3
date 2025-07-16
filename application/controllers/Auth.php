<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Auth_model'); // Pastikan ini dimuat
        // Jika Anda memang punya model terpisah bernama User_model dan ingin menggunakannya,
        // buka komentar baris di bawah ini dan pastikan file User_model.php ada.
        // $this->load->model('User_model');
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

            // PERBAIKAN: Gunakan Auth_model yang sudah dimuat
            // Jika Anda menggunakan User_model, pastikan sudah dimuat di __construct()
            $user = $this->Auth_model->get_user_by_username($username); // <-- Perbaikan di sini

            if ($user) {
                // Verifikasi password
                // Jika Anda menggunakan MD5:
                if (md5($password) === $user['password']) {
                // Jika Anda menggunakan password_hash() (DIREKOMENDASIKAN):
                // if (password_verify($password, $user['password'])) {
                    // Password cocok, buat session
                    $userdata = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'logged_in' => true,
                    ];
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

    public function ubah_password()
    {
        // Pastikan pengguna sudah login untuk mengakses halaman ini
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth/login');
        }

        $data['title'] = 'Ubah Password';

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required',
            array('required' => '%s harus diisi.')
        );
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]',
            array(
                'required' => '%s minimal 6 karakter.'
            )
        );
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|matches[new_password]',
            array(
                'required' => '%s harus diisi.',
                'matches' => '%s tidak cocok dengan Password Baru.'
            )
        );

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal atau pertama kali halaman dimuat
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/user/ubah_password', $data); // View untuk form ubah password
            $this->load->view('admin/templates/footer');
        } else {
            // Proses ubah password
            $user_id = $this->session->userdata('user_id'); // Ambil user_id dari session
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Verifikasi password saat ini
            if ($this->Auth_model->verify_password($user_id, $current_password)) {
                // Update password baru
                if ($this->Auth_model->update_password($user_id, $new_password)) {
                    $this->session->set_flashdata('success', 'Password berhasil diubah.');
                    redirect('admin'); // Redirect ke dashboard admin setelah berhasil
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengubah password. Silakan coba lagi.');
                    redirect('ubah_password');
                }
            } else {
                $this->session->set_flashdata('error', 'Password saat ini salah.');
                redirect('ubah_password');
            }
        }
    }

    public function logout()
    {
        // Hapus semua data session yang terkait login
        $this->session->unset_userdata(['user_id', 'username', 'nama_lengkap', 'logged_in']);
        $this->session->sess_destroy(); // Hancurkan seluruh session
        $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
        redirect('auth/login');
    }
}