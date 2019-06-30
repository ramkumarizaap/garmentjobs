<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('home_model', 'home');
  }
  public function index()
  {
    $data['data'] = "";
    $this->layout->view('home/dashboard', $data);
  }
}
