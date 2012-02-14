<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo ?></title>
        <!-- include y librerias de la plantilla de comfranklin -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>PlantillaComfranklin/images/favicon.ico" />
        <link href="<?php echo base_url(); ?>PlantillaComfranklin/960.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaComfranklin/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaComfranklin/text.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>PlantillaComfranklin/mi estilo.css" rel="stylesheet" type="text/css" />
        <!-- include y estilos para las tablas de lista de productos -->
        <link href="<?php echo base_url(); ?>PlantillaComfranklin/table-images/style.css" rel="stylesheet" type="text/css" />
        <!-- include y estilos para el cuadro de busqueda de productos-->
        <link href="<?php echo base_url(); ?>/CuadroBusqueda/styles/global.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>/CuadroBusqueda/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/CuadroBusqueda/js/effects.js"></script>
        <!-- include y estilos para el carrusel de imagenes por producto -->
        <link href="<?php echo base_url(); ?>/CarruselImagenes/css/skin.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/CarruselImagenes/css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery-1.4.1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery.jcarousel.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('#carousel').jcarousel();
                $('#carousel a').lightBox();
            });
        </script>
    </head>
    <body>
        <!-- script para plugin de facebook -->
        <div id="fb-root"></div>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!-- contenido del header -->
        <div id="header" class="container_12">
            <div id="contend_header" class="grid_12">
                <div id="logo" class="grid_1">
                    <?php
                    $logo_propiedades = array(
                        'src' => base_url() . 'PlantillaComfranklin/images/logo.png',
                        'class' => 'comfranklin',
                    );
                    echo anchor(base_url(), img($logo_propiedades));
                    ?>
                </div>
                
        <!-- script para radio top latino -->
<!--        <embed pluginspage="http://www.adobe.com/go/getflashplayer"src="http://cadenatop.com/cadenatop_mini.swf" width="1" height="1" wmode="transparent" type="application/x-shockwave-flash" allowscriptaccess="always"></embed>-->
                <div class="grid_9" id="sesion">
                    <?php
                    $imagen_propiedades = array(
                        'src' => base_url() . '/PlantillaComfranklin/iconos/User.png',
                        'class' => 'imagen_miniatura',
                    );
                    echo img($imagen_propiedades);
                    ?>
                    Bienvenid@...! 
                    <?php
                    $is_logged_in = $this->session->userdata('is_logged_in');
                    $id_cliente = $this->session->userdata('id_cliente');
                    if ($is_logged_in == TRUE OR $id_cliente != '') {
                        echo $this->session->userdata('nombre');
                    } else {
                        echo anchor('clientes/login', 'Entrar');
                    }
                    ?>
                </div>
                <div class="container_12">
                    <div class="grid_6 prefix_6">
                        <?php
                        $this->load->helper('form');
                        ?>
                        <div id="wrap">
                            <div id="wrap-search" >
                                <div id="search">
                                    <?php
                                    $atributos = array('class' => 'form-search close');
                                    echo form_open('productos/buscar_productos', $atributos);
                                    ?>
                                    <div id="icn-search"><div id="icn1"></div></div>
                                    <div id="icn-close"><div id="icn2"></div></div>
                                    <input type="text" name="search" value="Buscar" />
                                    <?php
                                    echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- contenido del menu categorias -->
        <div id="menu_categorias" class="container_12">
            <div class="espacio">
            </div>
            <?php
            $imagen_inicio = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Home.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_mision = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Document.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_donde = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Contact.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_tiendas = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/shopping-basket.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_contactenos = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Headphones.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_mapa = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Digg.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_acerca = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Favorite.png',
                'class' => 'imagen_miniatura',
            );
            $imagen_radio = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Music.png',
                'class' => 'imagen_miniatura',
            );
            ?>
            <div class="grid_12">
                <a href="<?php echo base_url(); ?>" ><?= img($imagen_inicio) . '  '; ?>Inicio</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/mision_vision" ><?= img($imagen_mision) . '  '; ?>Misión y Visión</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/donde_estamos" ><?= img($imagen_donde) . '  '; ?>Donde Estamos</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/nuestras_tiendas" ><?= img($imagen_tiendas) . '  '; ?>Nuestras Tiendas</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/contactenos" ><?= img($imagen_contactenos) . '  '; ?>Contactenos</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/mapa_sitio" ><?= img($imagen_mapa) . '  '; ?>Mapa del Sitio</a>
                <a href="<?php echo base_url(); ?>informacion_corporativa/acerca_de" ><?= img($imagen_acerca) . '  '; ?>Acerca de</a>
                <?php
                $atts = array(
                'width' => '270',
                'height' => '260',
                'scrollbars' => 'no',
                'toolbar' => 'no',
                'location' => 'no',
                'status' => 'no',
                'resizable' => 'no',
                'screenx' => '300',
                'screeny' => '150'
                );
                echo anchor_popup('informacion_corporativa/top_latino_radio', img($imagen_radio) .'   Escuchar Radio!', $atts);
                ?>
<!--                <a href="<?php echo base_url(); ?>informacion_corporativa/top_latino_radio" ><?= img($imagen_radio) . '  '; ?>Acerca de</a>-->
            </div>
        </div>
        <!-- contenido del cuerpo dividido en 3 columnas(izquierda,centro,derecha) -->
        <div id="contenido" class="container_12">