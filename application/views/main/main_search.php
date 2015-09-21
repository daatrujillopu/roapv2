<div class="box-header well" data-original-title="">
    <h2><i class="glyphicon glyphicon-user"></i><?=$container_titlesearch?> <span style="margin-left: 20px;">Objetos Encontrados (<?=count($metadatossearch)?>)</span></h2>
    <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                class="glyphicon glyphicon-chevron-up"></i></a>
        <a href="#" class="btn btn-close btn-round btn-default"><i
                class="glyphicon glyphicon-remove"></i></a>
    </div>
</div>
<div class="box-content">
    <div class="box-content" >
        <?php
        if(count($metadatossearch)>0) {
            $keysarray = array_keys($metadatossearch[0]);
            $keysarray2 = array_keys($hide_metadatossearch[0]);
            foreach ($metadatossearch as $key) {
                for ($i = 0; $i < count($keysarray); $i++) {
                    if ($keysarray[$i] != "id_oa") {
                        $son = $keysarray[$i];
                        $son1 = explode("_", $son);
                        ?>
                        <?php if ($i == 0) { ?>
                            <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2>
                                    <i class="glyphicon glyphicon-user"></i><?php echo $key[$keysarray[$i]] ?>
                                </h2>

                                <div class="box-icon">
                                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                            class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round btn-default"><i
                                            class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content row">
                            <div class="col-md-8 col-md-8">

                        <?php } else {
                            ?><?php echo '<div class="col-sm-12"><strong>' . end($son1) . ":</strong> " . $key[$keysarray[$i]] . "</div>"; ?>
                            <?php
                        }
                    }
                }
                ?>
                <div class="col-lg-offset-11">
                    <button class="btn btn-success btn-round showing_hide" data-status="hide"
                            data-id="hide_info_<?= $key["id_oa"] ?>">Ver Mas
                    </button>
                </div>
                </div>
                <div class="col-md-4 col-md-8">
                    <?php foreach ($oas_usersearch as $own_user) { ?>

                        <div class="col-sm-12">
                            <strong>Subido
                                por:</strong><?php if ($own_user["idlo"] == $key["id_oa"]) echo $own_user["name"] . " " . $own_user["lastname"] ?>
                        </div>
                        <div class="col-sm-12">
                            <strong>Fecha de
                                subida:</strong> <?php if ($own_user["idlo"] == $key["id_oa"]) echo date("d-m-Y", strtotime($own_user["insertiondate"])) ?>
                        </div>
                        <div class="col-sm-12">
                            <strong>Valoración:</strong> Danny
                        </div>
                        <div class="col-sm-12">
                            <strong>Calidad de los metadatos:</strong> Danny
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label"><strong>Opciones:</strong></label>
                                <a href="<?= base_url() ?>main/download_oa"
                                   class="btn btn-xs btn-round blue btn-default"><i
                                        class="glyphicon glyphicon-arrow-down"></i></a>
                                <a href="<?= base_url() ?>main/get_xml_oa"
                                   class="btn btn-xs btn-round blue btn-default"><i
                                        class="glyphicon glyphicon-book"></i></a>
                            </div>


                        </div>
                        <div class="col-sm-12">
                            <strong>Descargas:</strong> 0
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-8 col-md-12" style="display:none;"
                     id="hide_info_<?= $key["id_oa"] ?>">
                    <?php foreach ($hide_metadatossearch as $key2) {
                        for ($j = 0; $j < count($keysarray2); $j++) {
                            if ($keysarray2[$j] != "id_oa") {
                                if ($key2["id_oa"] == $key["id_oa"]) {
                                    $son1 = $keysarray2[$j];
                                    $son11 = explode("_", $son1); ?>
                                    <?php echo '<div class="col-sm-12"><strong>' . end($son11) . ":</strong> " . $key2[$keysarray2[$j]] . "</div>"; ?>


                                <?php }

                            }
                        }
                    } ?>
                </div>
                </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

</div>