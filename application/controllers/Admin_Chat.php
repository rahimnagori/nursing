<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Chat extends CI_Controller
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
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $join[0][] = 'users';
    $join[0][] = 'chats.user_id = users.id';
    $join[0][] = 'left';
    $select = 'chats.*, users.first_name, users.last_name, users.email';
    $pageData['chats'] = $this->Common_Model->join_records('chats', $join, false, $select, 'chats.id', 'DESC');
    if (!empty($pageData['chats'])) {
      $whereMessage['chat_id'] = $pageData['chats'][0]['id'];
      $pageData['messages'] = $this->Common_Model->fetch_records('messages', $whereMessage);
      $pageData['chatDetails']['id'] = $pageData['chats'][0]['id'];
      $pageData['chatDetails']['username'] = $pageData['chats'][0]['first_name'] . ' ' . $pageData['chats'][0]['last_name'];
      $pageData['chatDetails']['receiverId'] = $pageData['chats'][0]['user_id'];
    }

    $this->load->view('admin/chat', $pageData);
  }

  private function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function add()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('message', 'message', 'required|trim');
    $this->form_validation->set_rules('chat_id', 'chat_id', 'required');
    if ($this->form_validation->run()) {
      $insert['message'] = $this->input->post('message');
      $insert['chat_id'] = $this->input->post('chat_id');
      $insert['sender_id'] = $this->session->userdata('id');
      $insert['is_admin'] = 1;
      $insert['receiver_id'] = $this->get_receiver($insert['chat_id']);
      $insert['is_read'] = 0;
      $insert['created'] = date("Y-m-d H:i:s");
      if ($this->Common_Model->insert('messages', $insert)) {
        $this->check_notify_user($insert['receiver_id']);
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

  public function get_messages()
  {
    $where['chat_id'] = $this->input->post('chat_id');
    // $pageData['messages'] = $this->Common_Model->fetch_records('messages', $where);
    $join[0][] = 'user_docs';
    $join[0][] = 'messages.document_id = user_docs.id';
    $join[0][] = 'left';
    $select = 'messages.*, user_docs.document';
    $pageData['messages'] = $this->Common_Model->join_records('messages', $join, array('messages.chat_id' => $where['chat_id']), $select, 'messages.id', 'ASC');
    $where['is_admin'] = 0;
    $this->Common_Model->update('messages', $where, array('is_read' => 1));

    $this->load->view('site/messages', $pageData);
  }

  private function notify_user($userId, $email)
  {
    $userDetails = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);

    $subject = 'You have a new message.';
    $body = "<p>Dear " . $userDetails['first_name'] . " " . $userDetails['last_name'] . ",</p>";
    $body .= $email['content'];
    if ($this->config->item('ENVIRONMENT') == 'production') {
      $this->Common_Model->send_mail($userDetails['email'], $subject, $body);
      $insertSentMail = [
        'user_id' => $userId,
        'email_id' => $email['id'],
        'sent_at' => date("Y-m-d H:i:s")
      ];
      $this->Common_Model->insert('sent_mails', $insertSentMail);
    }
  }

  private function check_notify_user($userId)
  {
    $email = $this->Common_Model->fetch_records('emails', array('email_type' => 2), false, true);

    $whereSentMail = [
      'user_id' => $userId,
      'email_id' => $email['id'],
      'sent_at <' => date("Y-m-d 00:00:00")
    ];

    $isMailSent = $this->Common_Model->fetch_records('sent_mails', $whereSentMail, false, true);
    if (empty($isMailSent)) {
      $this->notify_user($userId, $email);
    }
  }

  private function get_receiver($chat_id)
  {
    $chatDetails = $this->Common_Model->fetch_records('chats', array('id' => $chat_id), false, true);
    return $chatDetails['user_id'];
  }
}
