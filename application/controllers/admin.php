<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/06/15
 * Time: 04:18 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

    private $standard;

    public function __construct(){
        parent::__construct();
        $this->load->library("User_standard");
        $this->load->model("admin_model");
        $this->load->model("user_model");

        $this->standard = new User_standard();
    }

    public function index(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->standard->structure_standard();

            $data = array(
                "main" => "admin/admin_view",
                "spadres" => $this->standard->get_spadres(),
                "padres" => $this->standard->get_padres(),
                "tree" => $this->standard->get_standard(),
                "hijos" => $this->standard->get_hijos(),
                "collections" => $this->admin_model->get_collections_list(),
                "subcollections" => $this->admin_model->get_subcollections_list()
            );

            $this->load->view("layouts/admin_template", $data);
        }else{
            redirect("user", "refresh");
        }
    }

    public function change_show_metadata(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $id = $this->input->post("id");
            $state = $this->input->post("state");
            $id2 = explode("_", $id);
            $padre = $id2[0];
            $hijo = $id2[1];
            $parentid = $this->user_model->get_id_father($padre);
            $idson = $this->user_model->get_id_son($parentid, $hijo);
            $this->admin_model->change_metadata_to_show($idson, $state);
        }else{
            redirect("user", "refresh");
        }

    }

    public function change_required_metadata(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $id = $this->input->post("id");
            $state = $this->input->post("state");
            $id2 = explode("_", $id);

            $padre = $id2[0];
            $hijo = $id2[1];

            $parentid = $this->user_model->get_id_father($padre);
            $idson = $this->user_model->get_id_son($parentid, $hijo);
            $this->admin_model->change_metadata_required($idson, $state);

        }else{
            redirect("user", "refresh");
        }
    }
    public function change_show_hide_metadata(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $id = $this->input->post("id");
            $state = $this->input->post("state");
            $id2 = explode("_", $id);

            $padre = $id2[0];
            $hijo = $id2[1];

            $parentid = $this->user_model->get_id_father($padre);
            $idson = $this->user_model->get_id_son($parentid, $hijo);
            $this->admin_model->change_metadata_show_hide($idson, $state);

        }else{
            redirect("user", "refresh");
        }
    }

    public function new_subcollection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->add_new_subcollection();
        }else{
            redirect("user", "refresh");
        }
    }

    public function delete_subcollection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->delete_subcollection();
        }else{
            redirect("user", "refresh");
        }
    }

    public function add_new_collection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->new_collection();
        }else{
            redirect("user", "refresh");
        }
    }
}