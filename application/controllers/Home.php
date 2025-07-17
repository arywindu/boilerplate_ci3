<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Artikel_model');
        $this->load->model('Kategori_model'); // MUAT KATEGORI_MODEL
        $this->load->helper('url'); // MUAT HELPER URL
        $this->load->helper('text'); // MUAT HELPER TEXT
    }

    public function index()
    {
        $data['title'] = 'Berita Terbaru';
        $data['artikel'] = $this->Artikel_model->get_all_artikel();

        // Artikel Unggulan (untuk carousel di homepage)
        $data['featured_articles'] = $this->Artikel_model->get_latest_articles(3); // Ambil 3 artikel terbaru

        // Rekomendasi Produk (dari pembahasan sebelumnya, jika masih ada)
        // Ini contoh dummy, ganti dengan data real jika ada tabel produk
        $data['recommended_products'] = [
            [
                'nama_produk' => 'Laptop Gaming Terbaru',
                'gambar_produk' => 'https://via.placeholder.com/400x300/007bff/FFFFFF?text=Laptop+Gaming',
                'harga_produk' => 'Mulai dari Rp15.000.000',
                'deskripsi_produk' => 'Performa tinggi untuk gaming dan multitasking.',
                'link_affiliate' => 'https://link-affiliate-laptop.com/produk123'
            ],
            [
                'nama_produk' => 'Smartwatch Anti Air',
                'gambar_produk' => 'https://via.placeholder.com/400x300/28a745/FFFFFF?text=Smartwatch',
                'harga_produk' => 'Rp850.000',
                'deskripsi_produk' => 'Pantau kesehatan dan notifikasi Anda. Tahan air hingga 50m.',
                'link_affiliate' => 'https://link-affiliate-smartwatch.com/produk456'
            ],
            // Tambahkan produk lain
        ];

        $this->load->view('public/templates/header', $data);
        $this->load->view('public/index', $data);
        $this->load->view('public/templates/footer');
    }

    public function detail($slug = null)
    {
        if ($slug === null) {
            show_404();
        }

        $data['artikel'] = $this->Artikel_model->get_artikel_by_slug($slug);

        if (empty($data['artikel'])) {
            show_404();
            return;
        }

        $data['title'] = $data['artikel']['judul'];

        // --- Ambil data nyata untuk Sidebar Artikel Detail ---
        // 1. Artikel Terkait: Artikel dari kategori yang sama (kecuali artikel saat ini)
        $data['related_articles'] = $this->Artikel_model->get_related_articles($data['artikel']['id_kategori'], $data['artikel']['id'], 3);

        // 2. Kategori Populer
        $data['popular_categories'] = $this->Kategori_model->get_popular_categories(4);

        // 3. Artikel Pilihan Lainnya (Menggantikan Produk Rekomendasi)
        $data['other_articles_choice'] = $this->Artikel_model->get_random_articles_not_in_list([$data['artikel']['id']], [], 3); // Ambil 3 artikel acak, tidak termasuk artikel saat ini, dan dari semua kategori

        $this->load->view('public/templates/header', $data);
        $this->load->view('public/detail', $data);
        $this->load->view('public/templates/footer');
    }
}