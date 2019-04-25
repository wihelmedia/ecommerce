<?php
class Security_model extends CI_Model
{
  public function getSecurity()
  {
    $email = $this->session->userdata('email');
    if (empty($email)) {
      $this->session->sess_destroy('email');
      redirect('auth');
    }
  }

  public function getSecurityLog()
  {
    $email = $this->session->userdata('email');
    if (!empty($email)) {
      redirect('dashboard');
    }
  }
}
