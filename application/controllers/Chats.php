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
            $responseMessage = $this->Common_Model->error('Please login to continue.');
            $this->session->set_flashdata('responseMessage', $responseMessage);
            redirect('');
        }
        $pageData = $this->Common_Model->get_userdata();
        $userId = $this->session->userdata('id');
        $pageData['chatDetails'] = $this->Common_Model->fetch_records('chats', array('user_id' => $userId), false, true);
        if (empty($pageData['chatDetails'])) {
            $insert['user_id'] = $userId;
            $where['id'] = $this->Common_Model->insert('chats', $insert);
            $pageData['chatDetails'] = $this->Common_Model->fetch_records('chats', $where, false, true);
        }
        $pageData['messages'] = $this->Common_Model->fetch_records('messages', array('chat_id' => $pageData['chatDetails']['id']));

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/chat', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    public function add()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

        $this->form_validation->set_rules('message', 'message', 'required|trim');
        $this->form_validation->set_rules('chat_id', 'chat_id', 'required');
        if ($this->form_validation->run()) {
            $insert = $this->createMessage();
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

    private function createMessage()
    {
        $insert['message'] = $this->input->post('message');
        $insert['chat_id'] = $this->input->post('chat_id');
        $insert['sender_id'] = $this->session->userdata('id');
        $insert['is_admin'] = 0;
        $insert['receiver_id'] = 1;
        $insert['is_read'] = 0;
        $insert['created'] = date("Y-m-d H:i:s");
        return $insert;
    }

    public function get_messages()
    {
        $pageData = $this->Common_Model->get_userdata();
        $where['chat_id'] = $this->input->post('chat_id');
        $join[0][] = 'user_docs';
        $join[0][] = 'messages.document_id = user_docs.id';
        $join[0][] = 'left';
        $select = 'messages.*, user_docs.document';
        $pageData['messages'] = $this->Common_Model->join_records('messages', $join, array('messages.chat_id' => $where['chat_id']), $select, 'messages.id', 'ASC');

        $where['is_admin'] = 1;
        $this->Common_Model->update('messages', $where, array('is_read' => 1));

        $this->load->view('site/messages', $pageData);
    }

    public function send_file()
    {
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $response['status'] = 0;

        if ($_FILES['chat_file']['error'] == 0) {
            $config['upload_path'] = "assets/site/documents/";
            $config['allowed_types'] = 'jpeg|gif|jpg|png|doc|docx|pdf';
            $config['encrypt_name'] = true;
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('chat_file')) {
                $chatFile = $this->upload->data("file_name");

                $insert['user_id'] = $this->session->userdata('id');
                $insert['document'] = $config['upload_path'] . $chatFile;
                $insert['doc_type'] = 2;
                $documentId = $this->Common_Model->insert('user_docs', $insert);
                if ($documentId) {
                    $insertMessage = $this->createMessage();
                    $insertMessage['document_id'] = $documentId;
                    $insertMessage['is_document'] = 1;
                    $this->Common_Model->insert('messages', $insertMessage);
                    $response['status'] = 1;
                    $response['responseMessage'] = $this->Common_Model->success('Document sent successfully.');
                    $response['document']['id'] = $documentId;
                }
            } else {
                $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
            }
        }
        echo json_encode($response);
    }

    public function delete_document()
    {
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $response['status'] = 0;
        $whereMessage['id'] = $this->input->post('message_id');
        $messageDetails = $this->Common_Model->fetch_records('messages', $whereMessage, false, true);
        $whereUserDoc['id'] = $messageDetails['document_id'];
        $documentDetails = $this->Common_Model->fetch_records('user_docs', $whereUserDoc, false, true);
        if (!empty($documentDetails) && file_exists(($documentDetails['document']))) {
            unlink($documentDetails['document']);
            $this->Common_Model->delete('user_docs', $whereUserDoc);
        }
        $updateMessage['message']  = ($this->session->userdata('is_user_logged_in')) ? '<i>This file is deleted</i>' : '<i>This file is deleted by Admin</i>';
        $updateMessage['document_id']  = 0;
        $updateMessage['is_document']  = 0;
        $updateMessage['is_deleted']  = 1;
        $this->Common_Model->update('messages', $whereMessage, $updateMessage);
        $response['responseMessage'] = $this->Common_Model->success('File deleted successfully.');
        $response['status'] = 1;
        echo json_encode($response);
    }

    public function delete_message(){
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $response['status'] = 0;
        $where['id'] = $this->input->post('message_id');
        $update['message'] = ($this->session->userdata('is_user_logged_in')) ? "<i>This messages is deleted.</i>" : "<i>Admin deleted this message.</i>";
        $update['is_deleted'] = 1;
        if($this->Common_Model->update('messages', $where, $update)){
            $response['responseMessage'] = $this->Common_Model->success('Message deleted successfully.');
            $response['status'] = 1;
        }
        echo json_encode($response);
    }
}
