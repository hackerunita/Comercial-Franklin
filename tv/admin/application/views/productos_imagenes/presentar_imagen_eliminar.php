        <a href="<?php echo base_url(); ?>productos_imagenes/mantenimiento_agregar_imagenes" class="activo">Administrar Imagenes</a>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>productos_imagenes/eliminar_imagen/<?php echo $idProductoActual ?>" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>productos_imagenes/imagenEliminada/<?php echo $idProductoImagenActual ?>/<?php echo $idProductoActual ?>" class="button">Eliminar</a>
            <h1>Productos</h1>
            <div><a href="">Catálogo</a> / <a href="">Eliminar Imagen</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Imagen a eliminar
                </div>
                <div class="grid_2 prefix_3">
                    <?php
                    foreach ($obtenerImagenSeleccionada as $filaObtenerImagenSeleccionada):
                        $d = explode("/", $filaObtenerImagenSeleccionada->imagenNormal);
                        $carpeta_principal = $d[1];
                        $nombre_imagen = $d[2];
                        $imagen_propiedades = array(
                            'src' => $carpeta_principal.'/'.$nombre_imagen,
                            'class' => 'imagen_muestra',
                        );
                        echo img($imagen_propiedades);
                    endforeach;
                    ?>
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
                    'src' => base_url() . 'PlantillaAdmin/img/hr.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
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
                    echo '<th>Precio</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerProductoSeleccionado as $filaObtenerProductoSeleccionado):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerProductoSeleccionado->idproductos . '</td>';
                        echo '<td width="288px">' . $filaObtenerProductoSeleccionado->nombre . '</td>';
                        echo '<td width="auto">$' . $filaObtenerProductoSeleccionado->precio . '</td>';
                        if ($filaObtenerProductoSeleccionado->estado == 0) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoSeleccionado->idproductos . '/' . $filaObtenerProductoSeleccionado->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerProductoSeleccionado->estado == 1) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoSeleccionado->idproductos . '/' . $filaObtenerProductoSeleccionado->estado, img($imagen_visto)) . '</td>';
                        }
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