<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_ayuda = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Help.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_ayuda).'';?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7">
        <?php
        $imagen_ayuda = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Help.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Comercial Franklin&nbsp;&nbsp;&nbsp;<?= img($imagen_ayuda);?></h1>
        <p>
            Para Comfranklin Cia Ltda. Es un gusto poner a su disposición una variedad de productos en dos amplios locales en los cuales puedes encontrar electronica, muebles, ropa, calzado,  juguetes, motos, herramientas.
        </p>
        <p>
            <img class="logo_acerca_de" src="<?php echo base_url(); ?>PlantillaComfranklin/images/logo.png"/>
<!--        <img class="logo_ipods" src="<?php echo base_url(); ?>PlantillaComfranklin/images/homepage_logo.jpg"/>-->
        </p>
        
        <p class="direccion">
            CHAUPITENA (Vía Conocoto - Amaguaña) Frente al Complejo Liga Atahualpa<br>
            TELÉFONO: 2335-067 / TELEFAX: 2338-929<br>
            E-MAIL ADDRESS: almacenesfranklin@gmail.com<br>
            QUITO-ECUADOR
        <p>
    </div>
</div>