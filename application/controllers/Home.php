<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Artikel_model');
    }

    public function index()
    {
        $data['title'] = 'Berita Terbaru';
        $data['artikel'] = $this->Artikel_model->get_all_artikel();
        $this->load->view('public/templates/header', $data);
        $this->load->view('public/index', $data);
        $this->load->view('public/templates/footer');
    }

    public function detail($slug = NULL)
    {
        if ($slug === NULL) {
            show_404();
        }

        $data['artikel'] = $this->Artikel_model->get_artikel_by_slug($slug);

        if (empty($data['artikel'])) {
            show_404();
        }

        $data['title'] = $data['artikel']['judul'];
        $this->load->view('public/templates/header', $data);
        $this->load->view('public/detail', $data);
        $this->load->view('public/templates/footer');
    }
}