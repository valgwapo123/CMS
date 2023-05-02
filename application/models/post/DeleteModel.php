<?php
class DeleteModel extends CI_Model {


 function deleteitem($table_name,$id){
   //$this->db->reconnect();
   $this->db->where('id', $id);
   $this->db->delete($table_name);

   if ($this->db->affected_rows() > 0) {
    return true;
   } else {
    return false;
   }
 }



}?>
