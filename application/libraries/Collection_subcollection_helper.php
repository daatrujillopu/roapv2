<?php

/**
 * Created by PhpStorm.
 * User: danny
 * Date: 28/08/15
 * Time: 04:45 PM
 */
class Collection_subcollection_helper
{
    private $collection, $subcollection;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("main_model");
        $this->CI->load->model("admin_model");
        $this->collection = $this->CI->admin_model->get_collections_list();
        $this->subcollection = $this->CI->admin_model->get_subcollections_list();
    }

    public function get_collection_list(){
        return $this->collection;
    }

    public function get_subcollection_list(){
        return $this->subcollection;
    }

    public function get_num_oas_collections(){
        $collection_num_oa = array();

        foreach($this->collection as $key){
            $collection_num_oa[$key["idcollection"].$key["name"]] = $this->CI->main_model->get_collections_num_oas($key["idcollection"]);
        }
        return $collection_num_oa;
    }

    public function get_num_oas_subcollections(){
        $subcollection_num_oa = array();
        foreach($this->subcollection as $key2){
            $subcollection_num_oa[$key2["idsubcollection"].$key2["name"]] = $this->CI->main_model->get_subcollections_num_oas($key2["idcollection"]);
        }
        return $subcollection_num_oa;
    }

}