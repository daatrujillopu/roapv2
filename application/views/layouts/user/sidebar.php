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
                <div class="nav-canvas"  style="overflow:scroll; max-height:768px;">
                    <div class="nav-sm nav nav-stacked" >

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
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
                        <ul class="nav nav-pills nav-stacked main-menu">
                            <li class="nav-header">Main</li>
                            <li><a class="ajax-link" href="index.html"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                            </li>
                            <li><a class="ajax-link" href="ui.html"><i class="glyphicon glyphicon-eye-open"></i><span> UI Features</span></a>
                            </li>
                            <li><a class="ajax-link" href="form.html"><i
                                        class="glyphicon glyphicon-edit"></i><span> Forms</span></a></li>
                            <li><a class="ajax-link" href="chart.html"><i class="glyphicon glyphicon-list-alt"></i><span> Charts</span></a>
                            </li>
                            <li><a class="ajax-link" href="typography.html"><i class="glyphicon glyphicon-font"></i><span> Typography</span></a>
                            </li>
                            <li><a class="ajax-link" href="gallery.html"><i class="glyphicon glyphicon-picture"></i><span> Gallery</span></a>
                            </li>
                            <li class="nav-header hidden-md">Sample Section</li>
                            <li><a class="ajax-link" href="table.html"><i
                                        class="glyphicon glyphicon-align-justify"></i><span> Tables</span></a></li>
                            <li class="accordion">
                                <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Accordion Menu</span></a>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Child Menu 1</a></li>
                                    <li><a href="#">Child Menu 2</a></li>
                                </ul>
                            </li>
                            <li><a class="ajax-link" href="calendar.html"><i class="glyphicon glyphicon-calendar"></i><span> Calendar</span></a>
                            </li>
                            <li><a class="ajax-link" href="grid.html"><i
                                        class="glyphicon glyphicon-th"></i><span> Grid</span></a></li>
                            <li><a href="tour.html"><i class="glyphicon glyphicon-globe"></i><span> Tour</span></a></li>
                            <li><a class="ajax-link" href="icon.html"><i
                                        class="glyphicon glyphicon-star"></i><span> Icons</span></a></li>
                            <li><a href="error.html"><i class="glyphicon glyphicon-ban-circle"></i><span> Error Page</span></a>
                            </li>
                            <li><a href="login.html"><i class="glyphicon glyphicon-lock"></i><span> Login Page</span></a>
                            </li>
                        </ul>
                        

                        
                    </ul>
                    
                </div>
            </div>
        </div>

        <!--/span-->
        <!-- left menu ends -->