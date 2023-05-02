<?php
class NavigationPostModel extends CI_Model {
 
 function read_single($CHECKSUM){
   $this->db->reconnect();
  $this->db->select("*"); 
  $this->db->from('navigation');
  $this->db->WHERE('checksum',$CHECKSUM);
  $query = $this->db->count_all_results();


    if($query==0){
       
         return true;
    }

 }



function read_alias($name){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('alias',$name);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret;


 }



 function read_parent_id($alias){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('alias',$alias);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->parent;

 }

  function get_id($alias){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('alias',$alias);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->id;

 }

  function read_parent_id_submenu($parent){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('parent',$parent);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->parent;

 }

  function read_id($id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('id',$id);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->parent;

 }

 function read_navigation_info($id){
      $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');    
    $this->db->WHERE('id',$id);
    $query = $this->db->get();
    return  $ret = $query->row();
 }



  function read_navigation_id($name){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('alias',$name);
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->nav_id;

 }





  function read_language($id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$id);
    $this->db->WHERE('alias !=','system');
    $this->db->order_by('sort', 'ASC');
    $query = $this->db->get();
    return $query->result_array();

 }

   function get_parent_id($name){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('alias',$name);
    $query = $this->db->get();
    $ret = $query->row();

    if($query->num_rows()>0){
      return $ret->id;
    }else{
      return -1;
    }
    

 }


  function GetFirstNavItem_ALias($id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$id);
    $this->db->order_by('sort', 'ASC');
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->alias;

 }


    function GetFirstNavItem_name($id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$id);
    $this->db->order_by('sort', 'ASC');
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->name;

 }

  function read_navigation($language_id,$login_required){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$language_id);
    $this->db->order_by('sort', 'ASC');
//    $this->db->WHERE('login_required',$login_required);
    $query = $this->db->get();
    return $query->result_array();

 }



   function read_submenu($parent_id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$parent_id);
    $this->db->order_by('sort', 'ASC');
    $query = $this->db->get();
    return $query->result_array();

 }

 function count_submenu($parent_id){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->WHERE('parent',$parent_id);
    $this->db->order_by('sort', 'ASC');
    return  $this->db->count_all_results();

 }



  function language_count(){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->order_by('sort', 'ASC');
    return  $this->db->count_all_results();

 }


   function language_first(){
    $this->db->reconnect();
    $this->db->select("*"); 
    $this->db->from('navigation');
    $this->db->WHERE('state',1);
    $this->db->order_by('sort', 'ASC');
    $query = $this->db->get();
    $ret = $query->row();
    return $ret->name;

 }


 function get_id_mandant(){
      $this->db->reconnect();
      $this->db->select("*"); 
      $this->db->from('navigation');
      $this->db->WHERE('state',1);
      $this->db->order_by('sort', 'ASC');
      $query = $this->db->get();
      $ret = $query->row();
      return $ret->id_mandant;
 }







}

?>