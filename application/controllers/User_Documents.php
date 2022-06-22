<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Documents extends CI_Controller
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
        $pageData['userDocuments'] = $this->Common_Model->fetch_records('user_docs', array('user_id' => $userId));

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/user_documents', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    public function update()
    {
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $response['status'] = 0;
        $existingFiles = $this->check_file_count();

        if ($existingFiles < 4) {
            if ($_FILES['document']['error'] == 0) {
                $config['upload_path'] = "assets/site/documents/";
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['encrypt_name'] = true;
                $this->load->library("upload", $config);
                if ($this->upload->do_upload('document')) {
                    $insert['document'] = $config['upload_path'] . $this->upload->data("file_name");
                    $insert['user_id'] = $this->session->userdata('id');
                    $insert['doc_type'] = 1;
                    $documentId = $this->Common_Model->insert('user_docs', $insert);
                    if ($documentId) {
                        $response['status'] = 1;
                        $response['responseMessage'] = $this->Common_Model->success('Document added successfully.');
                        $response['document']['id'] = $documentId;
                        $response['totalDocuments'] = $existingFiles + 1;
                    }
                } else {
                    $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
                }
            }
        } else {
            $response['responseMessage'] = $this->Common_Model->error('Maximum upto 4 files are allowed.');
            $response['status'] = 2;
        }
        echo json_encode($response);
    }

    private function check_file_count()
    {
        $userDocuments = $this->Common_Model->fetch_records('user_docs', array('user_id' => $this->session->userdata('id')));
        return count($userDocuments);
    }

    public function delete_document()
    {
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $response['status'] = 0;
        $where['id'] = $this->input->post('document_id');
        $document = $this->Common_Model->fetch_records('user_docs', $where, false, true);
        if (file_exists(($document['document']))) {
            unlink($document['document']);
        }
        if ($this->Common_Model->delete('user_docs', $where)) {
            $response['responseMessage'] = $this->Common_Model->success('Document deleted successfully.');
            $response['status'] = 1;
            $response['totalDocuments'] = $this->check_file_count();
        }
        echo json_encode($response);
    }
}
