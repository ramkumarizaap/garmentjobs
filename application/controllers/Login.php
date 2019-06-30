<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('login_model', 'login');
  }
  public function index()
  {
    $data['data'] = "";
    if ($this->session->userdata('userdata'))
      redirect('home');
    $this->layout->view('accounts/login', $data);
  }

  public function chk_login()
  {
    $data['data'] = "";
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'Enter Username'));
    $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Enter Password'));
    if ($this->form_validation->run() === FALSE) {
      $this->layout->view('accounts/login', $data);
    } else {
      $chk = $this->login->chk_login($username, $password);
      if ($chk->num_rows() > 0) {
        $this->session->set_userdata('userdata', $chk->row_array());
        redirect('home');
      } else {
        $this->session->set_flashdata('err_msg', 'Invalid Username or Password');
        redirect('login/index');
      }
    }
  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }
}
