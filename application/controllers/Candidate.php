<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate extends CI_Controller
{
  protected $_candidate_validation = array(
    array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
    array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
    array('field' => 'fathername', 'label' => 'Father Name', 'rules' => 'trim|required'),
    array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),
    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
    array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'trim|required|numeric'),
    array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
    array('field' => 'experience', 'label' => 'Experience', 'rules' => 'trim|required'),
    array('field' => 'qualification', 'label' => 'Qualification', 'rules' => 'trim|required'),
    array('field' => 'job_title', 'label' => 'Job TItle', 'rules' => 'trim|required'),
    array('field' => 'c_employer', 'label' => 'Current Employer', 'rules' => 'trim|required'),
    array('field' => 'current_salary', 'label' => 'Current Salary', 'rules' => 'trim|required'),
    array('field' => 'expected_salary', 'label' => 'Expected Salary', 'rules' => 'trim|required'),
    array('field' => 'skills[]', 'label' => 'Skills', 'rules' => 'trim|required'),
    array('field' => 'skype', 'label' => 'Skype', 'rules' => 'trim'),
    array('field' => 'current_designation', 'label' => 'Current Designation', 'rules' => 'trim|required'),
    array('field' => 'candidate_status', 'label' => 'Canidate Status', 'rules' => 'trim|required'),
    array('field' => 'negotiable', 'label' => 'Salary Negotiable', 'rules' => 'trim|required'),
    array('field' => 'source', 'label' => 'Source', 'rules' => 'trim|required'),
  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('candidate_model', 'candidate');
  }
  public function index()
  {
    $data['data'] = $this->candidate->select_join();
    $this->layout->view('candidate/view', $data);
  }
  public function add($id = "")
  {
    $data['source'] = $this->candidate->select(array("status" => "Active"), 'source')->result_array();
    $data['jobs'] = $this->candidate->select(array("status" => "Active"), 'job_position')->result_array();
    $data['skills'] = $this->candidate->select(array("status" => "Active"), 'skills')->result_array();
    $data['status'] = $this->candidate->select(array("status" => "Active"), 'application_status')->result_array();
    $data['qualifications'] = $this->candidate->select(array("status" => "Active"), 'qualification')->result_array();
    $data['data'] = array(
      "id" => "", "firstname" => "", "lastname" => "", "marital_status" => "", "fathername" => "",
      "email" => "", "mobile" => "", "address" => "", "experience" => "", "qualification" => "", "job_title" => "", "current_employer" => "", "current_salary" => "",
      "exp_salary" => "", "skype" => "", "candidate_status" => "", "source" => "", "resume" => "", "old_resume" => "", "old_photo" => "", "photo" => "",
      "current_designation" => ""
    );
    $this->form_validation->set_rules($this->_candidate_validation);
    if (!isset($_FILES['resume']))
      $this->form_validation->set_rules('resume', 'Resume', 'required');
    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['firstname'] = $form['firstname'];
      $ins['lastname'] = $form['lastname'];
      $ins['marital_status'] = $form['marital_status'];
      $ins['fathername'] = $form['fathername'];
      $ins['email'] = $form['email'];
      $ins['mobile'] = $form['mobile'];
      $ins['address'] = $form['location'];
      $ins['experience'] = $form['experience'];
      $ins['qualification'] = $form['qualification'];
      $ins['job_position'] = $form['job_title'];
      $ins['current_employer'] = $form['c_employer'];
      $ins['current_salary'] = $form['current_salary'];
      $ins['exp_salary'] = $form['expected_salary'];
      $ins['negotiable'] = $form['negotiable'];
      $ins['current_designation'] = $form['current_designation'];
      $ins['skype'] = $form['skype'];
      $ins['application_status'] = $form['candidate_status'];
      $ins['source'] = $form['source'];
      if (isset($_FILES['resume']['name']) && $_FILES['resume']['size'] > 0)
        $ins['resume'] = $this->do_upload('resume')['upload_data']['file_name'];
      if (isset($_FILES['photo']['name']) && $_FILES['photo']['size'] > 0)
        $ins['photo'] = $this->do_upload('photo')['upload_data']['file_name'];

      if ($c_id) {
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $where1['userid'] = $c_id;
        $this->candidate->delete($where1, "candidate_skills");
        $ins_id = $this->candidate->update($where, $ins, "candidate");
        $ins_id = $c_id;
      } else {
        $action = "add";
        $ins_id = $user_id = $this->candidate->insert($ins, "candidate");
      }
      if ($form['skills']) {
        foreach ($form['skills'] as $s) {
          $ins1['userid'] = $ins_id;
          $ins1['skill_id'] = $s;
          $sk = $this->candidate->insert($ins1, "candidate_skills");
        }
      }
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Candidate ' . $action . ' successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to ' . $action . ' Candidate Info.');
      redirect('candidate');
    } else {
      if ($id)
        $data['data'] = $this->candidate->select_join($id, "candidate")->row_array();
      $this->layout->view('candidate/add', $data);
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

  public function do_upload($type = '')
  {
    if ($type === 'resume') {
      $config['upload_path']          = 'uploads/resumes/';
      $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx';
    } else if ($type === 'photo') {
      $config['upload_path']          = 'uploads/photo/';
      $config['allowed_types']        = 'jpg';
    }
    // $config['max_size']             = 10000;
    // $config['max_width']            = 2024;
    // $config['max_height']           = 1768;
    $this->load->library('upload', $config);
    $file = ($type === 'resume') ? $this->upload->do_upload('resume') : $this->upload->do_upload('photo');
    if (!$file) {
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
