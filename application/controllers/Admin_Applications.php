<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Applications extends CI_Controller
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

    $join[0][] = 'users';
    $join[0][] = 'job_applications.user_id = users.id';
    $join[0][] = 'left';
    $join[1][] = 'jobs';
    $join[1][] = 'job_applications.job_id = jobs.id';
    $join[1][] = 'left';
    $select = 'job_applications.id, job_applications.user_id, job_applications.job_id, job_applications.status AS job_status, users.first_name, users.last_name, jobs.title, jobs.description';
    $pageData['jobApplications'] = $this->Common_Model->join_records('job_applications', $join, false, $select, 'job_applications.id', 'DESC');

    $this->load->view('admin/job_applications', $pageData);
  }
}
