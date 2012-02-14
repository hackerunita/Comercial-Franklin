<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_historial = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Notepad.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_historial);?>&nbsp;&nbsp;&nbsp;<?php echo $titulo ?>
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <div class="grid_7 alpha">
            <?php
            $imagen_historial = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Notepad.png',
                'class' => 'imagen_mediana_icono',
            );
            $imagen_detalle_historial = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Edit_Yes.png',
                'class' => 'imagen_miniatura',
            );
            ?>
        <h1>Mi Historial de Pedidos&nbsp;&nbsp;&nbsp;<?= img($imagen_historial);?></h1>
        </div>
        
        <?php
        if (!empty($datosHistorialPedido)) {
        $numero = 1;
        foreach ($datosHistorialPedido as $fila) {
            echo '<div id="bloque_producto_comprar" class="grid_7 alpha">';
            if ($fila->estado == 0) {
                echo 'Orden Numero: ' . $numero . ' (Pendiente)';
            }
            if ($fila->estado == 1) {
                echo 'Orden Numero: ' . $numero . ' (Confirmada)';
            }
            if ($fila->estado == 2) {
                echo 'Orden Numero: ' . $numero . ' (Enviada)';
            }
            if ($fila->estado == 3) {
                echo 'Orden Numero: ' . $numero . ' (Cancelada)';
            }
            echo '</div>';
            echo '<table>';
            echo '<tr>';
            echo '<td class="titulo_contenido_historial_orden">';
            echo 'Fecha Orden:';
            echo '</td>';
            echo '<td class="contenido_historial_orden">';
            echo $fila->fecha;
            echo '</td>';
            echo '<td width="120px">';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '</td>';
            echo '<td class="titulo_contenido_historial_orden">';
            echo 'Productos:';
            echo '</td>';
            echo '<td class="contenido_historial_orden">';
            $idPedido = $fila->idpedidos;
            //consultando el numero de productos de cada pedido
            $query = $this->db->query('select count(*) "total_productos" from detalle_pedidos 
            where pedidos_idpedidos =' . $idPedido);
            foreach ($query->result() as $r) {
                echo $r->total_productos;
            }
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="titulo_contenido_historial_orden">';
            echo 'Enviado a:';
            echo '</td>';
            echo '<td class="contenido_historial_orden">';
            echo $fila->nombrePersonaRecibePedido;
            echo '</td>';
            echo '<td width="120px">';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '</td>';
            echo '<td class="titulo_contenido_historial_orden">';
            echo 'Costo Pedido:';
            echo '</td>';
            echo '<td class="contenido_historial_orden" width="100px">';
            $total = $fila->total;
            echo '$' .$total ;
            echo '</td>';
            echo '<td>';
            echo anchor('pedidos/detalleHistorialPedidos/'.$fila->idpedidos.'/'.$numero ,'Ver Detalles', 'class="enlaces_generales"');
            echo img($imagen_detalle_historial);
            //echo form_submit('submit', 'Ver Detalles');
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            $numero += 1;
        }
        }else{
            echo '<div id="bloque_producto_comprar" class="grid_7 alpha">';
            echo 'No existen pedidos';
            echo '</div>';
        }
        ?>


        <!--
        <table>
            <tr>
                <td class="titulo_contenido_historial_orden">
                    Fecha Orden:
                </td>
                <td class="contenido_historial_orden">
                    2011/12/12
                </td>
                <td width="120px">
                    &nbsp;&nbsp;&nbsp;
                </td>
                <td class="titulo_contenido_historial_orden">
                    Productos:
                </td>
                <td class="contenido_historial_orden">
                    2
                </td>
            </tr>
            <tr>
                <td class="titulo_contenido_historial_orden">
                    Enviado a:
                </td>
                <td class="contenido_historial_orden">
                    Darwin Suntaxi
                </td>
                <td width="120px">
                    &nbsp;&nbsp;&nbsp;
                </td>
                <td class="titulo_contenido_historial_orden">
                    Costo Pedido:
                </td>
                <td class="contenido_historial_orden" width="100px">
                    $1234.90
                </td>
                <td>
                </td>
            </tr>
        </table>
        
        -->
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
            <?= anchor('index/index', 'Regresar', 'class="enlaces_generales"'); ?>
        </div>
    </div>
</div>
