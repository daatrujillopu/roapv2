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
                        <?php foreach($collections as $key) {?>

                            <ul class="nav nav-pills nav-stacked main-menu">
                                <li class="accordion active">
                                    <a class="filteroascollection" href="<?=base_url()?>main/oas_objects_per_collection/<?=$key["idcollection"]?>"><span><?php echo $key["name"]; ?> </span><span style="float: right;">(<?=$numoas_collection[$key["idcollection"].$key["name"]]?>)</span>

                                    </a>

                                    <ul class="dashboard-list"  style="display: block; padding: 5px;">
                                        <?php foreach($subcollections as $key2){
                                            if($key2["idcollection"]==$key["idcollection"]){ ?>
                                                <li><a href="<?=base_url()?>main/oas_objects_per_subcollection/<?=$key["idcollection"]?>/<?=$key2["idsubcollection"]?>"><?php echo $key2["name"]; ?></a><span style="float: right; margin-right: 10px;">(<?=$numoas_subcollections[$key2["idsubcollection"].$key2["name"]]?>)</span></i></li>
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