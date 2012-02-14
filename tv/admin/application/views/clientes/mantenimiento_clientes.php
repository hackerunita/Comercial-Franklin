<?php
$nombre_cliente_buscar = array(
    'name' => 'nombre_cliente_buscar',
    'id' => 'nombre_cliente_buscar',
    'value' => set_value('nombre_cliente_buscar')
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <h1>Usuarios Clientes</h1>
            <div><a href="">Clientes</a> / <a href="">Usuarios Clientes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Buscar Clientes:
                </div>
                <?php
                if (isset($Mensaje_Cliente_Creado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Cliente_Creado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Cliente Creado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo crear el cliente, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Cliente_Creado);
                }
                if (isset($Mensaje_Cliente_Actualizado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Cliente_Actualizado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Cliente Actualizado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar el cliente, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Cliente_Actualizado);
                }
                if (isset($Mensaje_Cliente_Estado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Cliente_Estado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'Disponibilidad Actualizada';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo actualizar la disponibilidad, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Cliente_Estado);
                }
                if (isset($Mensaje_Email_Enviado)) {
                    echo '<div class="grid_7 alpha">';
                    if (!empty($Mensaje_Email_Enviado)) {
                        echo '<div id="formato_de_exito">';
                        echo 'E-mail Enviado';
                        echo '</div>';
                    } else {
                        echo '<div id="formato_de_error">';
                        echo 'No se pudo enviar el e-mail, intentelo nuevamente!';
                        echo '</div>';
                    }
                    echo '</div>';
                    unset($Mensaje_Email_Enviado);
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
                $atributos = array('id' => 'formulario_buscar_cliente');
                echo form_open('clientes/buscar_cliente', $atributos);
                ?>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Apellido:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_cliente_buscar); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_buscar" type="submit" name="buscar_cliente" value="">
                </div>
                <?php echo form_close(); ?>
                <div class="grid_8 alpha" id="titulo_lista_registros">
                    Clientes Existentes
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
                $imagen_email = array(
                    'src' => base_url() . 'PlantillaAdmin/img/Send_Mail.png',
                    'class' => 'imagen_enlace_miniatura',
                );
                ?>
                <?php
                if (isset($obtenerClientes)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Apellido</th>';
                    echo '<th>E-mail</th>';
                    echo '<th>Actualizar</th>';
                    echo '<th>Disponible</th>';
                    echo '<th>Enviar</th>';
                    echo '</tr>';
                    foreach ($obtenerClientes as $filaObtenerCliente):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerCliente->idclientes . '</td>';
                        echo '<td width="250px">' . $filaObtenerCliente->nombres . '</td>';
                        echo '<td width="250px">' . $filaObtenerCliente->apellidos . '</td>';
                        echo '<td width="auto">' . $filaObtenerCliente->email . '</td>';
                        echo '<td width="70px">' . anchor('clientes/actualizar_clientes/' . $filaObtenerCliente->idclientes, img($imagen_editar)) . '</td>';
                        if ($filaObtenerCliente->estado == 0) {
                            echo '<td>' . anchor('clientes/actualizar_estado/' . $filaObtenerCliente->idclientes . '/' . $filaObtenerCliente->estado, img($imagen_eliminar)) . '</td>';
                        }
                        if ($filaObtenerCliente->estado == 1) {
                            echo '<td>' . anchor('clientes/actualizar_estado/' . $filaObtenerCliente->idclientes . '/' . $filaObtenerCliente->estado, img($imagen_agregar)) . '</td>';
                        }
                        echo '<td width="70px">' . anchor('clientes/enviar_email/' . $filaObtenerCliente->idclientes, img($imagen_email)) . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: ' . $obtenerTotalClientes . ' Registro(s)</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerClientes);
                }

                //muestra la tabla si se accedio a la busqueda
                if (isset($obtenerClientesPorNombre)) {
                    echo '<div class="grid_3 alpha prefix_1">';
                    echo 'Criterio de búsqueda: <b>' . $parametroClienteBusqueda . '</b>';
                    echo '</div>';
                    if (!empty($obtenerClientesPorNombre)) {
                        echo '<div class="table">';
                        echo '<table class="listing" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Apellido</th>';
                        echo '<th>E-mail</th>';
                        echo '<th>Actualizar</th>';
                        echo '<th>Disponible</th>';
                        echo '<th>Enviar</th>';
                        echo '</tr>';
                        foreach ($obtenerClientesPorNombre as $filaObtenerClientePorNombre):
                            echo '<tr>';
                            echo '<td class="id_tabla">' . $filaObtenerClientePorNombre->idclientes . '</td>';
                            echo '<td width="250px">' . $filaObtenerClientePorNombre->nombres . '</td>';
                            echo '<td width="250px">' . $filaObtenerClientePorNombre->apellidos . '</td>';
                            echo '<td width="auto">' . $filaObtenerClientePorNombre->email . '</td>';
                            echo '<td width="70px">' . anchor('clientes/actualizar_clientes/' . $filaObtenerClientePorNombre->idclientes, img($imagen_editar)) . '</td>';
                            if ($filaObtenerClientePorNombre->estado == 0) {
                                echo '<td>' . anchor('clientes/actualizar_estado/' . $filaObtenerClientePorNombre->idclientes . '/' . $filaObtenerClientePorNombre->estado, img($imagen_eliminar)) . '</td>';
                            }
                            if ($filaObtenerClientePorNombre->estado == 1) {
                                echo '<td>' . anchor('clientes/actualizar_estado/' . $filaObtenerClientePorNombre->idclientes . '/' . $filaObtenerClientePorNombre->estado, img($imagen_agregar)) . '</td>';
                            }
                            echo '<td width="70px">' . anchor('clientes/enviar_email/' . $filaObtenerClientePorNombre->idclientes, img($imagen_email)) . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        echo '<div class="select">';
                        echo '<strong>Total: ' . $obtenerTotalClientesBusqueda . ' Registro(s)</strong>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="grid_7 prefix_3" id="registro_no_encontrado">';
                        echo '<b>Registro No Encontrado</b>';
                        echo '</div>';
                    }
                    unset($obtenerClientesPorNombre);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->