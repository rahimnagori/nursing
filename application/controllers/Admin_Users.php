<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    if (!$this->check_login()) {
      redirect('Admin');
    }
  }

  public function index()
  {
    if (!$this->Common_Model->is_admin_authorized($this->session->userdata('id'), 4)) {
      $this->session->set_flashdata('responseMessage', $this->Common_Model->error('You are not authorized to access this page.'));
      redirect('Admin');
    }
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['users'] = $this->Common_Model->fetch_records('users', array('is_deleted' => 0));
    foreach ($pageData['users'] as $key => $user) {
      $whereDocs = [
        'user_id' => $user['id']
      ];
      $pageData['users'][$key]['userDocuments'] = $this->Common_Model->fetch_records('user_docs', $whereDocs);
    }

    $this->load->view('admin/users_management', $pageData);
  }

  public function admin()
  {
    $admin_id = $this->session->userdata('id');
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $whereAdmins = [
      'id !=' => $admin_id
    ];
    $pageData['admins'] = $this->Common_Model->fetch_records('admins', $whereAdmins);

    $this->load->view('admin/admins_management', $pageData);
  }

  public function create_admin()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|is_unique[admins.email]', array('is_unique' => 'This email is already taken. Please provide another email.'));
    if ($this->form_validation->run()) {
      $password = $this->Common_Model->generate_password(8);
      $insert = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'admin_type' => $this->input->post('admin_type'),
        'password' => md5($password),
        'pass' => $password, /* delete this column on production */
        'token' => rand(100000, 999999),
        'is_logged_in' => 0,
        'is_email_verified' => 0,
        'created' => date("Y-m-d H:i:s"),
        'updated' => date("Y-m-d H:i:s"),
      );
      $adminId = $this->Common_Model->insert('admins', $insert);
      if ($adminId) {
        $emailResponse = $this->send_joining_email_to_admin($adminId, $insert, $password);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Admin added successfully.' . $emailResponse);
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function resend_password()
  {
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;
    $where['id'] = $this->session->userdata('id');
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $password = $this->Common_Model->generate_password(8);
    $update['password'] = md5($password);
    $update['updated'] = date("Y-m-d H:i:s");
    $update['ip_address'] = $_SERVER['REMOTE_ADDR'];
    if ($this->Common_Model->update('admins', array('id' => $adminData['id']), $update)) {
      $emailResponse = $this->send_joining_email_to_admin($where['id'], $adminData, $password, true);
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Verification email sent successfully.' . $emailResponse);
    }
    echo json_encode($response);
  }

  public function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  private function send_joining_email_to_admin($adminId, $adminData, $password, $resend = false)
  {
    $verificationLink = $this->config->item('base_url');
    $verificationLink .= 'Verify-Admin/' . $adminId . '/' . $adminData['token'];
    $emailContent = $this->Common_Model->get_email_content(5);

    $subject = ($resend) ? 'Re: Invitation be to an Admin' : 'Invitation be to an Admin';
    $body = "<p>Dear " . $adminData['first_name'] . " " . $adminData['last_name'] . ",</p>";
    $body .= $emailContent;
    $body .= "<p> <b>$password</b> is your password.</p>";
    $body .= "<p>To start using the portal as an Admin, click on the link below and enter the above password. </p>";
    $body .= "<p><a href='" . $verificationLink . "' target='_blank' >Verify Now</a></p>";
    $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
    $body .= "<p>" . $verificationLink . "</p>";
    if ($this->config->item('ENVIRONMENT') == 'production') {
      $this->Common_Model->send_mail($adminData['email'], $subject, $body);
      return '';
    } else {
      return "<br/>" . $body;
    }
  }
}
