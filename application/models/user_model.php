<?php
/**
 * Clase que maneja todo el repositorio, estandar.
 * Class User_model
 * @Access Public/Private
 * @Autor Danny Alexander Trujillo Pulgarin
 * @Category Modelo
 * @Package Model
 * @SubPackage user_model
 */
class User_model extends CI_Model{
    /**
     * Funcion que crea un nuevo usuario en el repositorio
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    function new_user(){

        $data = array(
        "name" => $this->input->post("userfirstname"),
        "lastname" => $this->input->post("userlastname"),
        "email" => $this->input->post("useremail"),
        "logging" => $this->input->post("useradmin"),
        "password" => sha1($this->input->post("userpassword")),
        "role" => 2,
        "valided" => "TRUE",
        "lastloging" => date("Y-m-d"),

        );
        $this->db->insert("users", $data);
    }

    /**
     * Funcion que chequea si el username existe
     * @return string retorna false o true en caso de que no exista o exista el username
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    function check_user_name(){
        $this->db->select("email");
        $this->db->from("users");
        $this->db->where("logging", $this->input->post("username"));
        $query = $this->db->get();
        if($query->num_rows()>0){
            return "true";
        }else{
            return "false";
        }
    }

    /**
     * Reserva el id consecutivo para un nuevo oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function reserve_id_oa(){
        $data = array("general_title" =>'');
        $this->db->insert("oas", $data);
    }

    /**
     * Funcion que se encarga de busca el metadato destinado para la localizacion
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     * @return mixed retorna array con el string del metadato
     */
    public function get_metadato_location(){
        $this->db->select("*");
        $this->db->from("metadatos");
        $this->db->where("is_location", 'true');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funcion que se encarga de busca el metadato destinado para formato de un OA
     * @return mixed
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_metadato_format(){
        $this->db->select("*");
        $this->db->from("metadatos");
        $this->db->where("is_format", 'true');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funcion que se encarga de busca el metadato destinado para tamano de un OA
     * @return mixed
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_metadato_size(){
        $this->db->select("*");
        $this->db->from("metadatos");
        $this->db->where("is_size", 'true');
        $query = $this->db->get();
        return $query->result_array();
    }
     /**
     * Se revisa que exista al menos una fila en la tabla
     * @param $oa
     * @return bool
      * @Autor Danny Alexander Trujillo Pulgarin
      * @Category Modelo
      * @Package Model
      * @SubPackage user_model
     */
    public function exists_insert_oa($oa){
        $this->db->select("*");
        $this->db->from("oas");
        $this->db->where("id_oa",$oa);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }



    /**
     * En caso de no existir fila con el consecutivo del oa se insertara los datos
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $oa id oa
     * @param $dato dato referenciado
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function insert_metadato_oa_suppadre($padre, $hijo,$dato, $oa){
        $data = array(
            "id_oa" => $oa,
            "".$padre."_".$hijo => $dato
        );
        $this->db->insert("oas", $data);
    }

    /**
     * En caso de que exista algun dato se actualizara la fila
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $dato dato referenciado
     * @param $oa Consecutivo e identifcador del OA
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function update_metadato_oa_suppadre($padre, $hijo,$dato, $oa){
        $data = array(
            "".$padre."_".$hijo => $dato
        );
        $this->db->where("id_oa", $oa);
        $this->db->update("oas", $data);
    }

    /**
     * Obtener el dato del metadato de un super padre padre del padre
     * @param $padre padre inmediato de un metadato
     * @param $hijo metadato
     * @param $oa id del oa
     * @return mixed retorna el valor de metadato a buscar
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_metadato_oa_suppadre($padre, $hijo, $oa){
        $this->db->select("".$padre."_".$hijo);
        $this->db->from("oas");
        $this->db->where("id_oa", $oa);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funcion que obtiene el parent id del padre
     * @param $padre Padre que tiene como padre a $supfather
     * @return mixed Se devuelve el valor del parentid del padre;
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_parentid($padre){
        $query = $this->db->query("select parentid from metadatos where lower(replace(metadato, ' ', ''))='".$padre."'");
        //echo "select parentid from metadatos where lower(replace(metadato, ' ', ''))='".$padre."'";
        $dato = $query->result_array();
        if($query->num_rows>0){
            return $dato[0]["parentid"];
        }else{
            return 1;
        }

    }

    /**
     * Funcion para obtener el id unico de una padre en caso de tener devuelve 1
     * @param $padre
     * @return int
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_id_father($padre){
        $query = $this->db->query("select id_metadato from metadatos where lower(replace(metadato, ' ', ''))='".$padre."'");
        //echo "select parentid from metadatos where lower(replace(metadato, ' ', ''))='".$padre."'";
        $dato = $query->result_array();
        if($query->num_rows>0){
            return $dato[0]["id_metadato"];
        }else{
            return 1;
        }

    }

    /**
     * Funcion para obtener el id de un hijo metadato
     * @param $parentid padre inmediato de un metadato
     * @param $hijo metadato
     * @return mixed retorna id del metadato
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_id_son($parentid, $hijo){
        $query = $this->db->query("select id_metadato from metadatos where lower(replace(metadato, ' ', ''))='".$hijo."' and parentid=$parentid");

        $dato = $query->result_array();
        if($query->num_rows>0){
            return $dato[0]["id_metadato"];
        }
    }

    /**
     * Esta función devuelve el metadato  categoria resultado de la busqueda en el estandar del usuario
     * @param $suppadre
     * @return mixed Se retorna el metadato(nombre) del padre padre
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_metadato_father($suppadre){
        $this->db->select("metadato");
        $this->db->from("metadatos");
        $this->db->where("id_metadato", $suppadre);
        $query = $this->db->get();
        $dato = $query->result_array();
        if($query->num_rows()>0){
            return $dato[0]["metadato"];
        }else{
            return "false";
        }

    }

    /**
     * Esta función busca si existe registrado al menos el oa correspondiente a una tabla
     * @param $suppadre Padre que no tiene mas padres
     * @param $padre Padre que tiene un padre y a su vez es hijo
     * @param $oa Consecutivo del OA
     * @return bool Devuleve false sino existe, o devuelve un array con los datos del oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function exists_oa_table($suppadre, $padre, $oa){
        $this->db->select("*");
        $this->db->from($suppadre."_".$padre);
        $this->db->where("id_oa", $oa);
        $this->db->order_by("id".$suppadre."_".$padre, "ASC");
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }

    }

    /**
     * Esta función busca si existe registrado al menos el oa correspondiente a una tabla de una categoria multiple
     * @param $suppadre Padre que no tiene mas padres
     * @param $padre Padre que tiene un padre y a su vez es hijo
     * @param $oa Consecutivo del OA
     * @return bool Devuleve false sino existe, o devuleve un array con los datos del oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function exists_oa_category_multiple($suppadre, $oa){
        $this->db->select("*");
        $this->db->from($suppadre);
        $this->db->where("id_oa", $oa);
        $this->db->order_by("id_".$suppadre, "ASC");
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }

    }

    /**
     * Esta función inserta datos en una tabla determinada, identificandola con los parametros
     * de superpadre, padre e hijo y este se asocia al id del objeto de aprendizaje
     * @param $supfather padre que no tiene otro padre
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $dato dato referenciado
     * @param $oa   consecutivo del oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function insert_metadato_oa_table($supfather,$padre, $hijo, $dato,$oa){
        $data = array(
            "".$padre."_".$hijo => $dato,
            "id_oa" => $oa
        );
        $this->db->insert(''.$supfather.'_'.$padre, $data);

    }

    /**
     * Esta función inserta datos en una tabla determinada, identificandola con los parametros
     * de superpadre, padre e hijo y este se asocia al id del objeto de aprendizaje
     * @param $supfather padre que no tiene otro padre
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $dato dato referenciado
     * @param $oa   consecutivo del oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function insert_metadato_oa_category_multiple($supfather,$padre, $hijo, $dato,$oa){
        $data = array(
            "".$padre."_".$hijo => $dato,
            "id_oa" => $oa
        );
        $this->db->insert(''.$supfather, $data);

    }

    /**
     * Esta función actualizara datos en una tabla determinada, identificandola con los parametros
     * de superpadre, padre e hijo y este se asocia al id del objeto de aprendizaje
     * @param $id consecutivo de la tabla, este identifica que dato debe actualizar y en que fila
     * @param $supfather padre que no tiene otro padre
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $dato dato referenciado
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function update_metadato_oa_table($id,$supfather,$padre, $hijo, $dato){
        $data = array(
            "".$padre."_".$hijo => $dato
        );
        $this->db->where("id".$supfather."_".$padre, $id);
        $this->db->update("".$supfather."_".$padre, $data);
    }

    /**
     * Esta función actualizara datos en una tabla determinada de la categoria de multiples valores, identificandola con los parametros
     * de superpadre, padre e hijo y este se asocia al id del objeto de aprendizaje
     * @param $id consecutivo de la tabla, este identifica que dato debe actualizar y en que fila
     * @param $supfather padre que no tiene otro padre
     * @param $padre Padre que tiene como padre a $supfather
     * @param $hijo Metadato hoja
     * @param $dato dato referenciado
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */

    public function update_metadato_oa_category_multiple($id,$supfather,$padre, $hijo, $dato){
        $data = array(
            "".$padre."_".$hijo => $dato
        );
        $this->db->where("id_".$supfather, $id);
        $this->db->update("".$supfather, $data);
    }

    /**
     * Función que borra la fila de una tabla identificando su consecutivo
     * @param $id Consecutivo de la tabla
     * @param $supfather Superpadre que no tiene un padre
     * @param $padre Padre que tiene a su vez un padre
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function delete_metadato_oa_table($id,$supfather,$padre){

        $this->db->where("id".$supfather."_".$padre, $id);
        $this->db->delete("".$supfather."_".$padre);
    }
//*********************************Consultas a la bd*************************************
    /**
     * Obtiene el xml de un oa
     * @param $id_oa id del oa
     * @return mixed retorna el xml del metadato
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_xml($id_oa){
        $this->db->select("xmlo");
        $this->db->from("lo");
        $this->db->where("idlo", $id_oa);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]["xmlo"];
    }

    /**
     * Filtra oa por coleccion y subcoleccion
     * @param string $filterco id coleccion
     * @param string $filtersub id sub coleccion
     * @return mixed retorna id oas filtrados
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_existing_oas($filterco = "0", $filtersub = "0"){
        $this->db->select("id_oa");
        $this->db->from("oas");
        if($filterco!="0"&&$filtersub=="0"){
            $this->db->where("idcollection", $filterco);
        }elseif($filterco!="0"&&$filtersub!="0"){
            $this->db->where("idcollection", $filterco);
            $this->db->where("idsubcollection", $filtersub);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Funcion que obtiene toda la informacion de un metadato
     * @param $metadato metadato a buscar
     * @return int uno en caso de no existir
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_info_metadato($metadato){
        $query = $this->db->query("select * from metadatos where id_metadato=$metadato");
        //echo "select parentid from metadatos where lower(replace(metadato, ' ', ''))='".$padre."'";
        $dato = $query->result_array();
        if($query->num_rows>0){
            return $dato;
        }else{
            return 1;
        }
    }

    /**
     * Funcion que consulta un metadato que no se encuentra en la tabla oas
     * @param $padre padre inmediato del metadato
     * @param $hijo metadato
     * @param $oa id del oa
     * @return string retorna array en caso de existir o false en caso de no encontrarlo
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function consult_metadato_oa_table($padre, $hijo, $oa){
        $this->db->select($padre."_".$hijo);
        $this->db->from("oas");
        $this->db->where("id_oa", $oa);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return "false";
        }
    }

    /**
     * Consulta si el resultado de la busqueda pertenece a un oa
     * @param $padre padre inmediato del metadato
     * @param $hijo metadato
     * @param $oa id del oa
     * @param $words array de palabras
     * @return bool true si existe o esta presente en la busqueda, false no existe o no cumple con las reglas de busqueda
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function consult_metadato_oa_table_search($padre, $hijo, $oa, $words){
        $this->db->select($padre."_".$hijo);
        $this->db->from("oas");
        $this->db->where("id_oa", $oa);
        $i = 1;
        for($j=0; $j<count($words); $j++){
            if($i==1){
                $this->db->like("lower(".$padre."_".$hijo.")", $words[$j]);
            }else{
                $this->db->or_like("lower(".$padre."_".$hijo.")", $words[$j]);
            }
            $i++;
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * funcion que busca el dato de un metadato no presente en la tabla oas
     * @param $supfather Padre inmediato del padre inmediato del padre
     * @param $padre padre inmediato del metadato
     * @param $hijo metadato
     * @param $oa id oa
     * @return mixed retorna el dato del metadato a buscar
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     *
     */
    public function consult_oa_table($supfather, $padre, $hijo, $oa){
        if($supfather==$padre){
            $this->db->select($supfather."_".$hijo);
            $this->db->from($supfather);
        }else{
            $this->db->select($padre."_".$hijo);
            $this->db->from($supfather."_".$padre);
        }

        $this->db->where("id_oa", $oa);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();

    }

    /**
     * Busca en una tabla el dato de un metadato
     * @param $supfather Padre inmediato del padre inmediato del padre
     * @param $padre padre inmediato del metadato
     * @param $hijo metadato
     * @param $oa id oa
     * @param $words palabras del usuario
     * @return bool true en caso de existir, false no cumple con reglas de busqueda
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function consult_oa_table_search($supfather, $padre, $hijo, $oa, $words){
        if($supfather==$padre){
            $this->db->select($supfather."_".$hijo);
            $this->db->from($supfather);
            $i = 1;
            for($j=0; $j<count($words); $j++){
                if($i==1){
                    $this->db->like("lower(".$supfather."_".$hijo.")", $words[$j]);
                }else{
                    $this->db->or_like("lower(".$supfather."_".$hijo.")", $words[$j]);
                }
                $i++;
            }
        }else{
            $this->db->select($padre."_".$hijo);
            $this->db->from($supfather."_".$padre);
            $i = 1;
            for($j=0; $j<count($words); $j++){
                if($i==1){
                    $this->db->like("lower(".$padre."_".$hijo.")", $words[$j]);
                }else{
                    $this->db->or_like("lower(".$padre."_".$hijo.")", $words[$j]);
                }
                $i++;
            }

        }

        $this->db->where("id_oa", $oa);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query->count_rows());
        if($query->count_rows()>0){
            return true;
        }else{
            return false;
        }


    }

    /**
     * Chequea si existe si existe un oa en la tabla lo
     * @param $oa id oa
     * @return bool true si existe false no existe
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function exists_oa_in_lo($oa){
        $this->db->select("*");
        $this->db->from("lo");
        $this->db->where("idlo", $oa);
        $query = $this->db->get();
        if($query->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Funcion que busca los metadatos a mostrar dados por el usuario
     * @return mixed metadatos a mostrar
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_show_metadata(){

        $query = $this->db->get_where("metadatos", array("mostrar" => "true"));
        return $query->result_array();
    }

    /**
     * Funcion que busca los metadatos a mostrar y ocultados dados por el usuario
     * @return mixed metadatos a mostrar y ocultos
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_show_hide_metadata(){
        $query = $this->db->get_where("metadatos", array("show_hide_metadata" => "true"));
        return $query->result_array();
    }

    /**
     * Funcion que busca los metadatos a obtener los metadatos que son parte de la busqueda
     * @return mixed metadatos a mostrar y ocultos
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_searcheable_metadata(){
        $query = $this->db->get_where("metadatos", array("is_searchable" => "true"));
        return $query->result_array();
    }

    /**
     * Funcion que busca que usuario subieron oas y su pertenencia
     * @return mixed array con los datos del usuario y id de los oas
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_users_upload_oas(){
        $this->db->select("users.iduser, users.name, users.lastname, lo.idlo, lo.insertiondate");
        $this->db->from("users, lo");
        $this->db->where("users.iduser = lo.iduser");
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * funcion para obtener la coleccion en que fue insertado un oa
     * @param $idoa id oa
     * @return mixed dato con la colecion de un oa
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function get_collection_oa($idoa){
        $this->db->select("idcollection");
        $this->db->from("oas");
        $this->db->where("id_oa", $idoa);
        $query = $this->db->result_array();
        return $query[0]["idcollection"];
    }
//************************Consultas BD**********************************
    /**
     * Insertar xml
     * @param $xml header xml
     * @param $oa id oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function insert_xml($xml, $oa){
        $collection = $this->get_collection_oa($oa);
        $arr = $this->session->userdata("logged_in");
        $data = array(
            "idlo" => $oa,
            "idsubcollection" => $collection,
            "iduser" => $arr["id"],
            "insertiondate" => date("Y-m-d"),
            "deleted" => "false",
            "xmlo" => $xml
        );
        //$this->db->where("id_oa", $oa);
        $this->db->insert("lo", $data);
    }

    /**
     * Funcion para actualizar xml de un oa
     * @param $xml xml a actualizar
     * @param $oa id oa
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    public function update_xml($xml, $oa){
        $this->db->query("update lo set xmlo=concat(xmlo,'".$xml."') where idlo=".$oa);
    }



    //**********************************Actualizar Collection y SubCollection*****************
    /**
     * Funcion para actualizar la coleccion de un oa
     * @param $id_oa id oa
     * @param $collection id coleccion
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    function update_collection($id_oa, $collection){
        $data = array(
          "idcollection" => $collection
        );
        $this->db->where("id_oa", $id_oa);
        $this->db->update("oas", $data);
    }

    /**
     * Funcion para actualizar una subcoleccion de un oa
     * @param $id_oa id oa
     * @param $subcollection id subcoleccion
     * @Autor Danny Alexander Trujillo Pulgarin
     * @Category Modelo
     * @Package Model
     * @SubPackage user_model
     */
    function update_subcollection($id_oa, $subcollection){
        $data = array(
            "idsubcollection" => $subcollection
        );
        $this->db->where("id_oa", $id_oa);
        $this->db->update("oas", $data);

    }



}
?>