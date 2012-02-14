<?php
$nombre_fabricante = array(
    'name' => 'nombre_fabricante',
    'id' => 'nombre_fabricante',
    'value' => set_value('nombre_fabricante')
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
            <a href="<?php echo base_url(); ?>fabricantes/crear_fabricante" class="button">Crear Nuevo</a>
            <h1>Fabricantes</h1>
            <div><a href="">Catálogo</a> / <a href="">Fabricante</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Fabricantes:
                </div>
                <?php
                if (isset($Mensaje_Fabricante_Creado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Fabricante_Creado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Fabricante Creado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear el fabricante, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Fabricante_Creado);
                }
                if (isset($Mensaje_Fabricante_Actualizado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Fabricante_Actualizado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Fabricante Actualizado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar el fabricante, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Fabricante_Actualizado);
                }
                if (isset($Mensaje_Fabricante_Eliminado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Fabricante_Eliminado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Fabricante Eliminado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar el fabricante, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Fabricante_Eliminado);
                }
                if (isset($Mensaje_Fabricante_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Fabricante_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Fabricante_Estado);
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
                $atributos = array('id' => 'formulario_buscar_fabricante');
                echo form_open('fabricantes/buscar_fabricantes', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_fabricante); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_fabricante" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Fabricantes Existentes
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
                if (isset($obtenerFabricantes)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerFabricantes as $filaObtenerFabricantes):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerFabricantes->idfabricantes . '</td>';
                        echo '<td width="400px">' . $filaObtenerFabricantes->nombre . '</td>';
                        echo '<td width="70px">' . anchor('fabricantes/actualizar_fabricantes/' . $filaObtenerFabricantes->idfabricantes, img($imagen_editar)) . '</td>';
                        if ($filaObtenerFabricantes->estado == 0) {
                            echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricantes->idfabricantes . '/' . $filaObtenerFabricantes->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerFabricantes->estado == 1) {
                            echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricantes->idfabricantes . '/' . $filaObtenerFabricantes->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalFabricantes . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerFabricantes);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerFabricantesPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroFabricanteBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerFabricantesPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerFabricantesPorNombre as $filaObtenerFabricantePorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerFabricantePorNombre->idfabricantes . '</td>';
                            echo '<td width="400px">' . $filaObtenerFabricantePorNombre->nombre . '</td>';
                            echo '<td width="70px">' . anchor('fabricantes/actualizar_fabricantes/' . $filaObtenerFabricantePorNombre->idfabricantes, img($imagen_editar)) . '</td>';
                            if ($filaObtenerFabricantePorNombre->estado == 0) {
                                echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricantePorNombre->idfabricantes . '/' . $filaObtenerFabricantePorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerFabricantePorNombre->estado == 1) {
                                echo '<td>' . anchor('fabricantes/actualizar_estado/' . $filaObtenerFabricantePorNombre->idfabricantes . '/' . $filaObtenerFabricantePorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalFabricantesBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerFabricantesPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->