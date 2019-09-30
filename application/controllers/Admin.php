<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Admin_model', 'admin');
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
    $config['base_url'] = base_url('admin/userdata');
    $config['total_rows'] = $this->db->count_all('user');
    $config['per_page'] = 10;
    $config['num_links'] = 5;
    $this->pagination->initialize($config);
    $data['start'] = $this->uri->segment(3);
    $data['title'] = 'Users Data';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['userdata'] = $this->admin->getUsers($config['per_page'], $data['start']);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('admin/userdata', $data);
    $this->load->view('templates/footer');
	}

  public function roleaccess($id)
	{
    $data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['role_id'] = $this->admin->getRoleAccess($id);
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

  public function edituser()
  {
    echo json_encode($this->admin->usershow($_POST['id']));
  }

  public function updateuser()
  {
    $data = array(
      'no_ktp' => $_POST['no_ktpedit'],
      'name' => $_POST['nameedit'],
      'email' => $_POST['emailedit']
      // 'password' => password_hash($_POST['password1edit'], PASSWORD_DEFAULT)
    );

    $update = $this->db->update('user', $data, array('no_ktp' => $_POST['no_ktpedit']));
    if ($update) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success user updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('admin/userdata');
    }
  }

  public function addNewUser()
  {
    $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', [
      'matches' => 'password dont match!',
      'min_length' => 'password to short!'
    ]);
    $this->form_validation->set_rules('password2', 'password confirm', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('no_ktp', 'no_ktp', 'required');
    $this->form_validation->set_rules('name', 'name', 'required|trim');
    $this->form_validation->set_rules('email', 'email', 'required|trim');
    if ($this->form_validation->run() == false) {
      $this->userdata();
    } else {
      $this->registration->addNewUser(
        array(
          'name' => htmlspecialchars($this->input->post('name', true)),
          'no_ktp' => $this->input->post('no_ktp', true),
          'email' => htmlspecialchars($this->input->post('email', true)),
          'image' => 'default.jpg',
          'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
          'role_id' => 4,
          'is_active' => 1,
          'date_created' => time()
        )
      );
      $this->session->set_flashdata('msg', '<div class="alert alert-success mt-3 col-lg-6 mx-auto" role="alert">Congratulation! new user has been created.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('admin/userdata');
    }
  }

  public function getUserByID()
  {
    echo json_encode($this->admin->getUserById($this->input->post('id')));
  }

  public function delUser($id)
  {
    $this->db->where('id', $id);
    $deleted = $this->db->delete('user');
    if ($deleted) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success deleted user!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('admin/userdata');
    }
  }

  // public function gettotal()
  // {
  //   $data = array(
      
  //   );
  //   // var_dump($data); die;
  //   echo json_encode($data);
  // }
}
