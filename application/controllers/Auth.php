<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('registration');
    $this->load->model('login');
  }

	public function index()
	{
    $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'password', 'required|trim');

    if ($this->form_validation->run() ==  false) {
      $data['title'] = 'Login';
      $this->load->view('templates/auth_header', $data);
  		$this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else {
      $password = $this->input->post('password');
      $user = $this->login->checkUser(array(
        'email' => htmlspecialchars($this->input->post('email', true))
        )
      );

      if ($user) {
        if ($user['is_active'] == 1) {
          if (password_verify($password, $user['password'])) {
            $data = [
              'email' => $user['email'],
              'role_id' => $user['role_id']
            ];
            $this->session->set_userdata($data);
            if ($user['role_id'] == 1) {
              $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome to your login as <strong>Administrator</strong>!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              redirect('admin');
            } else {
              $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome to your login as <strong>Member</strong>!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              redirect('user');
            }
          } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Wrong password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('auth');
          }
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">This email has not been activated<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email is not registered!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
      }
    }

	}

  public function registration()
  {
    $this->form_validation->set_rules('name', 'name', 'required|trim');
    $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', [
      'matches' => 'password dont match!',
      'min_length' => 'password to short!'
    ]);
    $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registration';
      $this->load->view('templates/auth_header', $data);
  		$this->load->view('auth/registration');
      $this->load->view('templates/auth_footer');
    } else {
      if ($this->input->method() == 'post') {
        $addNewUser = $this->registration->addNewUser(array(
          'name' => htmlspecialchars($this->input->post('name', true)),
          'email' => htmlspecialchars($this->input->post('email', true)),
          'image' => 'default.jpg',
          'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
          'role_id' => 2,
          'is_active' => 1,
          'date_created' => time()
        )
      );

      $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('auth');
      }
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');
    $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">You have been logged out!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    redirect('auth');
  }

  public function blocked()
  {
    $this->load->view('auth/blocked');
  }
}
