<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Method ini digunakan di Auth Controller untuk mendapatkan data user saat login
    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); // Sesuaikan 'users' dengan nama tabel user Anda
        return $query->row_array();
    }

    // Method ini digunakan di Auth Controller untuk verifikasi password saat ini
    public function verify_password($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users'); // Sesuaikan 'users' dengan nama tabel user Anda

        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            // Jika Anda menggunakan MD5 untuk menyimpan password:
            return (md5($password) === $user['password']);

            // Jika Anda menggunakan password_hash() (DIREKOMENDASIKAN untuk PRODUKSI!):
            // return password_verify($password, $user['password']);
        }
        return FALSE;
    }

    // Method ini digunakan di Auth Controller untuk memperbarui password user
    public function update_password($user_id, $new_password)
    {
        // Pastikan Anda melakukan hashing pada password baru sebelum menyimpannya!
        // Jika Anda menggunakan MD5:
        $hashed_password = md5($new_password);
        $data = array('password' => $hashed_password);

        // Jika Anda menggunakan password_hash() (DIREKOMENDASIKAN untuk PRODUKSI!):
        // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // $data = array('password' => $hashed_password);

        $this->db->where('id', $user_id);
        return $this->db->update('users', $data); // Sesuaikan 'users' dengan nama tabel user Anda
    }
}