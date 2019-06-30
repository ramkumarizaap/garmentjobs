<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Onboard extends CI_Controller
{
  protected $_onboard_validation = array(
    array('field' => 'emp_name', 'label' => 'Employer Name', 'rules' => 'trim|required'),
    array('field' => 'c_name', 'label' => 'Candidate Name', 'rules' => 'trim|required'),
    array('field' => 'job_title', 'label' => 'Job Title', 'rules' => 'trim|required'),
    array('field' => 'join_date', 'label' => 'Joining Date', 'rules' => 'trim|required'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'salary', 'label' => 'Salary', 'rules' => 'trim|required'),
  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('onboard_model', 'onboard');
  }
  public function index()
  {
    $data['data'] = $this->onboard->select_join();
    $this->layout->view('onboard/view', $data);
  }
  public function add($id = "")
  {
    $data['jobs'] = $this->onboard->select(array("status" => "Active"), 'job_position')->result_array();
    $data['candidate'] = $this->onboard->select(array("application_status" => "1"), 'candidate')->result_array();
    $data['company'] = $this->onboard->select(array("status" => "Active"), 'company')->result_array();
    $data['data'] = array(
      "id" => "", "join_date" => date("d/m/Y"), "location" => "", "salary" => "", "job_title" => "", "" => "",
      "c_name" => "", "emp_name" => ""
    );
    $this->form_validation->set_rules($this->_onboard_validation);

    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['emp_name'] = $form['emp_name'];
      $ins['c_name'] = $form['c_name'];
      $ins['job_title'] = $form['job_title'];
      $ins['salary'] = $form['salary'];
      $ins['location'] = $form['address'];
      $ins['join_date'] = date("Y-m-d", strtotime($form['join_date']));
      if ($c_id) {
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $ins_id = $this->onboard->update($where, $ins, "onboarding");
        $ins_id = $c_id;
      } else {
        $action = "add";
        $ins_id = $this->onboard->insert($ins, "onboarding");
      }
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Onboarding for candidate scheduled successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to onboarding for a candidate.');
      redirect('onboard');
    } else {
      if ($id)
        $data['data'] = $this->onboard->select(array("id" => $id), "onboarding")->row_array();
      $this->layout->view('onboard/add', $data);
    }
  }

  public function delete($id = "")
  {
    $output['status'] = "success";
    $output['msg'] = "Deleted.";
    $where['id'] = $id;
    $del_id = $this->onboard->delete($where, "onboarding");
    $this->session->set_flashdata("succ_msg", "Onboarding Candidate deleted successfully.");
    echo json_encode($output);
  }


  public function ch_status($id = "", $status = "")
  {
    $where['id'] = $id;
    if ($status === "1")
      $data['joining_status'] = "Off";
    else
      $data['joining_status'] = "On";
    $del_id = $this->onboard->update($where, $data, "onboarding");
    $this->session->set_flashdata("succ_msg", "Candidate made <strong>" . $data['joining_status'] . "</strong> successfully.");
    redirect("onboard");
  }
}
