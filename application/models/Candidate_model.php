<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_model extends CI_Model
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
    $this->db->select("a.*,c.name as src_name,d.name as j_position,GROUP_CONCAT(b.skill_id SEPARATOR ',') as skillset,e.name app_status");
    $this->db->from("candidate a");
    $this->db->join("candidate_skills b", "b.userid=a.id");
    $this->db->join("source c", "c.id=a.source");
    $this->db->join("job_position d", "d.id=a.job_position");
    $this->db->join("application_status e", "e.id=a.application_status");
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
