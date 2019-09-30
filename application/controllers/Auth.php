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
    if ($this->session->userdata('email')) {
      redirect('user');
    }

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
            $sts = ['status' => 1];
            if ($status = $this->db->update('user', $sts, array('email' => $user['email']))) {
              $data = [
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'status' => $status
              ];
              $this->session->set_userdata($data);
              if ($user['role_id'] == 1) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome <strong>'. "$user[name]" .' </strong>your login as Admin!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin');
              } else if($user['role_id'] == 2) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome <strong>'. "$user[name]" .' </strong>your login as User!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('user');
              } else if($user['role_id'] == 3) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome <strong>'. "$user[name]" .' </strong>your login as User!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('rt');
              } else if ($user['role_id'] == 4) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Welcome <strong>' . "$user[name]" . ' </strong>your login as User!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('warga');
              } 
            }

          } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Wrong password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('auth');
          }
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">This email has not been activated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
    if ($this->session->userdata('email')) {
      redirect('user');
    }

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
      $token = base64_encode(random_bytes(32));
      $email = $this->input->post('email', true);
      $this->registration->addNewUser(array(
          'name' => htmlspecialchars($this->input->post('name', true)),
          'email' => htmlspecialchars($this->input->post('email', true)),
          'image' => 'default.jpg',
          'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
          'role_id' => 4,
          'is_active' => 0,
          'date_created' => time()
        )
      );
      $this->registration->addUserToken(array(
          'email'         => $email,
          'token'         => $token,
          'date_created'  => time()
      )
      );

      if ($this->_sendEmail($token, 'verify')) {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Congratulation! your account has been created. Please activate your account.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
      }
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'wihelmedia@gmail.com',
      'smtp_pass' => 'wihelmedianU45kbcSdon765',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->from('wihelmedia@gmail.com', 'PT. WihelMedia');
    $this->email->to($this->input->post('email'));
    if ($type == 'verify') {
      $this->email->subject('Account Verification');
      $this->email->message('Click this link to verify your account : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate<a/>');
    } else if($type == 'forgot') {
      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password<a/>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    if ($this->registration->getUser($email)) {
      $usertoken = $this->registration->getUserToken($token);
      if ($usertoken) {
        if (time() - $usertoken['date_created'] < (60*60*24)) {
          $this->registration->upTableUser(array('is_active' => 1), $email);
          $this->registration->delToken($email);
          $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('auth');
        } else {
          $this->registration->delUser($email);
          $this->registration->delToken($email);
          $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Account activate failed! Token expired.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Account activate failed! Token in failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Account activate failed! Wrong email.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('auth');
    }
  }

  public function resetpassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    if ($this->registration->getUser($email)) {
      $user_token = $this->registration->getUserToken($token);
      if ($user_token) {
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Reset password failed! Token not failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('auth');
    }
  }

  public function changePassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', [
      'matches' => 'password dont match!',
      'min_length' => 'password to short!'
    ]);
    $this->form_validation->set_rules('password2', 'repeat password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Change Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/change-password');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->session->userdata('reset_email');
      $this->login->updatePassword(array('password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)), $email);
      $this->session->unset_userdata('reset_email');
      $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Password has been  changed! Please login.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('auth');
    }
  }

  public function forgotPassword()
  {
    $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Forgot Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/forgot-password');
      $this->load->view('templates/auth_footer');
    } else {
      $token = base64_encode(random_bytes(32));
      $email = $this->input->post('email');
      if ($this->login->checkEmail($email)) {
        $this->registration->addUserToken(array(
            'email'         => $email,
            'token'         => $token,
            'date_created'  => time()
          )
        );

        $this->_sendEmail($token, 'forgot');
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Please check your email to reset your password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth/forgotPassword');
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email is not registered or activated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth/forgotPassword');
      }
    }
  }

  public function logout()
  {
    $sts = ['status' => 0];
    $this->db->update('user', $sts, ['email' => $this->session->userdata('email')]);
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
