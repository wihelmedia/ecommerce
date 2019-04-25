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
    $query = $this->db->get_where('user', array('email' => $data['email']))->row_array();
    return $query;
  }
}
