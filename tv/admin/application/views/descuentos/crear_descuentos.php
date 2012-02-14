<?php
$precio_producto_entero = array(
    'name' => 'precio_producto_entero',
    'id' => 'precio_producto_entero',
    'value' => set_value('precio_producto_entero'),
    'size' => '1',
    'maxlength' => '4'
);
$precio_producto_decimal = array(
    'name' => 'precio_producto_decimal',
    'id' => 'precio_producto_decimal',
    'value' => set_value('precio_producto_decimal'),
    'size' => '1',
    'maxlength' => '2'
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
        <!--                    <a href="#" class="link">Link here</a>
                            <a href="#" class="link">Link here</a>-->
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>promociones/mantenimiento_promociones" class="button">Cancelar</a>
            <h1>Promociones</h1>
            <div><a href="">Descuentos</a> / <a href="">Crear Promociones</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para crear una nueva promoción.
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
                $atributos = array('id' => 'formulario_crear_promocion');
                echo form_open('promociones/crearPromocion', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Producto:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <select name="cmb_promocion" id="cmb_promocion">
                        <option selected value="0">Elegir</option>
                        <?php
                        foreach ($obtenerProductos as $fila):
                            echo '<option value="' . $fila->idproductos . '"'. set_select('cmb_promocion', $fila->idproductos).'>' . $fila->nombre . ' ($'.$fila->precio.')</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Precio Especial:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?php
                    echo '$'.form_input($precio_producto_entero).'.'.form_input($precio_producto_decimal);
                    ?>
                </div>
                <div class="grid_2 prefix_5" id="imagen_boton">
                    <input class="boton_crear" type="submit" name="crear_promocion" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Promociones Existentes
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
                    'src' => base_url() . 'PlantillaAdmin/img/Recycle_Bin_Empty.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                $js = 'onClick="return confirm(\'¿Está seguro que desea eliminar?\');"';
                if (isset($obtenerProductosPromocion)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Precio</th>';
                    echo '<th>Promoción</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Eliminar</th>';
                    echo '</tr>';
                    foreach ($obtenerProductosPromocion as $filaObtenerPromocion):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerPromocion->idproductos . '</td>';
                        echo '<td width="400px">' . $filaObtenerPromocion->nombre . '</td>';
                        echo '<td width="auto">$' . $filaObtenerPromocion->precio . '</td>';
                        echo '<td width="auto">' . $filaObtenerPromocion->precioPromocion . '</td>';
                        echo '<td width="70px">' . anchor('promociones/actualizar_promocion/' . $filaObtenerPromocion->idproductos, img($imagen_editar)) . '</td>';
                        echo '<td width="70px">' . anchor('promociones/eliminarPromocion/' . $filaObtenerPromocion->idproductos, img($imagen_eliminar),$js) . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalProductosPromocion . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerProductosPromocion);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->