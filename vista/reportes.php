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
    <link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />

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
                            <a href="cpanel.php" target="_parent">
                                <i data-feather="airplay"></i>
                                <span>Crear producto</span>
                            </a>
                        </li>
                        <li>
                        <li title="Reporte">
                            <a href="#" target="_parent">
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
                                <h4 class="page-title" style="font-size:25px; text-align:center;">Reporte productos
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="box-body">
                                <!-- INICIO TABLA -->
                                <div id="consulta" class="table card dt-responsive nowrap w-100">
                                    <div class="col-md-2"
                                        style="float: left;margin-left: 250px;margin-top: 12px; position: absolute;">
                                    </div>
                                    <div class="text-right col-md-13">
                                        <div class="text-lg-right" style="padding:10px">
                                            <button type="button" id="filtros"
                                                class="btn btn-success waves-effect waves-light mb-2 mr-2"><i
                                                    class="fas fa-filter"></i></button>
                                            <button type="button" id="eli_filtros" title="Eliminar filtros"
                                                class="btn btn-success waves-effect waves-light mb-2 mr-2"
                                                onclick="eli_filtro()"><i class="fas fa-filter">×</i></button>
                                            <button type="button" id="CSV" title="Descargar CSV"
                                                class="btn btn-success waves-effect waves-light mb-2 mr-2"><i
                                                    class="fas fa-file-csv mr-2 font-18 vertical-middle"></i>CSV</button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="overflow-x: auto;">
                                        <table id="t_reporte" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="mb-1 font-weight-bold text-muted">
                                                    <th class="all">#</th>
                                                    <th class="all">Nombre</th>
                                                    <th>Email</th>
                                                    <!--<th>Tipo documento</th>
                                                    <th>Documento</th>-->
                                                    <th class="all">Vehiculo</th>
                                                    <th class="all">Placa</th>
                                                    <th class="all">Modelo</th>
                                                    <th class="all">Fecha inicio</th>
                                                    <th class="all">Fecha fin</th>
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
                    <div class="modal modal2 fade" id="modal_filtros" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h4 class="modal-title">Parametros de Busqueda</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form name="form_busqueda" method="post" id="frm_buscar_pedidos" action="#"
                                        autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha_ini" class="control-label">Fecha Inicio:</label>
                                                    <div class='input-group date fecha'>
                                                        <input type="text" name="fecha_ini" id="fecha_inicio"
                                                            class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-calendar-month"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha_fin" class="control-label">Fecha Fin:</label>
                                                    <div class='input-group date fecha'>
                                                        <input type="text" name="fecha_fin" id="fecha_fin"
                                                            class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-calendar-month"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect"
                                                data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-success waves-effect waves-light"
                                                onclick="consultar(1)">Filtrar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- FIN MODAL CREAR -->

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
            <script src="../assets/js/fun_report.js"></script>
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
            <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
            <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js"
                charset="UTF-8"></script>
</body>

</html>