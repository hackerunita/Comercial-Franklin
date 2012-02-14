<?php
$nombre_usuario_buscar = array(
    'name' => 'nombre_usuario_buscar',
    'id' => 'nombre_usuario_buscar',
    'value' => set_value('nombre_usuario_buscar')
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>administracion/crear_usuarios" class="button">Crear Nuevo</a>
            <h1>Usuarios Administradores</h1>
            <div><a href="">Administración</a> / <a href="">Busqueda de Usuarios</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Usuario:
                </div>
                <?php
                if (isset($Mensaje_Usuario_Creado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Usuario_Creado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Usuario Creado, los datos de acceso fueron enviados por e-mail';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear el usuario, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Usuario_Creado);
                }
                if (isset($Mensaje_Usuario_Actualizado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Usuario_Actualizado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Usuario Actualizado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar el usuario, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Usuario_Actualizado);
                }
                if (isset($Mensaje_Usuario_Eliminado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Usuario_Eliminado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Usuario Eliminado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar el usuario, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Usuario_Eliminado);
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
                $atributos = array('id' => 'formulario_buscar_usuario');
                echo form_open('administracion/buscar_usuario', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Apellido:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_usuario_buscar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_usuario" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Usuarios Existentes
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
                $js = 'onClick="return confirm(\'¿Está seguro que desea eliminar?\');"';
                if (isset($obtenerUsuarios)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Apellido</th>';
                    echo '<th>E-mail</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Eliminar</th>';
                    echo '</tr>';
                    foreach ($obtenerUsuarios as $filaObtenerUsuario):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerUsuario->idadministradores . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->nombres . '</td>';
                        echo '<td width="250px">' . $filaObtenerUsuario->apellidos . '</td>';
                        echo '<td width="auto">' . $filaObtenerUsuario->email . '</td>';
                        echo '<td width="70px">' . anchor('administracion/actualizar_usuario/' . $filaObtenerUsuario->idadministradores, img($imagen_editar)) . '</td>';
                        echo '<td width="70px">' . anchor('administracion/eliminarUsuario/' . $filaObtenerUsuario->idadministradores, img($imagen_eliminar),$js) . '</td>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalUsuarios . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerUsuarios);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerUsuariosPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroUsuarioBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerUsuariosPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Apellido</th>';
                        echo '<th>E-mail</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Eliminar</th>';
                        echo '</tr>';
                        foreach ($obtenerUsuariosPorNombre as $filaObtenerUsuario):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerUsuario->idadministradores . '</td>';
                            echo '<td width="250px">' . $filaObtenerUsuario->nombres . '</td>';
                            echo '<td width="250px">' . $filaObtenerUsuario->apellidos . '</td>';
                            echo '<td width="auto">' . $filaObtenerUsuario->email . '</td>';
                            echo '<td width="70px">' . anchor('administracion/actualizar_usuario/' . $filaObtenerUsuario->idadministradores, img($imagen_editar)) . '</td>';
                            echo '<td width="70px">' . anchor('administracion/eliminarUsuario/' . $filaObtenerUsuario->idadministradores, img($imagen_eliminar),$js) . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalUsuariosBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerUsuariosPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->