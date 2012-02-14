<?php
$nombre_producto_buscar = array(
    'name' => 'nombre_producto_buscar',
    'id' => 'nombre_producto_buscar',
    'value' => set_value('nombre_producto_buscar')
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <h1>Existencias de Productos</h1>
            <div><a href="">Descuentos</a> / <a href="">Stock de Productos</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Productos:
                </div>
                <?php
                if (isset($Mensaje_Stock_Actualizado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Stock_Actualizado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Stock de Producto Actualizado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar el stock del producto, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Stock_Actualizado);
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
                $atributos = array('id' => 'formulario_buscar_producto');
                echo form_open('productos/buscar_producto_stock', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_producto_buscar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_producto" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Productos Existentes
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
                if (isset($obtenerProductosStock)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
//                    echo '<th>Precio</th>';
                    echo '<th>Stock</th>';
                    echo '<th>Actualizar</th>';
                    echo '</tr>';
                    foreach ($obtenerProductosStock as $filaObtenerProductos):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerProductos->idproductos . '</td>';
                        echo '<td width="400px">' . $filaObtenerProductos->nombre . '</td>';
//                        echo '<td width="auto">$' . $filaObtenerProductos->precio . '</td>';
                        echo '<td width="auto">' . $filaObtenerProductos->stock . '</td>';
                        echo '<td width="70px">' . anchor('productos/actualizar_producto_stock/' . $filaObtenerProductos->idproductos, img($imagen_editar)) . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalProductosStock . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerProductosStock);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerProductosStockPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroProductoStockBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerProductosStockPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
//                        echo '<th>Precio</th>';
                        echo '<th>Stock</th>';
                        echo '<th>Actualizar</th>';
                        echo '</tr>';
                        foreach ($obtenerProductosStockPorNombre as $filaObtenerProductoPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerProductoPorNombre->idproductos . '</td>';
                            echo '<td width="400px">' . $filaObtenerProductoPorNombre->nombre . '</td>';
//                            echo '<td width="auto">$' . $filaObtenerProductoPorNombre->precio . '</td>';
                            echo '<td width="auto">' . $filaObtenerProductoPorNombre->stock . '</td>';
                            echo '<td width="70px">' . anchor('productos/actualizar_producto_stock/' . $filaObtenerProductoPorNombre->idproductos, img($imagen_editar)) . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalProductosStockBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerProductosStockPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->