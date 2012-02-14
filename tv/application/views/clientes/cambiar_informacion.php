<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#ciudad").change(function(){
            $.post("<?php echo base_url() ?>clientes/cargandoComboParroquia",{ id:$(this).val() },function(data){$("#parroquia").html(data);})
        });
    })
</script>
<?php
$atributos = array('id' => 'actulizar_datos_envio');
echo form_open('clientes/cambiarDatosEnvio', $atributos);
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
$telefono = array(
    'name' => 'telefono',
    'id' => 'telefono',
    'value' => set_value('telefono')
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
        <h1>Cambiar Mis Datos De Envio&nbsp;&nbsp;&nbsp;<?= img($imagen_cambiar);?></h1>
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
                    foreach ($datosActualesCliente as $filaDatos):
                        echo $filaDatos->nombrePersonaRecibePedido . ', ' . $filaDatos->direccion.', ';
                        $ciudad = $filaDatos->ciudad;
                        $parroquia = $filaDatos->parroquia;
                    endforeach;
                    //obteniendo los nombre de ciudad y parroquia a la que pertenece el cliente
                    $nombreCiudad = $this->Pedidos_modelo->nombreCiudad($ciudad);
                    echo $nombreCiudad.', ';
                    $nombreParroquia = $this->Pedidos_modelo->nombreParroquia($parroquia);
                    echo $nombreParroquia.'.';
                    ?>
                </div>
            </div>
        </div>
        <div class="grid_5">
            Ésta es la dirección de envío actualmente seleccionada dónde se entregarán los artículos al momento de realizar una orden de pedido, si desea conservar estos datos presione el siguiente enlace:
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
                <?= anchor('index/index', 'Regresar', 'class="enlaces_generales"'); ?>
            </div>
        </div>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Nueva Direccion de Envio
        </div>
        <div class="grid_7 alpha">
            Por favor use el siguiente formulario para crear una nueva dirección de envío.
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
            <?= form_input($nombres); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Apellido:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($apellidos); ?>
        </div>
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Dirección Exacta:<font color="red">&nbsp;*</font>
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
        <div class="grid_2 prefix_1" id="etiquetas_formulario_registro_clientes">
            Teléfono:<font color="red">&nbsp;*</font>
        </div>
        <div class="grid_4 alpha" id="campos_formulario">
            <?= form_input($telefono); ?>
        </div>
        <div class="grid_6" id="boton_enviar_registro">
            <input class="boton_continuar" type="submit" name="continuar" value="">
        </div>
        <?php echo form_close(); ?>
        
    </div>
</div>
