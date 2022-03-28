<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{

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
        $this->load->model('Jobs_Model');
        $this->load->library('session');
    }

    public function index(){
        $searchParams = $this->input->post();
        $orLikeGroup = [];
        if(!empty($searchParams['searchQuery'])){
            $orLikeGroup['jobs.title'] = $searchParams['searchQuery'];
            $orLikeGroup['jobs.description'] = $searchParams['searchQuery'];
        }
        if(!empty($searchParams['payment_type'])){
            if($searchParams['payment_type'] != 0){
                $whereJoin['jobs.payment_type'] = $searchParams['payment_type'];
            }
        }
        if(!empty($searchParams['locations'])){
            if($searchParams['locations'] != 0){
                $whereJoin['jobs.job_type'] = $searchParams['locations'];
            }
        }
        $join[0][] = 'job_types';
        $join[0][] = 'jobs.job_type = job_types.id';
        $join[0][] = 'left';
        $whereJoin['jobs.is_deleted'] = 0;
        $select = 'jobs.*, job_types.name';
        $pageData['jobs'] = $this->Jobs_Model->join_records('jobs', $join, $select, $whereJoin, $orLikeGroup,  'jobs.id', 'DESC');
        // echo $this->db->last_query();
        // die;
        $pageData['paymentTypes'] = $this->Common_Model->get_payment_types();
        $this->load->view('site/include/jobs_listings', $pageData);
    }
}