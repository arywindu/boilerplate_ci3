<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_kategori()
    {
        $this->db->order_by('nama_kategori', 'ASC');
        $query = $this->db->get('kategori');
        return $query->result_array();
    }

    public function get_kategori_by_id($id)
    {
        $query = $this->db->get_where('kategori', array('id' => $id));
        return $query->row_array();
    }

    public function get_kategori_by_slug($slug)
    {
        $query = $this->db->get_where('kategori', array('slug_kategori' => $slug));
        return $query->row_array();
    }

    public function tambah_kategori($data)
    {
        return $this->db->insert('kategori', $data);
    }

    public function update_kategori($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kategori', $data);
    }

    public function delete_kategori($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kategori');
    }
}