<?php
class Common_Model extends CI_Model {
  function join_records($table, $joins, $where = false, $select = '*', $ob = false, $obc = 'DESC', $groupBy = false){
    /* https://github.com/rahimnagori/cheat-sheet/blob/master/ci_dynamic_join.php */
    $this->db->select($select);
    $this->db->from($table);
    foreach($joins as $join){
      $this->db->join($join[0], $join[1], $join[2]);
    }
    if($where) $this->db->where($where);
    if($groupBy) $this->db->group_by($groupBy);
    if($ob) $this->db->order_by($ob, $obc);
    $query = $this->db->get();
    return $query->result_array();
  }

  function fetch_records($table, $where = false, $select = false, $singleRecords = false, $orderBy = false, $orderDirection = 'DESC', $groupBy = false, $where_in_key = false, $where_in_value = false, $limit = false, $start = 0){
    if($where) $this->db->where($where);
    if($where_in_key) $this->db->where_in($where_in_key, $where_in_value);
    if($select) $this->db->select($select);
    if($groupBy) $this->db->group_by($groupBy);
    if($orderBy) $this->db->order_by($orderBy, $orderDirection);
    if($limit) $this->db->limit($limit, $start);
    $query = $this->db->get($table);
    return ($singleRecords) ? $query->row_array() : $query->result_array();
  }

  public function update($table, $where, $updateData){
    $this->db->where($where);
    return $this->db->update($table, $updateData) ? true : false;
  }

  public function insert($table, $data){
    return ($this->db->insert($table, $data)) ? $this->db->insert_id() : false;
  }

	public function delete($table, $where){
   $this->db->where($where);
    $delete = $this->db->delete($table);
    return $delete ? true : false;
  }

  public function success($message){
    return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .$message .'</div>';
  }

  public function error($message){
    return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .$message .'</div>';
  }

  public function history($message){
    $insert['user_id'] = ($this->session->userdata('id')) ? $this->session->userdata('id') : 0;
    $insert['action'] = $message;
    $this->insert('histories', $insert);
  }

  public function send_mail($to, $subject, $body, $bcc = null, $attachment = false){
    $PROJECT = $this->config->item('PROJECT');
    $fromEmail = 'info@charity.in';
    $config = array();
    $config['mailtype'] = "html";
    $config['charset'] = "utf-8";
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;
    $config['validate'] = FALSE;

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->from($fromEmail, 'Admin');
    $this->email->to($to);
    $this->email->set_crlf("\r\n");
    $this->email->subject($subject);

    if($bcc){
      $this->email->bcc($bcc);
    }

    $pageData['body'] = $body;
    $pageData['PROJECT'] = $PROJECT;
    $msg = $this->load->view('site/include/email_template', $pageData, true);
    // $this->load->view('site/include/email_template', $pageData); /* Debug */

    if($attachment){
      $this->email->attach($attachment);
    }
    $this->email->message($msg);
    try{
      $this->email->send();
      return 1;
    }catch(Exception $e){
      // echo $e->getMessage(); die;
      return 0;
    }

  }

  public function update_user_login($table, $user_id, $action_type = 0){
    if($action_type){
      $update['last_login'] = date('Y-m-d H:i:s');
    }
    $update['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $update['is_online'] = $action_type;
    $this->update($table, array('id' => $user_id), $update);
    $insert['user_id'] = $user_id;
    $insert['ip_address'] = $update['ip_address'];
    $insert['is_organization'] = ($table == 'organizations') ? 1 : 0;
    $insert['action_type'] = $action_type;
    $insert['created'] = $update['last_login'];
    
    $this->insert('user_ips', $insert);
  }

  public function get_userdata(){
    $pageData = [];

    return $pageData;

  }

}
?>