<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_buscar = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/buscar.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_buscar);?>&nbsp;&nbsp;&nbsp;<?php echo $titulo ?>
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        <?php
            $imagen_buscar = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/buscar.png',
                'class' => 'imagen_mediana_icono',
            );
        ?>
        <div class="grid_5">
        <h1><?php echo 'Criterio de Busqueda: <i>'.$criterio_de_busqueda.'</i>'; ?>&nbsp;&nbsp;&nbsp;<?= img($imagen_buscar);?></h1>
        </div>
        <?php
        if (isset($listarProductos)) {
            echo '<div id="tabla_principal" class="grid_7">';
            echo '<table id="rounded-corner" summary="Lista de productos">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col" class="rounded-company">Imagen</th>';
            echo '<th scope="col" class="rounded-q1">';
            echo 'Nombre Producto';
            echo '</th>';
            echo '<th scope="col" class="rounded-q3">';
            echo 'Precio';
            echo '</th>';
            echo '<th scope="col" class="rounded-q4">Comprar</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tfoot>';
            echo '<tr>';
            echo '<td colspan="3" class="rounded-foot-left"><em></em></td>';
            echo '<td class="rounded-foot-right">&nbsp;</td>';
            echo '</tr>';
            echo '</tfoot>';
            echo '<tbody>';
            $precioReal = '';
            foreach ($listarProductos as $row):
                echo '<tr>';
                echo '<td>';
                $imagen_propiedades = array(
                    'src' => $row->imagenMuestra,
                    'class' => 'imagen_producto',
                );
                echo anchor('productos/presentar_producto/' . $row->idproductos, img($imagen_propiedades));
                echo '</td>';
                echo '<td>';
                echo anchor('productos/presentar_producto/' . $row->idproductos, $row->nombre, 'class="enlaceListaProductos"');
                echo '</td>';
                if ($row->precioPromocion != 0.00) {
                    echo '<td>';
                    echo '<span style="text-decoration: line-through">$' . $row->precio . '</span>';
                    echo '<div id="articuloPromocionDatos"><font color="red">$' . $row->precioPromocion . '</font></div>';
                    echo '</td>';
                    $precioReal = $row->precioPromocion;
                } else {
                    echo '<td>';
                    echo '$'.$row->precio;
                    echo '</td>';
                    $precioReal = $row->precio;
                }
                echo '<td>';
                $agregarProductoCarrito = array('id' => 'formulario_agregar_producto');
                echo form_open('carrito_de_compras/comprar', $agregarProductoCarrito);
                $datos = array(
                    'idproductos' => $row->idproductos,
                    'precio' => $precioReal
                );
                echo form_hidden($datos);
                echo '<input class="boton_comprar" type="submit" name="comprar" value="">';
                //echo form_submit('submit', 'Comprar Ahora');
                echo form_close();
                echo '</td>';
                echo '</tr>';
            endforeach;
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            unset($listarProductos);
        }
        ?>
    </div>
</div>
