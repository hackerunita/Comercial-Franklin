<?php
$actualizarCantidad = array(
    'name' => 'actualizarCantidad',
    'id' => '$actualizarCantidad',
    'value' => 'Actualizar',
);
?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_carrito = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Shopping_Cart.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_carrito);?>&nbsp;&nbsp;&nbsp;Carrito de compras
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_carrito = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Shopping_Cart.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>¿Que Hay En Mi Carrito?&nbsp;&nbsp;&nbsp;<?= img($imagen_carrito);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Producto(s)
        </div>
        <?php
        $imagen_eliminar = array(
            'src' => base_url().'/PlantillaComfranklin/images/ms_error.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <?php
        if (isset($idCarrito)) {
            $sw = 0;
            if (!empty($mostrarCarrito)) {
                foreach ($mostrarCarrito as $fila):
                    echo '<div class="grid_7 alpha">';
                    echo '<div id="precio_producto_comprar" class="grid_7">';
                    echo '$'.$fila->subtotal;
                    echo '</div>';
                    echo '<div class="grid_1 alpha suffix_1">';
                    $imagen_propiedades = array(
                        'src' => $fila->imagenMuestra,
                        'class' => 'imagen_producto_comprar',
                    );
                    echo img($imagen_propiedades);
                    echo '</div>';
                    echo '<div id="descripcion_producto_comprar" class="grid_4">';
                    if (isset($idproductoFueraStock)) {
                        if ($idproductoFueraStock == $fila->idproductos) {
                            echo anchor('productos/presentar_producto/' . $fila->idproductos, $fila->nombre) . '<font color="red"> ***</font>';
                            $sw++;
                        } else {
                            echo anchor('productos/presentar_producto/' . $fila->idproductos, $fila->nombre);
                        }
                    } else {
                        echo anchor('productos/presentar_producto/' . $fila->idproductos, $fila->nombre);
                    }
                    echo '<div id="controles_carrito">';
                    $actualizarProductoCarrito = array('id' => 'actualizar_producto_carrito');
                    echo form_open('carrito_de_compras/actualizarProducto', $actualizarProductoCarrito);

                    if ($fila->precioPromocion != 0.00) {
                        echo form_hidden('precio', $fila->precioPromocion);
                    } else {
                        echo form_hidden('precio', $fila->precio);
                    }
                    $cantidad = array(
                        'name' => 'cantidad',
                        'id' => 'cantidad',
                        'size' => '1',
                        'value' => $fila->cantidad
                    );
                    echo form_input($cantidad);
                    $data = array(
                        'idproducto' => $fila->idproductos,
                        'idCarrito' => $idCarrito
                    );
                    echo form_hidden($data);
                    echo form_submit($actualizarCantidad);
                    echo form_close();
                    echo '</div>';
                    echo '<div id="eliminar_de_carrito">';
                    echo anchor('carrito_de_compras/eliminarProducto/' . $fila->idproductos . '/' . $idCarrito, 'Eliminar'.img($imagen_eliminar));
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endforeach;
                echo '<div id="subtotal_carrito" class="grid_7">';
                echo '<font color="red">';
                echo 'Subtotal: $' . $totalCarrito;
                echo '</font>';
                $comenzarPedido = array('id' => 'comenzar_pedido');
                echo form_open('pedidos/pedido', $comenzarPedido);
                $enviarPedido = array(
                    'name' => 'enviarPedido',
                    'id' => 'enviarPedido',
                    'value' => '',
                    'class' => 'boton_mandar_pedido'
                );
                echo '<div class="boton_enviar_pedido">';
                echo form_submit($enviarPedido);
                echo form_close();
                echo '</div>';
                echo '</div>';
            }
            if ($sw != 0) {
                echo '<div class="mensaje_de_stock">';
                echo 'Los productos marcados con *** no existen en la cantidad deseada';
                echo '</div>';
            }
        }
        ?>
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
</div>
