<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 * Clase para el loggin de usuarios, asigna roles de acuerdo al tipo de usuario que este sea
 * @Access Public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Usuarios_No_Registrados
 * @Package Controladores
 * @Subpackage Controladores/login
 */
class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("user_model");
    }

    /**
     * Metodo que muestra la vista del loggin de usuario
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/login
     */
    function index() {
        $this->load->view('session/session_view');
    }

    /**
     * Metodo para mostrar formulario de registro de usuarios
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/login
     */
    function new_user(){
        $this->load->view('session/new_user_view');
    }

    /**
     * Crea un nuevo usuario
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/login
     */
    function create_new_user(){
        $this->user_model->new_user();
        $this->index();
    }

    /**
     * Metodo que se encarga de que los username no se repitan en el repositorio
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/login
     */
    function check_user_name(){
        echo $this->user_model->check_user_name();
    }



}
