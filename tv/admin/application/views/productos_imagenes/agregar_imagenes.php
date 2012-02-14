<!-- include y estilos para el carrusel de imagenes por producto -->
<link href="<?php echo base_url(); ?>/CarruselImagenes/css/skin.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>/CarruselImagenes/css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery-1.4.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery.jcarousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/CarruselImagenes/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#carousel').jcarousel();
        $('#carousel a').lightBox();
    });
</script>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
        <a href="<?php echo base_url(); ?>productos_imagenes/mantenimiento_agregar_imagenes" class="activo">Administrar Imagenes</a>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>productos_imagenes/mantenimiento_agregar_imagenes" class="button">Cancelar</a>
            <h1>Productos</h1>
            <div><a href="">Catálogo</a> / <a href="">Agregar Imagen</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente campo para agregar una imagen al producto seleccionado.
                </div>
                <?php
                if (isset($Mensaje_Imagen_Creada)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Imagen_Creada)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Imagen Agregada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo agregar la imagen, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Imagen_Creada);
                }
                ?>
                <?php
                if (isset($error_imagen)) {
                    echo '<div class="grid_7 alpha" id="formato_de_error">';
                    echo $error_imagen;
                    echo '</div>';
                    unset($error_imagen);
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
                $atributos = array('id' => 'formulario_agregar_imagen');
                echo form_open_multipart('productos_imagenes/agregarImagen', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Imagen:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <input type="file" name="userfile" size="15" />
                </div>
                <div class="grid_2 prefix_5" id="imagen_boton">
                    <input class="boton_agregar" type="submit" name="crear_imagen" value="">
                </div>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Imagenes Asociadas
                </div>
                <?php
                $imagen_agregar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/add-icon.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_visto = array(
                    'src' => base_url() . 'PlantillaAdmin/img/ms_success.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                $imagen_eliminar = array(
                    'src' => base_url() . 'PlantillaAdmin/img/hr.gif',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerImagenesProductoSeleccionado)) {
                    if (!empty($obtenerImagenesProductoSeleccionado)) {
                        echo '<div class="grid_5 prefix_2" id="carrusel_imagenes">';
                        echo '<div id="carousel" class="jcarousel-skin-tango">';
                        echo '<ul>';
                        foreach ($obtenerImagenesProductoSeleccionado as $filaObtenerImagenesProductoSeleccionado):
                            $d = explode("/", $filaObtenerImagenesProductoSeleccionado->imagenNormal);
                            $carpeta_principal = $d[1];
                            $nombre_imagen = $d[2];
                            echo '<li><a href="' . base_url() . '/' . $carpeta_principal . '/' . $nombre_imagen . '"><img src="' . base_url() . '/' . $carpeta_principal . '/' . $nombre_imagen . '" width="75" height="75" /></a></li>';
                        endforeach;
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                    }
                    unset($obtenerImagenesProductoSeleccionado);
                }
                ?>
                
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Producto Seleccionado
                </div>
                
                <?php
                if (isset($obtenerProductoSeleccionado)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Precio</th>';
                    echo '<th>Disponible</th>';
                    echo '</tr>';
                    foreach ($obtenerProductoSeleccionado as $filaObtenerProductoSeleccionado):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerProductoSeleccionado->idproductos . '</td>';
                        echo '<td width="288px">' . $filaObtenerProductoSeleccionado->nombre . '</td>';
                        echo '<td width="auto">$' . $filaObtenerProductoSeleccionado->precio . '</td>';
                        if ($filaObtenerProductoSeleccionado->estado == 0) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoSeleccionado->idproductos . '/' . $filaObtenerProductoSeleccionado->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerProductoSeleccionado->estado == 1) {
                            echo '<td>' . anchor('productos/actualizar_estado/' . $filaObtenerProductoSeleccionado->idproductos . '/' . $filaObtenerProductoSeleccionado->estado, img($imagen_visto)) . '</td>';
                        }
                        echo '</tr>';
                        echo form_hidden('id_producto_seleccionado', $filaObtenerProductoSeleccionado->idproductos);
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 1 Registro</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerProductoSeleccionado);
                }
                ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->