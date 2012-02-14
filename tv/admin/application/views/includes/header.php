<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo; ?></title>
        <!-- include y librerias de la plantilla de administracion -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>PlantillaAdmin/img/favicon.ico" />
        <link href="<?php echo base_url(); ?>PlantillaAdmin/960.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaAdmin/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaAdmin/text.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaAdmin/admin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="main">
            <!-- comienzo de cabecera -->
            <div id="header">
<!--                <a href="<?php echo base_url(); ?>" class="logo">
                    <img class="logo_comfranklin" src="<?php echo base_url(); ?>PlantillaAdmin/img/logo.png"/>
                    Comercial Franklin
                </a>-->
                <?php
                $imagen_usuario = array(
                    'src' => base_url().'/PlantillaAdmin/img/User.png',
                    'class' => 'imagen_miniatura',
                    );
                $imagen_candado = array(
                    'src' => base_url().'/PlantillaAdmin/img/candado.png',
                    'class' => 'imagen_miniatura',
                    'alt' => 'hola'
                    );
                $esta_logueado = $this->session->userdata('esta_logueado');
                $idAdministrador = $this->session->userdata('idAdministrador');
                if ($esta_logueado == TRUE OR $idAdministrador != '') {
                    echo '<div class="container_12">';
                    echo '<div class="grid_12">';
                    echo '<div class="grid_2 prefix_10" id="datos_sesion">';
                    echo img($imagen_usuario).' Bienvenid@..! ' . $this->session->userdata('nombre');
                    //echo img($imagen_usuario).' Bienvenid@..! ' .anchor('administracion/mi_cuenta', $this->session->userdata('nombre'),'class="enlaces_datos_sesion"');
                    echo '</div>';
                    echo '<div class="grid_2 prefix_10" id="datos_sesion">';
                    echo img($imagen_candado).' '.anchor('administracion/cerrar_sesion', 'Cerrar Sesión','class="enlaces_datos_sesion"');
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                <ul id="top-navigation">
                    <li>
                        <a href="<?php echo base_url(); ?>" 
                           class="
                            <?php 
                            if(isset($menu_activo_inicio)){
                                echo $menu_activo_inicio;
                                unset($menu_activo_inicio);
                            }
                            ?>
                           ">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>categorias/mantenimiento_categorias" 
                           class="
                            <?php 
                            if(isset($menu_activo_catalogo)){
                                echo $menu_activo_catalogo;
                                unset($menu_activo_catalogo);
                            }
                            ?>
                           ">
                            Catálogo
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>ciudades/mantenimiento_ciudades" 
                           class="
                            <?php 
                            if(isset($menu_activo_localizacion)){
                                echo $menu_activo_localizacion;
                                unset($menu_activo_localizacion);
                            }
                            ?>
                           ">
                            Localización
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>promociones/mantenimiento_promociones" 
                           class="
                            <?php 
                            if(isset($menu_activo_descuento)){
                                echo $menu_activo_descuento;
                                unset($menu_activo_descuento);
                            }
                            ?>
                           ">
                            Descuentos
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>clientes/mantenimiento_clientes" 
                           class="
                            <?php 
                            if(isset($menu_activo_cliente)){
                                echo $menu_activo_cliente;
                                unset($menu_activo_cliente);
                            }
                            ?>
                           ">
                            Clientes
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>administracion/mantenimiento_administracion" 
                           class="
                            <?php 
                            if(isset($menu_activo_administracion)){
                                echo $menu_activo_administracion;
                                unset($menu_activo_administracion);
                            }
                            ?>
                           ">
                            Admministración
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>reportes/reporte_productos_mas_vendidos" 
                           class="
                            <?php 
                            if(isset($menu_activo_reportes)){
                                echo $menu_activo_reportes;
                                unset($menu_activo_reportes);
                            }
                            ?>
                           ">
                            Reportes
                        </a>
                    </li>
                    
<!--                   <li><a href="#" class="<?php //echo $variable_activo; ?>">Usuarios</a></li>-->
<!--                     <li><a href="#" class="<?php //echo $variable_activo; ?>">Ordenes</a></li>
                    <li><a href="#" class="<?php //echo $variable_activo; ?>">Configuración</a></li>
                    <li><a href="#" class="<?php //echo $variable_activo; ?>">Estadísticas</a></li>
                    <li><a href="#" class="<?php //echo $variable_activo; ?>">Diseño</a></li>
                    <li><a href="#" class="<?php //echo $variable_activo; ?>">Contenidos</a></li>
                    <li><a href="#" class="<?php //echo $variable_activo; ?>">Créditos</a></li>-->
                </ul>
            </div>
            <!-- fin de cabecera -->
            <div id="middle">