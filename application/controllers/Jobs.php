<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Jobs_Model');
        $this->load->library('session');
    }

    public function index()
    {
        $searchParams = $this->input->post();
        $orLikeGroup = [];
        if (!empty($searchParams['searchQuery'])) {
            $orLikeGroup['jobs.title'] = $searchParams['searchQuery'];
            $orLikeGroup['jobs.description'] = $searchParams['searchQuery'];
        }
        if (!empty($searchParams['payment_type'])) {
            if ($searchParams['payment_type'] != 0) {
                $whereJoin['jobs.payment_type'] = $searchParams['payment_type'];
            }
        }
        if (!empty($searchParams['locations'])) {
            if ($searchParams['locations'] != 0) {
                $whereJoin['jobs.job_type'] = $searchParams['locations'];
            }
        }
        $join[0][] = 'job_types';
        $join[0][] = 'jobs.job_type = job_types.id';
        $join[0][] = 'left';
        $whereJoin['jobs.is_deleted'] = 0;
        $select = 'jobs.*, job_types.name';
        $pageData['jobs'] = $this->Jobs_Model->join_records('jobs', $join, $select, $whereJoin, $orLikeGroup,  'jobs.id', 'DESC');
        $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();
        $pageData['jobDetailsPath'] = $searchParams['jobDetailsPath'];
        $this->load->view('site/include/jobs_listings', $pageData);
    }

    public function job_details($id)
    {
        $pageData = $this->get_job_details_data($id);

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/job_details', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    public function user_job_details($id)
    {
        $pageData = $this->get_job_details_data($id);

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/job_details', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    private function get_job_details_data($id)
    {
        $pageData = $this->Common_Model->get_userdata();

        $where = [
            'id' => $id
        ];
        $whereJobApplication = [
            'user_id' => $this->session->userdata('id'),
            'job_id' => $id
        ];
        $pageData['jobDetails'] = $this->Common_Model->fetch_records('jobs', $where, false, true);
        if (empty($pageData['jobDetails'])) {
            $response['responseMessage'] = $this->Common_Model->error("Job not found or invalid job!!");
            $this->session->set_flashdata('responseMessage', $response['responseMessage']);
            redirect('Jobs');
        }
        $pageData['isJobApplied'] = $this->Common_Model->fetch_records('job_applications', $whereJobApplication, false, true);
        $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();
        $pageData['jobTypes'] = $this->Common_Model->get_job_types();
        return $pageData;
    }

    public function apply()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $jobId = $this->input->post('id');
        $userId = $this->session->userdata('id');
        if ($userId) {
            $insert['user_id'] = $userId;
            $insert['job_id'] = $jobId;
            $where = $insert;
            $isAlreadyApplied  = $this->Common_Model->fetch_records('job_applications', $where, false, true);
            if (empty($isAlreadyApplied)) {
                $insert['status'] = 0;
                $insert['created'] = date("Y-m-d H:i:s");
                if ($this->Common_Model->insert('job_applications', $insert)) {
                    $response['status'] = 1;
                    $response['responseMessage'] = $this->Common_Model->success('Applied successfully.');
                }
            } else {
                $response['status'] = 3;
                $response['responseMessage'] = $this->Common_Model->error('You have already applied for this job.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error('Sorry you are not authorized.');
        }
        echo json_encode($response);
    }

    public function apply_as_guest()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        // $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]|trim');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|is_unique[users.email]', array('is_unique' => 'This email is already registered with us. Please provide another email or you can <a href="' . site_url('Login') . '">Login</a> or <a href="' . site_url('Sign-Up') . '">Sign Up</a> to apply.'));
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('job_id', 'job_id', 'required');
        if ($this->form_validation->run()) {
            $inputName = $this->input->post('name');
            $name = explode(' ', $inputName);
            $insertUser['first_name'] = $name[0];
            $insertUser['last_name'] = (array_key_exists("1", $name)) ? $name[1] : $name[0];
            $insertUser['email'] = $this->input->post('email');
            // $insertUser['username'] = $this->input->post('username');
            $insertUser['username'] = $this->Common_Model->generate_username($insertUser);
            $insertUser['token'] = rand(100000, 999999);
            $password = $this->Common_Model->generate_password(8);
            $insertUser['password'] = md5($password);
            $insertUser['password_n'] = $password;
            if ($_FILES['resume']['error'] == 0) {
                $config['upload_path'] = "assets/site/resume/";
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['encrypt_name'] = true;
                $this->load->library("upload", $config);
                if ($this->upload->do_upload('resume')) {
                    $insertUser['resume'] = $config['upload_path'] . $this->upload->data("file_name");
                    $userId = $this->Common_Model->insert('users', $insertUser);
                    $insertJobApplication['user_id'] = $userId;
                    $insertJobApplication['job_id'] = $this->input->post('job_id');
                    $insertJobApplication['status'] = 0;
                    $insertJobApplication['created'] = date("Y-m-d H:i:s");
                    $this->Common_Model->insert('job_applications', $insertJobApplication);
                    if ($_FILES['document']['error'] == 0) {
                        $this->insert_user_document($userId);
                    }
                    $emailResponse = $this->send_verification_email($userId, $insertUser['token']);
                    $response['status'] = 1;
                    $response['responseMessage'] = $this->Common_Model->success('We have received your application. To complete the process, we have sent a verification mail to you. Please check your inbox or junk folder and click on the verification link to complete the job application.' . $emailResponse);
                } else {
                    $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
                }
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }
        echo json_encode($response);
    }

    public function applied()
    {
        $pageData = $this->Common_Model->get_userdata();

        $join[0][] = 'jobs';
        $join[0][] = 'job_applications.job_id = jobs.id';
        $join[0][] = 'left';
        $select = '*';
        $where['job_applications.user_id'] = $this->session->userdata('id');
        $pageData['appliedJobs'] = $this->Common_Model->join_records('job_applications', $join, $where, $select);
        $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/my-jobs', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    private function insert_user_document($userId)
    {
        $config['upload_path'] = "assets/site/documents/";
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['encrypt_name'] = true;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('document')) {
            $insertDocument['document'] = $config['upload_path'] . $this->upload->data("file_name");
            $insertDocument['doc_name'] = "Supporting Document";
            $insertDocument['doc_type'] = 1;
            $insertDocument['user_id'] = $userId;
            $this->Common_Model->insert('user_docs', $insertDocument);
        }
    }

    private function send_verification_email($userId, $token)
    {
        $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
        $verificationLink = $this->config->item('base_url');
        $verificationLink .= 'Verify/' . $userId . '/' . $token;
        $emailContent = $this->Common_Model->get_email_content(1);

        $subject = 'Verify your email address to complete job application process.';
        $body = "<p>Dear " . $userdata['first_name'] . " " . $userdata['last_name'] . ",</p>";
        $emailContent = $this->Common_Model->get_email_content(3);
        $body .= $emailContent;
        $body .= "<p><a href='" . $verificationLink . "'>Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" . $verificationLink . "</p>";
        if ($this->config->item('ENVIRONMENT') == 'production') {
            $this->Common_Model->send_mail($userdata['email'], $subject, $body);
            return '';
        } else {
            return "<br/>" . $body;
        }
    }
}
