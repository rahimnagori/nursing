<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chats extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->library('session');
        $this->check_login();
    }

    private function check_login()
    {
        return ($this->session->userdata('is_user_logged_in')) ? true : false;
    }

    public function index()
    {
        if (!$this->check_login()) {
            redirect('');
        }
        $pageData = [];
        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/login', $pageData);
        $this->load->view('site/include/footer', $pageData);
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
            $insert['is_admin'] = 0;
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
