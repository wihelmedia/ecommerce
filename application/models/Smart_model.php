<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Smart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getkegiatan($limit, $start)
    {
        return $this->db->get('kegiatan', $limit, $start)->result_array();
    }

    public function kegiatanshow($id)
    {
        return $this->db->get_where('kegiatan', ['id' => $id])->result_array();
    }

}


?>
