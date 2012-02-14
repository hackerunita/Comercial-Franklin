<?php
$id_CarritoCompras = $this->session->userdata('idCarrito');
?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_sesion = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Users_Group.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_sesion).'';?>&nbsp;&nbsp;&nbsp;Mi Cuenta
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        <h3>Información de mi cuenta</h3>
        <?php
        if (isset($mensaje_cambiar_password)) {
            if ($mensaje_cambiar_password == 'Su contraseña se actualizo exitosamente!') {
                echo '<div class="formato_de_exito">';
                echo $mensaje_cambiar_password;
                echo '</div>';
            }
            unset($mensaje_cambiar_password);
        }
        if (isset($mensaje_cambiar_datos_envio)) {
            if ($mensaje_cambiar_datos_envio == 'Sus datos se actualizaron exitosamente!') {
                echo '<div class="formato_de_exito">';
                echo $mensaje_cambiar_datos_envio;
                echo '</div>';
            } else {
                echo '<div class="formato_de_error">';
                echo $mensaje_cambiar_datos_envio;
                echo '</div>';
            }
            unset($mensaje_cambiar_datos_envio);
        }
        ?>
        <div id="index_cliente" class="grid_4">
            <p class="titilo_acceso">
                Mi Cuenta:
            </p>
            <div id="opciones_index">
                <?php
                    $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/User.png',
                    'class' => 'imagen_mediana_icono',
                );
                echo img($imagen_propiedades);
                ?>
                <?= anchor('clientes/cambiar_informacion', 'Ver o Cambiar Mis Datos', 'class="enlaces_generales"'); ?>
            </div>
            <div id="opciones_index">
                <?php
                    $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Lock.png',
                    'class' => 'imagen_mediana_icono',
                );
                echo img($imagen_propiedades);
                ?>
                <?= anchor('clientes/cambiar_password', 'Cambiar Contraseña', 'class="enlaces_generales"'); ?>
            </div>
            <div id="opciones_index">
                <?php
                    $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Delete.png',
                    'class' => 'imagen_mediana_icono',
                );
                echo img($imagen_propiedades);
                ?>
                <?= anchor('clientes/cerrar_sesion/' . $id_CarritoCompras, 'Cerrar Sesión', 'class="enlaces_generales"'); ?>
            </div>
            <div id="titulo_pedidos">
                Mis Pedidos:
            </div>
            <div id="opciones_index">
                <?php
                    $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Notepad.png',
                    'class' => 'imagen_mediana_icono',
                );
                echo img($imagen_propiedades);
                ?>
                <?= anchor('pedidos/historialPedidos', 'Historial de pedidos', 'class="enlaces_generales"'); ?>
            </div>
        </div>
        <div class="grid_3" id="top_latino_radio">
            <!-- top latino radio 
            <embed pluginspage="http://www.adobe.com/go/getflashplayer"src="http://toplatino.net/players/toplatino.swf" width="160" height="240" wmode="transparent"type="application/x-shockwave-flash" allowscriptaccess="always" HIDDEN="true"></embed>
            -->
            <embed pluginspage="http://www.adobe.com/go/getflashplayer"src="http://cadenatop.com/cadenatop_mini.swf" width="200" height="228" wmode="transparent"type="application/x-shockwave-flash" allowscriptaccess="always"></embed>

        </div>
    </div>
</div>