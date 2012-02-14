<?php
$atributos = array('id' => 'formulario_contactenos');
echo form_open('informacion_corporativa/enviarEmailContactenos', $atributos);
$nombre = array(
    'name' => 'nombre',
    'id' => 'nombre',
    'value' => set_value('nombre')
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email')
);
$telefono = array(
    'name' => 'telefono',
    'id' => 'telefono',
    'value' => set_value('telefono')
);
$asunto = array(
    'name' => 'asunto',
    'id' => 'asunto',
    'value' => set_value('asunto')
);
$mensaje = array(
    'name' => 'mensaje',
    'id' => 'mensaje',
    'value' => set_value('mensaje'),
    'rows' => '5',
    'cols' => '21'
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_contactenos = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Headphones.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_contactenos).'';?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_contactenos = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Headphones.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1><?php echo $titulo; ?>&nbsp;&nbsp;&nbsp;<?= img($imagen_contactenos);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Sus Dudas e Inquietudes
        </div>
        <div class="grid_7 alpha">
            Por favor use el siguiente formulario para expresar dudas, inquietudes o realizar preguntas con respecto al sito de Comercial Franklin.
        </div>
        <div class="grid_7 alpha">
        <?= validation_errors() ?>
        </div>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Sus Datos Personales:
        </div>
        <div class="grid_2" id="aviso">
            * Información Requerida
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Nombre:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($nombre); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            E-mail:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($email); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Teléfono:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($telefono); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Asunto:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($asunto); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Mensaje:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_textarea($mensaje); ?>
        </div>
        <div class="grid_6" id="boton_enviar_registro">
            <input class="boton_enviar" type="submit" name="enviar" value="">
        </div>
        <?php echo form_close();
        ?>
    </div>
</div>

