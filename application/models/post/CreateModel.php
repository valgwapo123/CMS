<?php

class CreateModel extends CI_Model {

// Insert json data into database
public function insertDatabase($passingdata,$tablename) {

$this->db->insert($tablename, $passingdata);
if ($this->db->affected_rows() > 0) {

$resultSet = Array();
return true;
} else {
return false;
}
}


}

?>