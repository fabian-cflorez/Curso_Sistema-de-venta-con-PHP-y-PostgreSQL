<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel de Administración</title>
        <link href="<?php echo base_url;?>Assets/css/styles.css" rel="stylesheet" />
        <!--<link href="<?php echo base_url;?>Assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />-->
        <!--<link href="<?php echo base_url;?>Assets/DataTables/datatables.min.js.css" rel="stylesheet" crossorigin="anonymous" />-->
        <link href="<?php echo base_url;?>Assets/DataTables/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?php echo base_url;?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">POS VENTA</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-user-alt mr-2"></i>Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url;?>Usuarios/salir"><i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools mr-2 text-primary fa-2x"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url;?>Usuarios"><i class="fas fa-user mr-2 text-warning fa-2x"></i> Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Cajas"><i class="fas fa-store-alt mr-2 text-warning fa-2x"></i>Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Administracion"><i class="fas fa-tools mr-2 text-warning fa-2x"></i>Configuracion</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users text-primary fa-2x"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Medidas">
                                <div class="sb-nav-link-icon"><i class="fas fa-balance-scale-left text-primary fa-2x"></i></div>
                                Medidas
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                                <div class="sb-nav-link-icon"><i class="fas fa-bezier-curve text-primary fa-2x"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Productos">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt text-primary fa-2x"></i></div>
                                Productos
                            </a>
                        <!--
                                <a class="nav-link" href="<?php echo base_url; ?>Compras" onclick="cargarDetalle()">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt text-primary"></i></div>
                                Compras
                            </a>
                        -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart text-primary mr-2 fa-2x"></i></div>
                                Entradas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url;?>Compras"><i class="fas fa-shopping-cart text-warning mr-2 fa-2x"></i> Nueva compra</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Compras/historial"><i class="fas fa-list mr-2 text-warning fa-2x"></i>Historial compras</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-2">