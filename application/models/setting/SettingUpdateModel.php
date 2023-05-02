<?php

class SettingUpdateModel extends CI_Model{


function update_setting($name,$passingdata){
	
	$this->db->where('table_name', $name);
	$this->db->update('setting', $passingdata);

	if ($this->db->affected_rows() > 0) {
	return true;
	} else {
	return false;
	}

}

}?>
