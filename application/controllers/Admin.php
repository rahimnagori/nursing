<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    // $this->check_login();
  }

  public function index(){
    if($this->check_login()){
      redirect('Dashboard');
    }
    $pageData = [];
    $this->load->view('admin/login', $pageData);
  }

  private function check_login(){
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function logout(){
    $where['id'] = $this->session->userdata('id');
    $update['is_logged_in'] = 0;
    $this->Common_Model->update('admins', $where, $update);
    $this->session->sess_destroy();
    return redirect('Admin');
  }

  public function login(){
    $username = trim($this->input->post('email'));
    $password = trim($this->input->post('password'));
    $where = array('email' => $username, 'password' => md5($password));
    $usernameLogin = $this->Common_Model->fetch_records('admins', $where, false, true);
    $userdata = [];
    if($usernameLogin){
      $userdata = $usernameLogin;
    }
    if($userdata){
      $where['id'] = $userdata['id'];
      $update['is_logged_in'] = 1;
      $update['last_login'] = date('Y-m-d H:i:s');
      $this->Common_Model->update('admins', $where, $update);
      $this->session->set_userdata(array('id' => $userdata['id'], 'is_admin_logged_in' => true));
      $response['responseMessage'] = $this->Common_Model->success('Login successfully.');
      $response['redirect'] = 'Dashboard';
    }else{
      $response['responseMessage'] = $this->Common_Model->error('Invalid Username or Password.');
    }
    echo json_encode($response);
  }

  public function change_password(){
    $response['status'] = 0;
    $update['password'] = $this->input->post('password');
    $confirmPassword = $this->input->post('confirmPassword');
    if($update['password'] == $confirmPassword){
      $where['id'] = $this->input->post('id');
      $userDetail = $this->Common_Model->fetch_records('admins', $where, false, true);
      if($userDetail){
        if($this->Common_Model->update('admins', $where, $update)){
          $subject = 'Your password has been changed.';
          $content = '<p>Hello ' .$userDetail['name'] .',</p>';
          $content .= '<p>Your password has been changed. Here is your new password :</p>';
          $content .= '<p><b>' .$update['password'] .'</b></p>';
          $this->Common_Model->send_mail($userDetail['email'], $subject, $content);
          $response['status'] = 1;
          $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Password changed successfully</div>');
        }else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Something went wrong please try again later.</div>');
        }
      }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> User not found.</div>');
      }
    }else{
      $response['status'] = 2;
      $response['message'] = 'Password doesn\'t match';
      $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Password doesn\'t match.</div>');
    }
    echo json_encode($response);
  }

  public function forget_password(){
    $this->form_validation->set_rules('email','email','required');
    if($this->form_validation->run()){
      $email = $this->input->post('email');
      $run = $this->Common_Model->fetch_records('admins',array('email' =>$email),false, true);
      if($run){
        $email = $run['email'];
        $name = $run['name'];
        $id = $run['id'];
        $subject = "Forget password";

        $html = '<p>Hello, '.$run['name'].'</p>';
        $html .= '<p>This is an automated message . If you did not recently initiate the Forgot Password process, please disregard this email.</p>';
        $html .= '<p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p>';
        $html .= '<p>Password: <b>'.$run['password'].'</b></p>';

        $this->Common_Model->send_mail($run['email'],$subject,$html);

        $output['status'] = 1;
        $output['message'] = 'Please check your mail , We have sent your password in your registered mail id.';

      } else {
        $output['status'] = 0;
        $output['message'] = 'Email address that you have entered is not registered with us.';
      }
      
    } else {
      $output['status'] = 0;
      $output['message'] = validation_errors();
    }
    echo json_encode($output);
  }

}
