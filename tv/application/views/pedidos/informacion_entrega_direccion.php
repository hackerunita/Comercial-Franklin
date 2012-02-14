<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#ciudad").change(function(){
            $.post("<?php echo base_url() ?>clientes/cargandoComboParroquia",{ id:$(this).val() },function(data){$("#parroquia").html(data);})
        });
    })
</script>
<?php
$atributos = array('id' => 'actulizar_direccion_envio');
echo form_open('pedidos/actualizarYValidarDatosEnvio', $atributos);
$nombres = array(
    'name' => 'nombres',
    'id' => 'nombres',
    'value' => set_value('nombres')
);
$apellidos = array(
    'name' => 'apellidos',
    'id' => 'apellidos',
    'value' => set_value('apellidos')
);
$direccion = array(
    'name' => 'direccion',
    'id' => 'direccion',
    'value' => set_value('direccion'),
    'rows' => '5',
    'cols' => '21'
);
$ciudad = array(
    'name' => 'ciudad',
    'id' => 'ciudad',
    'value' => set_value('ciudad')
);
$parroquia = array(
    'name' => 'parroquia',
    'id' => 'parroquia',
    'value' => set_value('parroquia')
);
$sector = array(
    'name' => 'sector',
    'id' => 'sector',
    'value' => set_value('sector')
);
?>
<?php $this->form_validation->set_error_delimiters('<div class="formato_de_error">', '</div>'); ?>
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
            <?= img($imagen_sesion);?>&nbsp;&nbsp;&nbsp;Cambiar direccion de entrega
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_cambiar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Refresh.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Informacion De Envio&nbsp;&nbsp;&nbsp;<?= img($imagen_cambiar);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Direccion de Envio
        </div>
        <div class="grid_2 alpha">

            <div id="modulo" class="grid_1 alpha">
                <div id="titulo_direccion_pedido" class="grid_1 alpha">
                    Datos de Envio
                </div>
                <div id="datos_direccion_pedido" class="grid_1 alpha">
                    <?php
                    $NombreApellido = $this->session->userdata('NombreApellido');
                    $Direccion = $this->session->userdata('Direccion');
                    $NombreParroquia = $this->session->userdata('NombreParroquia');
                    $NombreCiudad = $this->session->userdata('NombreCiudad');
                    echo $NombreApellido.', '.$Direccion.', '.$NombreParroquia.', '.$NombreCiudad.'.'
                    ?>
                </div>
            </div>
        </div>
        <div class="grid_5">
            Ésta es la dirección de envío actualmente seleccionada dónde se entregarán los artículos de esta orden.
        </div>
        <div class="grid_5">
            Si desea conservar estos datos presione el siguiente enlace: 
        </div>
        <div class="prefix_4 grid_1">
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
                <?= anchor('pedidos/pedido', 'Regresar', 'class="enlaces_generales"'); ?>
            </div>
        </div>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Nueva Direccion de Envio
        </div>
        <div class="grid_7 alpha">
            Por favor use el siguiente formulario para crear una nueva dirección de envío para usarla en esta orden.
        </div>
        <div class="grid_7 alpha">
        <?= validation_errors() ?>
        </div>
        <div id="titulo_registrar_clientes" class="grid_3 alpha suffix_2">
            Sus Datos Personales:
        </div>
        <div class="grid_2" id="aviso">
            * Informacion Requerida
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Nombre:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($nombres); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Apellido:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($apellidos); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Direccion Exacta:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_textarea($direccion); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Ciudad/Cantón:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <select name="ciudad" id="ciudad">
                <option selected value="0">Elegir</option>
                <?php
            foreach ($listarCiudades as $fila):
                echo '<option value="' . $fila->idciudades . '">' . $fila->nombre . '</option>';
            endforeach;
            ?>
            </select>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Parroquia:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <select name="parroquia" id="parroquia">
            <option selected value="0">Elegir</option>
            </select>
        </div>
        <div class="grid_6" id="boton_enviar_registro">
            <input class="boton_continuar" type="submit" name="continuar" value="">
        </div>
        <?php echo form_close(); ?>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Proceso de Compra
        </div>
        <div id="contenido_barra_progreso" class="grid_8">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . 'PlantillaComfranklin/images/paso1.png',
                'class' => 'barra_de_progreso',
            );
            echo img($imagen_propiedades);
            ?>
            <div class="grid_2 prefix_1">
                Informacion Envio
            </div>
            <div id="item_futuro" class="grid_2">
                Informacion Pago
            </div>
            <div id="item_futuro" class="grid_2">
                Confirmacion
            </div>
        </div>
    </div>
</div>