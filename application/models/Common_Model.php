<?php
class Common_Model extends CI_Model
{
  function join_records($table, $joins, $where = false, $select = '*', $ob = false, $obc = 'DESC', $groupBy = false)
  {
    /* https://github.com/rahimnagori/cheat-sheet/blob/master/ci_dynamic_join.php */
    $this->db->select($select);
    $this->db->from($table);
    foreach ($joins as $join) {
      $this->db->join($join[0], $join[1], $join[2]);
    }
    if ($where) $this->db->where($where);
    if ($groupBy) $this->db->group_by($groupBy);
    if ($ob) $this->db->order_by($ob, $obc);
    $query = $this->db->get();
    return $query->result_array();
  }

  function fetch_records($table, $where = false, $select = false, $singleRecords = false, $orderBy = false, $orderDirection = 'DESC', $groupBy = false, $where_in_key = false, $where_in_value = false, $limit = false, $start = 0)
  {
    if ($where) $this->db->where($where);
    if ($where_in_key) $this->db->where_in($where_in_key, $where_in_value);
    if ($select) $this->db->select($select);
    if ($groupBy) $this->db->group_by($groupBy);
    if ($orderBy) $this->db->order_by($orderBy, $orderDirection);
    if ($limit) $this->db->limit($limit, $start);
    $query = $this->db->get($table);
    return ($singleRecords) ? $query->row_array() : $query->result_array();
  }

  public function get_user($where)
  {
    $this->db->or_where('username', $where);
    $this->db->or_where('email', $where);
    $query = $this->db->get('users');
    return $query->row_array();
  }

  public function get_admin($where)
  {
    // $this->db->where('username', $where);
    $this->db->where('email', $where);
    $query = $this->db->get('admins');
    return $query->row_array();
  }

  public function update($table, $where, $updateData)
  {
    $this->db->where($where);
    return $this->db->update($table, $updateData) ? true : false;
  }

  public function insert($table, $data)
  {
    return ($this->db->insert($table, $data)) ? $this->db->insert_id() : false;
  }

  public function delete($table, $where)
  {
    $this->db->where($where);
    $delete = $this->db->delete($table);
    return $delete ? true : false;
  }

  public function success($message)
  {
    return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function error($message)
  {
    return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function history($message)
  {
    $insert['user_id'] = ($this->session->userdata('id')) ? $this->session->userdata('id') : 0;
    $insert['action'] = $message;
    $this->insert('histories', $insert);
  }

  public function send_mail($to, $subject, $body, $bcc = null, $attachment = false)
  {
    $this->load->library('parser');
    $response['status'] = 0;
    $PROJECT = $this->config->item('PROJECT');
    $fromEmail = 'contact@nursing.rahimnagori.com';
    $config = array();
    $config['mailtype'] = "html";
    $config['charset'] = "utf-8";
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;
    $config['validate'] = FALSE;

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->set_header("MIME-Version", "1.0");
    $this->email->set_header("Reply-To", $fromEmail);
    $this->email->set_header("Reply-To", $fromEmail);
    $this->email->set_header("X-Mailer", "PHP/" . phpversion());

    $this->email->from($fromEmail, 'Admin');
    $this->email->to($to);
    $this->email->set_crlf("\r\n");
    $this->email->subject($subject);

    if ($bcc) {
      $this->email->bcc($bcc);
    }

    $pageData['body'] = $body;
    $pageData['PROJECT'] = $PROJECT;
    $msg = $this->load->view('site/include/email_template', $pageData, true);
    // $this->load->view('site/include/email_template', $pageData); /* Debug */

    if ($attachment) {
      $this->email->attach($attachment);
    }
    $this->email->message($msg);
    try {
      $this->email->send();
      $response['status'] = 1;
    } catch (Exception $e) {
      $response['responseMessage'] = $e->getMessage();
      $response['status'] = 2;
    }
    return $response;
  }

  public function send_mail_with_smtp($to, $subject, $body, $bcc = null, $attachment = false)
  {
    $config = $this->get_smtp_configuration();
    $this->load->library('email');
    $this->email->set_mailtype("html");
    $this->email->from('rahimnagori47@gmail.com', 'Rahim');
    $this->email->to('rahim.nagori@gmail.com');
    $this->email->subject('Test email from CI and Gmail ooooooo ');
    $pageData['PROJECT'] = 'Test project';
    $pageData['body'] = 'This is the body';
    $message = $this->load->view('site/archive/include/email_template_new', $pageData, true);
    $this->email->message($message);
  }

  private function get_smtp_configuration()
  {
    //$config['mailpath'] = '/usr/sbin/sendmail';
    // $config['wordwrap'] = TRUE;
    // $config['mailtype'] = 'text/html';
    $config['useragent'] = 'CodeIgniter';
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_user'] = '';
    $config['smtp_pass'] = '';
    $config['smtp_port'] = 465;
    $config['smtp_timeout'] = 5;
    $config['wrapchars'] = 76;
    $config['charset'] = 'utf-8';
    $config['validate'] = FALSE;
    $config['priority'] = 3;
    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";
    return $config;
  }

  public function update_user_login($table, $user_id, $action_type = 0)
  {
    if ($action_type) {
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

  public function get_userdata()
  {
    $pageData = [];
    $where['id'] = $this->session->userdata('id');
    if ($where['id']) {
      $pageData['userDetails'] = $this->fetch_records('users', $where, false, true);
    }

    return $pageData;
  }

  public function get_payment_types()
  {
    $formattedPaymentTypes = [];
    $paymentTypes = $this->fetch_records('payment_types');
    foreach ($paymentTypes as $paymentType) {
      $formattedPaymentTypes[$paymentType['id']] = ucfirst($paymentType['payment_type']);
    }
    return $formattedPaymentTypes;
  }

  public function get_job_types()
  {
    $formattedJobType = [];
    $jobTypes = $this->fetch_records('job_types');
    foreach ($jobTypes as $jobType) {
      $formattedJobType[$jobType['id']] = ucfirst($jobType['name']);
    }
    return $formattedJobType;
  }

  public function get_email_content($email_type)
  {
    $where['email_type'] = $email_type;
    $email = $this->fetch_records('emails', $where, 'id, content', true);
    return $email['content'];
  }

  public function get_job_reference($data)
  {
    $jobTypes = $this->get_job_types();
    $employmentTypes = ($data['employment_type'] == 1) ? 'P' : 'T';
    $paymentTypes = $this->get_payment_types();
    $totalJobs = count($this->fetch_records('jobs')) + 1;

    return $this->format_ref_string($jobTypes[$data['job_type']]) . $employmentTypes . $this->format_ref_string($paymentTypes[$data['payment_type']]) . $totalJobs . rand(100, 999);
  }

  public function format_ref_string($string)
  {
    return substr($string, 0, 1);
  }

  public function generate_password($passwordLength)
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i <= $passwordLength; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  public function generate_username($userdata)
  {
    $totalUsers = count($this->fetch_records('users')) + 1;
    return $userdata['first_name'] . $totalUsers . $this->generate_password(4);
  }

  public function is_admin_authorized($adminId, $permissionId = false)
  {
    $adminData = $this->fetch_records('admins', array('id' => $adminId), false, true);
    $where['admin_id'] = $adminId;
    $adminPermissions = $this->fetch_records('admin_permissions', $where, false, true);
    if (empty($adminPermissions)) {
      $permissions = $this->fetch_records('permissions');
      $adminDefaultPermission = [];
      foreach ($permissions as $permission) {
        $adminDefaultPermission[$permission['id']] = 0;
      }
      $insertAdminPermission['admin_id'] = $adminId;
      $insertAdminPermission['permissions'] = json_encode($adminDefaultPermission);
      $this->insert('admin_permissions', $insertAdminPermission);
      $adminPermissions = $insertAdminPermission;
    }
    $allPermissions = json_decode($adminPermissions['permissions']);
    $bulkPermissions = [];
    foreach ($allPermissions as $key => $allPermission) {
      $bulkPermissions[$key] = $adminData['admin_type'] == 1 ? 1 : $allPermission; /* Super Admin have all the priviledge by default. */
    }
    if ($permissionId) {
      return isset($bulkPermissions[$permissionId]) ? $bulkPermissions[$permissionId] : 0;
      // return $adminData['admin_type'] == 1 ? 1 : isset($bulkPermissions[$permissionId]) ? $bulkPermissions[$permissionId] : 0;
    } else {
      return $bulkPermissions;
    }
  }

  public function getAdmin($adminId)
  {
    $where['id'] = $adminId;
    $pageData['adminData'] = $this->fetch_records('admins', $where, false, true);
    if (!empty($pageData['adminData'])) {
      $pageData['permissions'] = $this->is_admin_authorized($adminId);
    }
    return $pageData;
  }
}
