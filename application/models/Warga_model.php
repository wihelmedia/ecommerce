<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Warga_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getsurat($limit, $start)
  {
      return $this->db->get('surat_keluar', $limit, $start)->result_array();
  }

  public function getiuranwarga($limit, $start)
  {
      return $this->db->get('iuran_warga', $limit, $start)->result_array();
  }
  
  public function iuranshow($id)
  {
    return $this->db->get_where('iuran_warga', ['id' => $id])->result_array();
  }

}
