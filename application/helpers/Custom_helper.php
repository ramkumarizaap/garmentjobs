<?php

function getLabel($data = "")
{
  $labels_array = array(
    'ON-HOLD' => 'label-warning',
    'INACTIVE' => 'label-warning',
    'ACTIVE' => 'label-success',
    'PROCESSING' => 'label-info',
    'ON' => 'label-success',
    'COMPLETED' => 'label-success',
    'SELECTED' => 'label-success',
    'OFF' => 'label-danger',
    'IGNORED' => 'label-danger',
    'REJECTED' => 'label-warning',
  );
  if (isset($labels_array[strtoupper($data)])) {
    $label = $labels_array[strtoupper($data)];
    $data = "<label style='font-size:12px; !important;' class='label btn-sm $label'>{$data}</label>";
  } else {
    $data = "<label style='font-size:12px; !important;' class='label label-info'>{$data}</label>";
  }
  return $data;
}

function getInvNo()
{
  $CI = &get_instance();
  $CI->db->select('max(id) as id,inv_no');
  $CI->db->order_by('id', 'desc');
  $q = $CI->db->get('invoice')->row_array();
  $inv  = str_replace("INV", "", $q['inv_no']);
  $inv_no = $inv + 1;
  return "INV" . $inv_no;
}

function get_counts()
{
  $CI = &get_instance();
  $data['candidate'] = $CI->db->select('count(id) as id')->get('candidate')->row_array();
  $data['company'] = $CI->db->select('count(id) as id')->get('company')->row_array();
  $data['interview'] = $CI->db->select('count(id) as id')->get('interview_candidate')->row_array();
  $data['boarding'] = $CI->db->select('count(id) as id')->get('onboarding')->row_array();
  return $data;
}
