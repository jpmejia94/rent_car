<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="Movilbox" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>cPanel - Admin</title>

    <link href="../assets/css/funciones.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/css/bootstrap-material.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app-material.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="../assets/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading">
    <div id="wrapper">
        <div class="navbar-custom bg-dark">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"
                            data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="../assets/images/user.png" alt="user-image" class="rounded-circle">
                            <span class="hidden-xs" style="color: #FFF;">
                                <nousuario>Admin</nousuario>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <a href="#" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Configuración</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- LOGO -->
                <div class="logo-box">

                    <a href="?mod=principal" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="../assets/images/logotipo.png" alt="" height="15">
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logotipo.png" alt="" height="40">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- INICIO MENU -->
        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li title="Crear producto">
                            <a href="#" target="_parent">
                                <i data-feather="airplay"></i>
                                <span>Crear producto</span>
                            </a>
                        </li>
                        <li>
                        <li title="Reporte">
                            <a href="reportes.php" target="_parent">
                                <i data-feather="file"></i>
                                <span>Reporte</span>
                            </a>
                        </li>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- FIN MENU -->
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title" style="font-size:25px; text-align:center;">Creación de productos
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="box-body">
                                <!-- INICIO TABLA -->
                                <div id="consulta" style="display:none;" class="table card dt-responsive nowrap w-100">
                                    <div class="text-right col-md-13">
                                        <div class="text-lg-right" style="padding:10px">
                                            <button type="button"
                                                class="btn btn-success waves-effect waves-light mb-2 mr-2"
                                                id="btn_crear"><i class="mdi mdi-plus-circle mr-1"></i>Crear
                                                producto</button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="overflow-x: auto;">
                                        <table id="tbl_producto" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="mb-1 font-weight-bold text-muted">
                                                    <th>#</th>
                                                    <th>Imagen</th>
                                                    <th>Titulo</th>
                                                    <th>Modelo</th>
                                                    <th>Placa</th>
                                                    <th>Año</th>
                                                    <th>Valor</th>
                                                    <th>Disponibilidad</th>
                                                    <th>Ver más</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN TABLA -->

                    <!-- INICIO MODAL CREAR -->
                    <div id="modal_crear" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h4 class="modal-title" style="font-size: 23px;">Crear producto</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <form id="form_guardar" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    <div class="modal-body p-4">
                                        <input type="hidden" id="id_update">
                                        <p style="text-align: center;"><span class="fa fa-arrow-down"></span>Agrega aquí
                                            tus imagenes
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="mt-2" id="img_ini1"></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mt-2" id="img_ini2"></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mt-2" id="img_ini3"></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mt-2" id="img_ini4"></div>
                                            </div>
                                        </div> <br><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-1" class="control-label">Titulo</label>
                                                    <input type="text" class="form-control" id="titulo"
                                                        placeholder="Titulo" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Placa</label>
                                                    <input type="text" class="form-control" id="placa"
                                                        placeholder="Placa" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-4" class="control-label">Modelo</label>
                                                    <input type="text" class="form-control" id="modelo"
                                                        placeholder="Modelo" onkeyup="soloNum(this);" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Valor</label>
                                                    <input type="text" class="form-control" id="valor"
                                                        placeholder="Valor" onkeyup="formato(this);" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-6" class="control-label">Año</label>
                                                    <input type="text" class="form-control" id="anio" placeholder="Año"
                                                        onkeyup="soloNum(this);" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group no-margin">
                                                    <label for="field-7" class="control-label">Color</label>
                                                    <input class="form-control" type="color" id="color" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-info waves-effect waves-light"
                                            onclick="guardar_datos();">Guardar</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <!-- FIN MODAL CREAR -->

                    <!-- INICIO MODAL EDITAT -->

                    <div id="modal_editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h4 class="modal-title">Editar producto</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body p-4">
                                    <p style="text-align: center;"><span class="fa fa-arrow-down"></span>Agrega aquí
                                        tus imagenes
                                    <div class="row imagenes-edit">
                                        <div class="col-lg-3">
                                            <div class="mt-2" id="img_edit1"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mt-2" id="img_edit2"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mt-2" id="img_edit3"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mt-2" id="img_edit4"></div>
                                        </div>
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Titulo</label>
                                                <input type="text" class="form-control" id="titulo_edit"
                                                    placeholder="Titulo" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Placa</label>
                                                <input type="text" class="form-control" id="placa_edit"
                                                    placeholder="Placa" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-4" class="control-label">Modelo</label>
                                                <input type="text" class="form-control" id="modelo_edit"
                                                    placeholder="Modelo" onkeyup="soloNum(this);" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Valor</label>
                                                <input type="text" class="form-control" id="valor_edit"
                                                    placeholder="Valor" onkeyup="formato(this);" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Año</label>
                                                <input type="text" class="form-control" id="anio_edit" placeholder="Año"
                                                    onkeyup="soloNum(this);" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group no-margin">
                                                <label for="field-7" class="control-label">Color</label>
                                                <input class="form-control" type="color" id="color_edit" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light"
                                        id="btn_editar" onclick="editar_datos();">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FIN MODAL EDITAR -->

                    <!-- INICIO FOOTER -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Footer </b> ...
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- FIN FOOTER -->
                </div>
            </div>

            <!-- INICIO LIBRERIAS JS -->
            <script src="../assets/js/vendor.min.js"></script>
            <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
            <script src="../assets/js/app.min.js"></script>
            <script src="../assets/js/fun_cpanel.js"></script>
            <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
            <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
            <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="../assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
            <script src="../assets/libs/jquery-toast-plugin/jquery.toast.min.js"></script>
            <script src="../assets/js/pages/toastr.init.js"></script>
            <script src="../assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
            <script src="../assets/libs/dropzone/min/dropzone.min.js"></script>
            <script src="../assets/libs/dropify/js/dropify.min.js"></script>
            <script src="../assets/js/pages/form-fileuploads.init.js"></script>
            <script src="../assets/libs/dialogs/dist/bootstrap4-dialogs.js"></script>
</body>
</html>