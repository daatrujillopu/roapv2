<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Free HTML5 Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="<?php echo base_url()?>assets/css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="<?php echo base_url()?>assets/css/charisma-app.css" rel="stylesheet">
    <link href='<?php echo base_url()?>assets/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?php echo base_url()?>assets/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/jquery.noty.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/elfinder.min.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/uploadify.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>assets/css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.ico">

</head>

<body>
<input type="hidden" id="urlda" value="<?=base_url()?>">
<input type="hidden" id="csrf_name" value="<?= $this->security->get_csrf_token_name()?>">
<input type="hidden" id="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
<div class="ch-container">
    <div class="row">

        <div class="row">
            <div class="col-md-12 center login-header">
                <img src="<?php echo base_url()?>assets/img/rana.png" />
                <div class="row">
                    <h2>Nuevo Usuario-ROAP</h2>
                </div>


            </div>
            <!--/span-->
        </div><!--/row-->
        <div class="row"></div>
        <div class="row">
            <div class="well col-md-5 center login-box">
                <!--<div class="alert alert-info">
                    Please login with your Username and Password.
                </div>-->
                <?php
                $attributes = array("onsubmit"=>" return new_user_control()");
                echo form_open('index.php/login/create_new_user/', $attributes );
                ?>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn red"></i></span>
                        <input type="text" title="Este campo es obligatorio" class="form-control user_admin_data" placeholder="Nombre"  name="userfirstname" id="userfirstname">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn red"></i></span>
                        <input type="text" title="Este campo es obligatorio"  class="form-control user_admin_data" placeholder="Apellido" name="userlastname" id="userlastname">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-bell red"></i></span>
                        <input type="text" title="Este campo es obligatorio"  class="form-control user_admin_data" placeholder="Email" name="useremail" id="useremail">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" title="Este campo es obligatorio"  class="form-control user_admin_data" placeholder="Username" name="useradmin" id="useradmin">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" title="Este campo es obligatorio"  class="form-control user_admin_data" placeholder="Password" name="userpassword" id="userpassword">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" title="Este campo es obligatorio"  class="form-control user_admin_data" placeholder="Repeat Password" name="userrpassword" id="userrpassword">
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Registrarse</button>

                    </p>
                </fieldset>
                </form>
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div><!--/.fluid-container-->

<script>
    $("#useradmin").focusout(function () {
        var sendata = {};
        sendata[$("#csrf_name").val()] = $("#csrf_token").val();
        sendata["username"] = $("#useradmin").val();
        $.ajax({
            url: "<?=base_url()?>index.php/login/check_user_name/",
            data: sendata,
            type: "POST"
        }).done(function (msg) {
            if(msg=="true"){
                $("#useradmin").attr('title', "El username ya se encuentra en uso escoge otro");
                $("#useradmin").tooltip();
                $("#useradmin").parent().addClass("has-error");
                $("#useradmin").focus();
            }
        });
    });
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }

    $(".user_admin_data").keydown(function () {
        $(this).parent().removeClass('has-error');
    });
    function required_field() {
        $(".user_admin_data").each(function () {
            if ($(this).val() === "") {
                $(this).parent().addClass("has-error");
            }

        });
    }
    function new_user_control(){
        if($("#userfirstname").val()===""){
            required_field();
            return false;
        }
        if($("#userlastname").val()===""){
            required_field();
            return false;
        }
        if($("#useremail").val()===""){
            required_field();
            return false;
        }else{
            if(!validateEmail($("#useremail").val())){
                $("#useremail").attr('title', "Se requiere que sea un email valido");
                $("#useremail").tooltip();
                $("#useremail").parent().addClass("has-error");
                $("#useremail").focus();
                required_field();
                return false;
            }
        }
        if($("#userpassword").val()===""){
            required_field();
            return false;
        }else{
            if($("#userrpassword").val()===""){

            }else{
                if($("#userrpassword").val()!==("#userpassword").val()){
                    $("#userrpassword").attr('title', "Las contraseñas deben coincidir");
                    $("#useremail").tooltip();
                    return false;
                }
            }
        }

    }

</script>
<!-- external javascript -->

<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?php echo base_url()?>assets/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?php echo base_url()?>assets/bower_components/moment/min/moment.min.js'></script>
<script src='<?php echo base_url()?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?php echo base_url()?>assets/js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="<?php echo base_url()?>assets/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo base_url()?>assets/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?php echo base_url()?>assets/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?php echo base_url()?>assets/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo base_url()?>assets/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url()?>assets/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url()?>assets/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url()?>assets/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url()?>assets/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo base_url()?>assets/js/charisma.js"></script>


</body>
</html>
