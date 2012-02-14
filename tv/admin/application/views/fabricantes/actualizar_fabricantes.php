<?php
$nombre_fabricante_actualizar = array(
    'name' => 'nombre_fabricante_actualizar',
    'id' => 'nombre_fabricante_actualizar',
    'value' => set_value('nombre_fabricante_actualizar')
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
            <a href="<?php echo base_url(); ?>fabricantes/mantenimiento_fabricantes" class="button">Cancelar</a>
            <h1>Fabricantes</h1>
            <div><a href="">Catálogo</a> / <a href="">Actualizar Fabricantes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente campo para actualizar el fabricante seleccionado.
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
                $atributos = array('id' => 'formulario_actualizar_fabricante');
                echo form_open('fabricantes/actualizarFabricantes', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_fabricante_actualizar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_fabricante" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Fabricante Seleccionado
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
                if (isset($obtenerFabricanteSeleccionado)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerFabricanteSeleccionado as $filaObtenerFabricanteSeleccionado):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerFabricanteSeleccionado->idfabricantes . '</td>';
                        echo '<td width="400px">' . $filaObtenerFabricanteSeleccionado->nombre . '</td>';
                        if ($filaObtenerFabricanteSeleccionado->estado == 0) {
                            echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricanteSeleccionado->idfabricantes . '/' . $filaObtenerFabricanteSeleccionado->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerFabricanteSeleccionado->estado == 1) {
                            echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricanteSeleccionado->idfabricantes . '/' . $filaObtenerFabricanteSeleccionado->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                        echo form_hidden('id_fabricante_seleccionada', $filaObtenerFabricanteSeleccionado->idfabricantes);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerFabricanteSeleccionado);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->