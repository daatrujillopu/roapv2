<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 20/11/14
 * Time: 06:58 PM
 */
$this->load->view("layouts/user/head");
$this->load->view("layouts/user/top_bar");
$this->load->view("layouts/user/sidebar");
$this->load->view("layouts/user/search_bar");
$this->load->view("layouts/user/objects_container");
//$this->load->view("templates/user/oas");
$this->load->view($main);
$this->load->view("layouts/user/footer");
?>