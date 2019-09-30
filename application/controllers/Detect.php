<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detect extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Detect-face', 'face');
  }

  public function index()
	{
    $data['title'] = 'Detect Face';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('detect/index', $data);
    $this->load->view('templates/footer');
	}
}
