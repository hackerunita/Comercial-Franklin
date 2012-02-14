<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_donde = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Contact.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_donde).'';?>&nbsp;&nbsp;&nbsp;¿Donde Estamos?
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_7 alpha">
        <?php
        $imagen_donde = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Contact.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>¿Donde Estamos?&nbsp;&nbsp;&nbsp;<?= img($imagen_donde);?></h1>
        <p>
            Para Comfranklin Cia Ltda. Es un gusto poner a su disposición una variedad de productos en dos amplios locales en los cuales puedes encontrar electronica, muebles, ropa, calzado,  juguetes, motos, herramientas.
        </p>
        <strong>Matriz:</strong>
        <p>
        <img class="logo_mision" src="<?php echo base_url(); ?>PlantillaComfranklin/images/sucursal1.jpg"/>
        <p class="direccion">
            CHAUPITENA (Vía Conocoto - Amaguaña) Frente al Complejo Liga Atahualpa<br>
            TELÉFONO: 2335-067 / TELEFAX: 2338-929<br>
            E-MAIL ADDRESS: almacenesfranklin@gmail.com<br>
            QUITO-ECUADOR
        <p>
            </p>
    </div>
</div>
