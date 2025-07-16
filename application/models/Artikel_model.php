<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_artikel()
    {
        $this->db->select('artikel.*, kategori.nama_kategori'); // Pilih kolom artikel dan nama kategori
        $this->db->from('artikel');
        $this->db->join('kategori', 'kategori.id = artikel.id_kategori', 'left'); // LEFT JOIN agar artikel tanpa kategori tetap muncul
        $this->db->order_by('artikel.tanggal_publikasi', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_artikel_by_id($id)
    {
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'kategori.id = artikel.id_kategori', 'left');
        $this->db->where('artikel.id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_artikel_by_slug($slug)
    {
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'kategori.id = artikel.id_kategori', 'left');
        $this->db->where('artikel.slug', $slug);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function count_all_artikel($keyword = null) // Tambahkan parameter keyword
    {
        if ($keyword) {
            $this->db->like('judul', $keyword);
            $this->db->or_like('isi', $keyword);
        }

        return $this->db->count_all_results('artikel'); // Gunakan count_all_results
    }

    public function get_latest_articles($limit = 5)
{
    $this->db->order_by('tanggal_publikasi', 'DESC');
    $this->db->limit($limit);
    $query = $this->db->get('artikel');
    return $query->result_array();
}

    public function get_artikel_pagination($limit, $start, $keyword = null) // Tambahkan parameter keyword
    {
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'kategori.id = artikel.id_kategori', 'left');
        $this->db->order_by('artikel.tanggal_publikasi', 'DESC');

        if ($keyword) { // Tambahkan kondisi pencarian
            $this->db->like('judul', $keyword);
            $this->db->or_like('isi', $keyword);
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function tambah_artikel($data)
    {
        // $data seharusnya sudah termasuk meta_title, meta_description, meta_keywords
        return $this->db->insert('artikel', $data);
    }

    public function update_artikel($id, $data)
    {
        // $data seharusnya sudah termasuk meta_title, meta_description, meta_keywords
        $this->db->where('id', $id);
        return $this->db->update('artikel', $data);
    }

    public function delete_artikel($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('artikel');
    }
}
