<?php

/**
 * Clase para ejecutar queries personalizadas del estandar OAI-PMH
 * @Autor Danny Alexander Trujillo
 * @Category Modelo
 * @Package Model
 * @SubPackage Oai-Model
 * Class Oai_model
 */
class Oai_model extends CI_Model{
    /**
     * Ejecutar queries personalizadas
     * @param $sql Ejecuta SQl
     * @return mixed retorna Array con datos del sql
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage Oai-Model
     */
    public function execute_query($sql){
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Ejecutar queries personalizadas
     * @param $sql Ejecuta SQl
     * @return mixed retorna Array con datos del sql
     * @Autor Danny Alexander Trujillo
     * @Category Modelo
     * @Package Model
     * @SubPackage Oai-Model
     */
    public function execute_query2($sql){
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}