<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Contacts extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    if (!$this->check_login()) {
      redirect('Admin');
    }
  }

  public function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function index()
  {
    if (!$this->Common_Model->is_admin_authorized($this->session->userdata('id'), 16)) {
      $this->session->set_flashdata('responseMessage', $this->Common_Model->error('You are not authorized to access this page.'));
      redirect('Admin');
    }
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['contactRequests']  = $this->Common_Model->fetch_records('contact_requests', false, false, false, 'id');
    $this->load->view('admin/contact_requests', $pageData);
  }
}
