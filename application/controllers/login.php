<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("user_model");
    }

    function index() {
        $this->load->view('session/session_view');
    }

    function new_user(){
        $this->load->view('session/new_user_view');
    }

    function create_new_user(){
        $this->user_model->new_user();
        $this->index();
    }

    function check_user_name(){
        echo $this->user_model->check_user_name();
    }



}
