<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
  public function select_join($id = "")
  {
    if ($id)
      $this->db->where("a.id", $id);
    $this->db->select("a.*,b.name as emp_name,a.id as i_id,b.*,b.name as c_name,b.email as c_email,b.mobile as c_mobile,b.address as c_address");
    $this->db->from("invoice a");
    $this->db->join("company b", "b.id=a.to_name");
    $this->db->group_by("a.id");
    $q = $this->db->get();
    return $q;
  }
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
