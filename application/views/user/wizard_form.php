<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 27/02/15
 * Time: 03:23 PM
 */

?>
<div class="container" style="width: 100%">
    <div class="col-sm-12">
        <div class="row">
    <div id="rootwizard" >
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="width: 100%">
                    <ul style="width: 100%">
                        <li><a href="#tab1" data-toggle="tab">Como Desea ingresar los metadatos</a></li>
                        <li><a href="#tab2" data-toggle="tab" id="dynamictext"></a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="progress progress-striped progress-success active">
            <div class="progress-bar bar"></div>
        </div>
        <div class="container" style="width: 100%">
        <div class="tab-content">
            <div class="tab-pane" id="tab1">
                <div class="radio">
                    <label>
                        <input id="radioformu" type="radio" name="metadatatype" value="">
                        <span >Formulario</span>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input id="radioxml" type="radio" name="metadatatype" value="">
                        <span >
                            XML
                        </span>
                    </label>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="radio contenidoOA">
                    <div class="col-md-3">
                        <label>
                            <input id="archiveoa" type="radio" name="contentoa"  value="">
                            <span >Archivo</span>
                        </label>

                    </div>
                    <div class="col-md-9">
                        <input type="file" name="oaarchive" id="oaarchive">
                    </div>

                </div>
                <div class="radio contenidoOA" >
                    <div class="col-md-3">
                        <label>
                            <input id="referenceoa" type="radio" name="contentoa"  value="">
                            <span >Referencia</span>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control has-success">
                    </div>
                    <div class="col-md-6">

                    </div>

                </div>

                <div class="radio xmldata">

                        <div class="col-md-3">

                            <label>
                            <input id="uploadarchivexml" type="radio" name="contentoa"  value="">
                            <span >Subir Archivo</span>
                            </label>

                        </div>
                        <div class="col-md-9">
                            <input type="file" name="xmlarchive" id="xmlarchive">
                        </div>
                </div>
                <div class="radio xmldata">
                    <div class="col-md-3">
                        <label>
                            <input id="referencexml"type="radio" name="contentoa"  value="">
                            <span >Indicar Referencia</span>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control has-success">
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="radio xmldata">
                    <div class="col-md-12">
                        <label>
                            <input id="insidereferencexml" type="radio" name="contentoa"  value="">
                            <span >La localización está en el XML</span>
                        </label>

                    </div>

                </div>
            </div>
        </div>


            <ul class="pager wizard">
                <li class="previous first" style="display:none;"><a href="#">First</a></li>
                <li class="previous"><a href="#">Atras</a></li>
                <li class="next last" style="display:none;"><a href="#">Last</a></li>
                <li class="next"><a href="#">Siguiente</a></li>
            </ul>
        </div>
    </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#radioformu").change(function () {
            $("#dynamictext").text("¿Comó tiene el contenido del OA");
            $(".contenidoOA").show();
            $(".xmldata").hide();
        });

        $("#radioxml").change(function () {
            $("#dynamictext").text("¿Que desea hacer");
            $(".contenidoOA").hide();
            $(".xmldata").show();
        });
        $(".contenidoOA").hide();
        $(".xmldata").hide();

        $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {


            if(index==1){
                if((!$("#radioformu").is(":checked")) && !($("#radioxml").is(":checked"))){
                    alert("Debe elegir al menos una opción");
                    return false;
                }
            }


        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
        }, onTabClick:function(tab, navigation, index) {
            alert("No esta permitido realizar este click");
            return false;
        }});

        $("#oaarchive").on("change", function(){
            var inputfile = document.getElementById("oaarchive");
            var file = inputfile.files[0];
            var formdata = new FormData();
            formdata.append("archivo", file);

            $.ajax({
                url:"<?php echo base_url()?>index.php/user/uploadfile/",
                data: formdata,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (answer) {
                    alert("Se ha guardado correctamente el archivo");
                    window.location = "<?php echo base_url()?>user/form_metadata/"+answer;
                }
            });
        });


    });
</script>

