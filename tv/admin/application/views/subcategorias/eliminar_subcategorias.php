        <!--                    <a href="#" class="link">Link here</a>
                            <a href="#" class="link">Link here</a>-->
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>subcategorias/mantenimiento_subcategorias" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>subcategorias/eliminarSubCategoria/<?php echo $idSubCategoriaSeleccionada ?>" class="button">Eliminar</a>
            <h1>SubCategorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Eliminar SubCategorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    SubCategoria Seleccionada
                </div>
                <?php
                $imagen_editar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/edit-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerSubCategoriaSeleccionada)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Categoria</th>';
                    echo '<th>Actualizar</th>';
                    echo '</tr>';
                    foreach ($obtenerSubCategoriaSeleccionada as $filaObtenerSubCategoriasSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerSubCategoriasSeleccionada->idsubcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategoriasSeleccionada->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategoriasSeleccionada->NombreCategoria . '</td>';
                        echo '<td width="70px">' . anchor('subcategorias/actualizar_subcategoria/' . $filaObtenerSubCategoriasSeleccionada->idsubcategorias, img($imagen_editar)) . '</td>';
                        echo '</tr>';
                        echo form_hidden('id_subcategoria_seleccionada', $filaObtenerSubCategoriasSeleccionada->idsubcategorias);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerSubCategoriaSeleccionada);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->