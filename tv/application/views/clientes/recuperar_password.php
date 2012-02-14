<?php
$email = array(
    'name' => 'recuperar_email',
    'id' => 'recuperar_email',
    'value' => set_value('recuperar_email')
);
$dataEnviar = array(
    'name' => 'submit_recuperar',
    'id' => 'submit_recuperar',
    'value' => 'Enviar',
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_recuperar = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Unlock.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_recuperar);?>&nbsp;&nbsp;&nbsp;Recuperar Contraseña
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_recuperar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Unlock.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>¡Yo me he olvidado de mi contraseña!&nbsp;&nbsp;&nbsp;<?= img($imagen_recuperar);?></h1>
        <div id="contenido_formulario_registro">
            <span>Si usted se ha olvidado de su contraseña, ingrese su dirección de correo electrónico y nosotros le enviaremos un mensaje con su nueva contraseña.</span><br><br>
        </div>
        <?= validation_errors() ?>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Su E-mail:
        </div>
        <div class="grid_2" id="aviso">
            * Informacion Requerida
        </div>
        <?php
        $atributos = array('id' => 'formulario_recuperar');
        echo form_open('clientes/recuperando_password', $atributos);
        ?>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            e-mail:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($email); ?>
        </div>
        <div class="grid_6 suffix_1" id="boton_olvido_contrasenia">
            <input class="boton_enviar" type="submit" name="enviar" value="">
        </div>
        <?php echo form_close(); ?>
        <div id="contenido_formulario_registro">
            <span><font color="red"><b>Nota:</b></font> Si usted ya dispone de una cuenta dirigase a este enlace:</span>
            <?php
            $imagen_sistema = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/User.png',
                'class' => 'imagen_miniatura',
            );
            ?>
            <?= img($imagen_sistema) . ''; ?>
            <?= anchor('clientes/login', 'Entrar al Sistema', 'class="enlaces_generales"'); ?>
        </div>
    </div>
</div>
