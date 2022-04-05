<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Chat extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    if(!$this->check_login()){
      redirect('Admin');
    }
  }

  public function index(){
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $pageData['adminData'] = $this->Common_Model->fetch_records('admins', $where, false, true);
    $whereUsers['is_deleted'] = 0;
    $pageData['users'] = $this->Common_Model->fetch_records('users', $whereUsers);
    $join[0][] = 'users';
    $join[0][] = 'chats.user_id = users.id';
    $join[0][] = 'left';
    $select = '*';
    $pageData['chats'] = $this->Common_Model->join_records('chats', $join, false, $select, 'chats.id', 'DESC');
    if(!empty($pageData['chats'])){
        $whereMessage['chat_id'] = $pageData['chats'][0]['id'];
        $pageData['messages'] = $this->Common_Model->fetch_records('messages', $whereMessage);
        $pageData['chatDetails']['id'] = $pageData['chats'][0]['id'];
        $pageData['chatDetails']['receiverId'] = $pageData['chats'][0]['user_id'];
    }

    $this->load->view('admin/chat', $pageData);
  }

  private function check_login(){
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function add(){
      $response['status'] = 0;
      $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

      $this->form_validation->set_rules('message', 'message', 'required|trim');
      $this->form_validation->set_rules('chat_id', 'chat_id', 'required');
      if ($this->form_validation->run()) {
          $insert['message'] = $this->input->post('message');
          $insert['chat_id'] = $this->input->post('chat_id');
          $insert['sender_id'] = $this->session->userdata('id');
          $insert['is_admin'] = 1;
          $insert['receiver_id'] = 1;
          $insert['is_read'] = 0;
          $insert['created'] = date("Y-m-d H:i:s");
          if ($this->Common_Model->insert('messages', $insert)) {
              $response['status'] = 1;
              $response['responseMessage'] = $this->Common_Model->success('Message sent successfully.');
          }
      } else {
          $response['status'] = 2;
          $response['responseMessage'] = $this->Common_Model->error(validation_errors());
      }
      $this->session->set_flashdata('responseMessage', $response['responseMessage']);
      echo json_encode($response);
  }
}
