<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 28/05/15
 * Time: 03:13 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Installer extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("installer_model");
    }

    public function index(){
        //echo "sadfa". $this->installerhasexecute(true);
        if(!$this->installerhasexecute(true)){

            $data = array(
                "main" => "installer/auto_installer"
            );

            $this->load->view("layouts/installer_template", $data);
        }else{

            redirect('main', 'refresh');
            //header("Location: ".base_url()."user");
        }


    }

    public function create_user_table(){
        $this->installer_model->create_table_user();
    }

    public function create_big_table(){
        $datametadata = $this->input->post("datametadata");
        $datametadata = json_decode($datametadata);
        $this->installer_model->execute_query("create table if not exists  metadatos(
          id_metadato serial NOT NULL,
          metadato character varying(200),
          etiqueta character varying(200),
          tipo character varying(200),
          valores text,
          mostrar boolean NOT NULL DEFAULT false,
          required_metadata boolean NOT NULL DEFAULT false,
          show_hide_metadata boolean DEFAULT false,
          parentid integer,
          is_location boolean DEFAULT false,
          is_searchable boolean NOT NULL DEFAULT false,
          is_format boolean DEFAULT false,
          is_size boolean NOT NULL DEFAULT false,
          CONSTRAINT metadato_fk PRIMARY KEY (id_metadato)
        )");
        for ($j = 0; $j < count($datametadata); $j++) {
            if($datametadata[$j][0]!=null||$datametadata[$j][0]!=''){
                $id_metadato = $datametadata[$j][0];
                $metadato = $datametadata[$j][1];
                $etiqueta = $datametadata[$j][2];
                $tipo = $datametadata[$j][3];
                if($datametadata[$j][4]==null||$datametadata[$j][4]==''){
                    $valores = $datametadata[$j][4];
                }else{
                    $valores = $datametadata[$j][4];
                }
                $mostrar = $datametadata[$j][5];
                $show_hide_metadata = $datametadata[$j][6];
                $required_metadata = $datametadata[$j][7];
                $parentid = $datametadata[$j][8];
                $is_location = $datametadata[$j][9];
                $is_searchable = $datametadata[$j][10];
                $is_format = $datametadata[$j][11];
                $is_size = $datametadata[$j][12];

                $this->installer_model->execute_query("insert into metadatos (id_metadato, metadato, etiqueta, tipo, valores, mostrar, required_metadata,
                show_hide_metadata, parentid, is_location, is_searchable, is_format, is_size) values('$id_metadato', '$metadato', '$etiqueta', '$tipo', '$valores',
                $mostrar, $required_metadata, $show_hide_metadata, $parentid, $is_location, $is_searchable, $is_format, $is_size)");
            }


        }
        $get_form = $this->installer_model->get_metadatos_table();



        $arrayconsulta = array();

        foreach($get_form as $row){
            $arrayin = array("id_metadato" => $row["id_metadato"],"metadato" => $row["metadato"],"etiqueta" => $row["etiqueta"],
                "tipo" =>  $row["tipo"],"valores" => $row["valores"], "mostrar" => $row["mostrar"],"parentid" => $row["parentid"]);
            $arrayconsulta[] = $arrayin;
        }

        //print_r($arrayconsulta);
        $this->installer_model->execute_query("create table oas(id_oa bigserial not null primary key)");
        $this->installer_model->execute_query("alter table oas add COLUMN countdownloads integer;");
        $this->installer_model->execute_query("CREATE TABLE deletedlo(idlo integer NOT NULL primary key, iduserowner text NOT NULL, iduserdeleted text NOT NULL, title text NOT NULL, date date)");
        $this->installer_model->execute_query("CREATE TABLE lo(idlo bigserial NOT NULL primary key, idsubcollection integer NOT NULL, iduser integer NOT NULL, insertiondate date NOT NULL, deleted boolean NOT NULL DEFAULT false, lastmodified timestamp with time zone DEFAULT now(), xmlo text)");
        $this->installer_model->execute_query("CREATE TABLE collection(idcollection serial NOT NULL, name character varying(100), CONSTRAINT collection_pkey PRIMARY KEY (idcollection))");
        $this->installer_model->execute_query("CREATE TABLE subcollection(idsubcollection serial NOT NULL, idcollection integer NOT NULL, name character varying(100), CONSTRAINT subcollection_pkey PRIMARY KEY (idsubcollection), CONSTRAINT subcollection_idcollection_fkey FOREIGN KEY (idcollection) REFERENCES collection (idcollection) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE)");
        $this->installer_model->execute_query("alter table oas add COLUMN idcollection integer;");
        $this->installer_model->execute_query("alter table oas add foreign key (idcollection) references collection(idcollection);");;
        $this->installer_model->execute_query("alter table oas add COLUMN idsubcollection integer;");
        $this->installer_model->execute_query("alter table oas add foreign key (idsubcollection) references subcollection(idsubcollection);");

        for($i=0; $i<count($arrayconsulta); $i++){
            $id = $arrayconsulta[$i]["id_metadato"];
            $metadato = $arrayconsulta[$i]["metadato"];
            $tipo = $arrayconsulta[$i]["tipo"];
            $parent = $arrayconsulta[$i]["parentid"];
            $k=0;
            if($tipo=="multiple"){
                $padre1="";
                for($h=0; $h<count($arrayconsulta); $h++){
                    if($parent==$arrayconsulta[$h]["id_metadato"]){
                        $padre1 = $arrayconsulta[$h]["metadato"];
                    }
                }
                if($padre1!=""){
                    $sql = "create table ".str_replace(' ','',strtolower($padre1))."_".str_replace(' ','',strtolower($metadato)).
                        "(id".str_replace(' ','',strtolower($padre1))."_".str_replace(' ','',strtolower($metadato))." bigserial not null primary key, id_oa integer, FOREIGN KEY (id_oa) REFERENCES oas(id_oa)  ON UPDATE CASCADE ON DELETE CASCADE)";
                    $this->installer_model->execute_query($sql);
                    $ntable = str_replace(' ','',strtolower($padre1))."_".str_replace(' ','',strtolower($metadato));
                } else{
                    $sql = "create table ".str_replace(' ','',strtolower($metadato)).
                        "(id".str_replace(' ','',strtolower($padre1))."_".str_replace(' ','',strtolower($metadato))." bigserial not null primary key, id_oa integer, FOREIGN KEY (id_oa) REFERENCES oas(id_oa) ON UPDATE CASCADE ON DELETE CASCADE)";;
                    $this->installer_model->execute_query($sql);
                    $ntable = str_replace(' ','',strtolower($metadato));
                }


                for($b=$i+1; $b<count($arrayconsulta); $b++){
                    if($arrayconsulta[$b]["tipo"]!="multiple"){
                        if($id==$arrayconsulta[$b]["parentid"]){
                            $sql = "alter table ".$ntable." add column ";
                            $sql .= str_replace(' ', '', strtolower($metadato)) . "_" . str_replace(' ', '', strtolower($arrayconsulta[$b]["metadato"]));
                            if (($arrayconsulta[$b]["tipo"] == "text") || ($arrayconsulta[$b]["tipo"] == "valores") || ($arrayconsulta[$b]["tipo"] == "tmultiple") || ($arrayconsulta[$b]["tipo"] == "vmultiple")||($arrayconsulta[$b]["tipo"]=="date")) {
                                $sql .= " text";
                            } elseif ($tipo == "numero") {
                                $sql .= " double precision";
                            }

                            $createcolumn = $this->installer_model->execute_query($sql);
                        }
                    }


                }


            } else{
                if((int) $arrayconsulta[$i]['parentid']!=0){
                    for($j=$i+1; $j<count($arrayconsulta); $j++){
                        if($arrayconsulta[$j]['parentid']==0){

                        }elseif($id==$arrayconsulta[$j]["parentid"]){
                            $k++;
                        }
                        //echo " ". $id." i=".$i;

                    }
                    if($k==0){
                        for($h=0; $h<count($arrayconsulta); $h++){
                            if($parent==$arrayconsulta[$h]["id_metadato"]){
                                $padre = $arrayconsulta[$h]["metadato"];
                                $type = $arrayconsulta[$h]["tipo"];
                            }
                        }
                        if($type!="multiple"){
                            $sql = "alter table oas add column ";
                            $sql .= str_replace(' ','',strtolower($padre))."_".str_replace(' ','',strtolower($metadato)) ;
                            if(($tipo=="text")||($tipo=="valores")||($tipo=="tmultiple")||($tipo=="vmultiple")||($tipo=="date")){
                                $sql.= " text";
                            } elseif($tipo=="numero"){
                                $sql.= " double precision";
                            }
                            $createcolumn =$this->installer_model->execute_query($sql);
                        }

                    }
                }
            }


        }



        $this->installerhasexecute(false);

    }

    private function installerhasexecute($read){
        if($read){
            $fp = fopen("upload/installercontrol/installer.txt", "r");

            $linea = fgets($fp);

            fclose($fp);

            if((string)$linea=="1"){
                return true;
            }else{
                return false;
            }
        }else{
            $fp = fopen("upload/installercontrol/installer.txt", "w");
            fwrite($fp, "1");
            fclose($fp);
            return true;
        }


    }

}