<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    // $this->check_login();
  }

  public function index(){
    $this->load->view('admin/index');
  }

  public function login(){
    $this->load->view('admin/login');
  }

  public function profile(){
    $this->load->view('admin/profile');
  }

  public function table(){
    $this->load->view('admin/table');
  }

}
