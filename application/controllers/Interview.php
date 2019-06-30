<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Interview extends CI_Controller
{
  protected $_interview_validation = array(
    array('field' => 'emp_name', 'label' => 'Employer Name', 'rules' => 'trim|required'),
    array('field' => 'c_name', 'label' => 'Candidate Name', 'rules' => 'trim|required'),
    array('field' => 'job_title', 'label' => 'Job Title', 'rules' => 'trim|required'),
    array('field' => 'interview_type', 'label' => 'Interview Type', 'rules' => 'trim|required'),
    array('field' => 'int_date', 'label' => 'Interview Date', 'rules' => 'trim|required'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'interview_status', 'label' => 'Interview Status', 'rules' => 'trim|required'),
    array('field' => 'c_person', 'label' => 'Contact Person', 'rules' => 'trim|required'),
    array('field' => 'comments', 'label' => 'Comments', 'rules' => 'trim|required'),
  );
  function __construct()
  {
    parent::__construct();
    $this->load->model('interview_model', 'interview');
  }
  public function index()
  {
    //$this->send_call_letter('');
    // exit;
    $data['data'] = $this->interview->select_join();
    $this->layout->view('interview/view', $data);
  }
  public function add($id = "")
  {
    $data['jobs'] = $this->interview->select(array("status" => "Active"), 'job_position')->result_array();
    $data['candidate'] = $this->interview->select(array("application_status" => "1"), 'candidate')->result_array();
    $data['company'] = $this->interview->select(array("status" => "Active"), 'company')->result_array();
    $data['int_status'] = $this->interview->select(array("status" => "Active"), 'interview_status')->result_array();
    $data['int_type'] = $this->interview->select(array("status" => "Active"), 'interview_type')->result_array();
    $data['data'] = array(
      "id" => "", "int_date" => date("d/m/Y"), "address" => "", "comments" => "", "job_title" => "", "interview_type" => "",
      "interview_status" => "", "c_person" => ""
    );
    $this->form_validation->set_rules($this->_interview_validation);

    if ($this->form_validation->run()) {
      $form = $this->input->post();
      $c_id = $form['id'];
      $ins['emp_name'] = $form['emp_name'];
      $ins['c_name'] = $form['c_name'];
      $ins['job_title'] = $form['job_title'];
      $ins['interview_type'] = $form['interview_type'];
      $ins['interview_status'] = $form['interview_status'];
      $ins['c_person'] = $form['c_person'];
      $ins['int_date'] = $form['int_date'];
      $ins['address'] = $form['address'];
      $ins['int_date'] = date("Y-m-d", strtotime($form['int_date']));
      $ins['comments'] = $form['comments'];
      if ($c_id) {
        $ins['updated_date'] = date('Y-m-d h:i:s');
        $where['id'] = $c_id;
        $action = "update";
        $ins_id = $this->interview->update($where, $ins, "interview_candidate");
        $ins_id = $c_id;
      } else {
        $this->send_call_letter($ins_id);
        $action = "add";
        $ins_id = $this->interview->insert($ins, "interview_candidate");
      }
      if ($ins_id)
        $this->session->set_flashdata('succ_msg', 'Interview for candidate scheduled successfully.');
      else
        $this->session->set_flashdata('err_msg', 'Not able to schedule interview for a candidate.');
      redirect('interview');
    } else {
      if ($id)
        $data['data'] = $this->interview->select(array("id" => $id), "interview_candidate")->row_array();
      $this->layout->view('interview/add', $data);
    }
  }

  public function delete($id = "")
  {
    $output['status'] = "success";
    $output['msg'] = "Deleted.";
    $where['id'] = $id;
    $del_id = $this->interview->delete($where, "interview_candidate");
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

  function send_call_letter($emp = '')
  {
    $data = $this->interview->select_join($emp)->row_array();
    $negotiable = ($data['negotiable'] === 'Yes') ?  'Negotiable' : 'Non-Negotiable';
    ob_start();
    $data['data'] = "";
    $this->load->library('pdf');
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetMargins(5, 8, 5);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    $header = array('');
    $pdf->SetFont('helvetica', 'B', 16, '', true);
    $pdf->SetFillColor(202, 202, 202); // Grey
    $logo = base64_encode(file_get_contents(base_url() . 'assets/images/logo.png'));
    $pdf->MultiCell(150, 10, "Interview Call Letter", 0, 'L', 1, 0, '', '', '', '', '', '', 10, "M", false);
    $pdf->Image('assets/images/logo.png', 160, 5, 45, 15, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('helvetica', '', 12, '', true);
    $pdf->MultiCell(100, 10, "Dear\t" . $data['firstname'] . ",", 0, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(150, 10, "Your profile is being shortlisted for the mentioned post below.", 0, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(100, 5, "Kindly attend the interview as per below instruction.", 0, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->SetLineWidth(2);
    $pdf->Image(base_url() . 'uploads/photo/' . $data['photo'], 160, 25, 35, 35, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->SetFont('helvetica', '', 10, '', true);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0.3);
    $w = array(45, 60, 45, 60);
    $address = "NO.175, Defence colony,\nEkkattuthangal, Guindy,\nChennai – 600003";
    $fill = 0;
    $pdf->Ln(20);
    $pdf->MultiCell(40, 15, "Company Name:", 1, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->MultiCell(50, 15, $data['employer_name'], 1, 'C', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->MultiCell(50, 15, "Date of Interview:", 1, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->MultiCell(60, 15, date("d.m.Y", strtotime($data['int_date'])), 1, 'C', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(40, 18, "Address and \nContact\tNo", 1, 'J', 0, 0, '', '', true, 1, '', '', 20, "M", false);
    $pdf->MultiCell(50, 18, $data['address'], 1, 'C', 0, 0, '', '', true, 1, '', '', 20, "M", false);
    $pdf->MultiCell(50, 18, "Candidate\tName:", 1, 'L', 0, 0, '', '', true, 1, '', '', 20, "M", false);
    $pdf->MultiCell(60, 18, $data['firstname'] . "\t" . $data['lastname'], 1, 'C', 0, 0, '', '', true, 1, '', '', 20, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(40, 15, "Interview Date & Time", 1, 'L', 0, 0, '', '', true, 1, '', '', 15, "M", false);
    $pdf->MultiCell(50, 15, date("d.m.Y", strtotime($data['int_date'])), 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(50, 15, "Position", 1, 'L', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(60, 15, $data['j_position'], 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(40, 10, "Contact Person:", 1, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->MultiCell(50, 10,  $data['c_person'], 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(50, 10, "Total Experience:", 1, 'L', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(60, 10, $data['experience'], 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(40, 10, "Contact No:", 1, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->MultiCell(50, 10, $data['mobile'], 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(50, 10, "Current\tDesignation:", 1, 'L', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(60, 10, $data['current_designation'], 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(40, 10, "", 1, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->MultiCell(50, 10, "", 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(50, 10, "Expected\tSalary:", 1, 'L', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->MultiCell(60, 10, "Rs.\t" . $data['exp_salary'] . "\t/-\t" . $negotiable, 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->SetFillColor(202, 202, 202); // Grey
    $pdf->MultiCell(200, 10, "", 1, 'C', 1, 0, '', '', '', '', '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->Ln();
    $this->rules_set($pdf);
    $this->tips_set($pdf);
    $path = $_SERVER['DOCUMENT_ROOT'] . 'garmentjobs/uploads/call_letters/' . $data['firstname'] . ' - ' . $data['employer_name'] . '.pdf';
    $pdf->Output($path, 'F');
    // $this->send_email($data, $path);
  }
  function rules_set($pdf)
  {
    $pdf->SetFont('', 'B,U', 11);
    $pdf->Cell(0, 1, 'Additional Information:', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $pdf->Ln();
    $bring = "\n1.\tA pen and Notepad\n2. Printed Resume Copies\n3.\tCopies of Educational Certificates\n4.\tCopies of Work Experiences Certificates (if any)";
    $bring .= "\n5.\tPrevious Company appointment Letter or Salary Slip (if any)\n6.\tReferences (Think of two people who can vouch for you ability";
    $bring .= "\n7.\tPut all your things in folder/bag";
    $not_bring = "\n1.\tFood\n2.\tChewing Gum\n3.\tDrinks\n4.\tExcessive Jewelry\n5.\tYour Parents";
    $pdf->SetFont('', 'B', 11);
    $pdf->MultiCell(100, 10, "WHAT TO BRING @ INTEVIEW", 1, 'C', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->MultiCell(100, 10, "WHAT NOT TO BRING @ INTEVIEW", 1, 'C', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->Ln();
    $pdf->SetFont('', '', 11);
    $pdf->setCellPaddings(10, 5, 0, 0);
    $pdf->MultiCell(100, 50, $bring, 1, 'L', 0, 0, '', '', true, 1, '', '', 50, 'T', false);
    $pdf->MultiCell(100, 50, $not_bring, 1, 'L', 0, 0, '', '', true, 1, '', '', 50, "T", false);
    $pdf->Ln();
    $pdf->setCellPaddings(0, 0, 0, 0);
    $pdf->MultiCell(200, 10, "Please revert if any clarification is required.", 0, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->Ln();
    $pdf->MultiCell(200, 25, "Thanking You,\n\nWarm Regards,\nS.Saravanan\nGarmentjobs.in Team", 0, 'R', 0, 0, '', '', true, 1, '', '', 25, "M", false);
  }
  function tips_set($pdf)
  {
    $tips = "\n1.\tEnsure that you have researched the company that you are being interviewed at well. Have a good look at their website and try and get hold of any literature on the company etc. If the opportunity arises, you will be able to demonstrate some knowledge and interest in the company.";
    $tips .= "\n2.\tDress to impress! Always go for smart and professional rather than trendy. Full business suit is the best attire.";
    $tips .= "\n3.\tPlan your route and allow plenty of time to get to the interview.";
    $tips .= "\n4.\tBody language is key so be aware of your body and how you may be perceived. Crossed arms for example indicate hostility or a barrier. Adopt good posture and make sure that you smile.";
    $tips .= "\n5.\tYou must be able to back up and expand on your CV information rather than simply repeating. Mentioning specific scenarios which demonstrate key skills related to what you have written, a good interviewer will probe these points.";
    $tips .= "\n6.\tTransferable skills are the most important factors to highlight.";
    $tips .= "\n7.\tCommunicate as positively as possible and try not to use weak answers, for example 'I can' instead of 'I think I can'.";
    $tips .= "\n8.\tBe confident and outgoing but don't constantly interrupt the interviewer. An interview should flow.";
    $tips .= "\n9.\tDo not answer in single syllables i.e. “yes” and “no” but at the same time keep to the line of questioning don't waffle and mention things they are completely irrelevant to what you have been asked.";
    $tips .= "\n10.\tIf you don't understand a question, ask the interview if they could repeat it. Don't just guess.";
    $tips .= "\n11.\tAlways prepare some questions to ask at interview in advance, some examples are shown below.";
    $tips .= "\n12.\tAt the end of the interview always thank them for their time and remember to keep smiling.";
    $tips .= "\n13.\tIf you are genuinely interested in the position there is no harm in mentioning this…";
    $pdf->SetMargins(5, 25, 5);
    $pdf->AddPage();
    $pdf->Image('assets/images/logo.png', 160, 5, 45, 15, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
    $pdf->SetFillColor(202, 202, 202);
    $pdf->SetLineWidth(0);
    $pdf->SetFont('helvetica', 'B,U', 11);
    $pdf->MultiCell(200, 10, "INTERVIEW TIPS FOR CANDIDATES", 1, 'C', 1, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->Ln();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->setCellPaddings(5, 10, 10, 0);
    $pdf->MultiCell(200, 95, $tips, 1, 'L', 0, 0, '', '', true, 1, '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->setCellPaddings(5, 0, 0, 0);
    $pdf->MultiCell(200, 10, "Typical Interview Question Examples:", 1, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->Ln();
    $quest = "\n1.\tHow would you describe yourself?\n2.\tHow would your current manager describe you?\n3.\tWhat motivates you?";
    $quest .= "\n4.\tWhy are you leaving your current role?\n5.\tWhat skills and expertise do you have for this job?\n6.\tWhat do you know about our company?";
    $quest .= "\n7.\tWhat are your strengths and weaknesses?\n8.\tGive an example of how you handled certain situation i.e. complaint, busy period, handled customer service etc. in your current role.";
    $pdf->MultiCell(200, 45, $quest, 1, 'L', 0, 0, '', '', true, 1, '', '', 0, "M", false);
    $pdf->Ln();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->setCellPaddings(5, 0, 0, 0);
    $pdf->MultiCell(200, 10, "Typical suggested questions to ask: (By candidate to interviewer):", 1, 'L', 0, 0, '', '', true, 1, '', '', 10, "M", false);
    $pdf->Ln();
    $quest = "\n1.\tWhat are the opportunities for my career progression?\n2.\tWhat would your expectations be of me as a member of your team?";
    $quest .= "\n3.\tWhat obstacles may I come up against in this role?\n4.\tWhat training opportunities do you have? How has this position been created?";
    $quest .= "\n5.\tWhat can you tell me about the team and people that I will be working with?\n6.\tHow long will it take to make a final decision and / or What is the recruitment process?";
    $pdf->MultiCell(200, 35, $quest, 1, 'L', 0, 0, '', '', true, 1, '', '', 0, "M", false);
  }

  function send_email($data = '', $path = '')
  {
    $contact = $this->interview->select(array('id' => "1"), "contact_info")->row_array();
    $subject = "Interview Call Letter - " . $data['employer_name'];
    $body = "";
    $this->load->library('email');
    $this->email->from($contact['hr_email'], $contact['company_name']);
    $this->email->to($data['cand_email']);
    $this->email->subject($subject);
    $this->email->attach($path);
    $this->email->message($body);
    $this->email->send();
  }
}
