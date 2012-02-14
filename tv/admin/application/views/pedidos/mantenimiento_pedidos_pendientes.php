<?php
$nombre_pedido_buscar = array(
    'name' => 'nombre_pedido_pendiente_buscar',
    'id' => 'nombre_pedido_pendiente_buscar',
    'value' => set_value('nombre_pedido_pendiente_buscar')
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
<!--            <a href="<?php echo base_url(); ?>pedidos/crear_pedido" class="button">Crear Nuevo</a>-->
            <h1>Pedidos Pendientes</h1>
            <div><a href="">Clientes</a> / <a href="">Pedidos Pendientes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Pedidos Pendientes:
                </div>
                <?php
                if (isset($Mensaje_Pedido_Eliminado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Pedido_Eliminado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Pedido Eliminado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar el producto, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Pedido_Eliminado);
                }
                if (isset($Mensaje_Pedido_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Pedido_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Estado Actualizado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar el estado, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Pedido_Estado);
                }
                ?>
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
                $atributos = array('id' => 'formulario_buscar_pedido');
                echo form_open('pedidos/buscar_pedido_pendiente', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Apellido:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_pedido_buscar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_pedido" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Pedidos Pendientes Existentes
                </div>
                <?php
                $imagen_editar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/edit-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_agregar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/ms_success.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_eliminar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/hr.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerPedidos)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>Cliente</th>';
                    echo '<th>Total</th>';
                    echo '<th>Fecha</th>';
                    echo '<th>Estado</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Eliminar</th>';
                    echo '</tr>';
                    foreach ($obtenerPedidos as $filaObtenerPedido):
                        echo '<tr>';
                        echo '<td width="150px">' . $filaObtenerPedido->nombres . ' ' . $filaObtenerPedido->apellidos . '</td>';
                        echo '<td width="auto">$' . $filaObtenerPedido->total . '</td>';
                        echo '<td width="auto">' . $filaObtenerPedido->fecha . '</td>';
                        if ($filaObtenerPedido->estado == 0) {
                            echo '<td>Pendiente</td>';
                        }
                        if ($filaObtenerPedido->estado == 1) {
                            echo '<td>Confirmado</td>';
                        }
                        if ($filaObtenerPedido->estado == 2) {
                            echo '<td>Enviado</td>';
                        }
                        if ($filaObtenerPedido->estado == 3) {
                            echo '<td>Cancelado</td>';
                        }
                        echo '<td width="70px">' . anchor('pedidos/actualizar_pedidos_pendientes/' . $filaObtenerPedido->idpedidos, img($imagen_editar)) . '</td>';
                        echo '<td width="70px">' . anchor('pedidos/eliminar_pedidos_pendientes/' . $filaObtenerPedido->idpedidos, img($imagen_eliminar)) . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalPedidos . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerPedidos);
                } else {
                    echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                    echo '<b>No existen pedidos pendientes</b>';
                    echo '</div>';
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerPedidosPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroPedidoBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerPedidosPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>Cliente</th>';
                        echo '<th>Total</th>';
                        echo '<th>Fecha</th>';
                        echo '<th>Estado</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Eliminar</th>';
                        echo '</tr>';
                        foreach ($obtenerPedidosPorNombre as $filaObtenerPedidoPorNombre):
                            echo '<tr>';
                            echo '<td width="150px">' . $filaObtenerPedidoPorNombre->nombres . ' ' . $filaObtenerPedidoPorNombre->apellidos . '</td>';
                            echo '<td width="auto">$' . $filaObtenerPedidoPorNombre->total . '</td>';
                            echo '<td width="auto">' . $filaObtenerPedidoPorNombre->fecha . '</td>';
                            if ($filaObtenerPedidoPorNombre->estado == 0) {
                                echo '<td>Pendiente</td>';
                            }
                            if ($filaObtenerPedidoPorNombre->estado == 1) {
                                echo '<td>Confirmado</td>';
                            }
                            if ($filaObtenerPedidoPorNombre->estado == 2) {
                                echo '<td>Enviado</td>';
                            }
                            if ($filaObtenerPedidoPorNombre->estado == 3) {
                                echo '<td>Cancelado</td>';
                            }
                            echo '<td width="70px">' . anchor('pedidos/actualizar_pedidos_pendientes/' . $filaObtenerPedidoPorNombre->idpedidos, img($imagen_editar)) . '</td>';
                            echo '<td width="70px">' . anchor('pedidos/eliminar_pedidos_pendientes/' . $filaObtenerPedidoPorNombre->idpedidos, img($imagen_eliminar)) . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalPedidosBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerPedidosPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->