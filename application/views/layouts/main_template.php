<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 20/11/14
 * Time: 06:58 PM
 */
$this->load->view("layouts/main/head");
$this->load->view("layouts/main/top_bar");
$this->load->view("layouts/main/sidebar");
$this->load->view("layouts/main/search_bar");
$this->load->view("layouts/main/objects_container");
//$this->load->view("templates/user/oas");
$this->load->view($main);
$this->load->view("layouts/main/footer");
?>