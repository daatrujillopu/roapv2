<div class="ch-container">
    <div class="row">

        <div class="row">
            <div class="col-md-12 center login-header">
                <h2>Bienvenido a ROAP</h2>

            </div>
            <img src="<?php echo base_url()?>assets/img/rana.png" class="img-responsive center">

            <!--/span-->
        </div><!--/row-->

        <div class="row">
            <div class="well col-md-10 center login-box">
                <fieldset>
                    <button id="installerbutton" class="btn-primary btn">Comenzar la instalación</button>
                    <div id="rootwizard" >
                        <div class="navbar">
                            <div class="navbar-inner">
                                <div class="container" style="width: 100%">
                                    <ul style="width: 100%">
                                        <li><a href="#tab1" data-toggle="tab">Configuración Manual</a></li>
                                        <li><a href="#tab2" data-toggle="tab" >Usuario Administrador</a></li>
                                        <li><a href="#tab3" data-toggle="tab" >Estandar Metadatos</a></li>
                                        <li><a href="#tab4" data-toggle="tab" >Agregar Metadatos Propios</a></li>
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
                                    <h2>Bievenido al instalador de ROAP</h2>
                                    <p class="text-justify">Para empezar debes hacer algo por mi, debes entrar a la carpeta de este programa e ir a la 7
                                        siguiente direccion <span style='font-size: 16px; font-weight: bold;'>ROOT/application/config/config.php</span>, allí encontrará un archivo que contiene
                                    toda la configuracion del sistema, lo unico que debes hacer es comprobar que inea $config[base_url] es igual a la direccion url
                                        que vez en tu navegador, si es asi sigue al siguente parrafo, de no ser asi copia esta direccion despues del = en dicha url
                                    <?php   if(isset($_SERVER['HTTPS'])){ echo "<h3>https://".$_SERVER["HTTP_HOST"]."/".$_SERVER["REQUEST_URI"]."</h3>";}else{echo "<span style='font-size: 1em; font-weight: bold;'>"."http://".$_SERVER["HTTP_HOST"]."/".$_SERVER["REQUEST_URI"]."</span>";}?></p>
                                    <p class="text-justify">
                                        Una vez realizadala comprobacion anterior dirigite en la misma carpeta donde se encuentra el archivo config.php y localiza el archivo
                                        database.php, este archivo contiene informacion de conexcion a la base de datos, recuerda que ROAP esta optimizado para bases de datos
                                        Postgresql, debido a que se utilizan funciones propias de pgsql que pueden torpediar el funcionamiento en otras bases de datos, alli encontras
                                        una larga cadena de configuracion que tiene que tiene una cadena que comienza por <span style="font-weight: bold; font-size: 1em;"> $db['default']</span>,
                                    solo debes identificar el siguiente cadena que son de nuestra importancia <span style="font-size: 1em; font-weight: bold;">['hostname']='Direcion donde esta Alojado Postgresql', ['username'] = 'Usuario Postgresql',
                                            ['password'] = 'Contraseña del Usuario', ['database'] = 'Nombre de la Base de datos', ['dbdriver'] = 'postgre', este ultimo debe quedar como se muestra en el ejemplo</span>

                                    </p>
                                    <p class="text-justify">
                                        Una vez terminado estos 3 pasos puedes darle a siguiente
                                    </p>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="well col-md-10 center login-box">

                                        <div class="alert alert-danger">
                                            Ingrese los datos de acceso Administrador
                                        </div>

                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn red"></i></span>
                                            <input type="text" class="form-control user_admin_data" placeholder="Nombre" id="userfirstname">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn red"></i></span>
                                            <input type="text" class="form-control user_admin_data" placeholder="Apellido" id="userlastname">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-bell red"></i></span>
                                            <input type="text" class="form-control user_admin_data" placeholder="Email" id="useremail">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                            <input type="text" class="form-control user_admin_data" placeholder="Username" id="useradmin">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                            <input type="password" class="form-control user_admin_data" placeholder="Password" id="userpassword">
                                        </div>
                                        <br>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                            <input type="password" class="form-control user_admin_data" placeholder="Repeat Password" id="userrpassword">
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <p class="text-justify">Que estandar de metadatos deseas utilizar</p>
                                    <div class="well col-md-10 center login-box">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="base_estandar" id="base_estandar" value="LOM" checked="">
                                                Estandar LOM
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="base_estandar" id="base_estandar" value="LOMACC">
                                                Estandar Lom con Metadatos Accesibilidad
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="base_estandar" id="base_estandar" value="OWNmetadato">
                                                Propio Estandar De Metadatos
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4">
                                    <div class="col-lg-offset-10">
                                        <div class="row">
                                            <button class="btn btn-primary" id="agregar_metadato">Agregar Metadato</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="hot htRemoveRow handsontable htRowHeaders htColumnHeaders" style="width: 100%" id="metadatos_table">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <ul class="pager wizard">
                                <li class="previous first" style="display:none;"><a href="#">First</a></li>
                                <li class="previous"><a href="#">Atras</a></li>
                                <li class="next"><a href="#">Siguiente</a></li>
                                <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                            </ul>
                        </div>
                    </div>
                    <img id="ajaxload" src="<?php echo  base_url()?>assets/img/ajax-loaders/ajax-loader-7.gif" style="opacity: 1; display: none;">
                </fieldset>
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div><!--/.fluid-container-->
<script>
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }
    function create_user(){
        var sendata = {};
        sendata[$("#csrf_name").val()] = $("#csrf_token").val();
        sendata["first_name"] = $("#userfirstname").val();
        sendata["last_name"] = $("#userlastname").val();
        sendata["email"] = $("#useremail").val();
        sendata["username"] = $("#useradmin").val();
        sendata["password"] = $("#userpassword").val();

        $.ajax({
            url: "<?=base_url()?>index.php/installer/create_user_table/",
            data: sendata,
            type: "POST"
        }).done(function(){
            return true;
        });
    }
    $(function () {
        $("#installerbutton").click(function () {

        });

        $(".user_admin_data").keydown(function () {
           $(this).parent().removeClass('has-error');
        });





    });

    $(function () {

        function myAutocompleteRenderer(instance, td, row, col, prop, value, cellProperties) {
            Handsontable.AutocompleteCell.renderer.apply(this, arguments);
            td.style.fontStyle = 'italic';
            td.title = 'Type to show the list of options';
        }

        var LOMACC = [
            [1,"General","General","single","","false","false","false",0,"false","false","false","false"],
            [2,"Identifier","Identificador","multiple","","false","false","false",1,"false","false","false","false"],
            [3,"Catalog","Catalogo","text","","false","false","false",2,"false","false","false","false"],
            [4,"Entry","Entrada","text","","true","false","true",2,"false","false","false","false"],
            [5,"Title","Titulo","text","","true","false","true",1,"false","false","false","false"],
            [6,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","true","false","true",1,"false","false","false","false"],
            [7,"Description","Descripción","tmultiple","","false","false","true",1,"false","false","false","false"],
            [8,"Keywords","Palabras Claves","tmultiple","","true","false","true",1,"false","false","false","false"],
            [9,"Covergare","Cobertura","tmultiple","","true","false","false",1,"false","false","false","false"],
            [10,"Structure","Estructura","valores","atómica,colección,en red,jerárquica,lineal","true","false","true",1,"false","false","false","false"],
            [11,"Aggregation Level","Nivel de agregación","valores","1,2,3,4","true","false","true",1,"false","false","false","false"],
            [12,"Life Cycle","Ciclo de Vida","single","","false","false","false",0,"false","false","false","false"],
            [13,"Version","Versión","text","","true","false","true",12,"false","false","false","false"],
            [14,"Status","Estado","valores","borrador,Final,revisado,no disponible","false","true","false",12,"false","false","false","false"],
            [15,"Contribure","Contribución","multiple","","false","false","false",12,"false","false","false","false"],
            [16,"Role","Rol","valores","autor,desconocido,iniciador,terminador,revisor,editor,diseñador gráfico,desarrollador técnico,proveedor de contenidos, revisor técnico, revisor educativo,guionista,diseñador educativo,experto en la materia","false","false","false",15,"false","false","false","false"],
            [17,"Entity","Entidad","tmultiple","","false","false","false",15,"false","false","false","false"],
            [18,"Date","Fecha","date","","false","false","false",15,"false","false","false","false"],
            [19,"Meta Metadata","Meta metadata","single","","false","false","false",0,"false","false","false","false"],
            [20,"Identifier","Identificador","multiple","","false","false","false",19,"false","false","false","false"],
            [21,"Catalog","Catalogo","text","","false","false","false",20,"false","false","false","false"],
            [22,"Entry","Entrada","text","","false","false","false",20,"false","false","false","false"],
            [23,"Contribute","Contribuyente","multiple","","false","false","false",19,"false","false","false","false"],
            [24,"Role","Rol","valores","creador,revisor","true","false","false",23,"false","false","false","false"],
            [25,"Entity","Entidad","tmultiple","","false","false","false",23,"false","false","false","false"],
            [26,"Date","Fecha","date","","false","false","false",23,"false","false","false","false"],
            [27,"Metadata Schema","Esquema Metadatos","tmultiple","","false","false","false",19,"false","false","false","false"],
            [28,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","false","false","false",19,"false","false","false","false"],
            [29,"Technical","Técnica","single","","false","false","false",0,"false","false","false","false"],
            [30,"Format","Formato","tmultiple","","true","false","false",29,"false","false","true","false"],
            [31,"Size","Tamaño","text","","true","false","false",29,"false","false","false","true"],
            [32,"Location","Localización","tmultiple","","false","false","false",29,"true","false","false","false"],
            [33,"Requirement","Requisitos","multiple","","false","false","false",29,"false","false","false","false"],
            [34,"OrComposite","Compuesto","multiple","","false","false","false",33,"false","false","false","false"],
            [35,"Type","Tipo","valores","sistema operativo, navegador","false","false","false",34,"false","false","false","false"],
            [36,"Name","Nombre","text","","false","false","false",34,"false","false","false","false"],
            [37,"Minimum Version","Versión Minima","text","","false","false","false",34,"false","false","false","false"],
            [38,"Maximum Version","Versión Maxima","text","","false","false","false",34,"false","false","false","false"],
            [39,"Installation Remarks","Pautas de Instalación","text","","false","false","false",29,"false","false","false","false"],
            [40,"Other Platforms Requirements","Otros Requisitos de Plataforma","text","","false","false","false",29,"false","false","false","false"],
            [41,"Duration","Duración","text","","false","false","false",29,"false","false","false","false"],
            [42,"Educational","Educational","multiple","","false","false","false",0,"false","false","false","false"],
            [43,"Interactive Type","Tipo de interactividad","valores","activo,expositivo,mixto","true","false","false",42,"false","false","false","false"],
            [44,"Resource Learning Type","Tipo de Recurso Educativo","vmultiple","ejercicio,simulación,cuestionario,diagrama,figura,gráfico,indice,diapositiva,tabla,texto narrativo,exámen,experimento,planteamiento de problema,autoevaluación,conferencia","false","false","true",42,"false","false","false","false"],
            [45,"Interactivity Level","Nivel de Interactividad","valores","muy bajo,bajo,medio,alto,muy alto","false","false","false",42,"false","false","false","false"],
            [46,"Semantic Density","Densidad Semantica","valores","muy bajo,bajo,medio,alto,muy alto","false","false","false",42,"false","false","false","false"],
            [47,"Intended End User Role","Destinario","vmultiple","profesor,autor,aprendiz,administrador","false","false","false",42,"false","false","false","false"],
            [48,"Context","Contexto","vmultiple","escuela basica,escuela superior,entrenamiento,otro","false","false","false",42,"false","false","false","false"],
            [49,"Typical Age Range","Rango Típico de Edad","tmultiple","","false","false","false",42,"false","false","false","false"],
            [50,"Difficulty","Dificultad","valores","muy fácil,fácil,medio,dificil,muy dificil","false","false","false",42,"false","false","false","false"],
            [51,"Typical Learning Time","Tiempo Típicp de Apredizaje","text","","false","false","false",42,"false","false","false","false"],
            [52,"Description","Descripción","tmultiple","","false","false","false",42,"false","false","false","false"],
            [53,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","false","false","false",42,"false","false","false","false"],
            [54,"Rights","Derechos","multiple","","false","false","false",0,"false","false","false","false"],
            [55,"Cost","Costo","valores","si,no","false","false","false",54,"false","false","false","false"],
            [56,"Copy Right and Other Restrictios","Derechos de Autor y otras Restricciones","valores","si,no","false","false","false",54,"false","false","false","false"],
            [57,"Description","Descripción","text","","false","false","false",54,"false","false","false","false"],
            [58,"Relation","Relación","multiple","","false","false","false",0,"false","false","false","false"],
            [59,"Kind","Tipo","valores","es parte de,tiene parte,es la versión de,tiene versión,es el formato de,tiene formato,referencias,se hace referencia por,está basado en,es base para,necesario,es requerido por","false","false","false",58,"false","false","false","false"],
            [60,"Resource","Recurso","text","","false","false","false",58,"false","false","false","false"],
            [61,"Identifier","Identificador","multiple","","false","false","false",60,"false","false","false","false"],
            [62,"Catalog","Catalogo","text","","false","false","false",61,"false","false","false","false"],
            [63,"Entry","Entrada","text","","false","false","false",61,"false","false","false","false"],
            [64,"Description","Descripción","tmultiple","","false","false","false",58,"false","false","false","false"],
            [65,"Annotation","Anotación","multiple","","false","false","false",0,"false","false","false","false"],
            [66,"Entity","Entidad","text","","false","false","false",65,"false","false","false","false"],
            [67,"Date","Fecha","date","","false","false","false",65,"false","false","false","false"],
            [68,"Description","Descripción","text","","false","false","false",65,"false","false","false","false"],
            [69,"Classification","Clasificación","multiple","","false","false","false",0,"false","false","false","false"],
            [70,"Purpose","Proposito","text","","true","false","false",69,"false","false","false","false"],
            [71,"Taxon Path","Ruta Taxonómica","multiple","","false","false","false",69,"false","false","false","false"],
            [72,"Source","Fuente","text","","false","false","false",71,"false","false","false","false"],
            [73,"Taxon","Taxon","multiple","","false","false","false",71,"false","false","false","false"],
            [74,"Id","Id","text","","false","false","false",73,"false","false","false","false"],
            [75,"Entry","Entrada","text","","false","false","false",73,"false","false","false","false"],
            [76,"Description","Descripción","text","","false","false","false",69,"false","false","false","false"],
            [77,"Keywords","Palabras Clave","tmultiple","","false","false","false",69,"false","false","false","false"],
            [78,"Accesibility","Accesibilidad","single","","false","false","false",0,"false","false","false","false"],
            [79,"Has Sign Alternative","Tiene Signos Alternativos","valores","si,no","true","false","false",78,"false","false","false","false"],
            [80,"Has Text Alternative","Tiene Texto Alternativo","valores","si,no","false","false","false",78,"false","false","false","false"],
            [81,"Has Auditory Alternative","Tiene Alternativa auditiva","valores","si,no","false","false","false",78,"false","false","false","false"],
            [82,"Control Mechanism","Mecanismo de Control","valores","mouse,teclado,mouse-teclado","false","false","false",78,"false","false","false","false"]];

        var LOM = [
            [1,"General","General","single","","false","false","false",0,"false","false","false","false"],
            [2,"Identifier","Identificador","multiple","","false","false","false",1,"false","false","false","false"],
            [3,"Catalog","Catalogo","text","","false","false","false",2,"false","false","false","false"],
            [4,"Entry","Entrada","text","","true","false","true",2,"false","false","false","false"],
            [5,"Title","Titulo","text","","true","false","true",1,"false","false","false","false"],
            [6,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","true","false","true",1,"false","false","false","false"],
            [7,"Description","Descripción","tmultiple","","false","false","true",1,"false","false","false","false"],
            [8,"Keywords","Palabras Claves","tmultiple","","true","false","true",1,"false","false","false","false"],
            [9,"Covergare","Cobertura","tmultiple","","true","false","false",1,"false","false","false","false"],
            [10,"Structure","Estructura","valores","atómica,colección,en red,jerárquica,lineal","true","false","true",1,"false","false","false","false"],
            [11,"Aggregation Level","Nivel de agregación","valores","1,2,3,4","true","false","true",1,"false","false","false","false"],
            [12,"Life Cycle","Ciclo de Vida","single","","false","false","false",0,"false","false","false","false"],
            [13,"Version","Versión","text","","true","false","true",12,"false","false","false","false"],
            [14,"Status","Estado","valores","borrador,Final,revisado,no disponible","false","true","false",12,"false","false","false","false"],
            [15,"Contribure","Contribución","multiple","","false","false","false",12,"false","false","false","false"],
            [16,"Role","Rol","valores","autor,desconocido,iniciador,terminador,revisor,editor,diseñador gráfico,desarrollador técnico,proveedor de contenidos, revisor técnico, revisor educativo,guionista,diseñador educativo,experto en la materia","false","false","false",15,"false","false","false","false"],
            [17,"Entity","Entidad","tmultiple","","false","false","false",15,"false","false","false","false"],
            [18,"Date","Fecha","date","","false","false","false",15,"false","false","false","false"],
            [19,"Meta Metadata","Meta metadata","single","","false","false","false",0,"false","false","false","false"],
            [20,"Identifier","Identificador","multiple","","false","false","false",19,"false","false","false","false"],
            [21,"Catalog","Catalogo","text","","false","false","false",20,"false","false","false","false"],
            [22,"Entry","Entrada","text","","false","false","false",20,"false","false","false","false"],
            [23,"Contribute","Contribuyente","multiple","","false","false","false",19,"false","false","false","false"],
            [24,"Role","Rol","valores","creador,revisor","true","false","false",23,"false","false","false","false"],
            [25,"Entity","Entidad","tmultiple","","false","false","false",23,"false","false","false","false"],
            [26,"Date","Fecha","date","","false","false","false",23,"false","false","false","false"],
            [27,"Metadata Schema","Esquema Metadatos","tmultiple","","false","false","false",19,"false","false","false","false"],
            [28,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","false","false","false",19,"false","false","false","false"],
            [29,"Technical","Técnica","single","","false","false","false",0,"false","false","false","false"],
            [30,"Format","Formato","tmultiple","","true","false","false",29,"false","false","true","false"],
            [31,"Size","Tamaño","text","","true","false","false",29,"false","false","false","true"],
            [32,"Location","Localización","tmultiple","","false","false","false",29,"true","false","false","false"],
            [33,"Requirement","Requisitos","multiple","","false","false","false",29,"false","false","false","false"],
            [34,"OrComposite","Compuesto","multiple","","false","false","false",33,"false","false","false","false"],
            [35,"Type","Tipo","valores","sistema operativo, navegador","false","false","false",34,"false","false","false","false"],
            [36,"Name","Nombre","text","","false","false","false",34,"false","false","false","false"],
            [37,"Minimum Version","Versión Minima","text","","false","false","false",34,"false","false","false","false"],
            [38,"Maximum Version","Versión Maxima","text","","false","false","false",34,"false","false","false","false"],
            [39,"Installation Remarks","Pautas de Instalación","text","","false","false","false",29,"false","false","false","false"],
            [40,"Other Platforms Requirements","Otros Requisitos de Plataforma","text","","false","false","false",29,"false","false","false","false"],
            [41,"Duration","Duración","text","","false","false","false",29,"false","false","false","false"],
            [42,"Educational","Educational","multiple","","false","false","false",0,"false","false","false","false"],
            [43,"Interactive Type","Tipo de interactividad","valores","activo,expositivo,mixto","true","false","false",42,"false","false","false","false"],
            [44,"Resource Learning Type","Tipo de Recurso Educativo","vmultiple","ejercicio,simulación,cuestionario,diagrama,figura,gráfico,indice,diapositiva,tabla,texto narrativo,exámen,experimento,planteamiento de problema,autoevaluación,conferencia","false","false","true",42,"false","false","false","false"],
            [45,"Interactivity Level","Nivel de Interactividad","valores","muy bajo,bajo,medio,alto,muy alto","false","false","false",42,"false","false","false","false"],
            [46,"Semantic Density","Densidad Semantica","valores","muy bajo,bajo,medio,alto,muy alto","false","false","false",42,"false","false","false","false"],
            [47,"Intended End User Role","Destinario","vmultiple","profesor,autor,aprendiz,administrador","false","false","false",42,"false","false","false","false"],
            [48,"Context","Contexto","vmultiple","escuela basica,escuela superior,entrenamiento,otro","false","false","false",42,"false","false","false","false"],
            [49,"Typical Age Range","Rango Típico de Edad","tmultiple","","false","false","false",42,"false","false","false","false"],
            [50,"Difficulty","Dificultad","valores","muy fácil,fácil,medio,dificil,muy dificil","false","false","false",42,"false","false","false","false"],
            [51,"Typical Learning Time","Tiempo Típicp de Apredizaje","text","","false","false","false",42,"false","false","false","false"],
            [52,"Description","Descripción","tmultiple","","false","false","false",42,"false","false","false","false"],
            [53,"Language","Idioma","vmultiple","Español,English,Português,French,,Russian,Japanese,Latin,Afar,Abkhazian,Afrikaans,Amharic,Arabic,,Assamese,Aymara,Azerbaijani,Bashkir,Byelorussian,Bulgarian,Bihari,,Bislama,Bengali,Bangla,,Tibetan,Breton,Catalan,Corsican,Czech,Welsh,Danish,German,Bhutani,Greek,,Esperanto,Estonian,Basque,Persian,Finnish,Fiji,Faeroese,Frisian,,ga,Irish,Scots,Galician,Guarani,Gujarati,Hausa,,Hindi,Croatian,Hungarian,Armenian,Interlingua,Interlingue,Inupiak,Indonesian,Icelandic,Italian,Hebrew,Yiddish,Javanese,,Georgian,Kazakh,Greenlandic,Cambodian,Kannada,Korean,Kashmiri,Kurdish,Kirghiz,Lingala,Laothian,Lithuanian,Latvian-Lettish,Malagasy,Maori,Macedonian,Malayalam,Mongolian,Moldavian,Marathi,Malay,Maltese,Burmese,Nauru,Nepali,Dutch,Norwegian,Occitan,(Afan)Oromo,Oriya,Punjabi,Polish,Pashto-Pushto,Quechua,Rhaeto-Romance,Kirundi,,Romanian,Kinyarwanda,Sanskrit,Sindhi,Sangro,Serbo-Croatian,Singhalese,Slovak,Slovenian,Samoan,Shona,Somali,Albanian,Serbian,Siswati,Sesotho,Sundanese,Swedish,Swahili,Tamil,Tegulu,Tajik,Thai,Tigrinya,Turkmen,Tagalog,Setswana,Tonga,Turkish,Tsonga,Tatar,Twi,Ukrainian,Urdu,Uzbek,Vietnamese,Volapuk,Wolof,Xhosa,Yoruba,Chinese,Zulu","false","false","false",42,"false","false","false","false"],
            [54,"Rights","Derechos","multiple","","false","false","false",0,"false","false","false","false"],
            [55,"Cost","Costo","valores","si,no","false","false","false",54,"false","false","false","false"],
            [56,"Copy Right and Other Restrictios","Derechos de Autor y otras Restricciones","valores","si,no","false","false","false",54,"false","false","false","false"],
            [57,"Description","Descripción","text","","false","false","false",54,"false","false","false","false"],
            [58,"Relation","Relación","multiple","","false","false","false",0,"false","false","false","false"],
            [59,"Kind","Tipo","valores","es parte de,tiene parte,es la versión de,tiene versión,es el formato de,tiene formato,referencias,se hace referencia por,está basado en,es base para,necesario,es requerido por","false","false","false",58,"false","false","false","false"],
            [60,"Resource","Recurso","text","","false","false","false",58,"false","false","false","false"],
            [61,"Identifier","Identificador","multiple","","false","false","false",60,"false","false","false","false"],
            [62,"Catalog","Catalogo","text","","false","false","false",61,"false","false","false","false"],
            [63,"Entry","Entrada","text","","false","false","false",61,"false","false","false","false"],
            [64,"Description","Descripción","tmultiple","","false","false","false",58,"false","false","false","false"],
            [65,"Annotation","Anotación","multiple","","false","false","false",0,"false","false","false","false"],
            [66,"Entity","Entidad","text","","false","false","false",65,"false","false","false","false"],
            [67,"Date","Fecha","date","","false","false","false",65,"false","false","false","false"],
            [68,"Description","Descripción","text","","false","false","false",65,"false","false","false","false"],
            [69,"Classification","Clasificación","multiple","","false","false","false",0,"false","false","false","false"],
            [70,"Purpose","Proposito","text","","true","false","false",69,"false","false","false","false"],
            [71,"Taxon Path","Ruta Taxonómica","multiple","","false","false","false",69,"false","false","false","false"],
            [72,"Source","Fuente","text","","false","false","false",71,"false","false","false","false"],
            [73,"Taxon","Taxon","multiple","","false","false","false",71,"false","false","false","false"],
            [74,"Id","Id","text","","false","false","false",73,"false","false","false","false"],
            [75,"Entry","Entrada","text","","false","false","false",73,"false","false","false","false"],
            [76,"Description","Descripción","text","","false","false","false",69,"false","false","false","false"],
            [77,"Keywords","Palabras Clave","tmultiple","","false","false","false",69,"false","false","false","false"]];

        var own = [
            [1,"","","","","false","false","false",0,"false","false","false","false"]];

        function isEmptyRow(instance, row) {
            var rowData = instance.getData()[row];

            for (var i = 0, ilen = rowData.length; i < ilen; i++) {
                if (rowData[i] !== null) {
                    return false;
                }
            }

            return true;
        }

        var container = document.getElementById('metadatos_table');
        var hot = new Handsontable(container, {
            data: LOM,
            minSpareRows: 0,
            rowHeaders: true,
            outsideClickDeselects: true,
            colHeaders: ["No.","Metadata","Etiqueta","Tipo","Valores","Mostrar","Mostrar Oculto","Metadata Requerido","Padre Directo","Es Localización?", "Buscar", "Es Formato?", "Es Tamaño?"],
            contextMenu: true,
            colWidths: [50, 60, 60, 60, 300, 60, 60, 60, 60, 60, 60, 60, 60],
            stretchH: 'all',
            rowHeaders: true,
            columns: [
                {type: 'text'},
                {type: 'text'},
                {type: 'text'},
                {type: 'autocomplete',
                    source: ["single", "text", "date", "valores","multiple", "tmultiple", "vmultiple", "numero"],
                    strict: true
                },
                {type: 'text'},
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'numeric'},
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
                {type: 'autocomplete',
                    source: ["true", "false"],
                    strict: true
                },
            ],
            afterCreateRow: function(e, t){
                var itera = e;
                hot.setDataAtCell(e, 0, e + 1);
                hot.setDataAtCell(e, 3, "text");
                hot.setDataAtCell(e, 5, "false");
                hot.setDataAtCell(e, 6, "false");
                hot.setDataAtCell(e, 7, "false");
                hot.setDataAtCell(e, 9, "false");
                hot.setDataAtCell(e, 10, "false");
                hot.setDataAtCell(e, 11, "false");
                hot.setDataAtCell(e, 12, "false");

                setnewdataincell(itera, hot.countRows()-1);


            },
        });

        function setnewdataincell(itera, numrows){

            for(itera+1; itera<=numrows; itera++){
                hot.setDataAtCell(itera, 0, itera+1);
            }
        }


        $( "input[type=radio]" ).on( "click", function() {

            if($(this).val()==="LOM"){
                hot.loadData(LOM);
            }else{
                if($(this).val()=="LOMACC"){
                    hot.loadData(LOMACC);
                }else{
                    hot.loadData(own);
                }

            }
        });

       /* hot.
        $("#agregar_metadato").click(function(e) {
            hot.alter('insert_row');
            var last = hot.countRows();
            ht.alter('insert_row');
            ht.setDataAtCell(last, 0, last + 1);
            ht.setDataAtCell(last, 3, "text");
            ht.setDataAtCell(last, 5, "text");
            ht.setDataAtCell(last, 6, "text");
            ht.setDataAtCell(last, 7, "text");
            ht.setDataAtCell(last, 9, "false");
            ht.setDataAtCell(last, 10, "false");
            ht.setDataAtCell(last, 11, "false");
            ht.setDataAtCell(last, 12, "false");
        });*/

        $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {


            if(index==2){
                var control = 0
                $(".user_admin_data").each(function () {
                    if($(this).val()===""){
                        $(this).parent().addClass("has-error");
                        control=1;
                    }

                });

                if(!validateEmail($("#useremail").val())){
                    control=1;
                    $("#useremail").parent().addClass("has-error");
                }
                if($("#userpassword").val()!==$("#userrpassword").val()){
                    control=1;
                    $("#userrpassword").parent().addClass("has-error")
                }
                if(control==1){
                    return false;
                }else{
                    create_user();
                }

            }

            if(index==4){
                $("#ajaxload").show();

                var hansontable = hot.getInstance();
                console.log(hot.getData())//var hansontable = JSON.stringify(tablemetadatos.getData());
                var sendata = {};
                sendata[$("#csrf_name").val()] = $("#csrf_token").val();
                sendata["datametadata"] = JSON.stringify(hansontable.getData());

                $.ajax({
                    url: "<?php echo base_url()?>index.php/installer/create_big_table",
                    data: sendata,
                    type: "POST"

                }).done(function () {
                    $("#ajaxload").hide();
                    window.location.href = "<?php echo base_url()?>admin/"

                });
            }


        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});

            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }, /*onTabClick:function(tab, navigation, index) {
         alert("No esta permitido realizar este click");
         return false;
         }*/});
    });




</script>

<!-- external javascript -->