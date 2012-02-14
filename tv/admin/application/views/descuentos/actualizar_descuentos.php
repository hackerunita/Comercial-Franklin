<?php
$atributos = array('id' => 'formulario_actualizar_promocion');
echo form_open('promociones/actualizarPromocion', $atributos);
?>
<?php
if (isset($obtenerPromocionSeleccionada)) {
    foreach ($obtenerPromocionSeleccionada as $filaObtenerPromocionSeleccionada):
        echo form_hidden('id_promocion_seleccionado', $filaObtenerPromocionSeleccionada->idproductos);
        $nombreProducto = $filaObtenerPromocionSeleccionada->nombre . ' ($' . $filaObtenerPromocionSeleccionada->precio . ')';
        $d = explode(".", $filaObtenerPromocionSeleccionada->precioPromocion);
        $precio_entero = $d[0];
        $precio_decimal = $d[1];
        $precio_producto_entero = array(
            'name' => 'precio_producto_entero',
            'id' => 'precio_producto_entero',
            'value' => $precio_entero,
            'size' => '1',
            'maxlength' => '4'
        );
        $precio_producto_decimal = array(
            'name' => 'precio_producto_decimal',
            'id' => 'precio_producto_decimal',
            'value' => $precio_decimal,
            'size' => '1',
            'maxlength' => '2'
        );
    endforeach;
}else {
    if (isset($obtenerDatosPromocionSeleccionada)) {
        foreach ($obtenerDatosPromocionSeleccionada as $filaObtenerPromocionSeleccionada):
            echo form_hidden('id_promocion_seleccionado', $filaObtenerPromocionSeleccionada->idproductos);
            $nombreProducto = $filaObtenerPromocionSeleccionada->nombre . ' ($' . $filaObtenerPromocionSeleccionada->precio . ')';
        endforeach;
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
            'size' => '1',
            'maxlength' => '2'
        );
    }
}
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
</div>
<!-- fin de columna izquierda -->

<!-- comienzo de columna central -->
<div id="center-column">
    <div class="top-bar">
        <a href="<?php echo base_url(); ?>promociones/mantenimiento_promociones" class="button">Cancelar</a>
        <h1>Promociones</h1>
        <div><a href="">Descuentos</a> / <a href="">Actualizar Promociones</a></div>
    </div>
    <div class="container_12">
        <div class="grid_8">
            <div class="grid_8 alpha" id="comentario_formulario" >
                Complete el siguiente formulario para actualizar la promoción seleccionada.
            </div>
            <div class="grid_7 alpha">
                <?= validation_errors() ?>
            </div>
            <div class="grid_8 alpha">
                <div class="grid_3 alpha suffix_1" id="titulo_formulario">
                    Ingrese los Datos:
                </div>
                <div class="grid_3" id="informacion_requerida">
                    * Información Requerida
                </div>
            </div>
            <div class="grid_8 alpha">
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Producto:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_4 alpha" id="campos_formulario">
                    <?php
                    echo $nombreProducto;
                    ?>
                </div>
            </div>
            <div class="grid_8 alpha">
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Precio Especial:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?php
                    echo '$' . form_input($precio_producto_entero) . '.' . form_input($precio_producto_decimal);
                    ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_promocion" value="">
                </div>
            </div>
            <?php
            echo form_close();
            unset($obtenerPromocionSeleccionada);
            unset($obtenerDatosPromocionSeleccionada);
            ?>
            <div class="grid_8 alpha" id="titulo_lista_registros">
                Promoción Seleccionada
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
                echo '<th>Eliminar</th>';
                echo '</tr>';
                foreach ($obtenerProductosPromocion as $filaObtenerPromocion):
                    echo '<tr>';
                    echo '<td class="id_tabla">' . $filaObtenerPromocion->idproductos . '</td>';
                    echo '<td width="400px">' . $filaObtenerPromocion->nombre . '</td>';
                    echo '<td width="auto">$' . $filaObtenerPromocion->precio . '</td>';
                    echo '<td width="auto">$' . $filaObtenerPromocion->precioPromocion . '</td>';
                    echo '<td width="70px">' . anchor('promociones/eliminarPromocion/' . $filaObtenerPromocion->idproductos, img($imagen_eliminar), $js) . '</td>';
                    echo '</tr>';
                endforeach;
                echo '</table>';
                echo '<div class="select">';
                echo '<strong>Total: 1 Registro</strong>';
                echo '</div>';
                echo '</div>';
                unset($obtenerProductosPromocion);
            }
            ?>
        </div>
    </div>
</div>
<!-- fin de columna central -->