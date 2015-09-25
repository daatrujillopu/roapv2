<?php
/**
 * Class Admin_model
 * @Access Private
 * @Autor Danny Alexander Trujillo
 * @Category Modelo
 * @Package Model
 * @SubPackage admin_model
 */

class Admin_model extends CI_Model{
    /**
     * Metodo obtener todas las colecciones
     * @return mixed retorna array con todas la colecciones existentes en el repositorio
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function get_collections_list(){
        $query = $this->db->get("collection");
        return $query->result_array();
    }

    /**
     * Metodo para obtener todas las subcolecciones presentes en el repositorio
     * @return mixed Retorna array con las subcolecciones del repositorio
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function get_subcollections_list(){
        $query = $this->db->get("subcollection");
        return $query->result_array();
    }

    /**
     * Metodo para cambiar el estado del metadato a mostrar
     * @param $id id referenciado desde la tabla metadato
     * @param $state true/false, estado en que se quiere cambiar el metadato true para mostrar false para no mostrar
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function change_metadata_to_show($id, $state){
        $this->db->query("update metadatos set mostrar='".$state."' where id_metadato=$id");
    }

    /**
     * Metodo para cambiar el estado del metadato a requerir
     * @param $id id referenciado desde la tabla metadato
     * @param $state true/false, estado en que se quiere cambiar el metadato true para mostrar false para no mostrar
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function change_metadata_required($id, $state){
        $this->db->query("update metadatos set required_metadata='".$state."' where id_metadato=$id");
    }

    /**
     * Metodo para cambiar el estado del metadato a mostrar pero oculto
     * @param $id id referenciado desde la tabla metadato
     * @param $state true/false, estado en que se quiere cambiar el metadato true para mostrar false para no mostrar
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function change_metadata_show_hide($id, $state){
        $this->db->query("update metadatos set show_hide_metadata='".$state."' where id_metadato=$id");
    }

    /**
     * Metodo para cambiar el estado del metadato que sera parte de la busqueda
     * @param $id id referenciado desde la tabla metadato
     * @param $state true/false, estado en que se quiere cambiar el metadato true para mostrar false para no mostrar
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function change_metadata_searcheable($id, $state){
        $this->db->query("update metadatos set is_searchable='".$state."' where id_metadato=$id");
    }

    /**
     * Metodo para agregar una nueva coleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function add_new_subcollection(){
        $data = array(
            "idcollection" => $this->input->post('collection_id'),
            "name" => ucwords(strtolower($this->input->post('subcollection_title')))
        );
        $this->db->insert('subcollection', $data);
    }

    /**
     * Metodo para eliminar una subcoleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function delete_subcollection(){
        $this->db->where("idsubcollection", $this->input->post("subcollection_id"));
        $this->db->delete("subcollection");
    }

    /**
     * Metodo para agregar una nueva coleccion
     * @Access Private
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage admin_model
     */
    function new_collection(){
        $data = array(
            "name" => ucwords(strtolower($this->input->post("collection_title")))
        );
        $this->db->insert("collection", $data);
    }
}