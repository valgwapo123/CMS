<?php

class SettingCreateModel extends CI_Model {

// Insert json data into database
public function SettingInsertDatabase($passingdata) {

$this->db->insert('setting', $passingdata);
if ($this->db->affected_rows() > 0) {

$resultSet = Array();
return true;
} else {
return false;
}
}


}

?>