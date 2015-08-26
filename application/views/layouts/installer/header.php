<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 28/05/15
 * Time: 03:19 PM
 */
?>

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
    <title>Roap Installer</title>
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

    <!--HandSonTable -->
    <link rel="stylesheet" media="screen" href="<?=base_url()?>assets/bower_components/handsontable/dist/handsontable.full.css">
    <link href='<?php echo base_url()?>assets/css/jquery.handsontable.removeRow.css' rel='stylesheet'>
    <link rel="stylesheet" media="screen" href="<?=base_url()?>assets/bower_components/handsontable/plugins/bootstrap/handsontable.bootstrap.css">

    <!-- The fav icon -->

    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.ico">

</head>

<body>
<div style="display:none">
    <input type="hidden" id="urlda" value="<?=base_url()?>">
    <input type="hidden" id="csrf_name" value="<?= $this->security->get_csrf_token_name()?>">
    <input type="hidden" id="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
</div>
