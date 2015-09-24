<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 22/02/15
 * Time: 06:22 PM
 */

/**
 * Clase que maneja el estandar dado por el Usuario
 * @Autor Danny Alenxander Trujillo
 * @Package Libreria
 * @SubPackage Estandar Usuario
 * Class User_standard
 */
class User_standard
{
    /**
     * @var object $CI esta variable es la herencia de la clase proporcionada por Codeigniter
     */
    private $CI;
    /**
     * @var array $tree_standard Esta variable toma la estructura del estandar proporcionado por el usuario
     */
    private $tree_standard;
    /**
     * @var array $spadres corresponde a un array con el nombre de los padres que no tienen mas padres
     */
    private $spadres;
    /**
     * @var array $padres corresponde a un array con los nombres de los padres que tienen al menos un hijo, pero a su vez tienen un padre
     */
    private $padres;
    /**
     * @var array $hijos corresponden dentro de una estructura en arbol a las hojas del mismo, donde no tienen hijos y a su vez tienen un padre
     */
    private $hijos;

    private $xmlg;

    /**
     * Esta funcion crea el objecto CI de la clase codeigniter e invoca el modelo user_standard_model
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model("Libraries/user_standard_model");
        $this->CI->load->model("user_model");


    }

    /**
     * Esta clase consulta el ultimo id guardado de los OA's y entre el mismo sumado 1
     * @return int Se retorna el consecutivo del id del objeto de aprendizaje
     */
    public function get_actual_id()
    {
            $idoa = $this->CI->user_standard_model->get_last_row();
        if ($idoa == 1) {
            return 1;
        } else {
            return $idoa[0]["id_oa"] + 1;
        }
    }


    /**
     * Esta funcion estructura el estandar proporcionado por el usuario identificando los padres que no tienen padres, padres con padres e hijo con padres
     */
    public function structure_standard()
    {

        $this->tree_standard = $this->CI->user_standard_model->get_user_standard();
        $arrayin = array();

        for ($i = 0; $i < count($this->tree_standard); $i++) {
            $id = $this->tree_standard[$i]["id_metadato"];
            $metadato = $this->tree_standard[$i]["metadato"];
            //$tipo = $this->tree_standard[$i]["tipo"];
            $parent = $this->tree_standard[$i]["parentid"];
            $k = 0;
            //echo $id;
            if ((int)$this->tree_standard[$i]['parentid'] != 0) {
                for ($j = $i + 1; $j < count($this->tree_standard); $j++) {
                    if ($this->tree_standard[$j]['parentid'] == 0) {

                    } elseif ($id == $this->tree_standard[$j]["parentid"]) {
                        $k++;
                    }
                }
                if ($k == 0) {
                    $arrayin = array("id_metadato" => $this->tree_standard[$i]["id_metadato"],
                        "metadato" => $this->tree_standard[$i]["metadato"], "etiqueta" => $this->tree_standard[$i]["etiqueta"],
                        "tipo" => $this->tree_standard[$i]["tipo"], "valores" => $this->tree_standard[$i]["valores"],
                        "mostrar" => $this->tree_standard[$i]["mostrar"], "parentid" => $this->tree_standard[$i]["parentid"],
                    );
                    $this->hijos[] = $arrayin;
                } else {
                    $arrayin = array("id_metadato" => $this->tree_standard[$i]["id_metadato"],
                        "metadato" => $this->tree_standard[$i]["metadato"], "etiqueta" => $this->tree_standard[$i]["etiqueta"],
                        "tipo" => $this->tree_standard[$i]["tipo"], "valores" => $this->tree_standard[$i]["valores"],
                        "mostrar" => $this->tree_standard[$i]["mostrar"], "parentid" => $this->tree_standard[$i]["parentid"],
                    );

                    $this->padres[] = $arrayin;
                }
            } else {
                $arrayin = array("id_metadato" => $this->tree_standard[$i]["id_metadato"],
                    "metadato" => $this->tree_standard[$i]["metadato"], "etiqueta" => $this->tree_standard[$i]["etiqueta"],
                    "tipo" => $this->tree_standard[$i]["tipo"], "valores" => $this->tree_standard[$i]["valores"],
                    "mostrar" => $this->tree_standard[$i]["mostrar"], "parentid" => $this->tree_standard[$i]["parentid"],
                );

                $this->spadres[] = $arrayin;
            }
        }
    }

    /**
     * Esta función busca los padre que no tienen mas padres
     * @return mixed Retorna los superpadres del estandar del usuario
     */
    public function get_spadres()
    {

        $aux = null;
        /*foreach ($this->spadres as $key => $row) {
            $aux[$key] = $row["orderby"];
        }
        array_multisort($aux, SORT_ASC, $this->spadres);*/
        return $this->spadres;

    }

    /**
     * Esta función busca los padre que no tienen mas padres
     * @return mixed Retorna los superpadres del estandar del usuario
     */
    public function get_spadre()
    {
        $this->structure_standard();
        $aux = null;
        /*foreach ($this->spadres as $key => $row) {
            $aux[$key] = $row["orderby"];
        }
        array_multisort($aux, SORT_ASC, $this->spadres);*/
        return $this->spadres;

    }

    /**
     * Retorna los padres que tienen hijos y a su vez padres del estandar del usuario
     * @return mixed Array de datos con los padres
     */
    public function get_padres()
    {
        $aux = null;
        /*foreach ($this->padres as $key => $row) {
            $aux[$key] = $row["orderby"];
        }
        array_multisort($aux, SORT_ASC, $this->padres);*/
        return $this->padres;
    }

    /**
     * Retorna array con los hijos del estandar del usuario
     * @return mixed Retorna
     */
    public function get_hijos()
    {
        $aux = null;
        $this->structure_standard();
        /*foreach ($this->hijos as $key => $row) {
            $aux[$key] = $row["orderby"];
        }
        array_multisort($aux, SORT_ASC, $this->hijos);*/
        return $this->hijos;
    }

    /**
     * Inserta en la tabla OAS registro en caso de que no exista el consecutivo del OA y en caso de que exista
     * actualiza las columnas de esa fila
     * @param $padre Referencia el padre inmediato del hijo
     * @param $hijo Referencia al hijo inmediato perteneciente a la categoria o metadato al que corresponde el padre
     * @param $oa Consecutivo llave única del padre
     * @param $dato Corresponde al valor del campo tomado del formulario donde se lleno los metadatos del objeto de aprendizaje
     */
    public function insert_in_oas($padre, $hijo, $oa, $dato)
    {
        $existe = $this->exist_oa($oa);
        if ($existe) {
            //Existe un registro con ese oa
            $this->CI->user_model->update_metadato_oa_suppadre($padre, $hijo, $dato, $oa);

        } else {
            //No Existe ningun registro
            $this->CI->user_model->insert_metadato_oa_suppadre($padre, $hijo, $dato, $oa);
        }
    }

    public function get_data_in_oas($padre, $hijo, $oa){
        return $this->CI->user_model->get_metadato_oa_suppadre($padre, $hijo, $oa);
    }

    /*public function get_data_in_table($padre, $hijo, $oa, $dato, $orden){
        $this->CI->user_model->get_metadato_oa_suppadre($padre, $hijo, $oa);
    }*/

    /**
     * Función en busca de la si existe el id del OA
     * @param $oa Consecutivo de OA;
     * @return bool Retorna TRUE si existe o FALSE si no existe el objeto de aprendizaje
     */

    private function exist_oa($oa)
    {
        $rowoa = $this->CI->user_model->exists_insert_oa($oa);
        return $rowoa;
    }

    /**
     * Esta funcion insertara o
     * @param $padre Referencia el padre inmediato del hijo
     * @param $hijo Referencia al hijo inmediato perteneciente a la categoria o metadato al que corresponde el padre
     * @param $oa Consecutivo llave única del padre
     * @param $dato Corresponde al valor del campo tomado del formulario donde se lleno los metadatos del objeto de aprendizaje
     * @param $orden En los campos multivalorados se tiene en cuenta el orden con que se llenan los metadatos de acuerdo al numero de veces que el usuario disponga
     */
    public function insert_in_table($padre, $hijo, $oa, $dato, $orden)
    {

        $supfather = $this->get_father_father($padre);

        if ($supfather == $padre) {
            $oa_in = $this->exist_row_oas_category_multiple($supfather, $padre, $oa);
            if (!$oa_in) {
                $this->CI->user_model->insert_metadato_oa_category_multiple($supfather, $padre, $hijo, $dato, $oa);
            } else {
                $i = 1;
                $num = count($oa_in);
                foreach ($oa_in as $key) {
                    if ((int)$orden > $num) {
                        //echo $orden;
                        $this->CI->user_model->insert_metadato_oa_category_multiple($supfather, $padre, $hijo, $dato, $oa);
                        $num++;
                    }
                    if ($orden == $i) {
                        $id = $key["id_" . $supfather];
                        $this->CI->user_model->update_metadato_oa_category_multiple($id, $supfather, $padre, $hijo, $dato);
                    }
                    $i++;
                }
            }
        } else {
            $oa_in = $this->exist_row_oas($supfather, $padre, $oa);
            //echo count($oa_in);
            if (!$oa_in) {
                $this->CI->user_model->insert_metadato_oa_table($supfather, $padre, $hijo, $dato, $oa);

            } else {
                $i = 1;
                $num = count($oa_in);
                foreach ($oa_in as $key) {
                    if ((int)$orden > $num) {
                        //echo $orden;
                        $this->CI->user_model->insert_metadato_oa_table($supfather, $padre, $hijo, $dato, $oa);
                        $num++;
                    }
                    if ($orden == $i) {
                        $id = $key["id" . $supfather . "_" . $padre];
                        $this->CI->user_model->update_metadato_oa_table($id, $supfather, $padre, $hijo, $dato);
                    }
                    $i++;
                }
            }
        }
    }

    /**
     * Borra filas de registros correspondientes al id del OA
     * @param $padre Referencia el padre inmediato del hijo
     * @param $oa Consecutivo llave única del padre
     * @param $orden En los campos multivalorados se tiene en cuenta el orden con que se llenan los metadatos de acuerdo al numero de veces que el usuario disponga
     */
    public function delete_in_table($padre, $oa, $orden)
    {
        $supfather = $this->get_father_father($padre);
        if ($supfather == $padre) {

        }

        $oa_in = $this->exist_row_oas($supfather, $padre, $oa);

        $i = 1;
        foreach ($oa_in as $key) {

            if ($orden == $i) {
                $id = $key["id" . $supfather . "_" . $padre];
                $this->CI->user_model->delete_metadato_oa_table($id, $supfather, $padre);
            }
            $i++;
        }


    }

    /**
     * Función en busca del padre de un padre
     * @param $padre Padre inmediatamente superior al hijo
     * @return mixed Retorna el nombre del padre del padre
     * @Access private
     */
    private function get_father_father($padre)
    {
        $padreparent = $this->CI->user_model->get_parentid($padre);
        if ((string)$padreparent == '0') {
            $fathername = $padre;
        } else {
            if ($this->CI->user_model->get_metadato_father($padreparent)) {
                $fathername = str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($padreparent)));
            }
        }
        return $fathername;
    }

    /**
     * Esta función busca si existe al menos una fila registrada por con el consecutivo o id acutal del oa
     * @param $suppadre Padre del padre del hijo
     * @param $padre Padre mas directo
     * @param $hijo Hijo del padre inmediatamente superior
     * @param $oa consecutivo del oa
     * @param $orden es el numero de veces que se ha "clonado" el metadato
     * @return bool retorna true si existe o false sino existe
     * @Access private
     */
    private function exist_row_oas($suppadre, $padre, $oa)
    {
        $existe = $this->CI->user_model->exists_oa_table($suppadre, $padre, $oa);
        return $existe;
    }

    /**
     * Esta función busca si existe al menos una fila registrada por con el consecutivo o id acutal del oa
     * @param $suppadre Padre del padre del hijo
     * @param $padre Padre mas directo
     * @param $hijo Hijo del padre inmediatamente superior
     * @param $oa consecutivo del oa
     * @param $orden es el numero de veces que se ha "clonado" el metadato
     * @return bool retorna true si existe o false sino existe
     * @Access private
     */
    private function exist_row_oas_category_multiple($suppadre, $padre, $oa)
    {
        $existe = $this->CI->user_model->exists_oa_category_multiple($suppadre, $oa);
        return $existe;
    }

    public function get_standard()
    {
        $estandar = $this->CI->user_standard_model->get_user_standard();
        $datoestandar = array();
        $i = 0;
        foreach ($estandar as $row) {
            $datoestandar[$i] = array(
                'id' => $row["id_metadato"],
                'metadato' => $row["metadato"],
                'etiqueta' => $row["etiqueta"],
                'tipo' => $row["tipo"],
                'valores' => $row["valores"],
                'mostrar' => $row["mostrar"],
                'required_metadata' => $row["required_metadata"],
                'show_hide_metadata' => $row["show_hide_metadata"],
                //'order_form' => $row["order_form"],
                'is_location' => $row["is_location"],
                'is_searchable' => $row["is_searchable"],
                'is_format' => $row["is_format"],
                'is_size' => $row["is_size"],
                'parent_id' => $row["parentid"]);
            $i++;
        }
        $estandartree = $this->convert_standard_in_tree($datoestandar, 0);
        return $estandartree;
    }


    private function convert_standard_in_tree(array $standard, $parentId = 0)
    {
        $branch = array();

        foreach ($standard as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->convert_standard_in_tree($standard, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function generate_xml($id_oa)
    {
        $arraystandard = $this->get_standard();
        //print_r($arraystandard);
        $xml = '<lom:lom xmlns:lom="http://ltsc.ieee.org/xsd/LOM" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://ltsc.ieee.org/xsd/LOM http://ltsc.ieee.org/xsd/lomv1.0/lom.xsd">' . "\n";
        $spadres = $this->get_spadre();
        if (!$this->CI->user_model->exists_oa_in_lo($id_oa)) {
            $this->CI->user_model->insert_xml($xml, $id_oa);
        }

        $multiple = 0;
        $l = 0;
        //print_r($arraystandard[$l]);

        foreach ($spadres as $superpadres) {
            $cosa = $this->create_xml("", $superpadres["metadato"], $superpadres["metadato"], array($arraystandard[$l]), 0, $id_oa, 0);

            $l++;
        }
        $this->CI->user_model->update_xml("</lom:lom>", $id_oa);


    }

    public function reserve_id_oa($extension, $id_oa, $collection, $subcollection, $location, $size, $format)
    {
        $metadatolocation = $this->CI->user_model->get_metadato_location();
        if ($metadatolocation[0]["tipo"] != "multiple") {
            $father = $this->get_father_father(strtolower($metadatolocation[0]["metadato"]));
            //echo "padre location" .$father;
            $this->insert_in_oas($father, str_replace(" ", "", strtolower($metadatolocation[0]["metadato"])), $id_oa, $location);

        }

        $metadatosize = $this->CI->user_model->get_metadato_size();
        $father = $this->get_father_father(strtolower($metadatosize[0]["metadato"]));
        $this->insert_in_oas($father, str_replace(" ", "", strtolower($metadatosize[0]["metadato"])), $id_oa, $size);

        $metadatoformat = $this->CI->user_model->get_metadato_format();
        $father = $this->get_father_father(strtolower($metadatoformat[0]["metadato"]));
        $this->insert_in_oas($father, str_replace(" ", "", strtolower($metadatoformat[0]["metadato"])), $id_oa, $format);

        $this->update_reserve_id_oa_collection($id_oa, $collection);
        $this->update_reserve_id_oa_subcollection($id_oa, $subcollection);



    }

    public function update_reserve_id_oa_collection($id_oa, $collection){
        $this->CI->user_model->update_collection($id_oa, $collection);
    }
    public function update_reserve_id_oa_subcollection($id_oa, $subcollection){
        if((string)$subcollection!=="0"){
            $this->CI->user_model->update_subcollection($id_oa, $subcollection);
        }

    }

    private function create_xml($xml, $category, $padre, $elements, $indent, $id_oa, $ismultiple)
    {
        if ($indent >= 20) return;    // Stop at 20 sub levels
        //header('Content-type: text/plain');

        foreach ($elements as $nodes) {
            if ($nodes["parent_id"] == "0") {

                $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">";
                echo $xml;
                $this->CI->user_model->update_xml($xml, $id_oa);
                $padre = str_replace(" ", "", strtolower($nodes["metadato"]));
                // $ismultiple++;
            }

            if ($nodes["tipo"] == "multiple") {
                if ($nodes["parent_id"] != "0") {
                    $padre = str_replace(" ", "", strtolower($nodes["metadato"]));
                    echo " nuevo Padre" . $padre;
                    $xml = "<lom:" . $padre . ">\n\t";
                    $this->CI->user_model->update_xml($xml, $id_oa);

                }
                $ismultiple++;

            }

            if (($nodes["tipo"] == "text") || ($nodes["tipo"] == "valores") || ($nodes["tipo"] == "numero") || ($nodes["tipo"] == "date")) {
                if ($ismultiple > 0) {
                    $superpadre = $this->get_father_father(strtolower($padre));

                    if ($superpadre != "false") {

                        $data = $this->CI->user_model->consult_oa_table(str_replace(" ", "", strtolower($superpadre)), str_replace(" ", "", strtolower($padre)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                        if ($data != "false") {
                            foreach ($data as $dato) {

                                $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $dato[str_replace(" ", "", strtolower($padre)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                                $this->CI->user_model->update_xml($xml, $id_oa);
                                //echo "xml".$xml;

                            }
                        } else {
                            $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                            $this->CI->user_model->update_xml($xml, $id_oa);
                        }

                    } else {

                        $data = $this->CI->user_model->consult_oa_table(str_replace(" ", "", strtolower($category)), str_replace(" ", "", strtolower($padre)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                        if ($data != "false") {
                            foreach ($data as $dato) {
                                $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $dato[str_replace(" ", "", strtolower($padre)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                                $this->CI->user_model->update_xml($xml, $id_oa);
                                //echo "xml".$xml;
                            }
                        } else {
                            $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                            $this->CI->user_model->update_xml($xml, $id_oa);
                        }

                    }

                } else {

                    $data = $this->CI->user_model->consult_metadato_oa_table(str_replace(" ", "", strtolower($category)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                    if ($data != "false") {
                        foreach ($data as $dato) {
                            $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $dato[str_replace(" ", "", strtolower($category)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                            $this->CI->user_model->update_xml($xml, $id_oa);
                        }
                    } else {
                        $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                        $this->CI->user_model->update_xml($xml, $id_oa);
                    }

                }

            }

            if (($nodes["tipo"] == "tmultiple") || ($nodes["tipo"] == "vmultiple")) {
                if ($ismultiple > 0) {
                    $superpadre = $this->get_father_father(strtolower($padre));
                    if ($superpadre != "false") {
                        $data = $this->CI->user_model->consult_oa_table(str_replace(" ", "", strtolower($superpadre)), str_replace(" ", "", strtolower($padre)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                        if ($data != "false") {
                            foreach ($data as $dato) {
                                $vector = explode(",", $dato["" . str_replace(" ", "", strtolower($padre)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "");
                                for ($i = 0; $i < count($vector); $i++) {
                                    $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $vector[$i] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                                    $this->CI->user_model->update_xml($xml, $id_oa);
                                }
                            }
                        } else {
                            $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                            $this->CI->user_model->update_xml($xml, $id_oa);
                        }

                    } else {
                        $data = $this->CI->user_model->consult_oa_table(str_replace(" ", "", strtolower($category)), str_replace(" ", "", strtolower($padre)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                        if ($data != "false") {
                            foreach ($data as $dato) {
                                $vector = explode(",", $dato["" . str_replace(" ", "", strtolower($category)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "");
                                for ($i = 0; $i < count($vector); $i++) {
                                    $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $vector[$i] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                                    $this->CI->user_model->update_xml($xml, $id_oa);
                                }
                            }
                        } else {
                            $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                            $this->CI->user_model->update_xml($xml, $id_oa);
                        }

                    }

                } else {
                    $data = $this->CI->user_model->consult_metadato_oa_table(str_replace(" ", "", strtolower($category)), str_replace(" ", "", strtolower($nodes["metadato"])), $id_oa);
                    if ($data != "false") {
                        foreach ($data as $dato) {
                            $vector = explode(",", $dato["" . str_replace(" ", "", strtolower($category)) . "_" . str_replace(" ", "", strtolower($nodes["metadato"]))] . "");
                            for ($i = 0; $i < count($vector); $i++) {
                                $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . $vector[$i] . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                                $this->CI->user_model->update_xml($xml, $id_oa);
                            }
                        }
                    } else {
                        $xml = "<lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">" . "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">\n";
                        $this->CI->user_model->update_xml($xml, $id_oa);
                    }

                }

            }

            if (isset($nodes['children'])) {

                $this->create_xml($xml, $category, $padre, $nodes['children'], $indent + 1, $id_oa, $ismultiple);
                if ($ismultiple > 0) {
                    if ($nodes["tipo"] == "multiple") {
                        echo $padre;
                        $xml = "</lom:" . str_replace(" ", "", strtolower($padre)) . ">";
                        echo $xml;
                        $this->CI->user_model->update_xml($xml, $id_oa);
                        $ismultiple = $ismultiple - 1;
                    }
                    /*$xml="</lom:".str_replace(" ", "", strtolower($padre)).">";
                    echo "sigue siendo multiple".$xml;
                    $this->CI->user_model->update_xml($xml, $id_oa);*/
                } else {

                    $xml = "</lom:" . str_replace(" ", "", strtolower($nodes["metadato"])) . ">";
                    echo $xml;
                    $this->CI->user_model->update_xml($xml, $id_oa);

                }

                if (isset($superpadre)) {
                    $padre = $superpadre;
                }
                echo $ismultiple;
            }
        }
        //return $xml;
    }



    public function get_metadata_to_show($collection= "0", $subcollection = "0", $search = "0")
    {

            $metadatashow = $this->CI->user_model->get_show_metadata();


        //print_r($metadatashow);

        if($collection=="0"&&$subcollection=="0"&&$search=="0"){
            $oas = $this->CI->user_model->get_existing_oas();
        }elseif($collection!="0"&&$subcollection=="0"&&$search=="0"){

            $oas = $this->CI->user_model->get_existing_oas($collection);
        }elseif($collection!="0"&&$subcollection!="0"&&$search=="0"){

            $oas = $this->CI->user_model->get_existing_oas($collection, $subcollection);
        }elseif($search!="0"){
            $oas = $this->get_oas_search($search);
            if(count($oas)==0){
                $oas = array();
            }
        }

        $returnmetadata = array();
        $returnmetadata2 = array();
        $dato = "";

        if(count($oas)>0){
            foreach ($oas as $oa) {
                foreach ($metadatashow as $key) {
                    $dato = "";
                    //echo $key["metadato"];
                    $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                    $father2 = $this->CI->user_model->get_id_father($father);
                    $father3 = $this->CI->user_model->get_info_metadato($father2);
                    $parentidfather = $this->CI->user_model->get_parentid($father);
                    if ($parentidfather == "0") {
                        if ($father3[0]["tipo"] == "single") {
                            $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                            $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                            $dato = $this->CI->user_model->consult_metadato_oa_table($elpadre, $elhijo, $oa["id_oa"]);

                        }else{
                            $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                            $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                            $dato = $this->CI->user_model->consult_oa_table($elpadre, $elpadre, $elhijo, $oa["id_oa"]);
                        }
                    } else {
                        $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                        //echo $father;
                        $father2 = $this->CI->user_model->get_id_father($father);
                        $father3 = $this->CI->user_model->get_info_metadato($father2);
                        //print_r($father3);
                        if ($father3[0]["parentid"] == 0) {
                            $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                            $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                            $dato = $this->CI->user_model->consult_oa_table($elpadre, $elpadre, $elhijo, $oa["id_oa"]);
                            //echo $elpadre."_".$elhijo;

                        } else {
                            $superpadre = $this->get_father_father(str_replace(" ", "", strtolower($father3[0]["metadato"])));
                            $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                            $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                            $dato = $this->CI->user_model->consult_oa_table($superpadre, $elpadre, $elhijo, $oa["id_oa"]);
                        }

                    }
                    //print_r($dato);
                    if(is_array($dato)){
                        foreach ($dato as $metadatore) {
                            $returnmetadata2["" . $elpadre . "_" . $elhijo] = $metadatore["" . $elpadre . "_" . $elhijo];
                        }
                    }


                }
                $returnmetadata2["id_oa"] = $oa["id_oa"];
                $returnmetadata[] = $returnmetadata2;
            }
        }

        return $returnmetadata;
    }

    public function get_show_hide_metadata(){
        $metadatashow = $this->CI->user_model->get_show_hide_metadata();
        //print_r($metadatashow);
        $oas = $this->CI->user_model->get_existing_oas();
        $returnmetadata = array();
        $returnmetadata2 = array();
        $dato = "";
        foreach ($oas as $oa) {
            foreach ($metadatashow as $key) {
                $dato = "";
                //echo $key["metadato"];
                $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                $father2 = $this->CI->user_model->get_id_father($father);
                $father3 = $this->CI->user_model->get_info_metadato($father2);
                $parentidfather = $this->CI->user_model->get_parentid($father);
                if ($parentidfather == "0") {
                    if ($father3[0]["tipo"] == "single") {
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        $dato = $this->CI->user_model->consult_metadato_oa_table($elpadre, $elhijo, $oa["id_oa"]);

                    }else{
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        $dato = $this->CI->user_model->consult_oa_table($elpadre, $elpadre, $elhijo, $oa["id_oa"]);
                    }
                } else {
                    $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                    //echo $father;
                    $father2 = $this->CI->user_model->get_id_father($father);
                    $father3 = $this->CI->user_model->get_info_metadato($father2);
                    //print_r($father3);
                    if ($father3[0]["parentid"] == 0) {
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        $dato = $this->CI->user_model->consult_oa_table($elpadre, $elpadre, $elhijo, $oa["id_oa"]);
                        //echo $elpadre."_".$elhijo;

                    } else {
                        $superpadre = $this->get_father_father(str_replace(" ", "", strtolower($father3[0]["metadato"])));
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        $dato = $this->CI->user_model->consult_oa_table($superpadre, $elpadre, $elhijo, $oa["id_oa"]);
                    }

                }
                //print_r($dato);
                if(is_array($dato)){
                    foreach ($dato as $metadatore) {
                        $returnmetadata2["" . $elpadre . "_" . $elhijo] = $metadatore["" . $elpadre . "_" . $elhijo];
                    }
                }


            }
            $returnmetadata2["id_oa"] = $oa["id_oa"];
            $returnmetadata[] = $returnmetadata2;
        }
        return $returnmetadata;
    }

    public function get_own_users_oas(){
        return $this->CI->user_model->get_users_upload_oas();
    }

    public function get_oas_search($words){
        $metadatasearcheable= $this->CI->user_model->get_searcheable_metadata();
        $oas = $this->CI->user_model->get_existing_oas();
        $oasfound = array();
        foreach ($oas as $oa) {
            foreach ($metadatasearcheable as $key) {
                $dato = "";
                //echo $key["metadato"];
                $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                $father2 = $this->CI->user_model->get_id_father($father);
                $father3 = $this->CI->user_model->get_info_metadato($father2);
                $parentidfather = $this->CI->user_model->get_parentid($father);
                if ($parentidfather == "0") {
                    if ($father3[0]["tipo"] == "single") {
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        if($this->CI->user_model->consult_metadato_oa_table_search($elpadre, $elhijo, $oa["id_oa"], $words)){
                            $oasfound[] = array(
                                "id_oa" => $oa["id_oa"]
                            );
                        }


                    }else{
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        if($this->CI->user_model->consult_oa_table_search($elpadre, $elpadre, $elhijo, $oa["id_oa"], $words)){
                            $oasfound[] = array(
                                "id_oa" => $oa["id_oa"]
                            );
                        }
                    }
                } else {
                    $father = $this->get_father_father(str_replace(' ', '', strtolower($this->CI->user_model->get_metadato_father($key["id_metadato"]))));
                    //echo $father;
                    $father2 = $this->CI->user_model->get_id_father($father);
                    $father3 = $this->CI->user_model->get_info_metadato($father2);
                    //print_r($father3);
                    if ($father3[0]["parentid"] == 0) {
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        if($this->CI->user_model->consult_oa_table_search($elpadre, $elpadre, $elhijo, $oa["id_oa"], $words)){
                            $oasfound[] = array(
                                "id_oa" => $oa["id_oa"]
                            );
                        }

                    } else {
                        $superpadre = $this->get_father_father(str_replace(" ", "", strtolower($father3[0]["metadato"])));
                        $elpadre = str_replace(" ", "", strtolower($father3[0]["metadato"]));
                        $elhijo = str_replace(" ", "", strtolower($key["metadato"]));
                        if($this->CI->user_model->consult_oa_table_search($elpadre, $elpadre, $elhijo, $oa["id_oa"], $words)){
                            $oasfound[] = array(
                                "id_oa" => $oa["id_oa"]
                            );
                        }
                    }

                }
            }
        }

        return $this->unique_multidim_array($oasfound, "id_oa");

    }

    function unique_multidim_array($array, $key){
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val){
            if(!in_array($val[$key],$key_array)){
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function get_metadata_location(){
        $metadatolocation = $this->CI->user_model->get_metadato_location();
        if ($metadatolocation[0]["tipo"] != "multiple") {
            $father = $this->get_father_father(str_replace(" ", "", strtolower($metadatolocation[0]["metadato"])));

            return $father."_".str_replace(" ", "", strtolower($metadatolocation[0]["metadato"]));
        }
    }

    public function get_metadata_size(){
        $metadatosize = $this->CI->user_model->get_metadato_size();
        if ($metadatosize[0]["tipo"] != "multiple") {
            $father = $this->get_father_father(str_replace(" ", "", strtolower($metadatosize[0]["metadato"])));

            return $father."_".str_replace(" ", "", strtolower($metadatosize[0]["metadato"]));
        }
    }
    public function get_metadata_format(){
        $metadatoformat = $this->CI->user_model->get_metadato_format();
        if ($metadatoformat[0]["tipo"] != "multiple") {
            $father = $this->get_father_father(str_replace(" ", "", strtolower($metadatoformat[0]["metadato"])));

            return $father."_".str_replace(" ", "", strtolower($metadatoformat[0]["metadato"]));
        }
    }

}
?>