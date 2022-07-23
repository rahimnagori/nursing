<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Jobs extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    if (!$this->check_login()) {
      redirect('Admin');
    }
  }

  public function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function index()
  {
    if (!$this->Common_Model->is_admin_authorized($this->session->userdata('id'), 7)) {
      $this->session->set_flashdata('responseMessage', $this->Common_Model->error('You are not authorized to access this page.'));
      redirect('Admin');
    }
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $join[0][] = 'job_types';
    $join[0][] = 'jobs.job_type = job_types.id';
    $join[0][] = 'left';
    $whereJoin['jobs.is_deleted'] = 0;
    $select = 'jobs.*, job_types.name';
    $pageData['jobs'] = $this->Common_Model->join_records('jobs', $join, $whereJoin, $select, 'jobs.id', 'DESC');
    $pageData['jobTypes'] = $this->Common_Model->fetch_records('job_types');
    $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();

    $this->load->view('admin/jobs_management', $pageData);
  }

  public function types()
  {
    if (!$this->Common_Model->is_admin_authorized($this->session->userdata('id'), 10)) {
      $this->session->set_flashdata('responseMessage', $this->Common_Model->error('You are not authorized to access this page.'));
      redirect('Admin');
    }
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));

    $pageData['jobTypes'] = $this->Common_Model->fetch_records('job_types', false, false, false, 'id');

    $this->load->view('admin/job_types_management', $pageData);
  }

  public function add_job()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert = $this->create_job();

    if ($insert['job_type'] == 'other' && $insert['name']) {
      $insertJobType['name'] = $insert['name'];
      $insert['job_type'] = $this->Common_Model->insert('job_types', $insertJobType);
      unset($insert['name']);
    }
    if ($this->Common_Model->insert('jobs', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job added successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function delete_job()
  {
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_job_id');
    $update['is_deleted'] = 1;
    if ($this->Common_Model->update('jobs', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get_job($id)
  {
    $join[0][] = 'job_types';
    $join[0][] = 'jobs.job_type = job_types.id';
    $join[0][] = 'left';
    $where['jobs.is_deleted'] = 0;
    $where['jobs.id'] = $id;
    $select = 'jobs.*, job_types.name';
    $jobDetails = $this->Common_Model->join_records('jobs', $join, $where, $select, 'jobs.id', 'DESC');
    $pageData['jobDetails'] = $jobDetails[0];

    $pageData['jobTypes'] = $this->Common_Model->fetch_records('job_types');
    $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();

    $this->load->view('admin/include/job_details', $pageData);
  }

  public function update_job()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update = $this->create_job(true);
    $where['id'] = $this->input->post('job_id');
    if ($this->Common_Model->update('jobs', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function add_type()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert['name'] = $this->input->post('name');
    if ($this->Common_Model->insert('job_types', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job type added successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function delete_type()
  {
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_job_type_id');
    if ($this->Common_Model->delete('job_types', $where)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job type deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get_job_type($id)
  {
    $pageData['jobTypeDetails'] = $this->Common_Model->fetch_records('job_types', array('id' => $id), false, true);
    $this->load->view('admin/include/job_type_details', $pageData);
  }

  public function update_job_type()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update['name'] = $this->input->post('name');
    $where['id'] = $this->input->post('job_type_id');
    if ($this->Common_Model->update('job_types', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job type updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  private function create_job($update = false)
  {
    $data = [
      'job_ref' => $this->input->post('job_ref'),
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description'),
      'job_type' => $this->input->post('job_type'),
      'address' => $this->input->post('address'),
      'salary' => $this->input->post('salary'),
      'qualification' => $this->input->post('qualification'),
      'employment_type' => $this->input->post('employment_type'),
      'payment_type' => $this->input->post('payment_type'),
      'last_date' => $this->input->post('last_date'),
      'updated' => date("Y-m-d H:i:s"),
    ];
    if (!$update) {
      $data['created'] = date("Y-m-d H:i:s");
      $data['is_deleted'] = 0;
      $data['user_id'] = $this->session->userdata('id');
      // $data['job_ref'] = $this->Common_Model->get_job_reference($data);
    }
    return $data;
  }

  /* Not in use below functions */

  public function Add()
  {
    $response['status'] = 0;
    $insert = $this->input->post();
    if ($_FILES['service_image']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('service_image')) {
        $serviceImage = $this->upload->data("file_name");

        $insert['service_image'] = "assets/site/img/" . $serviceImage;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    if ($this->Common_Model->insert('services', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = 'Service Added Successfully.';
    }
    echo json_encode($response);
  }

  public function Get()
  {
    $whereService['id'] = $this->input->post('service_id');
    $pageData['serviceDetails'] = $this->Common_Model->fetch_records('services', $whereService, false, true);

    $this->load->view('admin/edit_service', $pageData);
  }

  public function Update()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');

    $update = $this->input->post();
    $where['id'] = $update['service_id'];
    unset($update['service_id']);
    if ($_FILES['service_image_update']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('service_image_update')) {
        $serviceImage = $this->upload->data("file_name");

        $update['service_image'] = "assets/site/img/" . $serviceImage;
        if (file_exists($update['thumbnail_old'])) unlink($update['thumbnail_old']);
      }
    }
    unset($update['thumbnail_old']);
    if ($this->Common_Model->update('services', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Services updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function Delete()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later.');
    $where['id'] = $this->input->post('service_id');
    $update['is_deleted'] = 1;
    if ($this->Common_Model->update('services', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Service deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function image($id)
  {
    $pageData = [];
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;

    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $pageData['adminData'] = $adminData;

    $pageData['serviceDetails'] = $this->Common_Model->fetch_records('services', array('id' => $id), false, true);

    $pageData['serviceImages'] = $this->Common_Model->fetch_records('service_images', array('service_id' => $id, 'is_deleted' => 0));

    $this->load->view('admin/service_images_management', $pageData);
  }

  public function Add_Image()
  {
    $response['status'] = 0;
    $insert = $this->input->post();
    $insert['is_deleted'] = 0;
    if ($_FILES['service_image']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('service_image')) {
        $serviceImage = $this->upload->data("file_name");

        $insert['service_image'] = "assets/site/img/" . $serviceImage;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    $insert['created'] = date("Y-m-d H:i:s");
    if ($this->Common_Model->insert('service_images', $insert)) {
      $response['status'] = 1;
      $response['responseMessage'] = 'Service Image Added Successfully.';
    }
    echo json_encode($response);
  }

  public function Get_Image()
  {
    $whereService['id'] = $this->input->post('service_image_id');
    $pageData['serviceImageDetails'] = $this->Common_Model->fetch_records('service_images', $whereService, false, true);

    $this->load->view('admin/edit_service_image', $pageData);
  }

  public function Update_Image()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');

    $update = $this->input->post();
    $where['id'] = $update['service_image_id'];
    unset($update['service_image_id']);
    if ($_FILES['service_image_update']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('service_image_update')) {
        $serviceImage = $this->upload->data("file_name");

        $update['service_image'] = "assets/site/img/" . $serviceImage;
        if (file_exists($update['thumbnail_old'])) unlink($update['thumbnail_old']);
      }
    }
    unset($update['thumbnail_old']);
    if ($this->Common_Model->update('service_images', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Service Image updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function Delete_Image()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later.');
    $where['id'] = $this->input->post('service_image_id');
    $update['is_deleted'] = 1;
    if ($this->Common_Model->update('service_images', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Service deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  // public function Brochure($id)
  // {
  //   $pageData = [];
  //   $admin_id = $this->session->userdata('id');
  //   $where['id'] = $admin_id;

  //   $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
  //   $pageData['adminData'] = $adminData;

  //   $pageData['serviceDetails'] = $this->Common_Model->fetch_records('services', array('id' => $id), false, true);

  //   $pageData['serviceBrochures'] = $this->Common_Model->fetch_records('service_brochures', array('service_id' => $id, 'is_deleted' => 0));

  //   $this->load->view('admin/brochure_management', $pageData);
  // }

  // public function add_brochure()
  // {
  //   $response['status'] = 0;
  //   $insert = $this->input->post();
  //   $insert['is_deleted'] = 0;
  //   if ($_FILES['brochure']['error'] == 0) {
  //     $config['upload_path'] = "assets/site/brochure/";
  //     $config['allowed_types'] = 'pdf';
  //     $config['encrypt_name'] = true;
  //     $this->load->library("upload", $config);
  //     if ($this->upload->do_upload('brochure')) {
  //       $brochure = $this->upload->data("file_name");

  //       $insert['brochure'] = "assets/site/brochure/" . $brochure;
  //     } else {
  //       $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
  //     }
  //   }
  //   $insert['created'] = date("Y-m-d H:i:s");
  //   if ($this->Common_Model->insert('service_brochures', $insert)) {
  //     $response['status'] = 1;
  //     $response['responseMessage'] = 'Service Brochure Added Successfully.';
  //   }
  //   echo json_encode($response);
  // }

  // public function Get_Brochure()
  // {
  //   $whereService['id'] = $this->input->post('service_id');
  //   $pageData['brochureDetails'] = $this->Common_Model->fetch_records('service_brochures', $whereService, false, true);

  //   $this->load->view('admin/edit_brochure', $pageData);
  // }

  // public function Update_Brochure()
  // {
  //   $response['status'] = 0;
  //   $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');

  //   $update = $this->input->post();
  //   $where['id'] = $update['brochure_id'];
  //   unset($update['brochure_id']);
  //   if ($_FILES['brochure_update']['error'] == 0) {
  //     $config['upload_path'] = "assets/site/brochure/";
  //     $config['allowed_types'] = 'pdf';
  //     $config['encrypt_name'] = true;
  //     $this->load->library("upload", $config);
  //     if ($this->upload->do_upload('brochure_update')) {
  //       $serviceImage = $this->upload->data("file_name");

  //       $update['brochure'] = "assets/site/brochure/" . $serviceImage;
  //       if (file_exists($update['brochure_old'])) unlink($update['brochure_old']);
  //     }
  //   }
  //   unset($update['brochure_old']);
  //   if ($this->Common_Model->update('service_brochures', $where, $update)) {
  //     $response['status'] = 1;
  //     $response['responseMessage'] = $this->Common_Model->success('Service brochure updated successfully.');
  //   }
  //   $this->session->set_flashdata('responseMessage', $response['responseMessage']);
  //   echo json_encode($response);
  // }

  // public function Delete_Brochure()
  // {
  //   $response['status'] = 0;
  //   $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later.');
  //   $where['id'] = $this->input->post('brochure_id');
  //   $update['is_deleted'] = 1;
  //   if ($this->Common_Model->update('service_brochures', $where, $update)) {
  //     $response['status'] = 1;
  //     $response['responseMessage'] = $this->Common_Model->success('Brochure deleted successfully.');
  //   }
  //   $this->session->set_flashdata('responseMessage', $response['responseMessage']);
  //   echo json_encode($response);
  // }
}
