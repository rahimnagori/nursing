<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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

  private function get_userdata(){

    return array();
  }

  public function index(){
    redirect('');
  }

  public function login(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/login', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function signup(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/sign-up', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function profile(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
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
    redirect('');
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/change-password', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

}
