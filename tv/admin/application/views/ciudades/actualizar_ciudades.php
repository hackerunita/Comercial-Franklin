<?php
$nombre_ciudad = array(
    'name' => 'nombre_ciudad_actualizar',
    'id' => 'nombre_ciudad_actualizar',
    'value' => set_value('nombre_ciudad_actualizar')
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
            <a href="<?php echo base_url(); ?>ciudades/mantenimiento_ciudades" class="button">Cancelar</a>
            <h1>Ciudades</h1>
            <div><a href="">Localización</a> / <a href="">Actualizar Ciudades</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar la ciudad seleccionada.
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
                $atributos = array('id' => 'formulario_actualizar_ciudad');
                echo form_open('ciudades/actualizarCiudad', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_ciudad); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_ciudad" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Ciudad Seleccionada
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
                if (isset($obtenerCiudadSeleccionada)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerCiudadSeleccionada as $filaObtenerCiudadSeleccionada):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCiudadSeleccionada->idciudades . '</td>';
                        echo '<td width="400px">' . $filaObtenerCiudadSeleccionada->nombre . '</td>';
                        if ($filaObtenerCiudadSeleccionada->estado == 0) {
                            echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudadSeleccionada->idciudades . '/' . $filaObtenerCiudadSeleccionada->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerCiudadSeleccionada->estado == 1) {
                            echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudadSeleccionada->idciudades . '/' . $filaObtenerCiudadSeleccionada->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                        echo form_hidden('id_ciudad_seleccionada', $filaObtenerCiudadSeleccionada->idciudades);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerCiudadSeleccionada);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->