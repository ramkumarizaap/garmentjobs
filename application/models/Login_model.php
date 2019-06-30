<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
  public function chk_login($username, $password)
  {
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $q = $this->db->get('users');
    return $q;
  }
}
