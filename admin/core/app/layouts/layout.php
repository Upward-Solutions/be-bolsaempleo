<?php
function hayUsuarioAutenticado(): bool
{
    return isset($_SESSION["user_id"]);
}

function userName(): string
{
    return UserData::getById($_SESSION["user_id"])->name;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bolsa de Empleo | Administrador</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <link href="dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css"/>
    <script src="plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="plugins/morris/raphael-min.js"></script>
    <script src="plugins/morris/morris.js"></script>
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/morris/example.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link href='plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet'/>
    <link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print'/>
    <script src='plugins/fullcalendar/moment.min.js'></script>
    <script src='plugins/fullcalendar/fullcalendar.min.js'></script>
    <link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.css">
    <link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.date.css">
    <link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.time.css">
    <script src='plugins/pickadate/picker.js'></script>
    <script src='plugins/pickadate/picker.date.js'></script>
    <script src='plugins/pickadate/picker.time.js'></script>
    <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css"/>
    <script src='plugins/select2/select2.min.js'></script>
</head>

<body class="skin-blue-light sidebar-mini">
    <?php if (hayUsuarioAutenticado()): ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="./" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>B</b>E</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Bolsa de Empleo</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="">
                                    <?php echo userName(); ?>
                                </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="./logout.php" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">ADMINISTRACI&Oacute;N</li>
                    <?php $u = UserData::getById($_SESSION["user_id"]); ?>
                    <li><a href="./index.php?view=home"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
                    <li><a href="./index.php?view=persons"><i class='fa fa-file-text'></i> <span>Solicitudes</span></a></li>
                    <li><a href="./index.php?view=jobs&opt=all"><i class='fa fa-flash'></i><span>Ofertas</span></a></li>
                    <li><a href="./?view=places&opt=all"><i class="fa fa-map-marker"></i>Lugares</a></li>
                    <li><a href="./?view=categories&opt=all"><i class="fa fa-tags"></i>Categor&iacute;as</a></li>
                    <li><a href="./?view=users"><i class='fa fa-user'></i> <span>Usuarios</span></a></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <?php View::load("index"); ?>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2023 <a href="https://www.psi.uba.ar/bienestar/index.php" target="_blank">Bienestar
                    Estudiantil</a></strong>
        </footer>
    <?php else: ?>
        <?php View::load("login"); ?>
    <?php endif; ?>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="dist/js/app.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".pickadate").pickadate({format: 'yyyy-mm-dd', min: '<?php echo date('Y-m-d', time() - (24 * 60 * 60)); ?>'});
        $(".pickatime").pickatime({format: 'HH:i', interval: 10});
    })
</script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datatable").DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>
</body>
</html>

