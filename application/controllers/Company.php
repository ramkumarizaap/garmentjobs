<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{
  protected $_company_validation = array(
    array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'trim|required'),
    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
    array('field' => 'number', 'label' => 'Contact Number', 'rules' => 'trim|required'),
    array('field' => 'website', 'label' => 'Website', 'rules' => 'trim|required'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('company_model', 'company');
  }
  public function index()
  {
    $data['data'] = $this->company->select('', 'company');
    $this->layout->view('company/view', $data);
  }
  public function add($id = "")
  {
    $data['data'] = "";
    $this->form_validation->set_rules($this->_company_validation);
    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['name'] = $form['company_name'];
      $ins['email'] = $form['email'];
      $ins['mobile'] = $form['number'];
      $ins['url'] = $form['website'];
      $ins['address'] = $form['address'];
      if ($c_id) {
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $ins_id = $this->company->update($where, $ins, "company");
        $ins_id = $c_id;
      } else {
        $action = "add";
        $ins_id = $this->company->insert($ins, "company");
      }
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Company ' . $action . ' successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to ' . $action . ' Company Info.');
      redirect('company');
    } else {
      $where['id'] = $id;
      $data['data'] = $this->company->select($where, "company")->row_array();
      $this->layout->view('company/add', $data);
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
}
