<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
  protected $_invoice_validation = array(
    array('field' => 'c_name', 'label' => 'Candidate Name', 'rules' => 'trim|required'),
    array('field' => 'emp_name', 'label' => 'Invoice To Name', 'rules' => 'trim|required'),
    array('field' => 'terms', 'label' => 'Terms', 'rules' => 'trim|required'),
    array('field' => 'notes', 'label' => 'Notes', 'rules' => 'trim|required'),
    array('field' => 'inv_date', 'label' => 'Invoice Date', 'rules' => 'trim|required'),
  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('invoice_model', 'invoice');
  }
  public function index()
  {
    $data['data'] = $this->invoice->select_join('', 'invoice');
    $this->layout->view('invoice/view', $data);
  }
  public function add($id = "")
  {
    $data['candidate'] = $this->invoice->select(array("application_status" => "1"), 'candidate')->result_array();
    $data['company'] = $this->invoice->select(array("status" => "Active"), 'company')->result_array();
    $data['contact'] = $this->invoice->select(array("id" => "1"), 'contact_info')->row_array();
    $data['items'] = array();
    $data['data'] = array(
      "id" => "", "inv_date" => "", "c_name" => "", "emp_name" => "", "terms" => "", "notes" => "", "sub_total" => "0.00",
      "total_gst" => "0.00", "total" => "0.00", "gst_percentage" => "18", "i_id" => ""
    );
    $this->form_validation->set_rules($this->_invoice_validation);
    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['from_name'] = $form['c_name'];
      $ins['to_name'] = $form['emp_name'];
      $ins['terms'] = $form['terms'];
      $ins['notes'] = $form['notes'];
      $ins['inv_no'] = getInvNo();
      $ins['inv_date'] = date("Y-m-d", strtotime($form['inv_date']));
      if ($c_id) {
        $del = $this->invoice->delete(array("inv_id" => $c_id), "invoice_items");
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $ins_id = $this->invoice->update($where, $ins, "invoice");
        $ins_id = $c_id;
      } else {
        $action = "generate";
        $ins_id = $this->invoice->insert($ins, "invoice");
      }
      $tot = array();
      if (count($form['description']) > 0) {
        for ($i = 0; $i < count($form['description']); $i++) {
          if ($form['description'][$i] !== '') {
            $ins1['description'] = $form['description'][$i];
            $ins1['price'] = $form['price'][$i];
            $ins1['inv_id'] = $ins_id;
            $ins1['qty'] = $form['qty'][$i];
            $ins1['total'] = $ins1['price'] * $ins1['qty'];
            $tot[$i] = $ins1['total'];
            $ins_id1 = $this->invoice->insert($ins1, "invoice_items");
          }
        }
      }
      $ins2['sub_total'] = array_sum($tot);
      $ins2['gst_percentage'] = 18;
      $ins2['total_gst'] = ($ins2['sub_total'] / 100) * 18;
      $ins2['total'] = $ins2['sub_total'] + $ins2['total_gst'];
      $where1['id'] = $ins_id;
      $ins2_id = $this->invoice->update($where1, $ins2, "invoice");
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Invoice ' . $action . 'd successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to ' . $action . ' invoice Info.');
      redirect('invoice');
    } else {
      if ($id) {
        $where['id'] = $id;
        $data['data'] = $this->invoice->select($where, "invoice")->row_array();
        $data['items'] = $this->invoice->select(array("inv_id" => $id), "invoice_items")->result_array();
      }
      $this->layout->view('invoice/add', $data);
    }
  }

  public function delete($id = "")
  {
    $output['status'] = "success";
    $output['msg'] = "Deleted.";
    $where['id'] = $id;
    $del_id = $this->invoice->delete($where, "invoice");
    $this->session->set_flashdata("succ_msg", "invoice deleted successfully.");
    echo json_encode($output);
  }

  public function get_invoice($id = '')
  {
    $output['status'] = "success";
    $where['id'] = $id;
    $data['data'] = $this->invoice->select_join($id, "invoice")->row_array();
    $data['items'] = $this->invoice->select(array("inv_id" => $id), "invoice_items")->result_array();
    $output['data'] = $this->load->view("invoice/modal_view", $data, TRUE);
    echo json_encode($output);
  }

  public function print_invoice($id = "")
  {
    $data['data'] = $this->invoice->select_join($id, "invoice")->row_array();
    $data['items'] = $this->invoice->select(array("inv_id" => $id), "invoice_items")->result_array();
    $this->load->view("invoice/print", $data);
  }
  public function download_invoice($id = "")
  {
    $data['data'] = $this->invoice->select_join($id, "invoice")->row_array();
    $data['items'] = $this->invoice->select(array("inv_id" => $id), "invoice_items")->result_array();
    // $this->load->view('invoice/pdf', $data);
    $this->load->library('pdf');
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $html = $this->load->view('invoice/pdf', $data, true);
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('helvetica', '', 12, '', true);
    $pdf->AddPage();

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
    $pdf->Output($data['data']['inv_no'] . '.pdf', 'D');
  }
}
