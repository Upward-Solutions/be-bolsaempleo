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
            <li class="header">ADMINISTRACION</li>
            <?php $u = UserData::getById($_SESSION["user_id"]); ?>
            <li><a href="./index.php?view=home"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
            <li><a href="./index.php?view=persons"><i class='fa fa-file-text'></i> <span>Solicitudes</span></a>
            </li>
            <li><a href="./index.php?view=jobs&opt=all"><i class='fa fa-flash'></i><span>Ofertas</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>Catalogos</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="./?view=places&opt=all"><i class="fa fa-circle-o"></i> Lugares</a></li>
                    <li><a href="./?view=categories&opt=all"><i class="fa fa-circle-o"></i> Categorias</a>
                    </li>
                </ul>
            </li>
            <li><a href="./?view=users"><i class='fa fa-user'></i> <span>Usuarios</span></a></li>
        </ul>
    </section>
</aside>
<div class="content-wrapper">
    <?php View::load("index"); ?>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs"><b>Version</b> v1.1</div>
    <strong>Copyright &copy; 2023 <a href="https://www.psi.uba.ar/bienestar/index.php" target="_blank">Bienestar
            Estudiantil</a></strong>
</footer>
