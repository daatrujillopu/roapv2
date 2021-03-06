<?php
/**
 * Class Collection_subcollection_helper
 * Clase ayudadora para obtener informacion acerca de las colecciones y subcolecciones en el repositorio
 * @Access public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Usuarios_No_Registrados
 * @Package Librerias
 * @Subpackage Librerias/Coll_Sub_helper
 */
class Collection_subcollection_helper
{
    /**
     * Objeto Coleccion
     * @var Coleccion
     */
    private $collection;
    /**
     * Objeto subcoleccion
     * @var subcolecion
     */
    private $subcollection;

    /**
     * Metodo constructor para precargar modelos
     */
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model("main_model");
        $this->CI->load->model("admin_model");
        $this->collection = $this->CI->admin_model->get_collections_list();
        $this->subcollection = $this->CI->admin_model->get_subcollections_list();
    }

    /**
     * Metodo que retorna todas las colecciones contenidas en el repositorio
     * @Access public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Librerias
     * @Subpackage Librerias/Coll_Sub_helper
     * @return Coleccion retorna todas las colecciones
     */
    public function get_collection_list(){
        return $this->collection;
    }

    /**
     * Funcion para retorna las subcolecciones presentes en el repositorio
     * @return subcolecion retorna las subcolecciones
     * @Access public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Librerias
     * @Subpackage Librerias/Coll_Sub_helper
     */
    public function get_subcollection_list(){
        return $this->subcollection;
    }

    /**
     * Funcion que obtiene el numero de objetos por coleccion
     * @return array numero de oas en la coleccion
     * @Access public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Librerias
     * @Subpackage Librerias/Coll_Sub_helper
     */
    public function get_num_oas_collections(){
        $collection_num_oa = array();

        foreach($this->collection as $key){
            $collection_num_oa[$key["idcollection"].$key["name"]] = $this->CI->main_model->get_collections_num_oas($key["idcollection"]);
        }
        return $collection_num_oa;
    }

    /**
     * Funcion que obtiene el numero de objetos por subcoleccion
     * @return array numero de oas en la subcoleccion
     * @Access public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Usuarios_No_Registrados
     * @Package Librerias
     * @Subpackage Librerias/Coll_Sub_helper
     *
     */
    public function get_num_oas_subcollections(){
        $subcollection_num_oa = array();
        foreach($this->subcollection as $key2){
            $subcollection_num_oa[$key2["idsubcollection"].$key2["name"]] = $this->CI->main_model->get_subcollections_num_oas($key2["idcollection"]);
        }
        return $subcollection_num_oa;
    }

}