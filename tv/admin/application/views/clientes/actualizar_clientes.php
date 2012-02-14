<?php
$atributos = array('id' => 'formulario_actualizar_cliente');
echo form_open('clientes/actualizarCliente', $atributos);
?>
<?php
if (isset($obtenerClienteSeleccionado)) {
    foreach ($obtenerClienteSeleccionado as $filaObtenerClienteSeleccionado):
        echo form_hidden('id_cliente_seleccionado', $filaObtenerClienteSeleccionado->idclientes);
        $nombre_cliente = array(
            'name' => 'nombre_cliente',
            'id' => 'nombre_cliente',
            'value' => $filaObtenerClienteSeleccionado->nombres
        );
        $apellido_cliente = array(
            'name' => 'apellido_cliente',
            'id' => 'apellido_cliente',
            'value' => $filaObtenerClienteSeleccionado->apellidos
        );
        $direccion_cliente = array(
            'name' => 'direccion_cliente',
            'id' => 'direccion_cliente',
            'value' => $filaObtenerClienteSeleccionado->direccion,
            'rows' => '5',
            'cols' => '41'
        );
        $email_cliente = array(
            'name' => 'email_cliente',
            'id' => 'email_cliente',
            'value' => $filaObtenerClienteSeleccionado->email
        );
        $telefono_cliente = array(
            'name' => 'telefono_cliente',
            'id' => 'telefono_cliente',
            'value' => $filaObtenerClienteSeleccionado->telefonoFijo
        );
        $celular_cliente = array(
            'name' => 'celular_cliente',
            'id' => 'celular_cliente',
            'value' => $filaObtenerClienteSeleccionado->telefonoMovil
        );
    endforeach;
    unset($obtenerClienteSeleccionado);
}else {
    echo form_hidden('id_cliente_seleccionado', $idClienteActual);
    $nombre_cliente = array(
        'name' => 'nombre_cliente',
        'id' => 'nombre_cliente',
        'value' => set_value('nombre_cliente')
    );
    $apellido_cliente = array(
        'name' => 'apellido_cliente',
        'id' => 'apellido_cliente',
        'value' => set_value('apellido_cliente')
    );
    $direccion_cliente = array(
        'name' => 'direccion_cliente',
        'id' => 'direccion_cliente',
        'value' => set_value('direccion_cliente'),
        'rows' => '5',
        'cols' => '41'
    );
    $email_cliente = array(
        'name' => 'email_cliente',
        'id' => 'email_cliente',
        'value' => set_value('email_cliente')
    );
    $telefono_cliente = array(
        'name' => 'telefono_cliente',
        'id' => 'telefono_cliente',
        'value' => set_value('telefono_cliente')
    );
    $celular_cliente = array(
        'name' => 'celular_cliente',
        'id' => 'celular_cliente',
        'value' => set_value('celular_cliente')
    );
}
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>clientes/mantenimiento_clientes" class="button">Cancelar</a>
            <h1>Usuarios Clientes</h1>
            <div><a href="">Clientes</a> / <a href="">Usuarios Clientes</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para actualizar el cliente seleccionado.
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
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Nombre:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($nombre_cliente); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Apellido:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($apellido_cliente); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Dirección:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_textarea($direccion_cliente); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    E-mail:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($email_cliente); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Teléfono Fijo:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($telefono_cliente); ?>
                </div>
                <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                    Celular:<font color="red">&nbsp;*</font>
                </div>
                <div class="grid_2 alpha" id="campos_formulario">
                    <?= form_input($celular_cliente); ?>
                </div>
                <div class="grid_2" id="imagen_boton">
                    <input class="boton_actualizar" type="submit" name="actualizar_cliente" value="">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->