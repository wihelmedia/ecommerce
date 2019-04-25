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
}
