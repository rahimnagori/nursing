<?php
class Jobs_Model extends CI_Model {
  function join_records($table, $joins, $select = '*', $where = false, $orLikeGroup = [], $ob = false, $obc = 'DESC', $groupBy = false){
    $this->db->select($select);
    $this->db->from($table);
    foreach($joins as $join){
      $this->db->join($join[0], $join[1], $join[2]);
    }
    if($where) $this->db->where($where);
    if(!empty($orLikeGroup)){
        $this->db->group_start();
        foreach($orLikeGroup as $key => $value){
            $this->db->or_like($key, $value);
        }
        $this->db->group_end();
    }
    if($groupBy) $this->db->group_by($groupBy);
    if($ob) $this->db->order_by($ob, $obc);
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>