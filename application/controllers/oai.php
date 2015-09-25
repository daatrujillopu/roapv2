<?php
/**
 * Class Oai
 * Clase que maneja el estandar OAIPMH para el cosechado de repositorios
 * @Access Public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Usuarios_No_Registrados
 * @Package Controladores
 * @Subpackage Controladores/oai
 */
class Oai extends CI_Controller{
    /**
     * Constructor de la clase
     */
    function __construct(){
        parent::__construct();
        $this->load->library("OAIPMH");
    }

    /**
     * Metodo que se encarga de generar el xml de cosechado
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/oai
     */
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