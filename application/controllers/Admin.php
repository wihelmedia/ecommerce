<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Admin_model', 'admin');
  }

  public function index()
	{
    $data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
	}

  public function role()
	{
    $data['title'] = 'Roles';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['role'] = $this->admin->getRole();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('admin/role', $data);
    $this->load->view('templates/footer');
	}

  public function userdata()
	{
    $data['title'] = 'Users Data';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['userdata'] = $this->admin->getUsers();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('admin/userdata', $data);
    $this->load->view('templates/footer');
	}

  public function roleaccess($role_id)
	{
    $data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['role_id'] = $this->admin->getRoleAccess($role_id);
    $data['menu'] = $this->admin->getMenu();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('admin/role-access', $data);
    $this->load->view('templates/footer');
	}

  public function changeaccess()
  {
    $data = [
      'role_id' => $this->input->post('roleId'),
      'menu_id' => $this->input->post('menuId')
    ];

    $result = $this->admin->changeacc($data);

    if ($result->num_rows() < 1) {
      $this->admin->insertAccess($data);
    } else {
      $this->admin->deleteAccess($data);
    }

    $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Access Changed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }

  public function addNewUser()
  {
    echo "ok";
  }

  public function getUserByID()
  {
    echo json_encode($this->admin->getUserById($_POST['id']));
  }

  public function upUserByID($id)
  {
    echo "ok";
  }

  public function delUser($id)
  {
    echo "ok";
  }
}
