<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/07/15
 * Time: 12:14 PM
 */

class Admin_model extends CI_Model{

    function get_collections_list(){
        $query = $this->db->get("collection");
        return $query->result_array();
    }

    function get_subcollections_list(){
        $query = $this->db->get("subcollection");
        return $query->result_array();
    }

    function change_metadata_to_show($id, $state){
        $this->db->query("update metadatos set mostrar='".$state."' where id_metadato=$id");
    }

    function change_metadata_required($id, $state){
        $this->db->query("update metadatos set required_metadata='".$state."' where id_metadato=$id");
    }

    function change_metadata_show_hide($id, $state){
        $this->db->query("update metadatos set show_hide_metadata='".$state."' where id_metadato=$id");
    }

    function change_metadata_searcheable($id, $state){
        $this->db->query("update metadatos set is_searchable='".$state."' where id_metadato=$id");
    }

    function add_new_subcollection(){
        $data = array(
            "idcollection" => $this->input->post('collection_id'),
            "name" => ucwords(strtolower($this->input->post('subcollection_title')))
        );
        $this->db->insert('subcollection', $data);
    }

    function delete_subcollection(){
        $this->db->where("idsubcollection", $this->input->post("subcollection_id"));
        $this->db->delete("subcollection");
    }

    function new_collection(){
        $data = array(
            "name" => ucwords(strtolower($this->input->post("collection_title")))
        );
        $this->db->insert("collection", $data);
    }
}