<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropdown extends CI_Controller
{
  protected $_app_status_validation = array(
    array('field' => 'name', 'label' => 'Applicant Status Name', 'rules' => 'trim|required'),
  );
  protected $_job_position_validation = array(
    array('field' => 'name', 'label' => 'Job Position Name', 'rules' => 'trim|required'),
  );
  protected $_qualification_validation = array(
    array('field' => 'name', 'label' => 'Qualification Name', 'rules' => 'trim|required'),
  );
  protected $_source_validation = array(
    array('field' => 'name', 'label' => 'Source Name', 'rules' => 'trim|required'),
  );
  protected $_skills_validation = array(
    array('field' => 'name', 'label' => 'Skill Name', 'rules' => 'trim|required'),
  );
  protected $_interview_status_validation = array(
    array('field' => 'name', 'label' => 'Interview Status', 'rules' => 'trim|required'),
  );
  protected $_interview_type_validation = array(
    array('field' => 'name', 'label' => 'Interview Type', 'rules' => 'trim|required'),
  );

  function __construct()
  {
    parent::__construct();
    $this->load->model('dropdown_model', 'drop_model');
  }
  public function app_status()
  {
    $data['data'] = $this->drop_model->select('', 'application_status');
    $this->layout->view('dropdown/app_status/view', $data);
  }
  public function job_position()
  {
    $data['data'] = $this->drop_model->select('', 'job_position');
    $this->layout->view('dropdown/job_position/view', $data);
  }
  public function source()
  {
    $data['data'] = $this->drop_model->select('', 'source');
    $this->layout->view('dropdown/source/view', $data);
  }
  public function qualification()
  {
    $data['data'] = $this->drop_model->select('', 'qualification');
    $this->layout->view('dropdown/qualification/view', $data);
  }
  public function skills()
  {
    $data['data'] = $this->drop_model->select('', 'skills');
    $this->layout->view('dropdown/skills/view', $data);
  }
  public function interview_status()
  {
    $data['data'] = $this->drop_model->select('', 'interview_status');
    $this->layout->view('dropdown/interview_status/view', $data);
  }
  public function interview_type()
  {
    $data['data'] = $this->drop_model->select('', 'interview_type');
    $this->layout->view('dropdown/interview_type/view', $data);
  }
  public function add($route = "", $id = "")
  {
    $data['data'] = array("id" => "", "name" => "");
    $table = "";
    $view = "";
    $redirect = "";
    $action = $this->getAction($route);
    $table = $action['table'];
    $view = $action['view'];
    $redirect = $action['redirect'];
    $this->form_validation->set_rules($action['validation']);
    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['name'] = $form['name'];
      $ins['status'] = "Active";
      if ($c_id) {
        // $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action1 = "update";
        $ins_id = $this->drop_model->update($where, $ins, $table);
        $ins_id = $c_id;
      } else {
        $action1 = "add";
        $ins_id = $this->drop_model->insert($ins, $table);
      }
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', ucfirst(str_replace("_", " ", $table)) . ' ' . $action1 . ' successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to ' . $action1 . ' ' . ucfirst($table));
      redirect($redirect);
    } else {
      if ($id !== '') {
        $where['id'] = $id;
        $data['data'] = $this->drop_model->select($where, $table)->row_array();
      }
      $this->layout->view($view, $data);
    }
  }

  public function delete($id = "")
  {
    $output['status'] = "success";
    $output['msg'] = "Deleted.";
    $where['id'] = $id;
    $del_id = $this->company->delete($where, "company");
    $this->session->set_flashdata("succ_msg", "Company deleted successfully.");
    echo json_encode($output);
  }
  public function ch_status($action = "", $id = "", $status = "")
  {
    $where['id'] = $id;
    if ($status === "1")
      $data['status'] = "Active";
    else
      $data['status'] = "Inactive";
    $getInfo  = $this->getAction($action);
    $table = $getInfo['table'];
    $redirect = $getInfo['redirect'];
    $gData  = $this->drop_model->select($where, $table)->row_array();
    $del_id = $this->drop_model->update($where, $data, $table);
    $this->session->set_flashdata("succ_msg", ucwords(str_replace("_", " ", $table)) . " <strong>" . $gData['name'] . "</strong> " . $data['status'] . " successfully.");
    redirect($redirect);
  }

  public function getAction($name = '')
  {
    $data = array();
    switch ($name) {
      case 'app_status':
        $data['table'] = "application_status";
        $data['view'] = "dropdown/app_status/add";
        $data['redirect'] = "dropdown/app_status";
        $data['validation'] = $this->_app_status_validation;
        break;
      case 'source':
        $data['table'] = "source";
        $data['view'] = "dropdown/source/add";
        $data['redirect'] = "dropdown/source";
        $data['validation'] = $this->_source_validation;
        break;
      case 'job_position':
        $data['table'] = "job_position";
        $data['view'] = "dropdown/job_position/add";
        $data['redirect'] = "dropdown/job_position";
        $data['validation'] = $this->_job_position_validation;
        break;
      case 'qualification':
        $data['table'] = "qualification";
        $data['view'] = "dropdown/qualification/add";
        $data['redirect'] = "dropdown/qualification";
        $data['validation'] = $this->_qualification_validation;
        break;
      case 'skills':
        $data['table'] = "skills";
        $data['view'] = "dropdown/skills/add";
        $data['redirect'] = "dropdown/skills";
        $data['validation'] = $this->_skills_validation;
        break;
      case 'interview_status':
        $data['table'] = "interview_status";
        $data['view'] = "dropdown/interview_status/add";
        $data['redirect'] = "dropdown/interview_status";
        $data['validation'] = $this->_interview_status_validation;
        break;
      case 'interview_type':
        $data['table'] = "interview_type";
        $data['view'] = "dropdown/interview_type/add";
        $data['redirect'] = "dropdown/interview_type";
        $data['validation'] = $this->_interview_type_validation;
        break;
    }
    return $data;
  }
}
