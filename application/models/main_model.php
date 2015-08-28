<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/06/15
 * Time: 03:25 PM
 */

class Main_model extends CI_Model{

    function get_container_name($collection, $subcollection = "0"){
        if($subcollection!="0"){
            $this->db->select("collection.name as cname, subcollection.name as subname");
            $this->db->from("collection, subcollection");
            $this->db->where("idsubcollection", $subcollection);
            $this->db->where("collection.idcollection", $collection);
            $query = $this->db->get();
            if($query->num_rows()>0){
                $result = $query->result_array();
                return ucwords(strtolower($result[0]["cname"]))."/".ucwords(strtolower($result[0]["subname"]));
            }
        }else{
            $this->db->select("name");
            $this->db->from("collection");
            $this->db->where("idcollection", $collection);
            $query = $this->db->get();
            if($query->num_rows()>0){
                $result = $query->result_array();
                return ucwords(strtolower($result[0]["name"]));
            }
        }
    }

    function get_collections_num_oas($idcollection){
        $this->db->from('oas');
        $this->db->where("idcollection", $idcollection);
        return $this->db->count_all_results();
    }

    function get_subcollections_num_oas($idsubcollection){
        $this->db->from('oas');
        $this->db->where("idsubcollection", $idsubcollection);
        return $this->db->count_all_results();
    }

}