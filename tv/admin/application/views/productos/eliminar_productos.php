        <!--                    <a href="#" class="link">Link here</a>
                            <a href="#" class="link">Link here</a>-->
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>productos/mantenimiento_productos" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>productos/eliminarProducto/<?php echo $idProductoSeleccionado ?>" class="button">Eliminar</a>
            <h1>Productos</h1>
            <div><a href="">Catálogo</a> / <a href="">Eliminar Productos</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Producto Seleccionado
                </div>
                <?php
                $imagen_editar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/edit-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerProductoSeleccionado)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Precio</th>';
                        echo '<th>Stock</th>';
                        echo '<th>Actualizar</th>';
                    echo '</tr>';
                    foreach ($obtenerProductoSeleccionado as $filaObtenerProductoSeleccionado):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerProductoSeleccionado->idproductos . '</td>';
                            echo '<td width="400px">' . $filaObtenerProductoSeleccionado->nombre . '</td>';
                            echo '<td width="auto">' . $filaObtenerProductoSeleccionado->precio . '</td>';
                            echo '<td width="auto">' . $filaObtenerProductoSeleccionado->stock . '</td>';
                            echo '<td width="70px">' . anchor('productos/actualizar_productos/' . $filaObtenerProductoSeleccionado->idproductos, img($imagen_editar)) . '</td>';
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
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->