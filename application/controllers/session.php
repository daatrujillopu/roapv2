<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/06/15
 * Time: 03:17 PM
 */

class Session extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('session_model','',TRUE);
    }

    function index(){

        //This method will have the credentials validation and select the rle an redirect for users
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->load->view('session/session_view');
        } else {
            //Go to private area
            $arr = $arr = $this->session->userdata('logged_in');
            //print_r($this->session->userdata('logged_in'));
            if ($arr['role'] == 1) {

                redirect('admin', 'refresh');

            }
            if($arr["role"] == 2){
                redirect('main', 'refresh');
            }
        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        //query the database
        $result = $this->session_model->user_login($username, sha1($password));

        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'username' => $row["name"]." ". $row["lastname"],
                    'role' => $row["role"],
                    'user_state' => $row["valided"],
                    'lastloggin' => date("d-m-Y", strtotime($row["lastloging"]))
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect("main", "refresh");
    }

}

