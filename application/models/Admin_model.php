<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getUsers($limit, $start)
  {
    return $this->db->get('user', $limit, $start)->result_array();
  }

  public function getpesan()
  {
    return $this->db->get('rt')->result_array();
  }

  public function totpesan()
  {
    return $this->db->get('rt')->num_rows();
  }

  public function usershow($id)
  {
    return $this->db->get_where('user', ['id' => $id])->result_array();
  }

  public function getUserById($id)
  {
    return $this->db->get_where('user', ['id' => $id])->result_array();
  }

  public function getRole()
  {
    return $this->db->get('user_role')->result_array();
  }

  public function getRoleAccess($id)
  {
    return $this->db->get_where('user_role', ['id' => $id])->row_array();
  }

  public function getMenu()
  {
    $this->db->where('id !=', 1);
    return $this->db->get('user_menu')->result_array();
  }

  public function changeacc($data = array())
  {
    return $this->db->get_where('user_access_menu', $data);
  }

  public function insertAccess($data)
  {
    return $this->db->insert('user_access_menu', $data);
  }

  public function deleteAccess($data)
  {
    return $this->db->delete('user_access_menu', $data);
  }

}


?>
