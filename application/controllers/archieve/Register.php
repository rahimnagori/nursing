<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/Home
   *	- or -
   * 		http://example.com/index.php/Home/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/Home/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function __construct(){
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  public function index(){
    redirect('');
  }

  public function organization(){
    $response['status'] = 0;
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[organizations.email]', array('is_unique' => 'Please select a unique email.'));
    $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
    if ($this->form_validation->run()){
      $insert = $this->input->post();
      $insert['created'] = $insert['updated'] = date('Y-m-d H:i:s');

      $insert['pass'] = $insert['password'];
      /* Delete this column on production */
      $insert['password'] = md5($insert['password']);

      unset($insert['confirm_password']);
      $organizationId = $this->Common_Model->insert('organizations', $insert);
      if($organizationId){
        $this->send_verification_email($organizationId);

        $response['responseMessage'] = $this->Common_Model->success('Please check your e-mail for completing the joining process.');
        $response['status'] = 1;
      }
    }else{
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

  public function resend_verification_email(){
    $pageData = $this->Common_Model->get_userdata();

    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    if($pageData['is_logged_in'] && $pageData['is_organization']){
      $organization_id = $pageData['organization_data']['id'];
    }
    if($organization_id){
      $response['status'] = 1;
      $this->send_verification_email($organization_id, true);
      $response['responseMessage'] = $this->Common_Model->success('Verification email sent successfully.');
    }
    echo json_encode($response);
  }

  private function send_verification_email($organization_id, $resend = false){
    $userdata = $this->Common_Model->fetch_records('organizations', array('id' => $organization_id), false, true);
    if($userdata){
      if($userdata['is_email_verified'] == 0){
        $token = rand(100000, 999999);
        $update['token'] = $token;
        $this->Common_Model->update('organizations', array('id' => $organization_id), $update);
        $verificationLink = $this->config->item('base_url');
        $verificationLink .= 'Verify/' .$userdata['id'] .'/' .$token;

        $subject = ($resend) ? 'Re: Verify you email address.' : 'Verify your email address.';
        $body = "<p>Hello " .$userdata['first_name'] ." " .$userdata['last_name'] .",</p>";
        $body .= "<p>Please verify your account to continue using our services by clicking the link below.</p>";
        $body .= "<p><a href='" .$verificationLink ."'>Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" .$verificationLink ."</p>";
        $this->Common_Model->send_mail($userdata['email'], $subject, $body);
      }
    }else{
      /* User does not exist */
    }
    
  }

}
