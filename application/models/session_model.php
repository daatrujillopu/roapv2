<?php
/**
 * Class Session_model
 * Clase que consulta el manejo dwe loggin de usuarios
 * @Access Public
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Modelo
 * @Package Model
 * @SubPackage session_model
 */
class Session_model extends CI_Model{
    /**
     * @param $username username proporcionado por el usuario
     * @param $password password proporcionado por el usuario
     * @return mixed retorna un array en caso de que se encuentra el usuario
     * @Access Public
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage main_model
     */
    function user_login($username, $password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("logging", $username);
        $this->db->where("password", $password);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }
    }



}