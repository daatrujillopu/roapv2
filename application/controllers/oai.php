<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 14/05/15
 * Time: 05:34 PM
 */

class Oai extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library("OAIPMH");
    }

    public function index(){
        $urlget = $_GET;

        header("Content-type: text/xml");
        $OAI = new OAIPMH();
        if($OAI->is_consultable()){
            $OAI->create_response($urlget);
            $OAI->print_response();
        }
        print_r($OAI->print_response());

    }


}