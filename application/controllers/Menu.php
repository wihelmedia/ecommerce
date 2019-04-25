<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Menu_model', 'menu');
  }

  public function index()
	{
    $this->form_validation->set_rules('menu', 'menu', 'required|trim', [
      'required' => 'This menu has not been input!'
    ]);

    $data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->menu->getUserMenu();

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    } else {
      if ($this->input->method() == "post") {
        $this->db->insert('user_menu', ['menu' => htmlspecialchars($this->input->post('menu'))]);
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New menu added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
      }
    }

  }

  // Roles
  // public function addrole()
  // {
  //   $this->form_validation->set_rules('role', 'role', 'required|trim', [
  //     'required' => 'This role has not been input!'
  //   ]);
  // }

  // Menu
  public function delMenu($id)
  {
    $delMnu = $this->menu->delmenu($id);
    if ($delMnu) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Successful delete the menu in question!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('menu');
    }
  }

// Submenu
  public function submenu()
  {
    $this->form_validation->set_rules('title', 'title', 'required|trim');
    $this->form_validation->set_rules('menu_id', 'menu_id', 'required|trim');
    $this->form_validation->set_rules('url', 'url', 'required|trim');
    $this->form_validation->set_rules('icon', 'icon', 'required|trim');

    $data['title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->menu->getUserMenu();
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('templates/footer');
    } else {
      if ($this->input->method() == "post") {
        $data = $this->menu->addSubMenu(array(
          'title' => htmlspecialchars($this->input->post('title')),
          'menu_id' => htmlspecialchars($this->input->post('menu_id')),
          'url' => htmlspecialchars($this->input->post('url')),
          'icon' => htmlspecialchars($this->input->post('icon')),
          'is_active' => htmlspecialchars($this->input->post('is_active'))
        ));
        if ($data) {
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New submenu added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('menu/submenu');
        }
      }
    }
  }


  public function showSubMenu()
  {
    echo json_encode($this->menu->subMenuShow($_POST['id']));
  }

  public function deleteSubMenu($id)
  {
    $delSubMenu = $this->menu->delSubMenu($id);
    if ($delSubMenu) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success delete submenu!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('menu/submenu');
    }
  }

  public function updateSubMenu($id)
  {
    if ($this->input->method() == "post") {
      $update = $this->menu->upSubMenu(array(
        'title' => htmlspecialchars($this->input->post('title')),
        'menu_id' => htmlspecialchars($this->input->post('menu_id')),
        'url' => htmlspecialchars($this->input->post('url')),
        'icon' => htmlspecialchars($this->input->post('icon')),
        'is_active' => htmlspecialchars($this->input->post('is_active'))
      ), $id);
      if ($update) {
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success update submenu!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
      }
    }
  }

  public function showMenu()
  {
    echo json_encode($this->menu->menuShow($_POST['id']));
  }

  public function updateMenu($id)
  {
    if ($this->input->method() == "post") {
      $update = $this->menu->upMenu(array(
        'menu' => htmlspecialchars($this->input->post('menu')),
      ), $id);
      if ($update) {
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success update menu!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
      }
    }
  }

}
