<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_all_peoples($limit, $start)
  {
    // $keyword = NULL
    // if ($keyword) {
    //   $this->db->like('nama_lengkap', $keyword);
    // }
    return $this->db->get('user_menu', $limit, $start)->result_array();
  }

  public function getUserMenu()
  {
    return $this->db->get('user_menu')->result_array();
  }

  public function getSubMenu($limit, $start)
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
              FROM `user_sub_menu` JOIN `user_menu`
              ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
              ";
    return $this->db->get('user_sub_menu', $limit, $start)->result_array();
  }

  public function addSubMenu($data = array())
  {
    return $this->db->insert('user_sub_menu', $data);
  }

  public function subMenuShow($id)
  {
    return $this->db->get_where('user_sub_menu', ['id' => $id])->result_array();
  }

  public function menuShow($id)
  {
    return $this->db->get_where('user_menu', ['id' => $id])->result_array();
  }

  public function delSubMenu($id)
  {
    return $this->db->delete('user_sub_menu', ['id' => $id]);
  }

  public function upSubMenu($data = array(), $id)
  {
    $this->db->where('id', $id);
    return $this->db->update('user_sub_menu', $data);
  }

  public function upmenu($data = array(), $id)
  {
    $this->db->where('id', $id);
    return $this->db->update('user_menu', $data);
  }

  public function delmenu($id)
  {
    return $this->db->delete('user_menu', ['id' => $id]);
  }

}


?>
