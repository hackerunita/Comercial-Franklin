<?php
$nombre_categoria_actualizar = array(
    'name' => 'nombre_categoria_actualizar',
    'id' => 'nombre_categoria_actualizar',
    'value' => set_value('nombre_categoria_actualizar')
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
            <a href="<?php echo base_url(); ?>subcategorias/mantenimiento_subcategorias" class="button">Cancelar</a>
            <h1>SubCategorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Actualizar SubCategorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete los siguientes campos para actualizar la subcategoria seleccionada.
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
                $atributos = array('id' => 'formulario_actualizar_subcategoria');
                echo form_open('subcategorias/actualizarSubCategoria', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_categoria_actualizar); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Categoria:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <select name="cmb_categoria" id="cmb_categoria">
                        <option selected value="0">Elegir</option>
                        <?php
                        foreach ($obtenerCategoriasCombo as $fila):
                            echo '<option value="' . $fila->idcategorias . '">' . $fila->nombre . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_subcategoria" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    SubCategoria Seleccionada
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
                    'src' => base_url() . 'PlantillaAdmin/img/hr.gif',
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
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerSubCategoriaSeleccionada as $filaObtenerSubCategoriasSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerSubCategoriasSeleccionada->idsubcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategoriasSeleccionada->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategoriasSeleccionada->NombreCategoria . '</td>';
                        if ($filaObtenerSubCategoriasSeleccionada->estado == 0) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategoriasSeleccionada->idsubcategorias . '/' . $filaObtenerSubCategoriasSeleccionada->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerSubCategoriasSeleccionada->estado == 1) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategoriasSeleccionada->idsubcategorias . '/' . $filaObtenerSubCategoriasSeleccionada->estado, img($imagen_agregar)) . '</td>';
                        }
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