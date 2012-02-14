<?php
$nombre_categoria = array(
    'name' => 'nombre_categoria',
    'id' => 'nombre_categoria',
    'value' => set_value('nombre_categoria')
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
            <a href="<?php echo base_url(); ?>categorias/crear_categoria" class="button">Crear Nuevo</a>
            <h1>Categorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Categorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Categorias:
                </div>
                <?php
                if (isset($Mensaje_Categoria_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Categoria_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Categoria Creada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear la categoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Categoria_Creada);
                }
                if (isset($Mensaje_Categoria_Actualizada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Categoria_Actualizada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Categoria Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la categoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Categoria_Actualizada);
                }
                if (isset($Mensaje_Categoria_Eliminada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Categoria_Eliminada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Categoria Eliminada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo eliminar la categoria, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Categoria_Eliminada);
                }
                if (isset($Mensaje_Categoria_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Categoria_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Categoria_Estado);
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
                $atributos = array('id' => 'formulario_buscar_categoria');
                echo form_open('categorias/buscarCategoria', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_categoria); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="crear_categoria" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Categorias Existentes
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
                if (isset($obtenerCategorias)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerCategorias as $filaObtenerCategorias):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCategorias->idcategorias . '</td>';
                        echo '<td width="400px">' . $filaObtenerCategorias->nombre . '</td>';
                        echo '<td width="70px">' . anchor('categorias/actualizarCategoria/' . $filaObtenerCategorias->idcategorias, img($imagen_editar)) . '</td>';
                        if ($filaObtenerCategorias->estado == 0) {
                            echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategorias->idcategorias . '/' . $filaObtenerCategorias->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerCategorias->estado == 1) {
                            echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategorias->idcategorias . '/' . $filaObtenerCategorias->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalCategorias . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerCategorias);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerCategoriasPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroCategoriaBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerCategoriasPorNombre)) {

                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '</tr>';
                        foreach ($obtenerCategoriasPorNombre as $filaObtenerCategoriasPorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerCategoriasPorNombre->idcategorias . '</td>';
                            echo '<td width="400px">' . $filaObtenerCategoriasPorNombre->nombre . '</td>';
                            echo '<td width="70px">' . anchor('categorias/actualizarCategoria/' . $filaObtenerCategoriasPorNombre->idcategorias, img($imagen_editar)) . '</td>';
                            if ($filaObtenerCategoriasPorNombre->estado == 0) {
                                echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategoriasPorNombre->idcategorias . '/' . $filaObtenerCategoriasPorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerCategoriasPorNombre->estado == 1) {
                                echo '<td>' . anchor('categorias/actualizar_estado/' . $filaObtenerCategoriasPorNombre->idcategorias . '/' . $filaObtenerCategoriasPorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalCategoriasBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerCategoriasPorNombre);
                }
                ?>
                
                
                
<!--                <div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Nombre</th>
                            <th>Header</th>
                            <th>Head</th>
                            <th>Header</th>
                            <th>Header</th>
                            
                            <th>Head</th>
                            <th>Header</th>
                            <th>Head</th>
                        </tr>
                        
                        <tr>
                            <td class="style2">- Lorem Ipsum </td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style3">- Lorem Ipsum </td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style4">- Lorem Ipsum </td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                    </table>
                    <div class="select">
                        <strong>Other Pages: </strong>
                        <select>
                            <option>1</option>
                        </select>
                    </div>
                </div>-->
                
                
                
            </div>
        </div>
    </div>
    <!-- fin de columna central -->