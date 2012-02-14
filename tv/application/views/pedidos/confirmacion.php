<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_pago = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Users_Chat.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_pago);?>&nbsp;&nbsp;&nbsp;Proceso de Pedido de Productos
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_pago = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Users_Chat.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Confirmar Orden&nbsp;&nbsp;&nbsp;<?= img($imagen_pago);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Informacion de Envio
        </div>

        <div class="grid_2 alpha" id="">

            <div id="modulo" class="grid_1 alpha">
                <div id="titulo_direccion_pedido" class="grid_1 alpha">
                    Datos de Envio
                </div>
                <div id="datos_direccion_pedido" class="grid_1 alpha">
                    <?php
                    $NombreApellido = $this->session->userdata('NombreApellido');
                    $Direccion = $this->session->userdata('Direccion');
                    $NombreParroquia = $this->session->userdata('NombreParroquia');
                    $NombreCiudad = $this->session->userdata('NombreCiudad');
                    echo $NombreApellido . ', ' . $Direccion . ', ' . $NombreParroquia . ', ' . $NombreCiudad . '.'
                    ?>
                </div>
            </div>

        </div>
        <div id="titulo_productos_confirmar_orden" class="grid_5">
            Productos:
        </div>

        <div class="grid_5">
            <?php
            foreach ($mostrarCarrito as $fila):
                echo '<div id="contenido_productos_confirmar_orden" class="grid_3 beta">';
                echo $fila->cantidad . ' x ' . $fila->nombre;
                echo '</div>';
                echo '<div id="valor_productos_confirmar_orden" class="grid_1">';
                if ($fila->precioPromocion != 0.00) {
                    echo '$' . $fila->precioPromocion;
                } else {
                    echo '$' . $fila->precio;
                }
                echo '</div>';
            endforeach;
            ?>
            <div id="subtotal_total_productos_confirmar_orden" class="grid_3 beta">
                <font color="red">Subtotal:</font> 
            </div>
            <div id="subtotal_valor_productos_confirmar_orden" class="grid_1">
                <?php echo '$' . $totalCarrito ?>
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
                    $totaPedido = $totalCarrito + 5.00;
                    echo '$' . $totaPedido;
                    ?>
                </b>
            </div>
        </div>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Proceso de Compra
        </div>
        <div id="contenido_barra_progreso" class="grid_8">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . 'PlantillaComfranklin/images/paso3.png',
                'class' => 'barra_de_progreso',
            );
            echo img($imagen_propiedades);
            ?>
            <div class="grid_2 prefix_1">
                Informacion Envio
            </div>
            <div class="grid_2">
                Informacion Pago
            </div>
            <div class="grid_2">
                Confirmacion
            </div>
        </div>
        <div id="continuar_orden" class="grid_7 alpha">
            <?php
            $confirmarOrden = array('id' => 'confirmar_orden');
            echo form_open('pedidos/orden_confirmada', $confirmarOrden);
            $enviarOrden = array(
                'name' => 'confirmarorden',
                'id' => 'confirmarorden',
                'value' => '',
                'class' => 'boton_confirmar_orden'
            );
            echo form_submit($enviarOrden);
            echo form_close();
            ?>
        </div>
    </div>
</div>