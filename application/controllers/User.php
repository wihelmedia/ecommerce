<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Users_model', 'user');
  }

  public function index()
	{
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    // $data['total'] =  $this->user->totpesan();
    $data['pesan'] = $this->user->getpesan();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
	}

  public function edit()
	{
    $data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('name', 'fullname', 'required|trim');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/footer');
    } else {
      if ($_FILES['image']['name']) {
        $config['upload_path']    = './assets/img/profile/';
        $config['allowed_types']  = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
          $old_image = $data['user']['image'];
          if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
            $new_image = $this->upload->data('file_name');
            if ($this->user->editProfile(array('name' => htmlspecialchars($this->input->post('name')), 'image' => $new_image))) {
              $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert"><strong>Success</strong> update your profile !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              redirect('user');
            }
          } else {
            $new_image = $this->upload->data('file_name');
            if ($this->user->editProfile(array('name' => htmlspecialchars($this->input->post('name')), 'image' => $new_image))) {
              $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert"><strong>Success</strong> update your profile !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              redirect('user');
            }
          }

        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('user');
        }

      } else {
        if ($this->user->editProfile(array('name' => htmlspecialchars($this->input->post('name'))))) {
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert"><strong>Success</strong> update your profile !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('user');
        }
      }

    }
	}

  public function changePassword()
	{
    $data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('current_password', 'current password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'new password', 'required|trim|min_length[8]', [
      'min_length' => 'password to short!'
    ]);
    $this->form_validation->set_rules('new_password2', 'repeat password', 'required|trim|matches[new_password1]', [
      'matches' => 'password dont match!',
      'min_length' => 'password to short!'
    ]);
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('user/changepassword', $data);
      $this->load->view('templates/footer');
    } else {
      if (!password_verify($this->input->post('current_password'), $data['user']['password'])) {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Wrong current password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/changepassword');
      } else {
        if ($this->input->post('new_password1') == $this->input->post('current_password')) {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">New password cannot be the same as current password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('user/changepassword');
        } else {
          if ($this->user->updatePassword(array('password' => password_hash($this->input->post('new_password1'), PASSWORD_DEFAULT)))) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert"><strong>Success</strong> update your password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('user/changepassword');
          }
        }
      }
	  }
  }

  public function gettot()
  {
    $data['total'] =  $this->user->totpesan();
    $data['pesan'] = $this->user->getpesan();
    echo json_encode($data);
  }
}
