<?php
class PostModel extends CI_Model {



  function read_single_id($id,$tablename){
   $this->db->reconnect();
  $this->db->select("*"); 
  $this->db->from($tablename);
  $this->db->WHERE('id',$id);
  $query = $this->db->count_all_results();


    if($query>0){
       
         return true;
    }

 }


 public function get_timeupdate(){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('Setting');
    $this->db->WHERE('table_name','updates');
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->date_time_sync;
 }

 function showall($tablename){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from($tablename);
    $query = $this->db->get();
    return $query->result_array();

 }


  function get_table_info($tablename){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from($tablename);
    $this->db->WHERE('state','1');
    $query = $this->db->get();
    return $ret = $query->row();

 }

 function read_post($tablename,$parent_id,$orderColumn,$orderSequence){  
  if ($this->db->table_exists($tablename)){
    $this->db->reconnect();  
    $this->db->select("*"); 
    $this->db->from($tablename);
    $this->db->WHERE('id_parent',$parent_id); 
    $this->db->order_by($orderColumn, $orderSequence);
    $query = $this->db->get();
    return $query->result_array();
  } else {
    return null;
  }

 }


  function read_post_detail($tablename,$seo){
  $this->db->reconnect();
  $this->db->select("*"); 
  $this->db->from($tablename);
  $this->db->WHERE('seo',$seo); 
  $this->db->order_by('id', 'ASC');
  $query = $this->db->get();
  return $query->result_array();

 }









}

