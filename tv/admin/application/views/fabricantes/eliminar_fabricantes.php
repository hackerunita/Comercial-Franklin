        <!--                    <a href="#" class="link">Link here</a>
                            <a href="#" class="link">Link here</a>-->
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>fabricantes/mantenimiento_fabricantes" class="button">Cancelar</a>
            <a href="<?php echo base_url(); ?>fabricantes/eliminarFabricantes/<?php echo $idFabricanteSeleccionado ?>" class="button">Eliminar</a>
            <h1>Fabricantes</h1>
            <div><a href="">Catálogo</a> / <a href="">Eliminar Fabricantes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Fabricantes Seleccionado
                </div>
                <?php
                $imagen_editar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/edit-icon.gif',
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
                    echo '<th>Actualizar</th>';
                    echo '</tr>';
                    foreach ($obtenerFabricanteSeleccionado as $filaObtenerFabricanteSeleccionado):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerFabricanteSeleccionado->idfabricantes . '</td>';
                        echo '<td width="400px">' . $filaObtenerFabricanteSeleccionado->nombre . '</td>';
                        echo '<td width="70px">' . anchor('fabricantes/actualizar_fabricantes/' . $filaObtenerFabricanteSeleccionado->idfabricantes, img($imagen_editar)) . '</td>';
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