<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 20/11/14
 * Time: 07:00 PM
 */
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon  glyphicon glyphicon-list"></i><span style="color:#317eac">
                        <!--<php echo $this->lang->line("container_title")?> (<php echo $num_objects." ".$this->lang->line("container_object")." ".$this->lang->line("container_found")?>)--></span></h2>

                <div class="controls " style="float:right;">
                    <label for="selectorder" >Ordenar por:</label>
                    <select id="selectorder" data-rel="chosen">
                        <option value="autor">Autor</option>
                        <option value="fecha" selected>Fecha</option>
                        <option value="titulo">Titulo</option>
                        <option value="valoracion">Valoración</option>

                    </select>

                </div>
            </div>

    <!--/span-->


<script>
    $("#objects_container").load("<php echo base_url()?>user/list_objects/fecha/0");
    $("#selectorder").change(function(){
        $("#objects_container").html("");
        $("#objects_container").load("<php echo base_url()?>user/list_objects/"+$("#selectorder").val()+"/0");
    });
</script>