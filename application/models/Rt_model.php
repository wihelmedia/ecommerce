<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Rt_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getUserWarga($limit, $start, $role)
  {
    // var_dump($role); die;
    if($role == '1'){
      $this->db->where('nama !=', 'Wihelmus Mekeng');
      return $this->db->get('warga')->result_array();
    } elseif ($role == '3') {
      $this->db->where('nama !=', 'Wihelmus Mekeng');
      $this->db->where('nama !=', 'Pak Toyib');
      return $this->db->get('warga')->result_array();
    } elseif ($role == '4') {
      $this->db->where('nama !=', 'Wihelmus Mekeng');
      return $this->db->get('warga', $limit, $start)->result_array();
    }
  }

  public function getSubMenu()
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
              FROM `user_sub_menu` JOIN `user_menu`
              ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
              ";
    return $this->db->query($query)->result_array();
  }

  public function addSubMenu($data = array())
  {
    return $this->db->insert('user_sub_menu', $data);
  }

  public function getsuratrt($limit, $start)
  {
    return $this->db->get('rt', $limit, $start)->result_array();
  }

  public function getkegiatan($limit, $start)
  {
    return $this->db->get('kegiatan', $limit, $start)->result_array();
  }

   public function getkk1($limit, $start)
  {
    return $this->db->get('kk', $limit, $start)->result_array();
  }

  public function getsuratrt1()
  {
    return $this->db->get('rt')->row_array();
  }

  public function wargashow($id)
  {
    return $this->db->get_where('warga', ['no_ktp' => $id])->result_array();
  }
  
  public function getrolebypenulis($role_id)
  {
    return $this->db->get_where('user_role', ['id' => $role_id])->result_array();
  }

  public function kegiatanshow($id)
  {
    return $this->db->get_where('kegiatan', ['id' => $id])->result_array();
  }

  public function wargashowkk($no_kk)
  {
    return $this->db->get_where('warga', ['no_kk' => $no_kk])->result_array();
  }

  public function kartushow($id)
  {
    return $this->db->get_where('kk', ['id_kk' => $id])->result_array();
  }

  public function getkk($no_kk)
  {
    return $this->db->get_where('kk', ['no_kk' => $no_kk])->result_array();
  }

  public function idenshow($id)
  {
    return $this->db->get_where('identitas', ['id' => $id])->result_array();
  }

  public function pesanshow($id)
  {
    return $this->db->get_where('rt', ['id' => $id])->result_array();
  }

  public function identitas()
  {
    return $this->db->get('identitas')->result_array();
  }

  public function nosurat()
  {
    return $this->db->get('surat')->result_array();
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
