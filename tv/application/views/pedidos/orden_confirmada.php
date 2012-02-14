<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_fin = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Smiley_Happy.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_fin);?>&nbsp;&nbsp;&nbsp;Proceso de Pedido de Productos
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_fin = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Smiley_Happy.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>¡Orden Confirmada!&nbsp;&nbsp;&nbsp;<?= img($imagen_fin);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Su orden se ha procesado con éxito!
        </div>
        <?php
        $imagen_email = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/carta.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div class="grid_7 alpha">
            Se envió un e-mail con el detalle de la compra como una confirmación de que se realizó la orden de pedido.&nbsp;&nbsp;&nbsp;<?= img($imagen_email);?>
        </div><br>
        <div class="grid_7 alpha">
            Un asesor de servicio al cliente se pondrá en contacto con usted para coordinar el pago y la entrega de los articulos adquiridos a traves de este medio.
        </div>
        <div id="datos_de_transporte" class="grid_7 alpha">
            Posibles acciones:
        </div>
        <div id="detalle_de_transporte" class="grid_6 beta">
            Usted puede ver su historia de ordenes haciendo clic en <b>'Mi Cuenta'</b> y visitando la opcion <b>'Historial de pedidos'</b>.<br><br>
        </div>
    </div>
    <div class="grid_1" id="posicion_imagen_atras">
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
    </div>
    <div class="grid_4" id="gracias_por_su_compra">
            ¡Gracias Por Ir De Compras Con Nosotros!
        </div>
</div>
