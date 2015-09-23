/**
 * Created by danny on 12/07/15.
 */
var base_url = $("#urlda").val();
$(function () {
    //Activar tabs para el administrador
    $("#tabs").tabs();
    $("#tabs").tabs({
        active: 0
    });
//Activar tabs para el administrador
    $("#tabs1").tabs();
    $("#tabs1").tabs({
        active: 0
    });

    $("#tabs2").tabs();
    $("#tabs2").tabs({
        active: 0
    });
    /**
     * Envio de datos para mostrar datos en el menu
     */
    $(".showmetadata").change(function (e) {
        e.preventDefault();
        var sendata = {};
        sendata[$("#csrf_name").val()] = $("#csrf_token").val();
        sendata["id"] = $(this).attr('id');
        var state = "FALSE";
        if ($(this).is(":checked")) {
            state = "TRUE"
        }
        sendata["state"] = state;
        $.ajax({
            url: base_url + "index.php/admin/change_show_metadata/",
            type: "POST",
            data: sendata
        }).done(function () {

            var n = ({
                text: "Cambios Guardados Completamente",
                layout: "topRight",
                type: "information",
                animateOpen: {"opacity": "show"}

            });

            noty(n);
        });
    });

    $(".showhidemetadata").change(function (e) {
        e.preventDefault();
        var sendata = {};
        sendata[$("#csrf_name").val()] = $("#csrf_token").val();
        sendata["id"] = $(this).attr('id');
        var state = "FALSE";
        if ($(this).is(":checked")) {
            state = "TRUE"
        }
        sendata["state"] = state;
        $.ajax({
            url: base_url + "index.php/admin/change_show_hide_metadata/",
            type: "POST",
            data: sendata
        }).done(function () {

            var n = ({
                text: "Cambios Guardados Completamente",
                layout: "topRight",
                type: "information",
                animateOpen: {"opacity": "show"}

            });

            noty(n);
        });
    });


    $(".requiredmetadata").change(function (e) {
        e.preventDefault();
        var sendata = {};
        sendata[$("#csrf_name").val()] = $("#csrf_token").val();
        sendata["id"]= $(this).attr('id');
        var state = "FALSE";
        if($(this).is(":checked")){
            state = "TRUE"
        }
        sendata["state"] = state;
        $.ajax({
            url: base_url+"index.php/admin/change_required_metadata/",
            type: "POST",
            data: sendata
        }).done(function(){
            var n = ({
                text: "Cambios Guardados Completamente",
                layout: "topRight",
                type: "information",
                animateOpen: {"opacity": "show"}

            });
            noty(n);
        });

    });

    $(".add_subcollection").click(function (e) {
        e.preventDefault();
        $("#id_collection").val($(this).attr('data-collection'));
        $("#addsubcollection").modal('show');
    });
    $("#adding_subcollection").click(function (e) {
        var senddata = {};
        senddata[$("#csrf_name").val()] = $("#csrf_token").val();
        senddata["collection_id"] = $("#id_collection").val();
        senddata["subcollection_title"] = $("#subcolletiontitle").val();
        $.ajax({
            url: base_url + "index.php/admin/new_subcollection/",
            data: senddata,
            type: "POST"
        }).done(function () {
            location.reload();
        });
    });

    $(".delete_subcollection").click(function (e) {
        var subcollection = $(this).attr('data-subcollection');
        bootbox.confirm("Estas seguro de borrar esta subcolección?", function(result) {
            if(result===true){
                var senddata = {};
                senddata[$("#csrf_name").val()] = $("#csrf_token").val();
                senddata["subcollection_id"] = subcollection;

                $.ajax({
                    url: base_url+"index.php/admin/delete_subcollection",
                    data: senddata,
                    type: "POST"
                }).done(function () {
                    location.reload();
                });
            }
        });
    });


    $("#add_new_collection").click(function () {
        $("#addnewcollection").modal('show');
    });

    $("#colletiontitle").keydown(function () {
        $("#form-collection").removeClass('has-error');
    });
    $("#adding_collection").click(function () {
       if($("#colletiontitle").val()===""){
           $("#form-collection").addClass('has-error');
       }else{
           var senddata = {};
           senddata[$("#csrf_name").val()] = $("#csrf_token").val();
           senddata["collection_title"] = $("#colletiontitle").val();
           $.ajax({
               url: base_url+"index.php/admin/add_new_collection/",
               data: senddata,
               type: "POST"
           }).done(function () {
               location.reload();
           });
       }
    });
});
