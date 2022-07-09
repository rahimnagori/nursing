<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  private function check_login()
  {
    return ($this->session->userdata('is_user_logged_in')) ? true : false;
  }

  public function index()
  {
    if ($this->check_login()) {
      redirect('Profile');
    }
    $pageData = [];
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/login', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function login()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('username', 'username', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required');
    if ($this->form_validation->run()) {
      $where = $this->input->post('username');
      $userdata = $this->Common_Model->get_user($where);
      $password = md5($this->input->post('password'));
      if ($userdata) {
        if ($password == $userdata['password']) {
          $update['is_logged_in'] = 1;
          $update['last_login'] = date("Y-m-d H:i:s");
          $update['user_ip'] = $_SERVER['REMOTE_ADDR'];
          $this->Common_Model->update('users', array('id' => $userdata['id']), $update);
          $this->session->set_userdata(array('id' => $userdata['id'], 'is_user_logged_in' => true, 'userdata' => $userdata));
          $response['status'] = 1;
          $response['responseMessage'] = $this->Common_Model->success('Logged in successfully.');
        } else {
          $response['status'] = 2;
          $response['responseMessage'] = $this->Common_Model->error('Your password is not correct. Try entering the correct password');
        }
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('User does not exists. Click on <a href="' . site_url('Sign-Up') . '">Sign Up</a> to register');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function signup()
  {
    $this->load->view('site/include/header');
    $this->load->view('site/sign-up');
    $this->load->view('site/include/footer');
  }

  public function register()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]|trim');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|is_unique[users.email]', array('is_unique' => 'This email is already taken. Please provide another email.'));
    $this->form_validation->set_rules('password', 'password', 'required');
    $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('matches' => 'Password and Confirm password does not match.'));
    $this->form_validation->set_rules('job_title', 'job_title', 'required');
    if ($this->form_validation->run()) {
      $insert = $this->create_user();
      $userId = $this->Common_Model->insert('users', $insert);
      if ($userId) {
        $emailResponse = $this->send_verification_email($userId);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Check your email to complete registration. If you have not found mail in Inbox please check your junk folder.' . $emailResponse);
        $response['insert'] = $insert;
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function forget()
  {
    if ($this->check_login()) {
      redirect('Profile');
    }
    $pageData = [];
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/forget', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function reset()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $this->form_validation->set_rules('username', 'username', 'required|trim');
    if ($this->form_validation->run()) {
      $where = $this->input->post('username');
      $userdata = $this->Common_Model->get_user($where);
      if ($userdata) {
        $emailResponse = $this->send_reset_mail($userdata['id']);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Check your email to complete password reset. If you have not found mail in Inbox please check your junk folder.' . $emailResponse);
      } else {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('You are not registered with us. Click on <a href="' . site_url('Sign-Up') . '">Sign Up</a> to register.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

  public function profile()
  {
    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if ($pageData['userDetails']['is_email_verified'] != 1) {
      redirect('Verify');
    }

    $whereDoc = [
      'user_id' => $this->session->userdata('id'),
      'doc_type' => 1 /* Profile */
    ];
    $pageData['userDocuments'] = $this->Common_Model->fetch_records('user_docs', $whereDoc);

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function verify()
  {
    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if ($pageData['userDetails']['is_email_verified'] == 1) {
      $responseMessage = $this->Common_Model->success('Email verified successfully.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Profile');
    }
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/email-verification', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function resend()
  {
    $pageData = $this->Common_Model->get_userdata();

    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    if ($pageData['userDetails']['id']) {
      $emailResponse = $this->send_verification_email($pageData['userDetails']['id'], true);
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Verification email sent successfully.' . $emailResponse);
    }
    echo json_encode($response);
  }

  private function send_verification_email($userId, $resend = false)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
    if ($userdata) {
      if ($userdata['is_email_verified'] == 0) {
        $token = rand(100000, 999999);
        $update['token'] = $token;
        $this->Common_Model->update('users', array('id' => $userId), $update);
        $verificationLink = $this->config->item('base_url');
        $verificationLink .= 'Verify/' . $userdata['id'] . '/' . $token;
        $emailContent = $this->Common_Model->get_email_content(1);

        $subject = ($resend) ? 'Re: Verify you email address.' : 'Verify your email address.';
        $body = "<p>Dear " . $userdata['first_name'] . " " . $userdata['last_name'] . ",</p>";
        $body .= $emailContent;
        $body .= "<p><a href='" . $verificationLink . "' target='_blank' >Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" . $verificationLink . "</p>";
        if ($this->config->item('ENVIRONMENT') == 'production') {
          $this->Common_Model->send_mail($userdata['email'], $subject, $body);
          return '';
        } else {
          return "<br/>" . $body;
        }
      }
    } else {
      /* User does not exist */
    }
  }

  private function send_reset_mail($userId)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
    if ($userdata) {
      $token = rand(100000, 999999);
      $update['token'] = $token;
      $this->Common_Model->update('users', array('id' => $userId), $update);
      $verificationLink = $this->config->item('base_url');
      $verificationLink .= 'Reset/' . $userdata['id'] . '/' . $token;
      $emailContent = $this->Common_Model->get_email_content(4);

      $subject = 'Password reset request received';
      $body = "<p>Dear " . $userdata['first_name'] . " " . $userdata['last_name'] . ",</p>";
      $body .= $emailContent;
      $body .= "<p><a href='" . $verificationLink . "'>Reset Now</a></p>";
      $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
      $body .= "<p>" . $verificationLink . "</p>";
      if ($this->config->item('ENVIRONMENT') == 'production') {
        $this->Common_Model->send_mail($userdata['email'], $subject, $body);
        return '';
      } else {
        return "<br/>" . $body;
      }
    } else {
      /* User does not exist */
    }
  }

  private function send_password_change_confirmation($user_id)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $user_id), false, true);
    if ($userdata) {
      $to = $userdata['email'];
      $subject = 'Password reset successfully.';
      $body = '<p>Hello ' . $userdata['first_name'] . ' ' . $userdata['last_name'] . ',</p>';
      $body .= '<p>Congratulations!! your password has been reset successfully. You may now continue using our services.</p>';
      if ($this->config->item('ENVIRONMENT') == 'production') {
        $this->Common_Model->send_mail($userdata['email'], $subject, $body);
        return '';
      } else {
        return "<br/>" . $body;
      }
    }
  }

  public function email_verification($user_id, $token)
  {
    $where['token'] = $token;
    $where['id'] = $user_id;
    $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
    if ($userdata) {
      if ($userdata['is_email_verified'] != 1) {
        $update['token'] = null;
        $update['last_login'] = date("Y-m-d H:i:d");
        $update['is_email_verified'] = 1;
        if ($this->Common_Model->update('users', array('id' => $userdata['id']), $update)) {
          $to = $userdata['email'];
          $subject = 'Email successfully verified.';
          $body = '<p>Hello ' . $userdata['first_name'] . ' ' . $userdata['last_name'] . ',</p>';
          $body .= '<p>Congratulations!! your email has been verified successfully. You may now continue using our services.</p>';
          $mailResponse = $this->Common_Model->send_mail($to, $subject, $body);
          if ($this->session->userdata('is_logged_id')) {
            redirect('Verify');
          } else {
            $message = $this->Common_Model->success('Thank you: Your email has been verified successfully. Please login to continue.');
            $this->session->set_flashdata('responseMessage', $message);
            redirect('Login');
          }
        }
      } else {
        $message = $this->Common_Model->success('Email already verified.');
        $this->session->set_flashdata('responseMessage', $message);
        redirect('Login');
      }
    } else {
      $message = $this->Common_Model->error('This link has been expired.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('');
    }
  }

  public function reset_password($user_id, $token)
  {
    $where['token'] = $token;
    $where['id'] = $user_id;
    $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
    if ($userdata) {
      $pageData = [];
      $this->session->set_userdata(array('resetPasswordId' => $user_id));
      $this->load->view('site/include/header', $pageData);
      $this->load->view('site/reset-password', $pageData);
      $this->load->view('site/include/footer', $pageData);
    } else {
      $message = $this->Common_Model->error('You are not authorized.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('Login');
    }
  }

  public function update_new_password()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $this->form_validation->set_rules('password', 'password', 'required|trim');
    $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('matches' => 'Password and Confirm password does not match.'));
    if ($this->form_validation->run()) {
      $userId = $this->session->userdata('resetPasswordId');
      if ($userId) {
        $update['token'] = null;
        $update['password'] = md5($this->input->post('password'));
        if ($this->Common_Model->update('users', array('id' => $userId), $update)) {
          $emailResponse = $this->send_password_change_confirmation($userId);
          $response['status'] = 1;
          $response['responseMessage'] = $this->Common_Model->success('Password updated successfully. You may now <a href="' . site_url('Login') . '">Login</a> and start applying for jobs.' . $emailResponse);
        }
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('You are not authorized.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

  public function update()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $response['isResumeUploaded'] = 0;

    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    if ($_FILES['resume']['error'] == 0) {
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'doc|docx|pdf';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        $resume = $this->upload->data("file_name");

        $update['resume'] = $config['upload_path'] . $resume;
        $oldResume = $this->input->post('old_resume');
        $response['isResumeUploaded'] = 1;
        $response['resume'] = $update['resume'];
        if (!empty($oldResume)) {
          if (file_exists($oldResume)) {
            unlink($oldResume);
          }
        }
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    $update['first_name'] = $this->input->post('first_name');
    $update['last_name'] = $this->input->post('last_name');
    $update['address'] = $this->input->post('address');
    $update['phone'] = $this->input->post('phone');
    $update['national_insurance_number'] = $this->input->post('national_insurance_number');
    $update['uk_work_permit'] = ($this->input->post('uk_work_permit')) ? 1 : 0;
    $where['id'] = $this->session->userdata('id');
    if ($this->Common_Model->update('users', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Profile updated successfully.');
    }
    echo json_encode($response);
  }

  public function account()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/account', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/add-post', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function posts()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/my-posts', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function password()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/change-password', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function logout()
  {
    $where['id'] = $this->session->userdata('id');
    $update['is_logged_in'] = 0;
    $this->Common_Model->update('users', $where, $update);
    $this->session->sess_destroy();
    return redirect('');
  }

  private function create_user()
  {
    return $insert = [
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'username' => $this->input->post('username'),
      'email' => $this->input->post('email'),
      'password' => md5($this->input->post('password')),
      'job_title' => $this->input->post('job_title'),
      'other_job_title' => ($this->input->post('other_job_title')) ? $this->input->post('other_job_title') : null,
      'is_email_verified' => 0,
      'token' => rand(1000, 99999),
      'is_logged_in' => 0,
      'user_ip' => $_SERVER['REMOTE_ADDR'],
      'is_deleted' => 0,
      'created' => date("Y-m-d H:i:s"),
      'updated' => date("Y-m-d H:i:s"),
      'password_n' => $this->input->post('password'), /* Development only can be deleted later */
    ];
  }
}
