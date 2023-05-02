<?php

class UpdateModel extends CI_Model{


function update_table($id,$passingdata,$tablename){	
	$this->db->where('id', $id);
	$this->db->update($tablename, $passingdata);

	if ($this->db->affected_rows() > 0) {
	  return true;
	} else {
	  return false;
	}
}

}?>
