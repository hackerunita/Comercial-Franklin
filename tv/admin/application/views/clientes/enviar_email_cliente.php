<?php
$asunto = array(
    'name' => 'asunto',
    'id' => 'asunto',
    'value' => set_value('asunto')
);
$mensaje = array(
    'name' => 'mensaje',
    'id' => 'mensaje',
    'value' => set_value('mensaje'),
    'rows' => '12',
    'cols' => '35'
);
?>
<?php $this->form_validation->set_error_delimiters('<div id="formato_de_error">', '</div>'); ?>
    </div>
    <!-- fin de columna izquierda -->

    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <a href="<?php echo base_url(); ?>clientes/mantenimiento_clientes" class="button">Cancelar</a>
            <h1>Clientes</h1>
            <div><a href="">Clientes</a> / <a href="">Enviar E-mail al Cliente</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="comentario_formulario" >
                    Complete el siguiente formulario para enviar un e-mail al cliente seleccionado.
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
                $atributos = array('id' => 'formulario_enviar_email_cliente');
                echo form_open('clientes/enviarEmail', $atributos);
                ?>
                <div class="grid_6">
                    <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                        Cliente:<font color="red">&nbsp;*</font>
                    </div>
                    <div class="grid_2 alpha" id="campos_formulario">
                        <?php echo $obtenerEmailCliente; ?>
                    </div>
                    <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                        De:<font color="red">&nbsp;*</font>
                    </div>
                    <div class="grid_2 alpha" id="campos_formulario">
                        almacenesfranklin@gmail.com
                    </div>
                    <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                        Asunto:<font color="red">&nbsp;*</font>
                    </div>
                    <div class="grid_2 alpha" id="campos_formulario">
                        <?= form_input($asunto); ?>
                    </div>
                    <div class="grid_2 prefix_1"  id="etiqueta_formulario">
                        Mensaje:<font color="red">&nbsp;*</font>
                    </div>
                    <div class="grid_1 alpha" id="campos_formulario">
                        <?= form_textarea($mensaje); ?>
                    </div>
                    <div class="grid_1 prefix_5" id="imagen_boton">
                        <input class="boton_enviar" type="submit" name="enviar_producto" value="">
                    </div>
                </div>
                <?php echo form_hidden('id_cliente_actual', $idClienteActual); ?>
                <?php echo form_hidden('email_cliente_actual', $obtenerEmailCliente); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->