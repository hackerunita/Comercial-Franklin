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
            <a href="<?php echo base_url(); ?>promociones/crear_promocion" class="button">Crear Nuevo</a>
            <h1>Promociones</h1>
            <div><a href="">Descuentos</a> / <a href="">Promociones</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Productos:
                </div>
                <?php
                if (isset($Mensaje_Promocion_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Promocion_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Promoción Creada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la promoción, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Promocion_Creada);
                }
                if (isset($Mensaje_Promocion_Actualizada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Promocion_Actualizada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Promoción actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la promoción, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Promocion_Actualizada);
                }
                if (isset($Mensaje_Promocion_Eliminada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Promocion_Eliminada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Promoción eliminada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la promoción, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Promocion_Eliminada);
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
                $atributos = array('id' => 'formulario_buscar_promocion');
                echo form_open('promociones/buscar_promocion', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Producto:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_producto_buscar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_promocion" value="">
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
                        echo '<td width="auto">$' . $filaObtenerPromocion->precioPromocion . '</td>';
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

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerPromocionesPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroPromocionBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerPromocionesPorNombre)) {
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
                        foreach ($obtenerPromocionesPorNombre as $filaObtenerPromocionPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerPromocionPorNombre->idproductos . '</td>';
                            echo '<td width="400px">' . $filaObtenerPromocionPorNombre->nombre . '</td>';
                            echo '<td width="auto">$' . $filaObtenerPromocionPorNombre->precio . '</td>';
                            echo '<td width="auto">$' . $filaObtenerPromocionPorNombre->precioPromocion . '</td>';
                            echo '<td width="70px">' . anchor('promociones/actualizar_promocion/' . $filaObtenerPromocionPorNombre->idproductos, img($imagen_editar)) . '</td>';
                            echo '<td width="70px">' . anchor('promociones/eliminarPromocion/' . $filaObtenerPromocionPorNombre->idproductos, img($imagen_eliminar),$js) . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalPromocionesBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerPromocionesPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->