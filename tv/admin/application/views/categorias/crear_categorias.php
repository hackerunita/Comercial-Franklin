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
            <a href="<?php echo base_url(); ?>categorias/mantenimiento_categorias" class="button">Cancelar</a>
            <h1>Categorias</h1>
            <div><a href="">Catálogo</a> / <a href="">Crear Categorias</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente campo para crear una nueva categoria.
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
                $atributos = array('id' => 'formulario_crear_categoria');
                echo form_open('categorias/crearCategoria', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_categoria); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_crear" type="submit" name="crear_categoria" value="">
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
                ?>
<!--                <div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                        
                        <tr>
                            <td class="id_tabla">1</td>
                            <td width="400px">Audio y Video</td>
                            <td width="70px"><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="id_tabla">2</td>
                            <td class="style3">Linea Blanca</td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="id_tabla">3</td>
                            <td class="style4">Computacion</td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="<?php echo base_url(); ?>PlantillaAdmin/img/hr.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        
                    </table>
                    <div class="select">
                        <strong>Total: 3 Registro(s)</strong>
                        <select>
                            <option>1</option>
                        </select>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <!-- fin de columna central -->