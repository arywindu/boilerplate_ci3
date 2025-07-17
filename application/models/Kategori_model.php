<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat database di konstruktor model
        // HAPUS Bagian ini untuk public/frontend, karena Auth/login tidak relevan di sini
        // if (!$this->session->userdata('logged_in')) {
        //    $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
        //    redirect('auth/login');
        // }
    }

    // Mengambil semua kategori (untuk dropdown atau daftar lengkap)
    public function get_all_kategori()
    {
        $this->db->order_by('nama_kategori', 'ASC');
        $query = $this->db->get('kategori');

        return $query->result_array(); // Mengembalikan array asosiatif dari semua baris
    }

    // Mengambil kategori berdasarkan ID
   public function get_kategori_by_id($id)
{
    $query = $this->db->get_where('kategori', array('id' => $id));
    return $query->row_array(); // Pastikan mengembalikan 1 baris
}

    // Mengambil kategori berdasarkan nama (untuk validasi unik)
    public function get_kategori_by_name($nama_kategori)
    {
        $query = $this->db->get_where('kategori', ['nama_kategori' => $nama_kategori]);

        return $query->row_array();
    }

    // Menambah kategori baru
    public function add_kategori($data)
    {
        return $this->db->insert('kategori', $data); // Mengembalikan TRUE/FALSE
    }

    // Memperbarui kategori
   public function update_kategori($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('kategori', $data); // Pastikan ada klausa WHERE
}

    // Menghapus kategori
   public function delete_kategori($id)
{
    return $this->db->delete('kategori', array('id' => $id)); // Pastikan ada klausa WHERE
}

    // Fungsi untuk Paginasi: Menghitung total kategori
    public function count_all_kategori()
    {
        return $this->db->count_all('kategori');
    }

    // Fungsi untuk Paginasi: Mengambil kategori dengan limit dan offset
    public function get_kategori_pagination($limit, $start)
    {
        $this->db->order_by('nama_kategori', 'ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    // Method baru untuk mengambil kategori populer
    public function get_popular_categories($limit = 4)
    {
        // Contoh sederhana: ambil kategori yang memiliki banyak artikel (jika ada kolom hit_count atau jumlah artikel)
        // Jika tidak ada, bisa diorder by ID atau nama
        $this->db->select('id, nama_kategori AS nama, slug_kategori AS slug'); // Alias untuk nama dan slug
        // Jika Anda punya tabel 'artikel' dan ingin menghitung artikel per kategori:
        // $this->db->join('artikel', 'artikel.id_kategori = kategori.id', 'left');
        // $this->db->group_by('kategori.id');
        // $this->db->order_by('COUNT(artikel.id)', 'DESC'); // Mengurutkan berdasarkan jumlah artikel
        $this->db->order_by('id', 'ASC'); // Sebagai contoh, urutkan berdasarkan ID
        $this->db->limit($limit);
        $query = $this->db->get('kategori');
        return $query->result_array();
    }
}