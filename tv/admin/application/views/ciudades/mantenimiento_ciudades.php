<?php
$nombre_ciudad = array(
    'name' => 'nombre_ciudad',
    'id' => 'nombre_ciudad',
    'value' => set_value('nombre_ciudad')
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
            <a href="<?php echo base_url(); ?>ciudades/crear_ciudades" class="button">Crear Nuevo</a>
            <h1>Ciudades</h1>
            <div><a href="">Localización</a> / <a href="">Ciudades</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Ciudades:
                </div>
                <?php
                if (isset($Mensaje_Ciudad_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Ciudad_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Ciudad Creada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear la ciudad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Ciudad_Creada);
                }
                if (isset($Mensaje_Ciudad_Actualizada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Ciudad_Actualizada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Ciudad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la ciudad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Ciudad_Actualizada);
                }
                if (isset($Mensaje_Ciudad_Eliminada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Ciudad_Eliminada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Ciudad Eliminada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la ciudad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Ciudad_Eliminada);
                }
                if (isset($Mensaje_Ciudad_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Ciudad_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Ciudad_Estado);
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
                $atributos = array('id' => 'formulario_buscar_ciudad');
                echo form_open('ciudades/buscar_ciudad', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_ciudad); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_ciudad" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Ciudades Existentes
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
                if (isset($obtenerCiudades)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerCiudades as $filaObtenerCiudades):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCiudades->idciudades . '</td>';
                        echo '<td width="400px">' . $filaObtenerCiudades->nombre . '</td>';
                        echo '<td width="70px">' . anchor('ciudades/actualizar_ciudades/' . $filaObtenerCiudades->idciudades, img($imagen_editar)) . '</td>';
                        if ($filaObtenerCiudades->estado == 0) {
                            echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudades->idciudades . '/' . $filaObtenerCiudades->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerCiudades->estado == 1) {
                            echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudades->idciudades . '/' . $filaObtenerCiudades->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalCiudades . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerCiudades);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerCiudadesPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroCiudadBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerCiudadesPorNombre)) {

                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerCiudadesPorNombre as $filaObtenerCiudadesPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerCiudadesPorNombre->idciudades . '</td>';
                            echo '<td width="400px">' . $filaObtenerCiudadesPorNombre->nombre . '</td>';
                            echo '<td width="70px">' . anchor('ciudades/actualizar_ciudades/' . $filaObtenerCiudadesPorNombre->idciudades, img($imagen_editar)) . '</td>';
                            if ($filaObtenerCiudadesPorNombre->estado == 0) {
                                echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudadesPorNombre->idciudades . '/' . $filaObtenerCiudadesPorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerCiudadesPorNombre->estado == 1) {
                                echo '<td>' . anchor('ciudades/actualizar_estado/' . $filaObtenerCiudadesPorNombre->idciudades . '/' . $filaObtenerCiudadesPorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalCiudadesBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerCiudadesPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->