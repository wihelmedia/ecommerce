<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getpesan()
  {
    return $this->db->get('rt')->result_array();
  }

  public function totpesan()
  {
    return $this->db->get('rt')->num_rows();
  }

  public function editProfile($data = array())
  {
    return $this->db->update('user', $data, ['email' => $this->session->userdata('email')]);
  }

  public function updatePassword($data = array())
  {
    return $this->db->update('user', $data, ['email' => $this->session->userdata('email')]);
  }


}


?>
