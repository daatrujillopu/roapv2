<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase para el administrador del repositorio
 * Class Admin
 * @Access Private
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Usuario Administrador
 * @Package Controladores
 * @Subpackage Controladores/Administrador
 */
class Admin extends CI_Controller{
    /**
     * @var User_standard Estandar proporcionado por el usuario, este se transforma en arbol de acuerdo a lo contenido en la tabla metadatos
     */
    private $standard;

    /**
     * Constructor de la clase para cargar clases, modelos y librerias necesarias
     */
    public function __construct(){
        parent::__construct();
        $this->load->library("User_standard");
        $this->load->model("admin_model");
        $this->load->model("user_model");

        $this->standard = new User_standard();
    }

    /**
     * Metodo default por el cual el framework ingresa en caso de no haber prametros que indiquen una funcion en especifico
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
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

    /**
     * Metodo para cambiar los metatados a ser mostrados por el usuario
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
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

    /**
     * Metodo para cambiar metadato que es requerido en el llenado de formulario
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
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

    /**
     * Metodo para cambiar los metadatos que se muestran pero estan ocultos al usuario (Ver Mas)
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
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

    /**
     * Metodo para cambiar aquellos metadatos en los que se debe hacer la busqueda
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
    public function change_searcheable_metadata(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $id = $this->input->post("id");
            $state = $this->input->post("state");
            $id2 = explode("_", $id);

            $padre = $id2[0];
            $hijo = $id2[1];

            $parentid = $this->user_model->get_id_father($padre);
            $idson = $this->user_model->get_id_son($parentid, $hijo);
            $this->admin_model->change_metadata_searcheable($idson, $state);

        }else{
            redirect("user", "refresh");
        }
    }

    /**
     * Metodo para agregar una nueva subcoleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
    public function new_subcollection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->add_new_subcollection();
        }else{
            redirect("user", "refresh");
        }
    }

    /**
     * Metodo para eliminar una subcoleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
    public function delete_subcollection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->delete_subcollection();
        }else{
            redirect("user", "refresh");
        }
    }

    /**
     * Metodo para cambiar una nueva coleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuario Administrador
     * @Package Controladores
     * @Subpackage Controladores/Administrador
     */
    public function add_new_collection(){
        $sess = $this->session->userdata('logged_in');
        if ($sess["role"]==1){
            $this->admin_model->new_collection();
        }else{
            redirect("user", "refresh");
        }
    }
}