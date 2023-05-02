<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_Add_Setting extends CI_Migration { 



    public function up() { 
            $this->dbforge->add_field(array(
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),

            'table_name' => array(
                 'type' => 'TEXT',
                 'null' => TRUE
            ),
           
            'date_time_sync' => array(
                 'type' => 'TEXT',
                 'null' => TRUE
            ),
            'unixtime' => array(
                 'type' => 'TEXT',
                 'null' => TRUE,
                 'default' => '0'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('Setting');
    }

    public function down()
    {
        $this->dbforge->drop_table('Setting');
    }
}