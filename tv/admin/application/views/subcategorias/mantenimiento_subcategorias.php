<?php
$nombre_subcategoria = array(
    'name' => 'nombre_subcategoria',
    'id' => 'nombre_subcategoria',
    'value' => set_value('nombre_subcategoria')
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
            <a href="<?php echo base_url(); ?>subcategorias/crear_subcategoria" class="button">Crear Nuevo</a>
            <h1>Subcategorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Subcategorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Subcategorias:
                </div>
                <?php
                if (isset($Mensaje_Subcategoria_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Subcategoria_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Subcategoria Creada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear la subcategoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Subcategoria_Creada);
                }
                if (isset($Mensaje_Subcategoria_Actualizada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Subcategoria_Actualizada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Subcategoria Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la subcategoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Subcategoria_Actualizada);
                }
                if (isset($Mensaje_Subcategoria_Eliminada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Subcategoria_Eliminada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Subcategoria Eliminada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la subcategoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Subcategoria_Eliminada);
                }
                if (isset($Mensaje_SubCategoria_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_SubCategoria_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_SubCategoria_Estado);
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
                $atributos = array('id' => 'formulario_buscar_subcategoria');
                echo form_open('subcategorias/buscar_subcategoria', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_subcategoria); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="crear_subcategoria" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    SubCategorias Existentes
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
                if (isset($obtenerSubCategorias)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Categoria</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerSubCategorias as $filaObtenerSubCategorias):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerSubCategorias->idsubcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategorias->nombre . '</td>';
                        echo '<td width="400px">' . $filaObtenerSubCategorias->NombreCategoria . '</td>';
                        echo '<td width="70px">' . anchor('subcategorias/actualizar_subcategoria/' . $filaObtenerSubCategorias->idsubcategorias, img($imagen_editar)) . '</td>';
                        if ($filaObtenerSubCategorias->estado == 0) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategorias->idsubcategorias . '/' . $filaObtenerSubCategorias->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerSubCategorias->estado == 1) {
                            echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategorias->idsubcategorias . '/' . $filaObtenerSubCategorias->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalSubCategorias . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerSubCategorias);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerSubCategoriasPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroSubCategoriaBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerSubCategoriasPorNombre)) {

                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Categoria</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerSubCategoriasPorNombre as $filaObtenerSubCategoriasPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerSubCategoriasPorNombre->idsubcategorias . '</td>';
                            echo '<td width="400px">' . $filaObtenerSubCategoriasPorNombre->nombre . '</td>';
                            echo '<td width="400px">' . $filaObtenerSubCategoriasPorNombre->NombreCategoria . '</td>';
                            echo '<td width="70px">' . anchor('subcategorias/actualizar_subcategoria/' . $filaObtenerSubCategoriasPorNombre->idsubcategorias, img($imagen_editar)) . '</td>';
                            if ($filaObtenerSubCategoriasPorNombre->estado == 0) {
                                echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategoriasPorNombre->idsubcategorias . '/' . $filaObtenerSubCategoriasPorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerSubCategoriasPorNombre->estado == 1) {
                                echo '<td>' . anchor('subcategorias/actualizar_estado/' . $filaObtenerSubCategoriasPorNombre->idsubcategorias . '/' . $filaObtenerSubCategoriasPorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalSubCategoriasBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerSubCategoriasPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->