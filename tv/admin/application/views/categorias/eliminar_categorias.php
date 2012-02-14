
    <!--                    <a href="#" class="link">Link here</a>
                        <a href="#" class="link">Link here</a>-->
</div>
<!-- fin de columna izquierda -->
<!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>categorias/mantenimiento_categorias" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>categorias/eliminarCategoria/<?php echo $idCategoriaSeleccionada ?>" class="button">Eliminar</a>
            <h1>Categorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Eliminar Categorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Categoria Seleccionada
                </div>
                <?php
                $imagen_editar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/edit-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerCategoriaSeleccionada)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Actualizar</th>';
                    //echo '<th>Eliminar</th>';
                    echo '</tr>';
                    foreach ($obtenerCategoriaSeleccionada as $filaObtenerCategoriasSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCategoriasSeleccionada->idcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerCategoriasSeleccionada->nombre . '</td>';
                        echo '<td width="70px">' . anchor('categorias/actualizarCategoria/' . $filaObtenerCategoriasSeleccionada->idcategorias, img($imagen_editar)) . '</td>';
                        //echo '<td>' . anchor('categorias/eliminarCategoria/' . $filaObtenerCategoriasSeleccionada->idcategorias, img($imagen_eliminar)) . '</td>';
                        echo '</tr>';
                        echo form_hidden('id_categoria_seleccionada', $filaObtenerCategoriasSeleccionada->idcategorias);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerCategorias);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->