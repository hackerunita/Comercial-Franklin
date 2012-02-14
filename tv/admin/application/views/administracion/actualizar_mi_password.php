<?php
$password = array(
    'name' => 'password',
    'id' => 'password',
    'value' => ''
);
$repetir_password = array(
    'name' => 'repetir_password',
    'id' => 'repetir_password',
    'value' => ''
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
            <a href="<?php echo base_url(); ?>" class="button">Cancelar</a>
            <h1>Mi Cuenta</h1>
            <div><a href="">Inicio</a> / <a href="">Actualizar Mi Contraseña</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar mi contraseña de acceso.
                </div>
                <?php
                if (isset($Mensaje_Password_Actualizados)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Password_Actualizados)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Mi contraseña fue actualizada exitosamente...!!';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar mi contraseña, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Password_Actualizados);
                }
                ?>
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
                $atributos = array('id' => 'formulario_actulizar_usuario');
                echo form_open('administracion/actualizarMiPassword', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Contraseña:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_password($password); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Repita Contraseña:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_password($repetir_password); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_password" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Mis Datos:
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
                if (isset($obtenerUsuarioSeleccionado)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Apellido</th>';
                    echo '<th>E-mail</th>';
                    echo '</tr>';
                    foreach ($obtenerUsuarioSeleccionado as $filaObtenerUsuario):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerUsuario->idadministradores . '</td>';
                        echo '<td width="200px">' . $filaObtenerUsuario->nombres . '</td>';
                        echo '<td width="200px">' . $filaObtenerUsuario->apellidos . '</td>';
                        echo '<td width="200px">' . $filaObtenerUsuario->email . '</td>';
                    endforeach;
                    echo '</table>';
                    echo '</div>';
                    unset($obtenerUsuarioSeleccionado);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->