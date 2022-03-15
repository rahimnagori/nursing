<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    if(!$this->check_login()){
      redirect('Admin');
    }
  }

  public function index(){
    $pageData = [];
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $pageData['adminData'] = $adminData;

    $this->load->view('admin/dashboard', $pageData);
  }

  public function profile(){
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $pageData['adminData'] = $this->Common_Model->fetch_records('admins', $where, false, true);
    $this->load->view('admin/profile', $pageData); 
  }

  public function update_profile(){
    $where['id'] = $this->input->post('id');
    $update['first_name'] = $this->input->post('first_name');
    $update['last_name'] = $this->input->post('last_name');
    $update['email'] = $this->input->post('email');
    $update['updated'] = date("Y-m-d H:i:s");

    if($this->Common_Model->update('admins', $where, $update)){
      $this->session->set_flashdata("responseMessage","<div class='alert alert-success' role='alert'><strong>Success!</strong> Your Profile is updated Successfully.</div>");
    }else{
      $this->session->set_flashdata("responseMessage", "<div class='alert alert-danger' role='alert'><strong>Error!</strong> Something went wrong.</div>"); 
    }
    return redirect('Admin-Profile');
  }

  public function update_password(){
    $where['id'] = $this->input->post('id');
    $userdata = $this->Common_Model->fetch_records('admins', array('id' => $where['id']), false, true);
    $oldPassword = md5($this->input->post('oldPassword'));
    $newPassword = $this->input->post('newPassword');
    $confirmNewPassword = $this->input->post('renewPassword');
    if($userdata['password'] == $oldPassword){
      if($newPassword == $confirmNewPassword){
        $update['password'] = md5($newPassword);
        $update['updated'] = date("Y-m-d H:i:s");
        if($this->Common_Model->update('admins', $where, $update)){
          $this->session->set_flashdata("responseMessage", "<div class='alert alert-success' role='alert'><strong>Success!</strong> Your Password has been changed Successfully.</div>");
        }else{
          $this->session->set_flashdata("responseMessage", "<div class='alert alert-danger' role='alert'><strong>Error!</strong> Something went wrong. Please try again later.</div>");
        }
      }else{
        $this->session->set_flashdata("responseMessage", "<div class='alert alert-danger' role='alert'><strong>Error!</strong> New Password and Confirm Password doesn't match.</div>");
      }
    }else{
      $this->session->set_flashdata("responseMessage", "<div class='alert alert-danger' role='alert'><strong>Error!</strong> Current password doesn't match.</div>");
    }
    return redirect('Admin-Profile');
  }

  public function check_login(){
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

}
