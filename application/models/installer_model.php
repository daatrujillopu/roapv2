<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 28/05/15
 * Time: 05:19 PM
 */
class Installer_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_metadatos_table(){
        $this->db->select("*");
        $this->db->from("metadatos");
        $this->db->order_by("id_metadato");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function execute_query($sql){
        $query = $this->db->query($sql);
        echo $this->db->last_query();
    }

    public function create_table_user(){
        $sql = "create table if not exists users(
                  iduser serial NOT NULL,
                  name character varying(100) NOT NULL,
                  lastname character varying(100),
                  password character varying(1000) NOT NULL,
                  logging character varying(100) NOT NULL,
                  email character varying(100) NOT NULL,
                  role integer NOT NULL,
                  valided boolean NOT NULL DEFAULT false,
                  lastloging timestamp with time zone,
                  CONSTRAINT users_pkey PRIMARY KEY (iduser),
                  CONSTRAINT users_email_key UNIQUE (email),
                  CONSTRAINT users_logging_key UNIQUE (logging))";
        try{
            $this->execute_query($sql);
            $query = $this->db->get("users", array("logging"=>$this->input->post("username")));
            if($query->num_rows()<1){
                $data = array(
                    "name" => $this->input->post("first_name"),
                    "lastname" => $this->input->post("last_name"),
                    "email" => $this->input->post("email"),
                    "logging" => $this->input->post("username"),
                    "password" => sha1($this->input->post("password")),
                    "role" => 1,
                    "valided" => "TRUE",
                    "lastloging" => date("Y-m-d"),

                );
                $this->db->insert("users", $data);
            }

        }catch (Exception $e){
            echo $e->getMessage();
        }

    }


}

?>