<?php
$nombre_producto_buscar = array(
    'name' => 'nombre_producto_buscar',
    'id' => 'nombre_producto_buscar',
    'value' => set_value('nombre_producto_buscar')
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
        <a href="<?php echo base_url(); ?>productos_imagenes/mantenimiento_agregar_imagenes" class="activo">Administrar Imagenes</a>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <h1>Productos</h1>
            <div><a href="">Catálogo</a> / <a href="">Administración de Imagenes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Productos:
                </div>
                <?php
                if (isset($Mensaje_Imagen_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Imagen_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Imagen Agregada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo agregar la imagen, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Imagen_Creada);
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
                echo form_open('productos_imagenes/buscar_producto', $atributos);
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
                $imagen_agregar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/add-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_visto = array(
                    'src' => base_url() . 'PlantillaAdmin/img/ms_success.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_eliminar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/Recycle_Bin_Empty.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerProductos)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Precio</th>';
                    echo '<th>Agregar</th>';
                    echo '<th>Eliminar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerProductos as $filaObtenerProductos):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerProductos->idproductos . '</td>';
                        echo '<td width="400px">' . $filaObtenerProductos->nombre . '</td>';
                        echo '<td width="auto">$' . $filaObtenerProductos->precio . '</td>';
                        echo '<td width="auto">' . anchor('productos_imagenes/agregar_imagen/' . $filaObtenerProductos->idproductos, img($imagen_agregar)) . '</td>';
                        echo '<td width="auto">' . anchor('productos_imagenes/eliminar_imagen/' . $filaObtenerProductos->idproductos, img($imagen_eliminar)) . '</td>';
                        if ($filaObtenerProductos->estado == 0) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductos->idproductos . '/' . $filaObtenerProductos->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerProductos->estado == 1) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductos->idproductos . '/' . $filaObtenerProductos->estado, img($imagen_visto)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalProductos . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerProductos);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerProductosPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroProductoBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerProductosPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Precio</th>';
                        echo '<th>Agregar</th>';
                        echo '<th>Eliminar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerProductosPorNombre as $filaObtenerProductoPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerProductoPorNombre->idproductos . '</td>';
                            echo '<td width="400px">' . $filaObtenerProductoPorNombre->nombre . '</td>';
                            echo '<td width="auto">' . $filaObtenerProductoPorNombre->precio . '</td>';
                            echo '<td width="70px">' . anchor('productos_imagenes/agregar_imagen/' . $filaObtenerProductoPorNombre->idproductos, img($imagen_agregar)) . '</td>';
                            echo '<td width="auto">' . anchor('productos_imagenes/eliminar_imagen/' . $filaObtenerProductoPorNombre->idproductos, img($imagen_eliminar)) . '</td>';
                            if ($filaObtenerProductoPorNombre->estado == 0) {
                                echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoPorNombre->idproductos . '/' . $filaObtenerProductoPorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerProductoPorNombre->estado == 1) {
                                echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoPorNombre->idproductos . '/' . $filaObtenerProductoPorNombre->estado, img($imagen_visto)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalProductosBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerProductosPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->