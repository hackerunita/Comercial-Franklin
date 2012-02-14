<?php
$nombre_subcategoria_crear = array(
    'name' => 'nombre_subcategoria_crear',
    'id' => 'nombre_subcategoria_crear',
    'value' => set_value('nombre_subcategoria_crear')
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
            <div><a href="">Catálogo</a> / <a href="">Crear SubCategorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete los siguientes campos para crear una nueva subcategoria.
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
                $atributos = array('id' => 'formulario_crear_subcategoria');
                echo form_open('subcategorias/crearSubCategoria', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_subcategoria_crear); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Categoria:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <select name="cmb_categoria" id="cmb_categoria">
                        <option selected value="0">Elegir</option>
                        <?php
                        foreach ($obtenerCategoriasCombo as $fila):
                            echo '<option value="' . $fila->idcategorias . '"'. set_select('cmb_categoria', $fila->idcategorias).'>' . $fila->nombre . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_crear" type="submit" name="crear_subcategoria" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    SubCategorias Existentes
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
                if (isset($obtenerSubCategorias)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Categoria</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerSubCategorias as $filaObtenerSubCategorias):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerSubCategorias->idsubcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategorias->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategorias->NombreCategoria . '</td>';
                        echo '<td width="70px">' . anchor('subcategorias/actualizar_subcategoria/' . $filaObtenerSubCategorias->idsubcategorias, img($imagen_editar)) . '</td>';
                        if ($filaObtenerSubCategorias->estado == 0) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategorias->idsubcategorias . '/' . $filaObtenerSubCategorias->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerSubCategorias->estado == 1) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategorias->idsubcategorias . '/' . $filaObtenerSubCategorias->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalSubCategorias . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerSubCategorias);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->