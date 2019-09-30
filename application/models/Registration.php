<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function addNewUser($data = array())
  {
    $this->db->insert('user', $data);
  }

  public function addUserToken($user_token = array())
  {
    return $this->db->insert('user_token', $user_token);
  }

  public function getUser($email)
  {
    return $this->db->get_where('user', ['email' => $email])->row_array();
  }

  public function getUserToken($token)
  {
    return $this->db->get_where('user_token', ['token' => $token])->row_array();
  }

  public function delUser($email)
  {
    return $this->db->delete('user', ['email' => $email]);
  }

  public function delToken($email)
  {
    return $this->db->delete('user_token', ['email' => $email]);
  }

  public function upTableUser($is_active = array(), $email)
  {
    return $this->db->update('user', $is_active, ['email' => $email]);
  }
}
