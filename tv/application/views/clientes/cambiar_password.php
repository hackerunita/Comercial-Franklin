<?php
$passwordActual = array(
    'name' => 'password_actual',
    'id' => 'password_actual',
    'value' => ''
);
$passwordNuevo = array(
    'name' => 'password_nuevo',
    'id' => 'password_nuevo',
    'value' => ''
);
$re_passwordNuevo = array(
    'name' => 're_password_nuevo',
    'id' => 're_password_nuevo',
    'value' => ''
);
$dataEnviarCambiar = array(
    'name' => 'submit_cambiar',
    'id' => 'submit_cambiar',
    'value' => 'Continuar',
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_cambiar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Lock.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_cambiar);?>&nbsp;&nbsp;&nbsp;Cambiar Contraseña
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_cambiar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Lock.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Cambiar Mi Contraseña&nbsp;&nbsp;&nbsp;<?= img($imagen_cambiar);?></h1>
        <?= validation_errors() ?>
        <?php
        if (isset($mensaje_cambiar_password)) {
            if ($mensaje_cambiar_password == 'Su contraseña actual no coincidio con la almacena en el sistema, vuelva a intentarlo') {
                echo '<div class="formato_de_error">';
                echo $mensaje_cambiar_password;
                echo '</div>';
            }
            unset($mensaje_cambiar_password);
        }
        ?>

        <?php
        $atributos = array('id' => 'formulario_cambiar_password');
        echo form_open('clientes/cambiando_password', $atributos);
        ?>

        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Complete el Formulario:
        </div>
        <div class="grid_2" id="aviso">
            * Informacion Requerida
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Contraseña Actual:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_password($passwordActual); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Nueva Contraseña:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_password($passwordNuevo); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Repita Contraseña:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_password($re_passwordNuevo); ?>
        </div>
        <div class="grid_6" id="boton_enviar_registro">
            <input class="boton_continuar" type="submit" name="continuar" value="">
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="grid_1" id="posicion_imagen_atras">
        <div id="imagen_siguiente">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Symbol_Back.png',
                'class' => 'imagen_mediana_icono',
            );
            echo img($imagen_propiedades);
            ?>
        </div>
        <div id="letra_imagen_siguiente">
            <?= anchor('index/index', 'Regresar', 'class="enlaces_generales"'); ?>
        </div>
    </div>
</div>

