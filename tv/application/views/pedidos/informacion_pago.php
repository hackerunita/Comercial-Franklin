<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_pago = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/coins.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_pago);?>&nbsp;&nbsp;&nbsp;Proceso de Pedido de Productos
        </div>
    </div>

    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        $imagen_pago = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/coins.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1>Informacion De Pago&nbsp;&nbsp;&nbsp;<?= img($imagen_pago);?></h1>
        <div id="bloque_producto_comprar" class="grid_7 alpha">
            Metodo de Pago
        </div>
        <div class="grid_7 alpha">
            Por favor seleccione el metodo de pago que va usar para esta orden.
        </div>
        <div id="datos_de_transporte" class="grid_7 alpha">
            Seleccione una opcion:
        </div>
        <?php
        $irAlPaso3 = array('id' => 'informacion_pago');
        echo form_open('pedidos/confirmacion', $irAlPaso3);
        foreach ($listarFormasPago as $fila):
            echo '<div id="detalle_de_transporte" class="grid_5 beta">';
            echo $fila->nombre . ' en la entrega';
            echo '</div>';
            echo '<div id="detalle_de_transporte" class="grid_1 alpha">';
            echo form_radio('forma_pago', $fila->idformasdepagos, TRUE);
            echo '</div>';
        endforeach;
        ?>
        <div id="titulo_metodo_envio" class="grid_7 alpha">
            Proceso de Compra
        </div>
        <div id="contenido_barra_progreso" class="grid_8">
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . 'PlantillaComfranklin/images/paso2.png',
                'class' => 'barra_de_progreso',
            );
            echo img($imagen_propiedades);
            ?>
            <div class="grid_2 prefix_1">
                Informacion Envio
            </div>
            <div class="grid_2">
                Informacion Pago
            </div>
            <div id="item_futuro" class="grid_2">
                Confirmacion
            </div>
        </div>
        <div id="continuar_orden" class="grid_7 alpha">
            <?php
            $enviarAConfirmar = array(
                'name' => 'irpaso3',
                'id' => 'irpaso3',
                'value' => '',
                'class' => 'boton_continuar'
            );
            echo form_submit($enviarAConfirmar);
            echo form_close();
            ?>
        </div>
    </div>
</div>
