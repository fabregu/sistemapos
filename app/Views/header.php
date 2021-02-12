<?php $user_session = session();?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>POS | IMPRESSIVE LINE</title>
        <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet"  />
        <link href="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>/js/jquery-ui/external/jquery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>/inicio">POS | IMPRESSIVE LINE</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user_session->nombre; ?> <i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Configuraciones</a>
                        <a class="dropdown-item" href="<?php echo base_url()?>/usuarios/cambia_password">Cambiar Contraseña</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php  echo base_url()?>/usuarios/logout">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Panel Principal</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                MENU
                            </a>
                            <a class="nav-link" href="<?php echo base_url(); ?>/ventas/pos">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                                PTV
                            </a>
                            <a class="nav-link" href="<?php echo base_url(); ?>/ventas">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Lista de Ventas
                            </a>

                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed"  href="#" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProductos" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/productos">Lista de Productos</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/productos/nuevo">Agregar Productos</a>
                                    
                                </nav>
                            </div>

                            <a class="nav-link collapsed"  href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/compras/nuevo">Agregar Compra</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/compras">Compras</a>
                                    
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Categorias
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategorias" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/categorias">Lista de Categorias</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/categorias/nuevo">Agregar Categorias</a>
                                    
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Clientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseClientes" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav ">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/clientes" >
                                        Listar Clientes
                                    </a> 
                                    <a class="nav-link" href="<?php echo base_url(); ?>/clientes/nuevo" >
                                        Agregar Clientes
                                    </a>                    
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGastos" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gastos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseGastos" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/gastos">Lista de Gastos</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/gastos/nuevo">Agregar Gastos</a>
                                    
                                </nav>
                            </div>
                            
                            <div class="sb-sidenav-menu-heading">Addons</div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguraciones" aria-expanded="false" aria-control="collapseConfiguracion">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Administración
                            </a>
                            
                            <div class="collapse" id="collapseConfiguraciones" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>/configuraciones">Configuraciones</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/usuarios">Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/roles">Roles</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false" aria-control="collapseReportes">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Reportes
                            </a>

                            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/muestraMinimos">Reportes de Mínimos
                                    </a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/configuraciones">Reportes de Ventas
                                    </a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>/usuarios">Reporte de Compras</a>
                                </nav>
                            </div>
                       
                        </div>
                    </div>
                    
                </nav>
            </div>