<?php
class DatabaseWrapper
{
    private $ci;
    private $db;
    private $result;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->db = $this->ci->db;
    }
    public function table_exists($table){
        if ($this->db->table_exists($table)){
            return true;
        } else {
            return false;
        }
    }
    public function query($query, $params = array())
    {
        $this->result = $this->db->query($query, $params);
        return $this;
    }

    public function fetchRow()
    {
        return $this->result->row();
    }

    public function fetchAll()
    {
        return $this->result->result();
    }
}
