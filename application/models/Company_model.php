<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
  public function select($where = array(), $table)
  {
    if ($where)
      $this->db->Where($where);
    $q = $this->db->get($table);
    return $q;
  }
  public function insert($data, $table)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }
  public function update($where, $data, $table)
  {
    $this->db->Where($where);
    $this->db->update($table, $data);
  }
  public function delete($where, $table)
  {
    $this->db->Where($where);
    $this->db->delete($table);
  }
}
