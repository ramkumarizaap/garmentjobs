<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    function __construct()
    {
        $this->CI = &get_instance();
    }
    public function view($file_name, $data)
    {
        $this->CI->load->view("partials/header");
        if ($this->CI->session->userdata('userdata')) {
            $this->CI->load->view("partials/navbar");
        }
        $this->CI->load->view($file_name, $data);
        $this->CI->load->view("partials/footer");
    }
}
