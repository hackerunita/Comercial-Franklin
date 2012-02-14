<?php
$nombre_usuario = array(
    'name' => 'nombre_usuario',
    'id' => 'nombre_usuario',
    'value' => set_value('nombre_usuario')
);
$apellido_usuario = array(
    'name' => 'apellido_usuario',
    'id' => 'apellido_usuario',
    'value' => set_value('apellido_usuario')
);
$email_usuario = array(
    'name' => 'email_usuario',
    'id' => 'email_usuario',
    'value' => set_value('email_usuario')
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
            <a href="<?php echo base_url(); ?>administracion/mantenimiento_administracion" class="button">Cancelar</a>
            <h1>Usuarios Administradores</h1>
            <div><a href="">Administración</a> / <a href="">Actualizar Usuarios</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar los datos del usuario seleccionado.
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
                $atributos = array('id' => 'formulario_actulizar_usuario');
                echo form_open('administracion/actualizarUsuario', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_usuario); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Apellido:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($apellido_usuario); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    E-mail:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($email_usuario); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_usuario" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Usuario Seleccionado
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
                    'src' => base_url() . 'PlantillaAdmin/img/Recycle_Bin_Empty.png',
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
                    echo '<th>Eliminar</th>';
                    echo '</tr>';
                    $js = 'onClick="return confirm(\'¿Está seguro que desea eliminar?\');"';
                    foreach ($obtenerUsuarioSeleccionado as $filaObtenerUsuario):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerUsuario->idadministradores . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->nombres . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->apellidos . '</td>';
                        echo '<td width="auto">' . $filaObtenerUsuario->email . '</td>';
                        echo '<td width="70px">' . anchor('administracion/eliminarUsuario/' . $filaObtenerUsuario->idadministradores, img($imagen_eliminar),$js) . '</td>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    echo form_hidden('id_usuario_seleccionado', $filaObtenerUsuario->idadministradores);
                    unset($obtenerUsuarioSeleccionado);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->