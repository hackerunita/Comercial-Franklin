<?php
$atributos = array('id' => 'formulario_actualizar_producto');
echo form_open_multipart('productos/actualizarProducto', $atributos);
?>
<?php
echo form_hidden('id_producto_seleccionado', $idproducto);
$nombre_producto = array(
    'name' => 'nombre_producto',
    'id' => 'nombre_producto',
    'value' => set_value('nombre_producto')
);
$descripcion_producto = array(
    'name' => 'descripcion_producto',
    'id' => 'descripcion_producto',
    'value' => set_value('descripcion_producto'),
    'rows' => '5',
    'cols' => '41'
);
$caracteristicas_producto = array(
    'name' => 'caracteristicas_producto',
    'id' => 'caracteristicas_producto',
    'value' => set_value('caracteristicas_producto'),
    'rows' => '10',
    'cols' => '41'
);
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
$stock_producto = array(
    'name' => 'stock_producto',
    'id' => 'stock_producto',
    'value' => set_value('stock_producto'),
    'size' => '5',
    'maxlength' => '4'
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
        <a href="<?php echo base_url(); ?>productos_imagenes/mantenimiento_agregar_imagenes" class="link">Administrar Imagenes</a>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>productos/mantenimiento_productos" class="button">Cancelar</a>
            <h1>Productos</h1>
            <div><a href="">Catálogo</a> / <a href="">Actualizar Productos</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete los siguientes campos para actualizar el producto seleccionado.
                </div>
                <?php
                if (isset($error_imagen)) {
                    if (!empty($error_imagen)) {
                        echo '<div class="grid_7 alpha" id="formato_de_error">';
                        echo $error_imagen;
                        echo '</div>';
                        unset($error_imagen);
                    }
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
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_producto); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Descripción:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_textarea($descripcion_producto); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Características:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_textarea($caracteristicas_producto); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Imagen Actual:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?php
                    $imagen_en_sesion = $this->session->userdata('imagen_producto_actual');
                    $imagen_producto = array(
                        'src' => base_url() . $imagen_en_sesion,
                        'class' => 'imagen_producto_sesion',
                    );
                    echo img($imagen_producto);
                    ?>
                    <input type="file" name="userfile" size="20" />
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Precio:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?php
                    echo '$'.form_input($precio_producto_entero).'.'.form_input($precio_producto_decimal);
                    ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Stock:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($stock_producto); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_producto" value="">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->