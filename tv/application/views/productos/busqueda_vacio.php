<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_buscar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/buscar.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_buscar);?>&nbsp;&nbsp;&nbsp;<?php echo $titulo ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_buscar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/buscar.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1><?php echo 'Criterio de Busqueda: <i>'.$criterio_de_busqueda.'</i>'; ?>&nbsp;&nbsp;&nbsp;<?= img($imagen_buscar);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            No hay resultados asociados a esta busqueda.
        </div>
<!--        <h2>Bienvenidos a Comercial Franklin</h2>
        <p>
            Para Comfranklin Cia Ltda. Es un gusto poner a su disposición una variedad de productos en dos amplios locales en los cuales puedes encontrar electronica, muebles, ropa, calzado,  juguetes, motos, herramientas.
        </p>
        <p>
        <img class="logo_ipods" src="<?php echo base_url(); ?>PlantillaComfranklin/images/homepage_logo.jpg"/>
        </p>
        <strong>Mision:</strong>
        <p>
            Brindar una amplia variedad de productos con excelente calidad, sin descuidar el servicio antes y después de la venta.
        </p>
        <strong>Vision:</strong>
        <p>
            Posicionarnos como una empresa reconocida por la variedad de productos con un buen servicio en el País.
        </p>-->
    </div>
</div>
