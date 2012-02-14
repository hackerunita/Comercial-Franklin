<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_proceso = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/shopping-bag.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_proceso);?>&nbsp;&nbsp;&nbsp;Proceso de Pedido de Productos
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_proceso = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/shopping-bag.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Informacion De Envio&nbsp;&nbsp;&nbsp;<?= img($imagen_proceso);?></h1>
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
            Por favor escoja de su libreta de direcciones dónde le gustaría que le entregen los artículos adquiridos.
        </div>
        <div class="grid_5">
            <?php
            $actualizarDireccion = array('id' => 'actualizar_direccion_envio');
            echo form_open('pedidos/actualizar_direccion_envio', $actualizarDireccion);
            $cambiarDireccion = array(
                'name' => 'cambiarDireccion',
                'id' => 'cambiarDireccion',
                'value' => '',
                'class' => 'boton_cambiar_direccion'
            );
            echo form_submit($cambiarDireccion);
            echo form_close();
            ?>
        </div>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Metodo de Envio
        </div>
        <div class="grid_7 alpha">
            Éste es actualmente el único método de envío disponible para usar en esta orden.
        </div>
        <div id="datos_de_transporte" class="grid_7 alpha">
            Datos de transporte:
        </div>
        <div id="detalle_de_transporte" class="grid_5 beta">
            <?php
            $imagen_proceso = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/transportation.png',
                'class' => 'imagen_miniatura',
            );
            ?>
            <?= img($imagen_proceso);?>
            Transporte Comercial Franklin
        </div>
        <div id="detalle_de_transporte" class="grid_1 alpha">
            <font color="red">$5.00</font>
        </div>
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
        <div id="continuar_orden" class="grid_7 alpha">
            <?php
            $irAlPaso2 = array('id' => 'informacion_pago');
            echo form_open('pedidos/informacion_pago', $irAlPaso2);
            $enviarAlPago = array(
                'name' => 'irpaso2',
                'id' => 'irpaso2',
                'value' => '',
                'class' => 'boton_continuar'
            );
            echo form_submit($enviarAlPago);
            echo form_close();
            ?>
        </div>
    </div>
</div>
