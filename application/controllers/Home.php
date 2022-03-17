<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
    $this->load->library('session');
  }

  public function index(){
    $pageData = $this->Common_Model->get_userdata();

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/index', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function about(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/about', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function blogs(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/blogs', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function blog($id){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/blog-details', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function jobs(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/jobs', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function contact(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/contact', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function terms(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/terms', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function privacy(){
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/privacy', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function contact_request(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('full_name', 'full_name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('message', 'message', 'required');
    $this->form_validation->set_rules('resume', 'resume', 'required');
    if ($this->form_validation->run()){
      $insert = $this->input->post();
      $insert['created'] = $insert['updated'] = date("Y-m-d H:i:s");
      if($this->Common_Model->insert('contact_requests', $insert)){
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Message sent successfully.');
        $this->Common_Model->history('New contact request added.');
      }
    }else{
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function resume(){
    $oldResume = $this->input->post('oldResume');
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('There are some error with this file, please upload another file.');
    if($_FILES['resume']['error'] == 0){
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'pdf|doc|docx|jpg';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        if(trim($oldResume)){
          if(file_exists($oldResume)){
            unlink($oldResume);
            $this->Common_Model->history('Resume removed by user.');
          }
        }
        $response['resumePath'] = $config['upload_path'] .$this->upload->data("file_name");
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Resume uploaded successfully.');
        $this->Common_Model->history('Resume uploaded by user.');
      }else{
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    echo json_encode($response);
  }

  /* Below these are not being used 

  public function request(){
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('phone', 'phone', 'required');
    $this->form_validation->set_rules('query', 'query', 'required');
    if ($this->form_validation->run()){
      $insert = $this->input->post();
      $insert['created'] = date('Y-m-d H:i:s');
      if($this->Common_Model->insert('contact_requests', $insert)){
        $adminData = $this->Common_Model->fetch_records('business_details', array('id' => 1));
        $adminData = $adminData[0];
        $subject = 'New request received';
        $this->Common_Model->send_mail($insert['email'], $subject, $insert['query']);

        $responseClass = 'success';
        $responseMessage = 'Request Sent Successfully.';
      }
    }else{
      $responseClass = 'danger';
      $responseMessage = validation_errors();
    }
    $formResponse = "<div class='row'>
                  <div class='col-sm-12'>
                    <div class='alert alert-$responseClass alert-dismissible'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          $responseMessage
        </div>
      </div>
    </div>";
    $this->session->set_flashdata('formResponse', $formResponse);

    redirect('Contact');
  }

  public function sounds($id){
    $pageData = $this->Common_Model->get_userdata();
    $where['id'] = $id;
    $pageData['categoryDetails'] = $this->Common_Model->fetch_records('categories', $where, false, true);
    if($pageData['categoryDetails']['parent_category'] != 0){
      redirect('Sounds/' .$pageData['categoryDetails']['parent_category']);
    }

    $pageData['currentCategoryId'] = $id;

    $whereSubCategory['parent_category'] = $id;
    $pageData['subCategories'] = $this->Common_Model->fetch_records('categories', $whereSubCategory);

    $this->load->view('site/sounds', $pageData);
  }

  public function sound_details($id){
    $pageData = $this->Common_Model->get_userdata();

    $where['id'] = $id;
    $pageData['categoryDetails'] = $this->Common_Model->fetch_records('categories', $where, false, true);

    if(empty($pageData['categoryDetails'])){
      redirect('');
    }
    if($pageData['categoryDetails']['parent_category'] == 0){
      redirect('Sounds/' .$pageData['categoryDetails']['id']);
    }

    $whereParentCategory['id'] = $pageData['categoryDetails']['parent_category'];
    $pageData['parentCategoryDetails'] = $this->Common_Model->fetch_records('categories', $whereParentCategory, false, true);

    $whereSound['sound_sub_category'] = $id;
    $pageData['categorySounds'] = $this->Common_Model->fetch_records('sounds', $whereSound);

    if(!empty($pageData['userdata'])){
      foreach($pageData['categorySounds'] as $key => $categorySound){
        $whereIsLiked['user_id'] = $pageData['userdata']['id'];
        $whereIsLiked['sound_id'] = $categorySound['id'];
        $isLikeExists = $this->Common_Model->fetch_records('sound_likes', $whereIsLiked, false, true);
        $pageData['categorySounds'][$key]['is_liked'] = ($isLikeExists) ? 1 : 0;
      }
    }

    $whereSubCategory['id !='] = $id;
    $pageData['sliderSubCategories'] = $this->Common_Model->fetch_records('categories', $whereSubCategory);
    $pageData['subCategoryId'] = $id;

    $this->load->view('site/sound-detail', $pageData);
  }

  // public function blog_details($id){
    // $pageData = $this->Common_Model->get_userdata();
    // $where['is_deleted'] = 0;
    // $where['id'] = $id;
    // $pageData['blogDetails'] = $this->Common_Model->fetch_records('blogs', $where, false, true);
    // $whereRecent['is_deleted'] = 0;
    // $whereRecent['id != '] = $id;
    // $pageData['recentBlogs'] = $this->Common_Model->fetch_records('blogs', $whereRecent, false, false, false, false, false, false, false, 3);

    // if(empty($pageData['blogDetails'])){
      // redirect('Blogs/1');
    // }
    // $this->load->view('site/blog-details', $pageData);
  // }

  public function collections($id){
    $pageData = $this->Common_Model->get_userdata();
    $where['id'] = $id;
    $pageData['categoryDetails'] = $this->Common_Model->fetch_records('categories', $where, false, true);
    if($pageData['categoryDetails']['parent_category'] == 0){
      redirect('');
    }

    $whereSubCategories['parent_category !='] = 0;
    $pageData['subCategories'] = $this->Common_Model->fetch_records('categories', $whereSubCategories);

    $pageData['currentCategoryId'] = $id;

    $whereCollections['sub_category_id'] = $id;
    $pageData['collections'] = $this->Common_Model->fetch_records('collections', $whereCollections);

    $this->load->view('site/collections', $pageData);
  }

  public function collection_details($id){
    $pageData = $this->Common_Model->get_userdata();

    $pageData['selectedSound'] = $this->session->flashdata('selected_sound');
    $pageData['downloaded'] = ($pageData['selectedSound']) ? 1 : 0;

    $where['id'] = $id;
    $pageData['collectionDetails'] = $this->Common_Model->fetch_records('collections', $where, false, true);

    if(empty($pageData['collectionDetails'])){
      redirect('');
    }

    $whereSound['sound_collection_id'] = $id;
    $pageData['collectionSounds'] = $this->Common_Model->fetch_records('sounds', $whereSound);

    $totalCredits = $this->Common_Model->fetch_records('sounds', $whereSound, 'SUM(credit_amount) AS total_credit', true);

    $alreadyPurchased = 0;
    if(!empty($pageData['userdata'])){
      foreach($pageData['collectionSounds'] as $key => $categorySound){
        $whereIsLiked['user_id'] = $pageData['userdata']['id'];
        $whereIsLiked['sound_id'] = $categorySound['id'];
        $isLikeExists = $this->Common_Model->fetch_records('sound_likes', $whereIsLiked, false, true);
        $pageData['collectionSounds'][$key]['is_liked'] = ($isLikeExists) ? 1 : 0;

        $isDownloadExists = $this->Common_Model->fetch_records('user_downloads', $whereIsLiked, false, true);
        $pageData['collectionSounds'][$key]['is_downloaded'] = ($isDownloadExists) ? 1 : 0;
        $alreadyPurchased += ($isDownloadExists) ? $categorySound['credit_amount'] : 0;
      }
    }
    $pageData['totalCredits'] = $totalCredits['total_credit'] - $alreadyPurchased;

    if(!empty($pageData['userdata'])){
      $pageData['creditAvailable'] = ($pageData['userdata']['total_credits'] >= $pageData['totalCredits']) ? 1 : 0;
    }

    $whereCollections['id !='] = $id;
    $pageData['sliderCollections'] = $this->Common_Model->fetch_records('collections', $whereCollections);
    $pageData['collectionId'] = $id;

    $this->load->view('site/collection-sound-detail', $pageData);
  }

  public function get_collection_sounds(){
    $pageData = $this->Common_Model->get_userdata();

    $pageData['collection_sound_type'] = 0;
    $whereSound['sound_collection_id'] = $this->input->post('collection_id');
    $sound_type = $this->input->post('sound_type');
    if(trim($sound_type)){
      $whereSound['sound_type'] = $sound_type;
      $pageData['collection_sound_type'] = $sound_type;
    }
    $pageData['collectionSounds'] = $this->Common_Model->fetch_records('sounds', $whereSound);

    $totalCredits = $this->Common_Model->fetch_records('sounds', $whereSound, 'SUM(credit_amount) AS total_credit', true);

    $alreadyPurchased = 0;
    if(!empty($pageData['userdata'])){
      foreach($pageData['collectionSounds'] as $key => $categorySound){
        $whereIsLiked['user_id'] = $pageData['userdata']['id'];
        $whereIsLiked['sound_id'] = $categorySound['id'];
        $isLikeExists = $this->Common_Model->fetch_records('sound_likes', $whereIsLiked, false, true);
        $pageData['collectionSounds'][$key]['is_liked'] = ($isLikeExists) ? 1 : 0;

        $isDownloadExists = $this->Common_Model->fetch_records('user_downloads', $whereIsLiked, false, true);
        $pageData['collectionSounds'][$key]['is_downloaded'] = ($isDownloadExists) ? 1 : 0;
        $alreadyPurchased += ($isDownloadExists) ? $categorySound['credit_amount'] : 0;
      }
    }
    $pageData['totalCredits'] = $totalCredits['total_credit'] - $alreadyPurchased;

    $this->load->view('site/include/sounds-list', $pageData);
  }

  public function open_player(){

    echo json_encode($response);
  }

  public function player(){
    $whereSound['sound_collection_id'] = $this->input->post('collection_id');
    if(!$whereSound['sound_collection_id'] && $this->session->userdata('is_playing')){
      $whereSound['sound_collection_id'] = $this->session->userdata('is_playing');
    }else{
      $this->session->set_userdata('is_playing', $whereSound['sound_collection_id']);
    }
    $whereSound['sound_type !='] = 3;

    $pageData['sound_collection_id'] = $whereSound['sound_collection_id'];
    $pageData['collectionSounds'] = $this->Common_Model->fetch_records('sounds', $whereSound, 'CONCAT("' .site_url() .'", sound_file) AS path, sound_title AS displayName, CONCAT("' .site_url() .'", sound_artwork) AS cover');

    $this->load->view('site/player', $pageData);
  }

  public function index_player(){
    $banners = $this->Common_Model->fetch_records('home_banners');
    $soundIds = [];
    $collections = [];
    foreach($banners as $banner){
      $collections[$banner['sound_id']] = $banner['collection_id'];
      $soundIds[] = $banner['sound_id'];
    }

    $this->db->select('CONCAT("' .site_url() .'", sound_file) AS path, sound_title AS displayName, CONCAT("' .site_url() .'", sound_artwork) AS cover, id');
    // $this->db->select('sound_file AS path, sound_title AS displayName, CONCAT("' .site_url() .'", sound_artwork) AS cover, id');
    $this->db->from('sounds');
    $this->db->where('sound_type !=', 3);
    $this->db->where_in('id', $soundIds);
    $query = $this->db->get();
    $collectionSounds = $query->result_array();
    $pageData['collectionSounds'] = [];
    foreach($collectionSounds as $key => $collectionSound){
      $collectionSounds[$key]['collection_id'] = $collections[$collectionSound['id']];
      // $soundFile = file_get_contents($collectionSound['path']);
      // $blobFile = base64_encode($soundFile);
      // $collectionSounds[$key]['path'] = $blobFile;
    }
    $pageData['collectionSounds'] = $collectionSounds;
    $pageData['sound_collection_id'] = $collectionSounds[0]['collection_id'];

    $this->load->view('site/player', $pageData);
  }
  */

}
