    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>administracion/mantenimiento_administracion" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>administracion/eliminarUsuario/<?php echo $idUsuarioActual ?>" class="button">Eliminar</a>
            <h1>Usuarios Administradores</h1>
            <div><a href="">Administración</a> / <a href="">Eliminar Usuarios</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Usuario Seleccionado:
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
                    echo '<th>Actualizar</th>';
                    echo '</tr>';
                    foreach ($obtenerUsuarioSeleccionado as $filaObtenerUsuario):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerUsuario->idadministradores . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->nombres . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->apellidos . '</td>';
                        echo '<td width="auto">' . $filaObtenerUsuario->email . '</td>';
                        echo '<td width="70px">' . anchor('administracion/actualizar_usuario/' . $filaObtenerUsuario->idadministradores, img($imagen_editar)) . '</td>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerUsuarioSeleccionado);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->