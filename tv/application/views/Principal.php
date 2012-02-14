<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_inicio = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Home.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
              <?= img($imagen_inicio).'';?>&nbsp;&nbsp;&nbsp;Bienvenida
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_7">
        <?php
        $imagen_inicio = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Home.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Bienvenidos a Comercial Franklin&nbsp;&nbsp;&nbsp;<?= img($imagen_inicio);?></h1>
        <p>
            Para Comfranklin Cia Ltda. Es un gusto poner a su disposición una variedad de productos en dos amplios locales en los cuales puedes encontrar electronica, muebles, ropa, calzado,  juguetes, motos, herramientas.
        </p>
        <!-- Pagina de plugin carrusel apple -->
        <html>
            <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/CarruselApple/demo.css" />
<!--        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>/CarruselApple/jquery-1.3.2.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>/CarruselApple/script.js"></script>
            </head>
            <body>
                <div id="main">
                <div id="gallery">
                    <div id="slides">
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/iphone.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/equipo.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/refri.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/imac.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/apple-ipod-nano-4g.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/varios.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipod.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/macbook.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipodtouch.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/blackberry.jpg" width="550" height="250" alt="side" /></div>
                        <div class="slide"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipodclasic.jpg" width="550" height="250" alt="side" /></div>
<!--                        <div class="slide"><a href="http://tutorialzine.com/2009/10/beautiful-apple-gallery-slideshow/" target="_blank"><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/info.jpg" width="920" height="400" alt="side" /></a></div>-->
                    </div>
                    <div id="menu">
                        <ul>
                            <li class="fbar">&nbsp;</li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/thumb_iphone.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/equipo.jpg" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/refri.jpg" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/thumb_imac.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/apple-ipod-nano-4g.jpg" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/varios.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipod.jpg" width="50" height="24" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/thumb_macbook.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipodtouch.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/blackberry.png" alt="thumbnail" /></a></li>
                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/ipodclasic.png" alt="thumbnail" /></a></li>
<!--                            <li class="menuItem"><a href=""><img src="<?php echo base_url(); ?>CarruselApple/img/sample_slides/thumb_about.png" alt="thumbnail" /></a></li>-->
                        </ul> 
                    </div>
                </div>
                </div>
            </body>
        </html>
        <p class="direccion">
            CHAUPITENA (Vía Conocoto - Amaguaña) Frente al Complejo Liga Atahualpa<br>
            TELÉFONO: 2335-067 / TELEFAX: 2338-929<br>
            E-MAIL ADDRESS: almacenesfranklin@gmail.com<br>
            QUITO-ECUADOR
        </p>
    </div>
</div>
