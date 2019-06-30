<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Interview_model extends CI_Model
{
  public function select($where = array(), $table)
  {
    if ($where)
      $this->db->Where($where);
    $q = $this->db->get($table);
    return $q;
  }
  public function select_join($user_id = "")
  {
    if ($user_id)
      $this->db->where("a.id", $user_id);
    $this->db->select("a.id as i_id,a.*,b.*,b.firstname,b.lastname,b.email as cand_email,c.*,c.name as employer_name,d.name as j_position,e.name as int_status,f.name as interview_type");
    $this->db->from("interview_candidate a");
    $this->db->join("candidate b", "b.id = a.c_name");
    $this->db->join("company c", "c.id = a.emp_name");
    $this->db->join("job_position d", "d.id = a.job_title");
    $this->db->join("interview_status e", "e.id = a.interview_status");
    $this->db->join("interview_type f", "f.id = a.interview_type");
    $this->db->group_by("a.id");
    $q = $this->db->get();
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
