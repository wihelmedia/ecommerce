<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smart extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Admin_model', 'admin');
    $this->load->model('Smart_model', 'smart');
    $this->load->model('registration');
  }

  public function index()
	{
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['total'] =  $this->admin->totpesan();
        $data['pesan'] = $this->admin->getpesan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function info()
    {
        $config['base_url'] = base_url('smart/info');
        $config['total_rows'] = $this->db->count_all('kegiatan');
        $config['per_page'] = 6;
        $config['num_links'] = 5;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['title'] = 'Info Kegiatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesan'] = $this->admin->getpesan();
        $data['kegiatan'] = $this->smart->getkegiatan($config['per_page'], $data['start']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('smart/info', $data);
        $this->load->view('templates/footer');
    }

    public function detailkegiatan($id)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesan'] = $this->admin->getpesan();
        $data['kegiatan'] = $this->smart->kegiatanshow($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('smart/detail', $data);
        $this->load->view('templates/footer');
    }
}
