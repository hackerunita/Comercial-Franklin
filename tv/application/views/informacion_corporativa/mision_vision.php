<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_mision = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Document.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_mision).'';?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7 alpha">
        <?php
        $imagen_inicio = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Document.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Bienvenidos a Comercial Franklin&nbsp;&nbsp;&nbsp;<?= img($imagen_inicio);?></h1>
        <p>
            Para Comfranklin Cia Ltda. Es un gusto poner a su disposición una variedad de productos en dos amplios locales en los cuales puedes encontrar electronica, muebles, ropa, calzado,  juguetes, motos, herramientas.
        </p>
        <strong>Mision:</strong>
        <p>
            Brindar una amplia variedad de productos con excelente calidad, sin descuidar el servicio antes y después de la venta.
        </p>
        <strong>Vision:</strong>
        <p>
            Posicionarnos como una empresa reconocida por la variedad de productos con un buen servicio en el País.
        </p>
        <img class="logo_mision" src="<?php echo base_url(); ?>PlantillaComfranklin/images/im.jpg"/>
<!--        <img class="logo_mision" src="<?php echo base_url(); ?>PlantillaComfranklin/images/sucursal1.jpg"/>
        <p class="direccion">
            CHAUPITENA (Vía Conocoto - Amaguaña) Frente al Complejo Liga Atahualpa<br>
            TELÉFONO: 2335-067 / TELEFAX: 2338-929<br>
            E-MAIL ADDRESS: almacenesfranklin@gmail.com<br>
            QUITO-ECUADOR
        <p>-->
    </div>
</div>