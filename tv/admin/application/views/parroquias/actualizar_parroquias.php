<?php
$nombre_parroquia_actualizar = array(
    'name' => 'nombre_parroquia_actualizar',
    'id' => 'nombre_parroquia_actualizar',
    'value' => set_value('nombre_parroquia_actualizar')
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
            <a href="<?php echo base_url(); ?>parroquias/mantenimiento_parroquias" class="button">Cancelar</a>
            <h1>Parroquias</h1>
            <div><a href="">Localización</a> / <a href="">Actualizar parroquias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar la parroquia seleccionada.
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
                $atributos = array('id' => 'formulario_actualizar_parroquia');
                echo form_open('parroquias/actualizarParroquia', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_parroquia_actualizar); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Ciudad:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <select name="cmb_ciudad" id="cmb_ciudad">
                        <option selected value="0">Elegir</option>
                        <?php
                        foreach ($obtenerCiudadesCombo as $fila):
                            echo '<option value="' . $fila->idciudades . '"'. set_select('cmb_ciudad', $fila->idciudades).'>' . $fila->nombre . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_parroquia" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Parroquia Seleccionada
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
                if (isset($obtenerParroquiaSeleccionada)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Ciudad</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerParroquiaSeleccionada as $filaObtenerParroquiaSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerParroquiaSeleccionada->idparroquias . '</td>';
                        echo '<td width="400px">' . $filaObtenerParroquiaSeleccionada->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerParroquiaSeleccionada->NombreCiudad . '</td>';
                        if ($filaObtenerParroquiaSeleccionada->estado == 0) {
                            echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquiaSeleccionada->idparroquias . '/' . $filaObtenerParroquiaSeleccionada->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerParroquiaSeleccionada->estado == 1) {
                            echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquiaSeleccionada->idparroquias . '/' . $filaObtenerParroquiaSeleccionada->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                        echo form_hidden('id_parroquia_seleccionada', $filaObtenerParroquiaSeleccionada->idparroquias);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerParroquiaSeleccionada);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->