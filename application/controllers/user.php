<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 22/02/15
 * Time: 06:22 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Esta clase se encarga de generar formularios automaticos a partir de
 * @Access public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Usuarios_No_Registrados
 * @Package Controladores
 * @Subpackage Controladores/Usuario
 * Class User
 */

class User extends CI_Controller{
    /**
     * @var User_standard Variable que tiene la estructura del estandar proporcionado por el usuario
     */
    private $standard;

    private $actualoa_id;

    private $collection_sub_helper;

    /**
     *Constructor de la clase que carga las librerias encrypt y user_standard, ademas de crear una nueva estancia de la clase user_standard
     */
    public function __construct(){
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library("User_standard");
        $this->load->library("Collection_subcollection_helper");
        $this->standard = new User_standard();
        $this->collection_sub_helper = new Collection_subcollection_helper();
    }

    /**
     * Este metodo muestra el formulario de entrada para la carga de archivos o carga de metadatos de objetos
     * de aprendizaje
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     */

    public function index(){
        if($this->session->userdata("logged_in")){
            $data = array(
                "actual_id" => $this->standard->get_actual_id(),
                "main" => "user/wizard_form",
                "sessioninitialized" => "yes",
                "collections" => $this->collection_sub_helper->get_collection_list(),
                "numoas_collection" => $this->collection_sub_helper->get_num_oas_collections(),
                "subcollections" => $this->collection_sub_helper->get_subcollection_list(),
                "numoas_subcollections" => $this->collection_sub_helper->get_num_oas_subcollections(),
            );
            $this->load->view("layouts/user_template", $data);
        }else{
            $this->session->unset_userdata("logged_in");
            redirect("main", "refresh");
        }


    }

    /**
     * Esta clase se encarga de mostrar la vista donde se carga el formulario dinamico
     * apartir del estandar proporcionado por el usuario
     * @param $id_oa Consecutivo del id del objeto de aprendizaje
     */


    public function form_metadata($id_oa) {
        if($this->session->userdata("logged_in")){
            //echo $id_oa;

            $this->standard->structure_standard();
            $this->actualoa_id = $this->standard->get_actual_id();

            $oa = $this->encrypt->decode(base64_decode($id_oa));
            $location = $this->standard->get_metadata_location();
            $location2 = explode("_",$location);
            $padre = $location2[0];
            $hijo = $location2[1];
            $locationdato = $this->standard->get_data_in_oas($padre, $hijo, $oa);

            $size = $this->standard->get_metadata_size();
            $size2 = explode("_",$size);
            $padre = $size2[0];
            $hijo = $size2[1];
            $sizedato = $this->standard->get_data_in_oas($padre, $hijo, $oa);

            $formato = $this->standard->get_metadata_format();
            $formato2 = explode("_",$formato);
            $padre = $formato2[0];
            $hijo = $formato2[1];
            $formatdato = $this->standard->get_data_in_oas($padre, $hijo, $oa);


            $data = array(
                "actual_id" => $id_oa,
                "spadres" => $this->standard->get_spadres(),
                "padres" => $this->standard->get_padres(),
                "tree" => $this->standard->get_standard(),
                "hijos" => $this->standard->get_hijos(),
                "sessioninitialized" => "yes",
                "collections" => $this->collection_sub_helper->get_collection_list(),
                "numoas_collection" => $this->collection_sub_helper->get_num_oas_collections(),
                "subcollections" => $this->collection_sub_helper->get_subcollection_list(),
                "numoas_subcollections" => $this->collection_sub_helper->get_num_oas_subcollections(),
                "location" => $location,
                "locationdato" => $locationdato[0][$location],
                "size" => $size,
                "sizedato" => $sizedato[0]["$size"],
                "format" => $formato,
                "formatdato" => $formatdato["0"][$formato],
                "main" => "user/form"
            );
            $this->load->view("layouts/user_template", $data);
        }

    }


    //funciones para insertar datos
    /**
     * Funcion se encarga de guardar los datos de cada categoria del estandar brindado por el usuario
     * @Access public
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/Usuario
     */
    public function save_category(){
        if($this->session->userdata("logged_in")){
            $datos = json_decode($this->input->get("datos"));
            $metadatos = json_decode($this->input->get("elementos"));
            $create = $this->input->get("find");
            $oa = $this->encrypt->decode(base64_decode($this->input->get("oa")));
            echo $oa;
            for($i = 0; $i<count($datos); $i++) {
                $dato = $datos[$i];
                $father = $metadatos[$i];
                echo $father;
                $father = explode("_",$father);
                if(count($father)<3){
                    $padre = $father[0];
                    $hijo = $father[1];
                    $this->standard->insert_in_oas($padre,$hijo,$oa,$dato);
                }else{
                    $padre = $father[0];
                    $hijo = $father[1];
                    $orden = $father[2];
                    $this->standard->insert_in_table($padre, $hijo, $oa, $dato, $orden);
                }
            }

            if($create == "si"){
                $this->standard->generate_xml($oa);
            }
        }



    }

    /**
     * Funcion se encarga de borrar los metadatos de cada categoria del estandar brindado por el usuario
     * @Access public
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/Usuario
     */
    public function delete_metadato(){
        if($this->session->userdata("logged_in")){
            $metadato = $this->input->get("metadato");
            $oa = $this->input->get("oa");
            echo $oa;
            $father = $metadato;
            $father = explode("_",$father);
            echo $metadato;
            $padre = $father[0];
            $orden = $father[2];
            $this->standard->delete_in_table($padre, $oa, $orden);
        }

    }

    /**
     * Esta función se encarga de subir archivos mediante el metodo ajax solo para un archivo
     * @Access public
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/Usuario
     */

    public function uploadfile(){
        if($this->session->userdata("logged_in")){
            $actual_id = $this->check_id_oa();

            if(!is_dir("./upload/".$actual_id)){
                mkdir("./upload/".$actual_id, 0777);
            }
            $direccionima = "./upload/".$actual_id;
            $fecha = date("Y-m-d-H-i-s");
            $config['upload_path'] = $direccionima;
            $config['allowed_types'] = '*';
            $config['max_size'] = '1000000';
            $nombre = $_FILES['archivo']['name'];
            $extension = end(explode(".", $nombre));
            $size = $_FILES['archivo']['size'];
            $config['file_name'] = $actual_id.".".$extension;
            $collection = $this->input->post("currentcollec");
            $subcollection = $this->input->post("currentsubcollec");
            $this->load->library('upload', $config);
            if($size<1000){
                $size = $size."bytes";
            }elseif($size>1000&&$size<1000000){
                $size = $size."kb";
            }else{
                $size = $size."mb";
            }

            if (!$this->upload->do_upload('archivo')) {
                echo "errores";
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
//            $this->index();
//
//                $this->load->view('formulario_carga', $error);
            }else{
                $this->standard->reserve_id_oa($extension,$actual_id, $collection, $subcollection, base_url()."upload/".$actual_id."/".$actual_id.".".$extension, $size, $extension);
                echo base64_encode($this->encrypt->encode($actual_id));
            }

            /*$this->load->library('upload', $config);
            $upload_folder ='upload';
            $nombre_archivo = $_FILES['archivo']['name'];
            $tipo_archivo = $_FILES['archivo']['type'];
            $tamano_archivo = $_FILES['archivo']['size'];
            $tmp_archivo = $_FILES['archivo']['tmp_name'];
            $archivador = $upload_folder . '/' . $nombre_archivo;
            if (!move_uploaded_file($tmp_archivo, $archivador)) {

            }*/
        }

    }

    /**
     * @Access public
     * @Category Usuarios_No_Registrados
     * @Package Controladores
     * @Subpackage Controladores/Usuario
     * @return int Retorna el id consecutivo del oa, en caso de que haya cambiado cambiar el id
     */

    private function check_id_oa(){
        if($this->session->userdata("logged_in")){
            $actualid = $this->standard->get_actual_id();
            if($actualid!=$this->actualoa_id){
                return $actualid;
            }else{
                return $this->actualoa_id;
            }
        }

    }

    public function oaipmh(){
        $cosa = array(
            "verb" => "ListRecords",
            "metadataPrefix" => "lom"
        );


    }
}
?>