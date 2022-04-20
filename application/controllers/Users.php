<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  private function check_login(){
    return ($this->session->userdata('is_user_logged_in')) ? true : false;
  }

  public function index(){
    if($this->check_login()){
      redirect('Profile');
    }
    $pageData = [];
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/login', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function login(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('username', 'username', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required');
    if($this->form_validation->run()){
      $isUserExist = false;
      $where['username'] = $this->input->post('username');
      $where['password'] = md5($this->input->post('password'));
      $userDetailsWithUsername = $this->Common_Model->fetch_records('users', $where);
      if(!empty($userDetailsWithUsername)){
        $isUserExist = true;
        $userDetails = $userDetailsWithUsername;
      }
      $where['email'] = $this->input->post('username');
      unset($where['username']);
      $userDetailsWithEmail = $this->Common_Model->fetch_records('users', $where);
      if(!empty($userDetailsWithEmail)){
        $isUserExist = true;
        $userDetails = $userDetailsWithEmail;
      }
      if($isUserExist){
        $update['is_logged_in'] = 1;
        $update['last_login'] = date("Y-m-d H:i:s");
        $this->Common_Model->update('users', $where, $update);
        $this->session->set_userdata(array('id' => $userDetails[0]['id'], 'is_user_logged_in' => true, 'userdata' => $userDetails[0]));
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Logged in successfully.');
      }else{
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('User does not exists. Either username or password is wrong.');
      }
    }else{
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function signup(){
    $this->load->view('site/include/header');
    $this->load->view('site/sign-up');
    $this->load->view('site/include/footer');
  }

  public function register(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]|trim');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|is_unique[users.email]', array('is_unique' => 'This email is already taken. Please provide another email.'));
    $this->form_validation->set_rules('password', 'password', 'required');
    $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('matches' => 'Password and Confirm password does not match.'));
    $this->form_validation->set_rules('job_title', 'job_title', 'required');
    if($this->form_validation->run()){
      $insert = $this->input->post();
      $insert['is_email_verified'] = 0;
      $insert['token'] = rand(1000, 99999);
      $insert['is_logged_in'] = 0;
      $insert['user_ip'] = $_SERVER['REMOTE_ADDR'];
      $insert['is_deleted'] = 0;
      $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
      unset($insert['confirm_password']);
      $insert['password_n'] = $insert['password'];
      $insert['password'] = md5($insert['password']);
      $userId = $this->Common_Model->insert('users', $insert);
      if($userId){
        $this->send_verification_email($userId);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Check your email to complete registration. If you have not found mail in Inbox please check your junk folder.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function profile(){
    if(!$this->check_login()){
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if($pageData['userDetails']['is_email_verified'] != 1){
      redirect('Verify');
    }
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function verify(){
    if(!$this->check_login()){
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if($pageData['userDetails']['is_email_verified'] == 1){
      $responseMessage = $this->Common_Model->success('Email verified successfully.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Profile');
    }
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/email-verification', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function resend(){
    $pageData = $this->Common_Model->get_userdata();

    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    if($pageData['userDetails']['id']){
      $this->send_verification_email($pageData['userDetails']['id'], true);
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Verification email sent successfully.');
    }
    echo json_encode($response);
  }

  private function send_verification_email($userId, $resend = false){
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
    if($userdata){
      if($userdata['is_email_verified'] == 0){
        $token = rand(100000, 999999);
        $update['token'] = $token;
        $this->Common_Model->update('users', array('id' => $userId), $update);
        $verificationLink = $this->config->item('base_url');
        $verificationLink .= 'Verify/' .$userdata['id'] .'/' .$token;

        $subject = ($resend) ? 'Re: Verify you email address.' : 'Verify your email address.';
        $body = "<p>Hello " .$userdata['first_name'] ." " .$userdata['last_name'] .",</p>";
        $body .= "<p>Please verify your account to continue using our services by clicking the link below.</p>";
        $body .= "<p><a href='" .$verificationLink ."'>Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" .$verificationLink ."</p>";
        $mailResponse = $this->Common_Model->send_mail($userdata['email'], $subject, $body);
      }
    }else{
      /* User does not exist */
    }
  }

  public function email_verification($user_id, $token){
    $where['token'] = $token;
    $where['id'] = $user_id;
    $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
    if($userdata){
      if($userdata['is_email_verified'] != 1){
        $update['token'] = null;
        $update['last_login'] = date("Y-m-d H:i:d");
        $update['is_email_verified'] = 1;
        if($this->Common_Model->update('users', array('id' => $userdata['id']), $update)){
          $to = $userdata['email'];
          $subject = 'Email successfully verified.';
          $body = '<p>Hello ' .$userdata['first_name'] .' ' .$userdata['last_name'] .',</p>';
          $body .= '<p>Congratulations!! your email has been verified successfully. You may now continue using our services.</p>';
          $mailResponse = $this->Common_Model->send_mail($to, $subject, $body);
          if($this->session->userdata('is_logged_id')){
            redirect('Verify');
          }else{
            $message = $this->Common_Model->success('Thank you: Your email has been verified successfully. Please login to continue.');
            $this->session->set_flashdata('responseMessage', $message);
            redirect('Login');
          }
        }
      }else{
        $message = $this->Common_Model->success('Email already verified.');
        $this->session->set_flashdata('responseMessage', $message);
        redirect('Login');
      }
    }else{
      $message = $this->Common_Model->error('This link has been expired.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('');
    }
  }

  public function update(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $response['isResumeUploaded'] = 0;

    if(!$this->check_login()){
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    if($_FILES['resume']['error'] == 0){
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'doc|docx|pdf';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        $resume = $this->upload->data("file_name");

        $update['resume'] = $config['upload_path'] .$resume;
        $oldResume = $this->input->post('old_resume');
        $response['isResumeUploaded'] = 1;
        $response['resume'] = $update['resume'];
        if(!empty($oldResume)){
          if(file_exists($oldResume)){
            unlink($oldResume);
          }
        }
      }else{
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    $update['address'] = $this->input->post('address');
    $update['phone'] = $this->input->post('phone');
    $update['national_insurance_number'] = $this->input->post('national_insurance_number');
    $update['uk_work_permit'] = ($this->input->post('uk_work_permit')) ? 1 : 0;
    $where['id'] = $this->session->userdata('id');
    if($this->Common_Model->update('users', $where, $update)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Profile updated successfully.');
    }
    echo json_encode($response);
  }

  public function account(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/account', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/add-post', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function posts(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/my-posts', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function password(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/change-password', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function logout(){
    $where['id'] = $this->session->userdata('id');
    $update['is_logged_in'] = 0;
    $this->Common_Model->update('users', $where, $update);
    $this->session->sess_destroy();
    return redirect('');
  }

}
