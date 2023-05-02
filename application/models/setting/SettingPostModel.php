<?php
class SettingPostModel extends CI_Model {


 function check_exist($table_name){
   $this->db->reconnect();
  $this->db->select("*"); 
  $this->db->from('setting');
  $this->db->WHERE('table_name',$table_name);
  $query = $this->db->count_all_results();


    if($query>0){
       
         return true;
    }

 }


   function read_datetimesync($table_name){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('setting');
    $this->db->WHERE('table_name',$table_name);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->date_time_sync;

 }

 function get_unixtime($table_name){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('setting');
    $this->db->WHERE('table_name',$table_name);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->unixtime;

 }

}?>
