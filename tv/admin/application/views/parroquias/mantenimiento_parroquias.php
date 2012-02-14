<?php
$nombre_parroquia = array(
    'name' => 'nombre_parroquia_buscar',
    'id' => 'nombre_parroquia_buscar',
    'value' => set_value('nombre_parroquia_buscar')
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
            <a href="<?php echo base_url(); ?>parroquias/crear_parroquias" class="button">Crear Nuevo</a>
            <h1>Parroquias</h1>
            <div><a href="">Localización</a> / <a href="">Parroquias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Parroquias:
                </div>
                <?php
                if (isset($Mensaje_Parroquia_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Parroquia_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Parroquia Creada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear la parroquia, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Parroquia_Creada);
                }
                if (isset($Mensaje_Parroquia_Actualizada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Parroquia_Actualizada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Parroquia Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la parroquia, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Parroquia_Actualizada);
                }
                if (isset($Mensaje_Parroquia_Eliminada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Parroquia_Eliminada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Parroquia Eliminada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la parroquia, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Parroquia_Eliminada);
                }
                if (isset($Mensaje_Parroquia_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Parroquia_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Parroquia_Estado);
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
                $atributos = array('id' => 'formulario_buscar_parroquia');
                echo form_open('parroquias/buscar_parroquia', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_parroquia); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_parroquia" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_3 alpha" id="titulo_lista_registros">
                    Parroquias Existentes
                </div>
                <div class="grid_5 alpha" id="estilo_paginacion">
                    <?php
                    echo $this->pagination->create_links();
                    ?>
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
                if (isset($obtenerParroquias)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Ciudad</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerParroquias as $filaObtenerParroquias):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerParroquias->idparroquias . '</td>';
                        echo '<td width="400px">' . $filaObtenerParroquias->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerParroquias->NombreCiudad . '</td>';
                        echo '<td width="70px">' . anchor('parroquias/actualizar_parroquias/' . $filaObtenerParroquias->idparroquias, img($imagen_editar)) . '</td>';
                        if ($filaObtenerParroquias->estado == 0) {
                            echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquias->idparroquias . '/' . $filaObtenerParroquias->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerParroquias->estado == 1) {
                            echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquias->idparroquias . '/' . $filaObtenerParroquias->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalParroquias . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerParroquias);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerParroquiasPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroParroquiaBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerParroquiasPorNombre)) {

                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Categoria</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerParroquiasPorNombre as $filaObtenerParroquiaPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerParroquiaPorNombre->idparroquias . '</td>';
                            echo '<td width="400px">' . $filaObtenerParroquiaPorNombre->nombre . '</td>';
                            echo '<td width="400px">' . $filaObtenerParroquiaPorNombre->NombreCiudad . '</td>';
                            echo '<td width="70px">' . anchor('parroquias/actualizar_parroquias/' . $filaObtenerParroquiaPorNombre->idparroquias, img($imagen_editar)) . '</td>';
                            if ($filaObtenerParroquiaPorNombre->estado == 0) {
                                echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquiaPorNombre->idparroquias . '/' . $filaObtenerParroquiaPorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerParroquiaPorNombre->estado == 1) {
                                echo '<td>' . anchor('parroquias/actualizar_estado/' . $filaObtenerParroquiaPorNombre->idparroquias . '/' . $filaObtenerParroquiaPorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalParroquiasBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerParroquiasPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->