<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 20/11/14
 * Time: 06:58 PM
 */
$this->load->view("layouts/admin/head");
$this->load->view("layouts/admin/top_bar");
$this->load->view("layouts/admin/sidebar");
$this->load->view("layouts/admin/search_bar");
//$this->load->view("templates/user/oas");
$this->load->view($main);
$this->load->view("layouts/admin/footer");
?>