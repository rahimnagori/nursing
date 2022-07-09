<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
    // $this->check_login();
  }

  public function index()
  {
    if ($this->check_login()) {
      redirect('Dashboard');
    }
    $pageData = [];
    $this->load->view('admin/login', $pageData);
  }

  private function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function logout()
  {
    $where['id'] = $this->session->userdata('id');
    $update['is_logged_in'] = 0;
    $this->Common_Model->update('admins', $where, $update);
    $this->session->sess_destroy();
    return redirect('Admin');
  }

  public function login()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('email', 'email', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required');
    if ($this->form_validation->run()) {
      $where = $this->input->post('email');
      $adminData = $this->Common_Model->get_admin($where);
      $password = md5($this->input->post('password'));
      if ($adminData) {
        if ($password == $adminData['password']) {
          $update['is_logged_in'] = 1;
          $update['last_login'] = date("Y-m-d H:i:s");
          $update['ip_address'] = $_SERVER['REMOTE_ADDR'];
          $this->Common_Model->update('admins', array('id' => $adminData['id']), $update);
          $this->session->set_userdata(array('id' => $adminData['id'], 'is_admin_logged_in' => true, 'adminData' => $adminData));
          $response['status'] = 1;
          $response['responseMessage'] = $this->Common_Model->success('Logged in successfully.');
        } else {
          $response['status'] = 2;
          $response['responseMessage'] = $this->Common_Model->error('Your password is not correct. Try entering the correct password');
        }
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('Admin does not exists.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function new_login()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('email', 'email', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required');
    if ($this->form_validation->run()) {
      $where = $this->input->post('email');
      $adminData = $this->Common_Model->get_admin($where);
      $password = md5($this->input->post('password'));
      if ($adminData) {
        if ($password == $adminData['password']) {
          $emailResponse = $this->send_joining_confirmation($adminData);
          $update['is_logged_in'] = 1;
          $update['is_email_verified'] = 1;
          $update['token'] = null;
          $update['updated'] = $update['last_login'] = date("Y-m-d H:i:s");
          $update['ip_address'] = $_SERVER['REMOTE_ADDR'];
          $this->Common_Model->update('admins', array('id' => $adminData['id']), $update);
          $this->session->set_userdata(array('id' => $adminData['id'], 'is_admin_logged_in' => true, 'adminData' => $adminData));
          $response['status'] = 1;
          $response['responseMessage'] = $this->Common_Model->success('Password verified successfully. You may now start using our services.' . $emailResponse);
        } else {
          $response['status'] = 2;
          $response['responseMessage'] = $this->Common_Model->error('Your password is not correct. Try entering the correct password');
        }
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('Admin does not exists.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function change_password()
  {
    $response['status'] = 0;
    $update['password'] = $this->input->post('password');
    $confirmPassword = $this->input->post('confirmPassword');
    if ($update['password'] == $confirmPassword) {
      $where['id'] = $this->input->post('id');
      $userDetail = $this->Common_Model->fetch_records('admins', $where, false, true);
      if ($userDetail) {
        if ($this->Common_Model->update('admins', $where, $update)) {
          $subject = 'Your password has been changed.';
          $content = '<p>Hello ' . $userDetail['name'] . ',</p>';
          $content .= '<p>Your password has been changed. Here is your new password :</p>';
          $content .= '<p><b>' . $update['password'] . '</b></p>';
          $mailResponse = $this->Common_Model->send_mail($userDetail['email'], $subject, $content);
          $response['status'] = 1;
          $this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Password changed successfully</div>');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Something went wrong please try again later.</div>');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> User not found.</div>');
      }
    } else {
      $response['status'] = 2;
      $response['message'] = 'Password doesn\'t match';
      $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Password doesn\'t match.</div>');
    }
    echo json_encode($response);
  }

  private function send_joining_confirmation($adminData)
  {
    $emailContent = $this->Common_Model->get_email_content(6);

    $subject = 'Invitation accepted successfully.';
    $body = "<p>Dear " . $adminData['first_name'] . " " . $adminData['last_name'] . ",</p>";
    $body .= $emailContent;
    if ($this->config->item('ENVIRONMENT') == 'production') {
      $this->Common_Model->send_mail($adminData['email'], $subject, $body);
      return '';
    } else {
      return "<br/>" . $body;
    }
  }

  public function forget_password()
  {
    $output['status'] = 0;
    $this->form_validation->set_rules('email', 'email', 'required');
    if ($this->form_validation->run()) {
      $email = $this->input->post('email');
      $run = $this->Common_Model->fetch_records('admins', array('email' => $email), false, true);
      if ($run) {
        $email = $run['email'];
        $subject = "Forget password";

        $html = '<p>Hello, ' . $run['name'] . '</p>';
        $html .= '<p>This is an automated message . If you did not recently initiate the Forgot Password process, please disregard this email.</p>';
        $html .= '<p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p>';
        $html .= '<p>Password: <b>' . $run['password'] . '</b></p>';

        $mailResponse = $this->Common_Model->send_mail($run['email'], $subject, $html);
        if ($mailResponse['status'] == 1) {
          $output['status'] = 1;
          $output['message'] = 'Please check your mail, We have sent your password to your registered mail id.';
        } else {
          $output['message'] = 'Server error! Unable to sent password to your email at this time.';
        }
      } else {
        $output['message'] = 'Email address that you have entered is not registered with us.';
      }
    } else {
      $output['message'] = validation_errors();
    }
    echo json_encode($output);
  }

  public function verify_admin($adminId, $token)
  {
    $where['token'] = $token;
    $where['id'] = $adminId;
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    if ($adminData) {
      if ($adminData['is_email_verified'] != 1) {
        // $update['token'] = null;
        // $update['updated'] = $update['last_login'] = date("Y-m-d H:i:d");
        // $update['is_email_verified'] = 1;
        // if ($this->Common_Model->update('admins', array('id' => $adminData['id']), $update)) {
        //   $to = $adminData['email'];
        //   $subject = 'Email successfully verified.';
        //   $body = '<p>Hello ' . $adminData['first_name'] . ' ' . $adminData['last_name'] . ',</p>';
        //   $body .= '<p>Congratulations!! your email has been verified successfully. You may now continue using our services.</p>';
        //   $mailResponse = $this->Common_Model->send_mail($to, $subject, $body);
        //   if ($this->session->userdata('is_logged_id')) {
        //     redirect('Verify');
        //   } else {
        //     $message = $this->Common_Model->success('Thank you: Your email has been verified successfully. Please login to continue.');
        //     $this->session->set_flashdata('responseMessage', $message);
        //     redirect('Login');
        //   }
        // }
        $pageData['adminData'] = $adminData;
        $this->session->set_userdata(array('id' => $adminData['id'], 'is_admin_logged_in' => true, 'adminData' => $adminData));
        $this->load->view('admin/admin-joining', $pageData);
      } else {
        $message = $this->Common_Model->success('Email already verified.');
        $this->session->set_flashdata('responseMessage', $message);
        redirect('Admin');
      }
    } else {
      $message = $this->Common_Model->error('This link has been expired.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('Admin');
    }
  }
}
