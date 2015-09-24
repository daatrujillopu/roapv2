<?php

function display_tree($nodes, $indent, $html, $idinput, $existsmul,$superpadre, $tipo) {
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
                            <i class="glyphicon glyphicon-plus-sign blue" tipo="multi" id="'.$temp.'">
                            </i>
                            </span>
                            </a>

                        </div>

                    </div>
                    <div class="box-content row"><div class="col-lg-12">';
        }

        if($node["tipo"]=="text"||$node["tipo"]=="valores"||$node["tipo"]=="numero"||$node["tipo"]=="tmultiple"||$node["tipo"]=="vmultiple"){
            if($existsmul>0){

                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"])) . "_1";
            }else{
                $temp = $idinput . str_replace(' ', '', strtolower($node["metadato"]));

            }
            if($tipo==1){

                if($node["mostrar"]==='t'){
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" checked class="showmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }else{
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" class="showmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }

            }elseif($tipo==3){
                if($node["mostrar"]==='t'){
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" checked class="" type="checkbox" disabled  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }elseif($node["show_hide_metadata"]==="t"){
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" checked class="showhidemetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }else{
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" class="showhidemetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }

            }elseif($tipo==4){
                if($node["is_searchable"]==='t'){
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" checked class="searchmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }else{
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" class="searchmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }
            }else{
                if($node["required_metadata"]==='t'){
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" checked class="requiredmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }else{
                    echo '<label style="float: left; margin-top: 20px; margin-bottom: 20px;" data-noty-options="{"text":"Cambios Guardados Exitosamente ","layout":"topRight","type":"success"}}" class="checkbox-inline"  for="' . $temp . '"><input inside_multiple="1" class="requiredmetadata" type="checkbox"  id="'.$temp.'">'. $node["etiqueta"] .' </label>';
                }
            }

        }


        if (isset($node['children'])) {
            if($node["tipo"]=="multiple"){
                //$existsmul++;
                $idinput = str_replace(' ', '', strtolower($node["metadato"])) . "_";
            }


            display_tree($node['children'], $indent + 1, $html, $idinput, $existsmul, $superpadre, $tipo);

            if($node["tipo"]=="multiple"){
                $idinput = $superpadre;
                $existsmul = $existsmul-1;
                echo '<input type="hidden" tipo="cerrarmultiple" id="'.$temp.'" name="'.$temp.'">';
                echo "</div>
                            </div>
                        </div>
                        </div></div>";

            }

        }

    }
}
?>
<div class="ch-container">
    <div class="row">
        <div id="content" class="col-lg-10 col-sm-10 center">
            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2><i class="glyphicon glyphicon-info-sign"></i> Administracion ROAP</h2>

                            <div class="box-icon">
                                <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        lass="glyphicon glyphicon-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="box-content row">
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#general">General</a></li>
                                    <li><a href="#showmetadata">Metadatos a Mostrar</a></li>
                                    <li><a href="#showhidemetadata">Metadatos Ocultos</a></li>
                                    <li><a href="#requiredmetadata">Metadatos Requeridos</a></li>
                                    <li><a href="#searchmetadata">Metadatos Busqueda</a></li>
                                    <li><a href="#colections">Colecciones</a></li>
                                    <li><a href="#users">Usuarios</a></li>
                                    <li><a href="#reportedlo">Objetos Reportados</a></li>
                                    <li><a href="#removedlo">Objetos Removidos</a></li>
                                    <li><a href="#language">Configurar Idioma</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane active" id="general">
                                        <div class="row">
                                            <div class="box col-md-12">
                                                <div class="box-inner">
                                                    <div class="box-header well">
                                                        <h2><i class="glyphicon glyphicon-info-sign"></i> Servicio de Envio Correos</h2>

                                                        <div class="box-icon">
                                                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-cog"></i></a>
                                                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="box-content row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" style="float: left;" for="smtpserver">Servidor SMTP</label>
                                                                <input type="text" id="smtpserver" class="form-control" placeholder="Servidor SMTP"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" style="float: left;" for="port">Puerto</label>
                                                                <input type="text" class="form-control" id="port" placeholder="Puerto"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" style="float: left;" for="from">Remitente</label>
                                                                <input type="text" class="form-control" id="from" placeholder="Remitente"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" style="float: left;" for="email">Email</label>
                                                                <input type="text" class="form-control" id="email" placeholder="Email"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" style="float: left;" for="email">Contraseña</label>
                                                                <input type="text" class="form-control" id="password" placeholder="Contraseña"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="box col-md-6">
                                                <div class="box-inner">
                                                    <div class="box-header well">
                                                        <h2><i class="glyphicon glyphicon-info-sign"></i> Conexión con FROAC</h2>

                                                        <div class="box-icon">
                                                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-cog"></i></a>
                                                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="box-content row">
                                                        <div class="col-lg-12 col-md-12">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box col-md-6">
                                                <div class="box-inner">
                                                    <div class="box-header well">
                                                        <h2><i class="glyphicon glyphicon-info-sign"></i>Conexion OAI-PMH</h2>

                                                        <div class="box-icon">
                                                            <a href="#" class="btn btn-setting btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-cog"></i></a>
                                                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="box-content row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="checkbox">
                                                                <label style="float: left;">
                                                                    <input type="checkbox" value="">
                                                                    Permitir ser consultado via OAI-PMH
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="showmetadata">
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


                                                    <?php

                                                    $idinput = str_replace(' ', '', strtolower($suppadres["metadato"])) . "_";
                                                    $form = display_tree(array($tree[$i]), 0, "", $idinput, 0,$idinput, 1);

                                                    ?>
                                            </div>
                                            <?php $i++;
                                                $l++;
                                            } ?>
                                        <br>
                                        <br>

                                    </div>
                                        </div>
                                    <div class="tab-pane" id="showhidemetadata">
                                        <div id="tabs2">
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


                                                    <?php

                                                    $idinput = str_replace(' ', '', strtolower($suppadres["metadato"])) . "_";
                                                    $form = display_tree(array($tree[$i]), 0, "", $idinput, 0,$idinput, 3);

                                                    ?>
                                                </div>
                                                <?php $i++;
                                                $l++;
                                            } ?>
                                            <br>
                                            <br>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="requiredmetadata">
                                        <div id="tabs1">
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


                                                    <?php

                                                    $idinput = str_replace(' ', '', strtolower($suppadres["metadato"])) . "_";
                                                    $form = display_tree(array($tree[$i]), 0, "", $idinput, 0,$idinput, 2);

                                                    ?>
                                                </div>
                                                <?php $i++;
                                                $l++;
                                            } ?>
                                            <br>
                                            <br>

                                        </div>

                                    </div>
                                    <div class="tab-pane" id="searchmetadata">
                                        <div id="tabs4">
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


                                                    <?php

                                                    $idinput = str_replace(' ', '', strtolower($suppadres["metadato"])) . "_";
                                                    $form = display_tree(array($tree[$i]), 0, "", $idinput, 0,$idinput, 4);

                                                    ?>
                                                </div>
                                                <?php $i++;
                                                $l++;
                                            } ?>
                                            <br>
                                            <br>

                                        </div>

                                    </div>
                                    <div class="tab-pane" id="colections">
                                        <br>
                                        <div class="col-lg-10"></div>
                                        <div class="col-lg-2">
                                            <button type="button" id="add_new_collection" class="btn btn-large btn-default">Agregar Colección</button>
                                        </div>

                                        <?php foreach($collections as $key) {?>
                                        <div class="box col-md-4">
                                            <div class="box-inner">
                                                <div class="box-header well" data-original-title="">
                                                    <h2><i class="glyphicon glyphicon-list"></i><?php echo " ".$key["name"]; ?></h2>
                                                    <div class="box-icon">
                                                        <a href="#" data-collection="<?=$key["idcollection"]?>" data-toggle="tooltip" title="Eliminar Colección" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-minus-sign"></i></a>
                                                        <a href="#" data-collection="<?=$key["idcollection"]?>" data-toggle="tooltip" title="Agregar Subcolección" class="btn btn-sm btn-primary add_subcollection"><i class="glyphicon glyphicon-plus-sign"></i></a>
                                                    </div>
                                                </div>
                                                <div class="box-content">
                                                    <div class="box-content">
                                                        <ul class="dashboard-list">
                                                            <?php foreach($subcollections as $key2){
                                                                if($key2["idcollection"]==$key["idcollection"]){ ?>
                                                                    <li>
                                                                        <a href="#" class="delete_subcollection" data-subcollection="<?=$key2["idsubcollection"]?>" data-collection="<?=$key["idcollection"]?>"><?php echo $key2["name"]; ?>
                                                                            <i class="glyphicon glyphicon-minus-sign pull-right"></i>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <div class="tab-pane" id="users">

                                    </div>
                                    <div class="tab-pane" id="reportedlo">

                                    </div>
                                    <div class="tab-pane" id="removedlo">

                                    </div>
                                    <div class="tab-pane" id="language">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addsubcollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Nueva Subcolección</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_collection">
                <label for="subcolletiontitle">Titulo Subcolección</label>
                <input type="text" class="form-control" id="subcolletiontitle">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="adding_subcollection" data-dismiss="modal">Guardar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addnewcollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Nueva Colección</h3>
            </div>
            <div class="modal-body">
                <div class="form-group" id="form-collection">
                    <label class="control-label" for="colletiontitle">Titulo Colección</label>
                    <input type="text" class="form-control" id="colletiontitle">
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="adding_collection">Guardar</a>
                <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(".glyphicon-minus-sign").click(function () {
        
    });

</script>

