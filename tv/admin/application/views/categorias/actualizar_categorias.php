<?php
$nombre_categoria = array(
    'name' => 'nombre_categoria',
    'id' => 'nombre_categoria',
    'value' => set_value('nombre_categoria')
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
            <a href="<?php echo base_url(); ?>categorias/mantenimiento_categorias" class="button">Cancelar</a>
            <h1>Categorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Actualizar Categorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente campo para actualizar la categoria seleccionada.
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
                $atributos = array('id' => 'formulario_actualizar_categoria');
                echo form_open('categorias/actualizar_categorias', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_categoria); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_categoria" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Categoria Seleccionada
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
                if (isset($obtenerCategoriaSeleccionada)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerCategoriaSeleccionada as $filaObtenerCategoriasSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCategoriasSeleccionada->idcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerCategoriasSeleccionada->nombre . '</td>';
                        if ($filaObtenerCategoriasSeleccionada->estado == 0) {
                            echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategoriasSeleccionada->idcategorias . '/' . $filaObtenerCategoriasSeleccionada->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerCategoriasSeleccionada->estado == 1) {
                            echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategoriasSeleccionada->idcategorias . '/' . $filaObtenerCategoriasSeleccionada->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                        echo form_hidden('id_categoria_seleccionada', $filaObtenerCategoriasSeleccionada->idcategorias);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerCategoriaSeleccionada);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->