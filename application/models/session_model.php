<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/06/15
 * Time: 03:25 PM
 */

class Session_model extends CI_Model{

    function user_login($username, $password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("logging", $username);
        $this->db->where("password", $password);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }
    }

}