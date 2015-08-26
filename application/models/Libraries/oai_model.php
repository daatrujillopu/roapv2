<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 14/05/15
 * Time: 04:10 PM
 */

class Oai_model extends CI_Model{

    public function execute_query($sql){
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function execute_query2($sql){
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}