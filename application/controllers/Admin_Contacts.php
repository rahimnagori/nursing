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
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['contactRequests']  = $this->Common_Model->fetch_records('contact_requests', false, false, false, 'id');
    $this->load->view('admin/contact_requests', $pageData);
  }
}
