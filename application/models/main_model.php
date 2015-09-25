<?php
/**
 * Class Main_model
 * Clase que maneja todo lo relacionado con la llegada de visitantes del usuario
 * @Access Public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Modelo
 * @Package Model
 * @SubPackage main_model
 */
class Main_model extends CI_Model{
    /**
     * Obtner el nombre de una coleccion y una subcoleccion
     * @param $collection is de la coleccion
     * @param string $subcollection id de la subcoleccion
     * @return string retorna el nombre de la coleccion y subcoleccion
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage main_model
     */
    function get_container_name($collection, $subcollection = "0"){
        if($subcollection!="0"){
            $this->db->select("collection.name as cname, subcollection.name as subname");
            $this->db->from("collection, subcollection");
            $this->db->where("idsubcollection", $subcollection);
            $this->db->where("collection.idcollection", $collection);
            $query = $this->db->get();
            if($query->num_rows()>0){
                $result = $query->result_array();
                return ucwords(strtolower($result[0]["cname"]))."/".ucwords(strtolower($result[0]["subname"]));
            }
        }else{
            $this->db->select("name");
            $this->db->from("collection");
            $this->db->where("idcollection", $collection);
            $query = $this->db->get();
            if($query->num_rows()>0){
                $result = $query->result_array();
                return ucwords(strtolower($result[0]["name"]));
            }
        }
    }

    /**
     * Obtener el numero de oas en una coleccion
     * @param $idcollection id de la coleccion
     * @return string retorna numero de oas en una coleccion
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage main_model
     */
    function get_collections_num_oas($idcollection){
        $this->db->from('oas');
        $this->db->where("idcollection", $idcollection);
        return $this->db->count_all_results();
    }

    /**
     * Obtener el numero de oas en una subcoleccion
     * @param $idsubcollection is de la subcoleccion
     * @return string retorna numero de oas en una subcoleccion
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage main_model
     */
    function get_subcollections_num_oas($idsubcollection){
        $this->db->from('oas');
        $this->db->where("idsubcollection", $idsubcollection);
        return $this->db->count_all_results();
    }

}