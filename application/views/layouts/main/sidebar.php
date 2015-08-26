<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 20/11/14
 * Time: 06:48 PM
 */
?>

<div class="ch-container">
    <div class="row">

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2"  >
            <div class="sidebar-nav" >
                <div class="nav-canvas"  style="overflow:auto; max-height:768px;">
                    <div class="nav-sm nav nav-stacked" >

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu" style="padding: 5px;">
                        <li class="nav-header">Colecciones</li>
                        <!--<php/*
                        foreach ($colecciones['coleccion'] as $key) {
                            $id_coleccion = $key['idcollection'];
                            $i = 0;
                            foreach ($colecciones['subcoleccion'] as $key2) {
                                if($key2['idcollection']==$id_coleccion){
                                    $i++;
                                }
                            }
                            if($i > 0){?>
                                <li class="accordion active">
                                    <a href="#"><i class="glyphicon glyphicon-plus"></i><span><php echo $key['name']. " (".$key['numobjects'].")"?></span></a>
                                    <ul style="display:block; font-size:13px !important;" class="nav nav-pills nav-stacked">
                                    <php foreach ($colecciones['subcoleccion'] as $key2) {
                                        if($key2['idcollection']==$id_coleccion){
                                            if($key2['name']!=$key['name']){?>
                                            <li><a href="#"><php echo $key2['name']." (".$key2['numobjects'].")" ?></a></li>

                                       <php } }
                                    }       ?>


                                </ul>
                           <php } else{

                                ?>
                                <li><a class="ajax-link" href="index.html"><i class="glyphicon glyphicon-home"></i><span><php echo $key['name']." (".$key['numobjects'].")"?></span></a> </li>
                                <php
                            }
                            }
                        ?>-->
                        <?php foreach($collections as $key) {?>

                        <ul class="nav nav-pills nav-stacked main-menu">
                            <li class="accordion">
                                <a class="filteroascollection" href="<?=base_url()?>main/oas_objects_per_collection/<?=$key["idcollection"]?>"><span><?php echo $key["name"]; ?></span>

                                </a>

                                <ul class="dashboard-list"  style="display: block; padding: 5px;">
                                    <?php foreach($subcollections as $key2){
                                        if($key2["idcollection"]==$key["idcollection"]){ ?>
                                            <li><a href="<?=base_url()?>main/oas_objects_per_subcollection/<?=$key["idcollection"]?>/<?=$key2["idsubcollection"]?>"><?php echo $key2["name"]; ?></a></i></li>
                                        <?php } ?>


                                    <?php } ?>

                                </ul>
                            </li>

                        </ul>

                        <?php } ?>
                        

                        
                    </ul>
                    
                </div>
            </div>
        </div>
        <script>
            $(function(){
                $(".filteroascollection").on("click", function () {
                    window.location.href = $(this).attr('href');
                })
            });
        </script>

        <!--/span-->
        <!-- left menu ends -->