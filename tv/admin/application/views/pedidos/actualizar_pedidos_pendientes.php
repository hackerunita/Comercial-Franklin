<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>pedidos/mantenimiento_pedidos_pendientes" class="button">Cancelar</a>
            <h1>Pedidos Pendientes</h1>
            <div><a href="">Clientes</a> / <a href="">Actualizar Pedidos Pendientes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar el estado del pedido seleccionado.
                </div>
                <div class="grid_7 alpha">
                    <?= validation_errors() ?>
                </div>
                <div class="grid_3 alpha suffix_2" id="titulo_formulario">
                    Ingrese los Datos:
                </div>
                <div class="grid_2" id="informacion_requerida">
                    * Información Requerida
                </div>
                <?php
                $atributos = array('id' => 'formulario_actualizar_pedido');
                echo form_open('pedidos/actualizarPedidoPendiente', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Estado:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <select name="cmb_estado" id="cmb_estado">
                        <option selected value="0">Pendiente</option>
                        <option value="1">Confirmado</option>
                        <option value="2">Enviado</option>
                        <option value="3">Cancelado</option>
                    </select>
                </div>
                <?php echo form_hidden('id_pedido_seleccionado', $idpedidoActual) ?>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_pedido" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Orden de Pedido: 
                    <?php
                    if ($obtenerEstadoPedidoSeleccionado == 0) {
                        echo 'Pendiente';
                    }
                    if ($obtenerEstadoPedidoSeleccionado == 1) {
                        echo 'Confirmado';
                    }
                    if ($obtenerEstadoPedidoSeleccionado == 2) {
                        echo 'Enviado';
                    }
                    if ($obtenerEstadoPedidoSeleccionado == 3) {
                        echo 'Cancelado';
                    }
                    ?>
                </div>
                <?php
                if (isset($obtenerPedidoSeleccionado)) {
                    foreach ($obtenerPedidoSeleccionado as $filaObtenerPedido):
                ?>
                <div class="grid_4 alpha">
                    <div class="grid_4 alpha" id="titulo_formulario_cliente_envio">
                        Datos del Cliente:
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Cliente:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->nombres.' '.$filaObtenerPedido->apellidos ?>
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Dirección:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->DireccionCliente ?>
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Teléfono:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->telefonoFijo ?>
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        E-mail:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->email ?>
                    </div>
                </div>
                <div class="grid_4 alpha">
                    <div class="grid_4 alpha" id="titulo_formulario_cliente_envio">
                        Datos  de  Envio:
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Persona recibe:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->nombrePersonaRecibePedido ?>
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Dirección:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->DireccionEnvio ?>
                    </div>
                </div>
                <div class="grid_4 alpha">
                    <div class="grid_4 alpha" id="titulo_formulario_cliente_envio">
                        Método de Pago:
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Método:
                    </div>
                    <div class="grid_2 alpha" id="campos_texto_formulario">
                        <?php echo $filaObtenerPedido->nombre ?>
                    </div>
                </div>
                <?php
                    endforeach;
                unset($obtenerPedidoSeleccionado);
                }
                ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Detalle del Pedido
                </div>
                <?php
                if (isset($obtenerDetallePedidoSeleccionado)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>Cantidad</th>';
                    echo '<th>Producto</th>';
                    echo '<th>Valor Unitario</th>';
                    echo '<th>Total</th>';
                    echo '</tr>';
                    foreach ($obtenerDetallePedidoSeleccionado as $filaObtenerDetalle):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerDetalle->cantidad . '</td>';
                        echo '<td width="auto">' . $filaObtenerDetalle->descripcion . '</td>';
                        echo '<td width="auto">$' . $filaObtenerDetalle->precioUnitario . '</td>';
                        echo '<td width="auto">$' . $filaObtenerDetalle->precioTotal . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '</div>';
                    unset($obtenerDetallePedidoSeleccionado);
                }
                ?>
                <div class="grid_3 alpha" id="contenido_total">
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Subtotal:
                    </div>
                    <div class="grid_1 alpha" id="campos_total">
                        <?php 
                        $gastos_envio = 5.00;
                        $subtotal = $obtenerTotalPedidoSeleccionado - $gastos_envio; 
                        echo '$'.$subtotal;
                        ?>
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Gastos Envio:
                    </div>
                    <div class="grid_1 alpha" id="campos_total">
                        $5.00
                    </div>
                    <div class="grid_2 alpha"  id="etiqueta_texto_formulario">
                        Total:
                    </div>
                    <div class="grid_1 alpha" id="campos_total">
                        <?php
                        echo '$'.$obtenerTotalPedidoSeleccionado;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->