<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  public function index()
  {
    $pageData = $this->Common_Model->get_userdata();
    $pageData['newses']  = $this->Common_Model->fetch_records('newses', array('is_deleted' => 0), false, false, 'id');
    $pageData['jobLocations'] = $this->Common_Model->fetch_records('job_types');

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/index', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function about()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/about', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function newses()
  {
    $pageData = $this->Common_Model->get_userdata();
    $pageData['newses']  = $this->Common_Model->fetch_records('newses', array('is_deleted' => 0), false, false, 'id');
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/blogs', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function news($id)
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/blog-details', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function jobs()
  {
    $pageData = $this->Common_Model->get_userdata();
    $join[0][] = 'job_types';
    $join[0][] = 'jobs.job_type = job_types.id';
    $join[0][] = 'left';
    $whereJoin['jobs.is_deleted'] = 0;
    $select = 'jobs.*, job_types.name';
    $pageData['jobs'] = $this->Common_Model->join_records('jobs', $join, $whereJoin, $select, 'jobs.id', 'DESC');
    $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();
    $pageData['jobLocations'] = $this->Common_Model->fetch_records('job_types');

    $pageData['searchParams']['types'] = (isset($_GET['type'])) ? $_GET['type'] : '';

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/jobs', $pageData);
  }

  public function contact()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/contact', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function terms()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/terms', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function privacy()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/privacy', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function contact_request()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('full_name', 'full_name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('message', 'message', 'required');
    $this->form_validation->set_rules('resume', 'resume', 'required');
    if ($this->form_validation->run()) {
      $insert = $this->input->post();
      $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
      if ($this->Common_Model->insert('contact_requests', $insert)) {
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

  public function resume()
  {
    $oldResume = $this->input->post('oldResume');
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('There are some error with this file, please upload another file.');
    if ($_FILES['resume']['error'] == 0) {
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'pdf|doc|docx';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        if (trim($oldResume)) {
          if (file_exists($oldResume)) {
            unlink($oldResume);
          }
        }
        $response['resumePath'] = $config['upload_path'] . $this->upload->data("file_name");
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Resume uploaded successfully.');
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    echo json_encode($response);
  }

  public function request_professional()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('company', 'company', 'required');
    $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('staff_required', 'staff_required', 'required');
    $this->form_validation->set_rules('work_location', 'work_location', 'required');
    $this->form_validation->set_rules('description', 'description', 'required');
    if ($this->form_validation->run()) {
      $insert['name'] = $this->input->post('name');
      $insert['email'] = $this->input->post('email');
      $insert['company'] = $this->input->post('company');
      $insert['phone'] = $this->input->post('phone');
      $insert['staff_required'] = $this->input->post('staff_required');
      $insert['work_location'] = $this->input->post('work_location');
      $insert['description'] = $this->input->post('description');
      $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");

      if (!empty($_FILES)) {
        if ($_FILES['resume']['error'] == 0) {
          $config['upload_path'] = "assets/site/resume/";
          $config['allowed_types'] = 'doc|docx|pdf';
          $config['encrypt_name'] = true;
          $this->load->library("upload", $config);
          if ($this->upload->do_upload('resume')) {
            $resume = $this->upload->data("file_name");

            $insert['resume'] = $config['upload_path'] . $resume;
          } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
          }
        }
      }
      if ($this->Common_Model->insert('professional_requests', $insert)) {
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Request sent successfully.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

  public function test(){
    $to = 'test-35a775@test.mailgenius.com';
    $subject = 'test mail';
    $body = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>";
    try{
      $this->Common_Model->send_mail($to, $subject, $body);
      echo "Worked";

    }catch(Exception $e){
      echo 'Message: ' .$e->getMessage();
    }
  }
}
