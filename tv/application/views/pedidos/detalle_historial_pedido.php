<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_detalle = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Edit_Yes.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_detalle);?>&nbsp;&nbsp;&nbsp;<? echo $titulo ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <h1>Informacion Pedido</h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            <?php
            foreach ($datosDetalleHistorialPedido as $fila) {
                if ($fila->estado == 0) {
                    echo 'Orden #' . $numeroPedido . ' (Pendiente)';
                }
                if ($fila->estado == 1) {
                    echo 'Orden #' . $numeroPedido . ' (Confirmada)';
                }
                if ($fila->estado == 2) {
                    echo 'Orden #' . $numeroPedido . ' (Enviada)';
                }
                if ($fila->estado == 3) {
                    echo 'Orden #' . $numeroPedido . ' (Cancelada)';
                }
            }
            ?>
        </div>
        
        <table>
            <tr>
                <td class="titulo_contenido_historial_orden">
                    Fecha Orden:
                </td>
                <td class="contenido_historial_orden">
                    <?php
                    foreach ($datosDetalleHistorialPedido as $fila) {
                    echo $fila->fecha;
                        ?>
                </td>
                <td width="150px">
                    &nbsp;&nbsp;&nbsp;
                </td>
                <td class="titulo_contenido_historial_orden">
                    Costo Pedido:
                </td>
                <td class="contenido_historial_orden" width="100px">
                    <?php
                    $total = $fila->total;
                    echo '$' .$total ;
                    }
                    ?>
                </td>
                <td>
                </td>
            </tr>
        </table>
        
        

        <div class="grid_2 alpha" id="">

            <div id="modulo" class="grid_1 alpha">
                <div id="titulo_direccion_pedido" class="grid_1 alpha">
                    Datos de Envio
                </div>
                <div id="datos_direccion_pedido" class="grid_1 alpha">
                    <?php
                    foreach ($datosDetalleHistorialPedido as $fila) {
                        echo $fila->nombrePersonaRecibePedido . ', ' . $fila->direccion . ', ' . $fila->parroquia . '.';
                    }
                    ?>
                </div>
            </div>

        </div>
        <div id="titulo_productos_confirmar_orden" class="grid_5">
            Productos:
        </div>
        <div class="grid_5">
            <?php
            foreach ($detalleHistorialPedido as $fila):
                echo '<div id="contenido_productos_confirmar_orden" class="grid_3 beta">';
                echo $fila->cantidad . ' x ' . $fila->descripcion;
                echo '</div>';
                echo '<div id="valor_productos_confirmar_orden" class="grid_1">';
                    echo '$' . $fila->precioTotal;
                echo '</div>';
            endforeach;
            ?>
            <div id="subtotal_total_productos_confirmar_orden" class="grid_3 beta">
                <font color="red">Subtotal:</font> 
            </div>
            <div id="subtotal_valor_productos_confirmar_orden" class="grid_1">
                <?php 
                foreach ($datosDetalleHistorialPedido as $fila) {
                    $subtotal = $fila->total; 
                    $subtotalCalculado = $subtotal-5;
                    echo '$'.$subtotalCalculado;
                }
                ?>
            </div>
            <div id="titulo_totales_productos_confirmar_orden" class="grid_3 beta">
                <font color="red">Gatos de envio:</font> 
            </div>
            <div id="otros_datos_confirmar_orden" class="grid_1">
                $5.00
            </div>
            <div id="titulo_totales_productos_confirmar_orden" class="grid_3 beta">
                <font color="red">Total:</font> 
            </div>
            <div id="otros_datos_confirmar_orden" class="grid_1">
                <b>
                    <?php
                    foreach ($datosDetalleHistorialPedido as $fila) {
                        $totaPedido = $fila->total;
                    }
                    echo '$' . $totaPedido;
                    ?>
                </b>
            </div>
        </div>
    </div>
    <div class="grid_1" id="posicion_imagen_atras">
        <div id="imagen_siguiente">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Symbol_Back.png',
                'class' => 'imagen_mediana_icono',
            );
            echo img($imagen_propiedades);
            ?>
        </div>
        <div id="letra_imagen_siguiente">
            <?= anchor('pedidos/historialPedidos', 'Regresar', 'class="enlaces_generales"'); ?>
        </div>
    </div>
    <div class="grid_1" id="posicion_imagen_continuar">
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
