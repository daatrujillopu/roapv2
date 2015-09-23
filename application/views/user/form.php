<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 15/02/15
 * Time: 04:47 PM
 */

function display_tree($nodes, $indent, $html, $actual_id, $idinput, $existsmul,$superpadre, $size, $sizedato, $location, $locationdato, $format, $formatdato) {

    if ($indent >= 20) return;	// Stop at 20 sub levels

    foreach ($nodes as $node) {
        if($node["tipo"]=="multiple"){
            $existsmul++;
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            echo '<div class="row">
                    <div class="box col-md-12" rel="fatherclone" is_multiple="true">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2><i class="glyphicon glyphicon-th"></i>'.$node["metadato"].'</h2>

                                <div class="box-icon">
                                    <a href="#" class="btn  btn-round btn-default">
                                    <span>
                                    <i class="glyphicon glyphicon-plus-sign blue" tipo="multi" id="'.$temp.'" data_oa="'.$actual_id.'"  repeat="1" rel="can_clone">
                                    </i>
                                    </span>
                                    </a>

                                </div>

                            </div>
                            <div class="box-content">';
        }

        if($node["tipo"]=="text"){
            $value = "";
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            $required = "no_required";
            $pophover = "";
            if($node["required_metadata"]==="t"){
                $required = "required";
                $pophover = ' data-content="Este Campo es Requerido" title="Este Campo es Requerido"';
            }
            if(strpos($temp, $location)!==false){

                $value = $locationdato;
            }
            if(strpos($temp, $size)!==false){
                $value = $sizedato;
            }
            if(strpos($temp, $format)!==false){
                $value = $formatdato;
            }
            echo '<label for="' . $temp . '">' . $node["etiqueta"] . '</label><input inside_multiple="1" tipo="text" type="text" class="form-control data_metadato '.$required.'" '.$pophover.' value="'.$value.'"  data_oa="' . $actual_id . '" id="'.$temp.'">';

        }
        if($node["tipo"]=="valores"){
            $required = "no_required";
            $pophover = "";
            if($node["required_metadata"]==="t"){
                $required = "required";
                $pophover = ' data-content="Este Campo es Requerido" title="Escoga una opción para este campo"';
            }
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            echo '<div class="control-group">
                    <div class="controls" style="padding-top: 10px;">
                        <label style="padding-top: 10px"
                               for="'.$temp.'">'.$node["etiqueta"].'</label>';
            echo '<select inside_multiple="1"  tipo="valores" style="width: 100%;"  data_oa="'.$actual_id.'"id="'.$temp.'" data-rel="chosen" '.$pophover.' class="data_metadato '.$required.'" name="'.$idinput.'">';
            echo '<option value="0">Eliga una opción</option>';
            $elements = explode(",", $node["valores"]);
            for ($i = 0; $i < count($elements); $i++) {
               echo '<option value="'.$elements[$i].'">'.ucfirst($elements[$i]).'<option>';
            }
            echo '</select>
                                                            </div>
                                                        </div>';
        }
        if($node["tipo"]=="numero"){
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            $required = "no_required";
            $pophover = "";
            if($node["required_metadata"]==="t"){
                $required = "required";
                $pophover = 'data-content="Este Campo es Requerido" title="Este campo es requerido"';
            }
            echo '<label for="'.$temp.'">'.$node["etiqueta"].'</label>';
            echo '<input inside_multiple="1" tipo="numero" data_oa="'.$actual_id.'" type="text" rel="numeric" id="'.$temp.'" name="'.$temp.'" '.$pophover.'  class="form-control data_metadato '.$required.'" placeholder="'.$node["etiqueta"].'" />';
        }

        if($node["tipo"]=="tmultiple"){
            $value = "";
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            $required = "no_required";
            $pophover = "";
            if($node["required_metadata"]==="t"){
                $required = "required";
                $pophover = 'data-content="Este Campo es Requerido" title="Escoga debe tener al menos una opción"';
            }


            if(strpos($temp, $location)!==false){

                $value = trim($locationdato);
            }
            if(strpos($temp, $size)!==false){
                $value = trim($sizedato);
            }
            if(strpos($temp, $format)!==false){
                $value = trim($formatdato);
            }
            echo '<label for="'.$temp.'">'.$node["etiqueta"].'</label>';
            echo '<input  inside_multiple="1" tipo="tmultiple"  data_oa="'.$actual_id.'" type="text"  '.$pophover.'  class="form-control data_metadato_multiple '.$required.'" value="'.$value.'" style="width: 100%;" id="'.$temp.'" data-role="tagsinput">';

        }
        if($node["tipo"]=="vmultiple"){
            if($existsmul>0){
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));
            }
            $required = "no_required";
            $pophover = "";
            if($node["required_metadata"]==="t"){
                $required = "required";
                $pophover = ' data-content="Este Campo es Requerido" title="Escoga debe tener al menos una opción"';
            }
            echo '<div class="control-group">
            <div class="controls" style="padding-top: 10px;">
                <label style="padding-top: 10px"
                    for="'.$temp.'">'.$node["etiqueta"].'</label>';
            echo '<select inside_multiple="1" tipo="vmultiple" '.$pophover.' data_oa="'.$actual_id.'" style="width: 100%; height: 25px !important;" id="'.$temp.'" data-rel="chosen" multiple class="form-control data_metadato_multiple '.$required.'" name="'.$temp.'">';
            echo '<option value="0">Eliga una opción</option>';
            $elements = explode(",", $node["valores"]);
            for ($i = 0; $i < count($elements); $i++) {
                echo '<option value="'.$elements[$i].'">'.ucfirst($elements[$i]).'</option>';

            }
            echo '</select>
            </div>
        </div>';
        }

        if (isset($node['children'])) {
            if($node["tipo"]=="multiple"){
                //$existsmul++;
                $idinput = str_replace(' ', '', strtolower($node["metadato"])) . "_";
            }


            display_tree($node['children'], $indent + 1, $html, $actual_id, $idinput, $existsmul, $superpadre, $size, $sizedato, $location, $locationdato, $format, $formatdato);

            if($node["tipo"]=="multiple"){
                $idinput = $superpadre;
                $existsmul = $existsmul-1;
                echo '<input type="hidden" tipo="cerrarmultiple" id="'.$temp.'" name="'.$temp.'" data_oa="'.$actual_id.'">';
                echo "</div>
                    </div>
                </div>
                </div>";
            }
        }
    }
}
?>
<div id="container">

    <div id="tabs">
        <ul>
            <?php $k=1; foreach($spadres as $key){
                ?>
                <li><a href="#tab-<?php echo $k?>" ><?php echo $key["metadato"] ?></a></li>
                <?php $k++; } ?>
        </ul>
        <?php
        $i=0;
        $l=1;
        foreach($spadres as $suppadres){
            ?>
        <div id="tab-<?php echo $l?>">
            <form id="form<?php echo $l?>"  enctype="multipart/form-data" action="#">

        <?php

            $idinput = str_replace(' ', '', strtolower($suppadres["metadato"])) . "_";
            $form = display_tree(array($tree[$i]), 0, "", $actual_id, $idinput, 0,$idinput, $size, $sizedato, $location, $locationdato, $format, $formatdato);

            //echo $form;


        ?>
                <div class="row">
                    <input type="hidden" value="0">
                    <div class="center">
                        <button type="button" style="font-size: 0.8em;" rel-form="form<?php echo $l ?>" class="btn  btn-primary guardarinfo">Guardar categoría </button>

                    </div>
                </div>
                </form>
            </div>
        <?php
            $i++;
            $l++;
        }

        ?>

    </div>
</div>
</div>
</div>
</div>
</div>

    <script>
        //Scripts para manejo de formulario
        $(document).ready(function() {
            $("#tabs").tabs();
            $("#tabs").tabs({
                active: 0
            });
            $('[rel="datepicker"]').datepicker();
            $('[rel="datepicker"]').datepicker("option", "dateFormat", "yy-mm-dd");
            $('[rel="numeric"]').numeric();
//Importante cambiar id para la clonacion
           // $(document).on("click", '[rel="can_clone"]', function(){
            $(document).on("click", '[rel="can_clone"]', function(){
                var controlvarios = 0;
                var $parent1;
                var $parentid1;
                var titlebox1;

                var array = [];
                var $parent1control = "nada";
                var $parent = $(this).parent().parent().parent().parent().parent().parent();
                //alert($parent.html());
                var $parentid = parseInt($(this).attr("repeat")) + 1;
                $(this).attr("repeat", ""+$parentid);
                //alert($parentid);
                var titlebox = $parent.find('h2').first().text();
                //alert(titlebox);
                var htm = '<div class="box col-md-12" is_multiple="true" repeat="' + $parentid + '" rel="fatherclone"><div class="box-inner"><div class="box-header well" data-original-title=""><h2><i class="glyphicon glyphicon-th"></i>' + titlebox + '</h2><div class="box-icon"><a href="#" class="btn btn-block btn-round btn-default"><span><i class=" glyphicon glyphicon-minus-sign red" rel="can_unclone""></i></span></i></a></div></div><div class="box-content">';
                //alert(htm);
                $parent.find('[data_oa="<?php echo $actual_id?>"]').each(function () {

                    var oldid = $(this).attr('id');
                    var tipo = $(this).attr('tipo');
                    //alert(tipo);
                    var tex = $(this).attr('id');
                    var id = tex.substr(0, (tex.length) - 2) + "_" + $parentid;
                    //alert(id);
                    //alert($parentid);
                    var labeltext = $parent.find('label[for="' + oldid + '"]').html();
                    //alert(labeltext);
                    //alert($(this).attr('tipo'));
                    if($(this).attr('tipo')=="multi"){
                        controlvarios++;
                        if(controlvarios>1){
                            $parent1 = $(this).parent().parent().parent().parent().parent().parent();

                            $parentid1 = parseInt($(this).attr("repeat")) + 1;
                            titlebox1 = $parent1.find('h2').first().text();
                            htm += '<div class="box col-md-12" is_multiple="true" rel="fatherclone" repeat="' + $parentid1 + '" ><div class="box-inner"><div class="box-header well" data-original-title=""><h2><i class="glyphicon glyphicon-th"></i>' + titlebox1 + '</h2><div class="box-icon"><a href="#" class="btn btn-block btn-round btn-default"><span><i class="glyphicon glyphicon-plus-sign blue" rel="can_clone""></i></span></i></a></div></div><div class="box-content">';
                        }

                    }else{
                        if ($(this).attr('tipo') == "date") {

                            htm += '<label for="' + id + '">' + labeltext + '</label><input inside_multiple="1" data_oa="<?php echo $actual_id?>" type="text" rel="datepicker" tipo="date" id="' + id + '" name="' + id + '" class="form-control data_metadato" placeholder="' + labeltext + '"/>'
                        } else {
                            if ($(this).attr('tipo') == "vmultiple") {
                                htm += '<label  for="' + id + '">' + labeltext + '</label><select inside_multiple="1" tipo="vmultiple"   data_oa="<?php echo $actual_id?>" id="' + id + '"  class="data_metadato_multiple" multiple name="' + id + '">';
                            } else {
                                if ($(this).attr('tipo') == "numero") {
                                    htm += '<label  for="' + id + '"><' + labeltext + '</label><input inside_multiple="1" tipo="numero" data_oa="<?php echo $actual_id?>" type="text" rel="numeric"   id="' + id + '"  name="' + id + '" class="form-control data_metadato" placeholder="' + labeltext + '"/>'
                                } else {
                                    if ($(this).attr('tipo') == "valores") {
                                        htm += '<div><label style="padding-top:10px" for="' + id + '">' + labeltext + '</label><select inside_multiple="1" tipo="valores" style="width: 100%;"    data_oa="<?php echo $actual_id?>" id="' + id + '"  class="data_metadato" name="' + id + '"></select></div>'
                                    } else {
                                        if ($(this).attr('tipo') == "text") {
                                            htm += '<label  for="' + id + '">' + labeltext + '</label><input inside_multiple="1" tipo="text" data_oa="<?php echo $actual_id?>" type="text" class="form-control data_metadato" id="' + id + '" name="' + id + '">'

                                        } else {
                                            if ($(this).attr('tipo') == "tmultiple") {
                                                htm += '<labelfor="' + id + '">' + labeltext + '</label><input inside_multiple="1" tipo="tmultiple"    data_oa="<?php echo $actual_id?>" type="text" class="col-lg-12 form-control data_metadato_multiple" style="width: 100%;" id="' + id + '" name="' + id + '" >'


                                            }else{
                                                if($(this).attr('tipo') == "cerrarmultiple"){
                                                    htm += '</div></div></div>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //alert($(this).attr("tipo"));
                    array.push(id);



                });

                //alert("este es el html a insertar "+htm);
                $($parent).after(htm);
                for (var l = 0; l < array.length; l++) {
                    //alert(array[l]);
                    var tipo = $(document).find($("#" + array[l])).attr('tipo');
                    //alert(tipo);
                    if (tipo == "tmultiple") {
                        $("#" + array[l]).tagsinput();
                    } else {
                        if (tipo == "vmultiple") {
                            var text = array[l];
                            //alert(text);
                            var res = text.substr(0, (text.length) - 2)+"_1";
                            //alert(res);
                            var options = $("#" + res + " > option").clone();
                            $("#" + array[l]).append(options);
                            $("#" + array[l]).chosen({width: '100%'});
                        } else {
                            if (tipo == "date") {
                                $("#" + array[l]).datepicker();
                                $("#" + array[l]).datepicker("option", "dateFormat", "yy-mm-dd");
                            } else {
                                if (tipo == "numero") {
                                    $("#" + array[l]).numeric();
                                } else {
                                    if (tipo == "valores") {
                                        //alert("valores");
                                        var text = array[l];
                                        var res = text.substr(0, (text.length) - 2)+"_1";
                                        //alert(res);
                                        var options = $("#" + res + " > option").clone();
                                        //alert(options);
                                        $("#" + array[l]).append(options);
                                        $("#" + array[l]).chosen();
                                    }
                                }
                            }
                        }
                    }
                }

            });
        });

        $(".guardarinfo").click(function () {

            var ultimo = "<?php echo ($k-1);?>";
            var encontro = "no";
            //alert(ultimo);
            var isultimo = $(this).attr('rel-form');
            var isultimo = isultimo.substr(4, isultimo.length);
            //alert(isultimo);
            if(parseInt(ultimo)==parseInt(isultimo)){
                var encontro = "si";
            }
            //alert(encontro);
            var arrayele = Array();
            var arraydatos = Array();
            var con = $(this).attr("rel-form");
            var itera = 0;
            var form = $("#"+con);
            var oa_id = "<?php echo $actual_id?>";
            var typeope = form.find('input[type=hidden]').val();
            var cantsend = true;
            form.find('[data_oa="<?php echo $actual_id?>"]').each(function(){

                if($(this).hasClass("required")){
                    if($(this).attr("tipo")=="text"){

                        if($(this).val()==""){
                            $(this).tooltip('show');
                            cantsend = false;
                        }
                    }
                    if($(this).attr("tipo")=="valores"){

                        if($(this).find("option:selected").val()=="0"){
                            $(this).next(".chosen-container").tooltip('show');
                            cantsend = false;
                        }
                    }
                    if($(this).attr("tipo")=="numero"){
                        if($(this).val()==""){
                            $(this).tooltip('show');
                            cantsend = false;
                        }
                    }
                    if($(this).attr("tipo")=="tmultiple"){

                        if($(this).val()==""){
                            $(this).tooltip('show');
                            cantsend = false;
                        }
                    }
                    if($(this).attr("tipo")=="vmultiple"){

                        if($(this).val()==null){
                            $(this).next(".chosen-container").tooltip('show');
                            cantsend = false;
                        }
                    }

                }

                if($(this).attr("tipo")!="multi"){
                    if($(this).attr("tipo")!="cerrarmultiple"){
                        arraydatos[itera] = ""+$(this).val();
                        arrayele[itera] = $(this).attr('id');
                        itera++;
                    }

                }

            });
            arraydatos = JSON.stringify(arraydatos);
            //alert(arraydatos);
            arrayele = JSON.stringify(arrayele);
            //if(ultimo)
            if(cantsend){
                $.ajax({
                    type:"get",
                    url:"<?php echo base_url()?>index.php/user/save_category/",
                    data:{datos:arraydatos, elementos:arrayele, hide:typeope, oa:oa_id, find:encontro},
                    success: function (response) {

                    }
                });
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-success');
                $(this).text("Actualizar Categoría");
            }
        });

        $(document).on("click", '[rel="can_unclone"]', function(){
            var $parent = $(this).parent().parent().parent().parent().parent().parent();
            var $parent2 = $(this).parent().parent().parent().parent().parent().parent().parent();

            var idconsecutivo, oa_id;
            $parent.find('[data_oa="<?php echo $actual_id?>"]').each(function () {
                idconsecutivo = $(this).attr('id');
                oa_id = "<?php echo $actual_id?>";
                //alert($(this).attr('id'));
            });
            var $consecutivo = parseInt(idconsecutivo.substring((idconsecutivo.length)-1));
            //alert($consecutivo)
            //alert(idconsecutivo);
            $.ajax({
                type:"get",
                url:"<?php echo base_url()?>index.php/user/delete_metadato/",
                data:{metadato:idconsecutivo, oa:oa_id},
                success: function (response) {

                }
            });

            //En caso de borrar un item se borrara de la base de datos e igualmente se debe reordenar los id
            var auxid;
            var sientro = 0;
            var auxconsecutivo, auxconsecutivo2;
            $parent2.find('[data_oa="<?php echo $actual_id?>"]').each(function () {
                auxid = $(this).attr('id');
                //alert(auxid);
                auxconsecutivo = parseInt(auxid.substring((auxid.length)-1));
                //alert(auxconsecutivo);
                if((auxconsecutivo>1)&&(auxconsecutivo>$consecutivo)){
                    auxconsecutivo2 = auxid.substring(0,(auxid.length)-1);
                    //alert(auxconsecutivo2);
                    $(this).attr('id', ""+auxconsecutivo2+$consecutivo);

                    sientro = 1;
                }
            });
            if(sientro==1){
                $parent2.find('.glyphicon-plus-sign').attr("repeat", ""+$consecutivo);
            }else{
                $parent2.find('.glyphicon-plus-sign').attr("repeat", ""+$consecutivo-1);
            }

            $parent.remove();
        });

    </script>


</div>
