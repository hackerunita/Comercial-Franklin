<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_acerca = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Favorite.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_acerca) . ''; ?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7">
        <?php
        $imagen_acerca = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Favorite.png',
            'class' => 'imagen_mediana_icono',
        );
        $imagen_chrome = array(
            'src' => base_url() . '/PlantillaComfranklin/images/chrome.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Comercial Franklin&nbsp;&nbsp;&nbsp;<?= img($imagen_acerca); ?></h1>
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
        <h1>Se recomienda usar&nbsp;&nbsp;&nbsp;<?= img($imagen_chrome); ?></h1>
        <p>
            El presente sitio web puede ser visualizado en cualquier navegador web moderno, sin embargo para una mejor experiencia se recomienda su uso en Google Chrome. <?= anchor('informacion_corporativa/descargar_chrome', 'Descargar Google Chrome', 'class="enlaces_generales" target="_blank"'); ?>
        </p>
    </div>
</div>

