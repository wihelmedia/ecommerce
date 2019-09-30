<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function checkUser($data = array())
  {
    return $this->db->get_where('user', array('email' => $data['email']))->row_array();
  }

  public function checkEmail($email)
  {
    return $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
  }

  public function updatePassword($password = array(), $email)
  {
    return $this->db->update('user', $password, ['email' => $email]);
  }
}
