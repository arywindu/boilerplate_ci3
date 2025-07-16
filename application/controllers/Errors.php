
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); // Pastikan helper URL dimuat
    }

    public function page_not_found()
    {
        $this->output->set_status_header('404'); // Penting: Mengirim header 404
        $data['title'] = 'Halaman Tidak Ditemukan';
        $this->load->view('custom_404_view', $data); // Memuat view kustom Anda
    }
}