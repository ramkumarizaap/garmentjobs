<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
  protected $_contact_validation = array(
    array('field' => 'company_name', 'label' => 'Propreiter Name', 'rules' => 'trim|required'),
    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
    array('field' => 'mobile', 'label' => 'Mobile Number', 'rules' => 'trim|required|numeric'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'hr_email', 'label' => 'HR Email', 'rules' => 'trim|required|valid_email'),
    array('field' => 'sales_email', 'label' => 'Sales Email', 'rules' => 'trim|required|valid_email'),

  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('contact_model', 'contact');
  }
  public function index()
  {
    redirect('contact/add');
  }
  public function add($id = "")
  {
    $data['source'] = $this->contact->select(array("status" => "Active"), 'source')->result_array();
    $data['jobs'] = $this->contact->select(array("status" => "Active"), 'job_position')->result_array();
    $data['skills'] = $this->contact->select(array("status" => "Active"), 'skills')->result_array();
    $data['status'] = $this->contact->select(array("status" => "Active"), 'application_status')->result_array();
    $data['qualifications'] = $this->contact->select(array("status" => "Active"), 'qualification')->result_array();
    $data['data'] = array(
      "company_name" => "", "id" => "", "email" => "", "mobile" => "", "address" => "", "hr_email" => "", "sales_email" => ""
    );
    $this->form_validation->set_rules($this->_contact_validation);

    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $ins['company_name'] = $form['company_name'];
      $ins['email'] = $form['email'];
      $ins['mobile'] = $form['mobile'];
      $ins['address'] = $form['address'];
      $ins['hr_email'] = $form['hr_email'];
      $ins['sales_email'] = $form['sales_email'];
      $chk = $this->contact->select(array("id" => '1'), "contact_info")->num_rows();
      if ($chk > 0) {
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $ins_id = $this->contact->update($where, $ins, "contact_info");
        $ins_id = $c_id;
      } else {
        $action = "add";
        $ins_id = $user_id = $this->contact->insert($ins, "contact_info");
      }

      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Contact Info ' . $action . ' successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to ' . $action . ' Contact Info.');
      redirect('contact');
    } else {
      $data['data'] = $this->contact->select(array("id" => "1"), "contact_info")->row_array();
      $this->layout->view('contact/add', $data);
    }
  }

  public function delete($id = "")
  {
    $output['status'] = "success";
    $output['msg'] = "Deleted.";
    $where['id'] = $id;
    $del_id = $this->candidate->delete($where, "candidate");
    $this->session->set_flashdata("succ_msg", "Candidate deleted successfully.");
    echo json_encode($output);
  }

  public function do_upload()
  {
    $config['upload_path']          = 'uploads/resumes/';
    $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx';
    // $config['max_size']             = 10000;
    // $config['max_width']            = 2024;
    // $config['max_height']           = 1768;
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('resume')) {
      $error = array('error' => $this->upload->display_errors());
      // $this->load->view('upload_form', $error);
      return $error;
    } else {
      $data = array('upload_data' => $this->upload->data());
      // $this->load->view('upload_success', $data);
      return $data;
    }
  }
  public function download($file = "")
  {
    $this->load->helper('download');
    $data = file_get_contents('./uploads/resumes/' . $file);
    force_download($name, $data);
  }
}
