<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 15/02/15
 * Time: 04:51 PM
 */

/**
 * Esta clase contiene los metodos de insercion actualizacion y borrado de metadatos pertenecientes
 * al estandar proporcionado por el usuario
 * Class User_standard_model
 *
 */
class User_standard_model extends CI_Model{
    /**
     * Funcíon que busca y retorna la estructura el estandar de metadatos propocionado por el usuario
     * @return mixed Se retorna un array con los metadatos proporcionados por el usuario
     */
    public function get_user_standard(){
        $this->db->select("*");
        $this->db->from("metadatos");
        $this->db->order_by("id_metadato","asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Retorna el consecutivo inmediatamente siguiente al ultimo id del oa que se tiene
     * @return int
     */
    public function get_last_row(){
        $this->db->select("id_oa");
        $this->db->from("oas");
        $this->db->order_by("id_oa", "DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return 1;
        }
    }



}
?>