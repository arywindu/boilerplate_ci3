<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {

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

public function count_all_artikel($keyword = NULL) // Tambahkan parameter keyword
{
    if ($keyword) {
        $this->db->like('judul', $keyword);
        $this->db->or_like('isi', $keyword);
    }
    return $this->db->count_all_results('artikel'); // Gunakan count_all_results
}

public function get_artikel_pagination($limit, $start, $keyword = NULL) // Tambahkan parameter keyword
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
        return $this->db->insert('artikel', $data);
    }

    public function update_artikel($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('artikel', $data);
    }

    public function delete_artikel($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('artikel');
    }
}