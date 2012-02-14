<?php
$stock_producto = array(
    'name' => 'stock_producto',
    'id' => 'stock_producto',
    'value' => set_value('stock_producto'),
    'size' => '5',
    'maxlength' => '4'
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>productos/mantenimiento_stock" class="button">Cancelar</a>
            <h1>Existencia de Produtos</h1>
            <div><a href="">Descuentos</a> / <a href="">Actualizar Stock de Productos</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar el stock del producto seleccionado.
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
                $atributos = array('id' => 'formulario_actualizar_producto_stock');
                echo form_open('productos/actualizarProductoStock', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Stock:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($stock_producto); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_producto" value="">
                </div>
                <?php echo form_hidden('id_producto_seleccionado', $idProductoActual); ?>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                Producto Seleccionado
            </div>
            <?php
            if (isset($obtenerProductoSeleccionado)) {
                echo '<div class="table">';
                echo '<table class="listing" cellpadding="0" cellspacing="0">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nombre</th>';
                echo '<th>Stock</th>';
                echo '</tr>';
                foreach ($obtenerProductoSeleccionado as $filaObtenerPromocion):
                    echo '<tr>';
                    echo '<td class="id_tabla">' . $filaObtenerPromocion->idproductos . '</td>';
                    echo '<td width="400px">' . $filaObtenerPromocion->nombre . '</td>';
                    echo '<td width="auto">' . $filaObtenerPromocion->stock . '</td>';
                    echo '</tr>';
                endforeach;
                echo '</table>';
                echo '<div class="select">';
                echo '<strong>Total: 1 Registro</strong>';
                echo '</div>';
                echo '</div>';
                unset($obtenerProductoSeleccionado);
            }
            ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->