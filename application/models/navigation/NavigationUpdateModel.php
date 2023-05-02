<?php

class NavigationUpdateModel extends CI_Model{


function update_navigation($id,$passingdata){
	
	$this->db->where('id', $id);
	$this->db->update('navigation', $passingdata);

	if ($this->db->affected_rows() > 0) {
	return true;
	} else {
	return false;
	}

}

}?>
