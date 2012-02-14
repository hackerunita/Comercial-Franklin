<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_producto = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Picture.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_producto);?>&nbsp;&nbsp;&nbsp;Detalles del Producto
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
        if (!empty($mostrarProducto)) {
            $precioReal='';
            foreach ($mostrarProducto as $producto):
                
                $imagen_moneda = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/coins.png',
                    'class' => 'imagen_miniatura',
                );
                if ($producto->precioPromocion != 0.00) {
                    echo '<div id="producto_precio" class="grid_1">'.img($imagen_moneda).'&nbsp;&nbsp;<font style="text-decoration: line-through">$' . $producto->precio . '</font><font color="red">&nbsp;&nbsp;&nbsp;$' . $producto->precioPromocion . '</font></div>';
                    $precioReal=$producto->precioPromocion;
                } else {
                    echo '<div id="producto_precio" class="grid_1">'.img($imagen_moneda).'&nbsp;&nbsp;$' . $producto->precio . '</div>';
                    $precioReal=$producto->precio;
                }
                echo '<div class="grid_7">';
                echo '<h3>' . $producto->nombre . '</h3>';
                echo '</div>';
                echo '<div class="grid_1 alpha suffix_1">';
                $imagen_propiedades = array(
                    'src' => $producto->imagenMuestra,
                    'class' => 'imagen_muestra',
                );
                echo img($imagen_propiedades);
                $comprar = array(
                  'name' => 'submit_comprar_producto',
                  'id' => 'submit_comprar_producto',
                  'value' => '',
                  'class' => 'boton_comprar_producto'
                  );
                $atributos = array('id' => 'formulario_agregar_carrito');
                echo form_open('carrito_de_compras/comprar', $atributos);
                $data = array(
                    'idproductos' => $producto->idproductos,
                    'precio' => $precioReal
                    );
                echo form_hidden($data);
                echo form_submit($comprar);
                echo form_close();
                echo '</div>';
                echo '<div id="descripcion_producto" class="grid_5">';
                echo '<div id="titulo_descripcion_producto">';
                echo '<b>Descripcion General</b>';
                echo '</div>';
                echo $producto->descripcion;
                echo '</div>';
                $d = explode(".", $producto->caracteristicas);
                echo '<div id="descripcion_producto" class="grid_7">';
                echo '<div id="titulo_caracteristicas_producto" class="grid_7">';
                echo '<b>Caracteristicas:</b>';
                echo '</div>';
                $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/images/ms_success.png',
                    'class' => 'imagen_miniatura',
                );
                echo '<div class="caracteristicas">';
                foreach ($d as $fila):
                    echo img($imagen_propiedades).' '.$fila.'<br>';
                endforeach;
                echo '</div>';
                echo '</div>';
            endforeach;
            //cargando imagenes de cada producto
            if(!empty($imagenesProducto)){
            echo '<div class="grid_5 prefix_3" id="carrusel_imagenes">';
                echo '<div id="carousel" class="jcarousel-skin-tango">';
                echo '<ul>';
                foreach ($imagenesProducto as $filaImagen):
                    echo '<li><a href="'.base_url().'/'.$filaImagen->imagenNormal.'"><img src="'.base_url().'/'.$filaImagen->imagenNormal.'" width="75" height="75" /></a></li>';
                endforeach;
                echo '</ul>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>