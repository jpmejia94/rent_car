<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquiler de vehiculos</title>
    <link href="assets/css/funciones.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap-material.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="assets/css/app-material.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="assets/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <style>
        .dropify-wrapper {
            border: none;
            cursor: auto;
        }

        .dropify-wrapper .dropify-preview {
            background-color: #FDFDFD;
        }

        .dropify-wrapper .dropify-preview .dropify-infos {
            background: none;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-white bg-dark">
        <img src="assets/images/logotipo.png" width="200" class="d-inline-block align-top" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Vehiculos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Automoviles</a>
                        <a class="dropdown-item" href="#">Camionetas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Gama alta</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="col-md-2">
                    <h5 style="text-align: center;color:#FFF;">Buscar vehiculo</h5>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" id="txt_buscar" class="form-control" onkeyup="EjecutarBusqueda();">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button"
                                onclick="cargar_paginador(1,8)">Buscar</button>
                        </span>
                    </div>
                </div>
                <div class="btn btn-outline-success my-2 my-sm-0" onclick="$('#modal_login').modal('show');">cPanel
                </div>
            </form>
        </div>
    </nav>

    <div class="flex-container">
        <div style="width: 40%;margin-top: 20px;">
        </div>
    </div>

    <!-- INICIO SLIDER -->

    <div class="card card-default bg-dark" style="padding-top:15px;margin-bottom: 40px;min-height: 200px;">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: -30px;">
                <a data-slide="prev" id="flecha_izquierda" href="#carousel" class="left"><img
                        src="assets/images/ante.png" style="border: none;border-radius: inherit;margin-top: 50px;
            margin-left: -15px;position: absolute;z-index:99;"></a>
                <a data-slide="next" id="flecha_derecha"
                    style="background:url(assets/images/sigue.png) no-repeat;border: none; border-radius: inherit;"
                    href="#carousel" class="right"><img src="assets/images/sigue.png" style="border: none;border-radius: inherit;margin-top: 50px;
                margin-left: 94%;z-index: 99;position: absolute;"></a>
                <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000">
                    <div class="carousel-inner">
                    </div>
                    <a data-slide="next"
                        style="background:url(assets/images/sigue.png) no-repeat;border: none; border-radius: inherit;"
                        href="#carousel" class="right"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN SLIDER -->

    <!-- INICIO CONTENIDO PAGINA -->
    <div id="conte_pagina" style="padding-top:15px;min-height: 600px;">
    </div>
    <div class="col-md-12">
        <nav aria-label="..." style="float: right;">
            <ul id="paginador" class="pagination pagination-sm" style="float: right;margin-right: 5px;">
            </ul>
        </nav>
    </div>

    <!-- FIN CONTENIDO PAGINA -->

    <!--MODAL DETALLE-->
    <div id="modal_detalle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="margin-top:-15px; max-height:570px;">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="standard-modalLabel">Detalle vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" id="id_update-modal">
                            <input type="hidden" id="id_referencia-modal">
                            <div class="content-gallery">
                                <div id="imgLarge-modal">
                                    <img src='assets/images/not_available.png' id="not_img_modal"
                                        class='image-preview-edit gallerySlide'
                                        style="width:100%; display:block;opacity: 0.4;">
                                </div>
                            </div>
                            <section id="Images-edit" class="images-cards gallery" style="width: 150%;right: 40px;">
                                <div class="gallery-edit">
                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12"
                                        id="add-photo-container-modal" onclick="currentDiv_edit(index)"></div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h4 class="mb-2 product-price-edit" id="nombre_producto"></h4>
                                <h4 class="mb-3 product-title-edit" id="precio_producto"></h4>
                                <span class="strong-none" id="marca">&nbsp;</span>
                                <span class="strong-none" id="atributos">&nbsp;</span>
                                <h5 class="mb-2">Color:</h5>
                                <input class="form-control" id="color2" type="color"
                                    style="width: 70%;position: absolute;margin-top: -37px;margin-left: 47px;" disabled>
                            </div><br><br><br><br>
                            <button type="button" class="btn btn-success waves-effect waves-light" style="float: right;"
                                onclick="form_car()">
                                <span class="btn-label"><i class="mdi mdi-car-multiple"></i></span>Alquilar vehiculo
                            </button>
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"
                                style="float: right;">Cancelar</button>
                        </div>
                        <div class="col-lg-12"><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL DETALLE-->

    <!-- MODAL FORMULARIO-->
    <div class="modal modal2 fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="margin-left: -8px;height: 550px;margin-top:-10px;">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title">Solicitud de vehiculo - Item # <span id="id_item"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form_guardar" method="POST" autocomplete="off"
                                        enctype="multipart/form-data">

                                        <div id="basicwizard">

                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                                                <li class="nav-item">
                                                    <a href="#basictab1" data-toggle="tab"
                                                        class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-account-circle mr-1"></i>
                                                        <span class="d-none d-sm-inline">Información basica</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#basictab2" data-toggle="tab"
                                                        class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                        <span class="d-none d-sm-inline">Información alquiler</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content b-0 mb-0 pt-0">
                                                <div class="tab-pane" id="basictab1">
                                                    <input type="hidden" id="lat">
                                                    <input type="hidden" id="lon">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Nombre:</label>
                                                            <input type="text" class="form-control no_reload"
                                                                id="nombre" placeholder="Nombre"
                                                                onkeypress="return soloLetras(event)" required />
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label class="control-label">Apellido:</label>
                                                            <input type="text" class="form-control no_reload"
                                                                id="apellido" placeholder="Apellido"
                                                                onkeypress="return soloLetras(event)" required />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Correo electronico:</label>
                                                            <input type="text" class="form-control no_reload" id="email"
                                                                placeholder="Correo electronico" required />
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Tipo documento:</label>
                                                            <select id="t_doc" data-toggle="select" class="form-control"
                                                                required>
                                                                <option value="">SELECCIONAR</option>
                                                                <option value="1">Cedula Ciudadania</option>
                                                                <option value="2">Cedula Extranjeria</option>
                                                                <option value="3">Nit</option>
                                                                <option value="4">Nuip</option>
                                                                <option value="5">Pasaporte</option>
                                                                <option value="6">Registro Civil</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Documento:</label>
                                                            <input type="text" class="form-control no_reload"
                                                                id="documento" placeholder="N° Documento"
                                                                onkeyup="soloNum(this);" required />
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Medio de pago:</label>
                                                            <select id="t_pago" data-toggle="select"
                                                                class="form-control" required>
                                                                <option value="">SELECCIONAR</option>
                                                                <option value="1">Efectivo</option>
                                                                <option value="2">Tarjeta Crédito / Débito</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <ul class="list-inline mb-0 wizard">
                                                        <li class="next list-inline-item float-right">
                                                            <a href="javascript: void(0);"
                                                                class="btn btn-success next">Siguiente</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="tab-pane" id="basictab2">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label for="fecha" class="control-label">Fecha
                                                                Inicio:</label>
                                                            <div class='input-group date fecha_prod'>
                                                                <input type="text" id="f_ini_prod" class="form-control"
                                                                    required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-calendar-month"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label for="fecha" class="control-label">Fecha Fin:</label>
                                                            <div class='input-group date fecha_prod'>
                                                                <input type="text" id="f_fin_prod" class="form-control"
                                                                    required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-calendar-month"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label class="control-label">Vehiculo:</label>
                                                            <input type="text" class="form-control no_reload"
                                                                id="vehiculo" style="background: #DFDFDF" disabled />
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <label class="control-label">Modelo:</label>
                                                            <input type="text" class="form-control no_reload" id="mod"
                                                                style="background: #DFDFDF" disabled />
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <label class="control-label">Valor total:</label>
                                                            <input type="text" class="form-control no_reload"
                                                                id="precio_tot" placeholder="Valor total"
                                                                style="background: #DFDFDF" disabled />
                                                        </div>
                                                    </div><br><br>
                                                    <ul class="list-inline mb-0 wizard">
                                                        <li class="previous list-inline-item">
                                                            <a href="javascript: void(0);"
                                                                class="btn btn-success">Anterior</a>
                                                        </li>
                                                        <li class="next list-inline-item float-right">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <a href="javascript: void(0);" class="btn btn-success"
                                                                id="btn_save" onclick="guardar_form()">Confirmar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL FORMULARIO-->


    <!--INICIO MODAL LOGIN-->
    <div id="modal_login" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                    <h4 class="modal-title">Iniciar sesión</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <a href="index.html" class="text-success">
                            <span><img src="assets/images/logotipo.png" alt="" height="40"></span>
                        </a>
                    </div>
                    <form action="#" class="px-3">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input class="form-control" type="text" id="user" required="" placeholder="Ingrese su usuario">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input class="form-control" type="password" required="" id="password"
                                placeholder="Ingrese su contraseña">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-rounded btn-success" onclick="login();">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL LOGIN-->

    <!--INICIO FOOTER-->
    <footer class="page-footer font-small special-color-dark pt-4">
        <div class="container">
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item">
                    <a class="btn-floating btn-fb mx-1">
                        <i class="fab fa-facebook-f"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-tw mx-1">
                        <i class="fab fa-twitter"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-gplus mx-1">
                        <i class="fab fa-google-plus-g"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-li mx-1">
                        <i class="fab fa-linkedin-in"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-dribbble mx-1">
                        <i class="fab fa-dribbble"> </i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
        </div>
    </footer>

    <!--FIN FOOTER-->

    <!--INICIO LIBRERIAS JS-->

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/fun_index.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    <script src="assets/js/pages/toastr.init.js"></script>
    <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="assets/js/pages/form-wizard.init.js"></script>
    <script src="assets/libs/dropzone/min/dropzone.min.js"></script>
    <script src="assets/libs/dropify/js/dropify.min.js"></script>
    <script src="assets/js/pages/form-fileuploads.init.js"></script>
    <script src="assets/libs/dialogs/dist/bootstrap4-dialogs.js"></script>
</body>

</html>