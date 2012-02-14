<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_carrito = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Shopping_Cart_Remove.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_carrito);?>&nbsp;&nbsp;&nbsp;Carrito de Compras
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_carrito = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Shopping_Cart_Remove.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>¿Que Hay En Mi Carrito?&nbsp;&nbsp;&nbsp;<?= img($imagen_carrito);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Carrito sin Producto(s)
        </div>
    </div>
<!--    <div class="grid_1" id="posicion_imagen_atras">
        <div id="imagen_siguiente">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/User.png',
                'class' => 'imagen_mediana_icono',
            );
            echo img($imagen_propiedades);
            ?>
        </div>
        <div id="letra_imagen_siguiente">
            <?= anchor('index/index', 'Mi Cuenta', 'class="enlaces_generales"'); ?>
        </div>
    </div>
    <div class="grid_1" id="posicion_imagen_continuar">
        <div id="imagen_siguiente">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Home.png',
                'class' => 'imagen_mediana_icono',
            );
            echo img($imagen_propiedades);
            ?>
        </div>
        <div id="letra_imagen_siguiente">
            <?= anchor(base_url(), 'Mi Inicio', 'class="enlaces_generales"'); ?>
        </div>
    </div>-->
</div>