<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_lista = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Mobile.png',
            'class' => 'imagen_miniatura',
        );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_lista);?>&nbsp;&nbsp;&nbsp;Lista de Productos
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_8 alpha">
        
        <div class="grid_2">
        <h1><?php echo $nombreSubCategoria ?></h1>
        </div>
<!--        <div class="grid_2">
        <h1><?php //echo $this->pagination->create_links(); ?></h1>
        </div>-->
        <?php
        if (!empty($listarProductos)) {
            echo '<div id="select_filtrar_por_marca" class="grid_5">';
            $atributos = array('id' => 'filtrar_fabricantes');
            echo form_open('productos/listar_productos_por_fabricante', $atributos);
            echo '<b>Mostrar:</b>';
            echo '<select id="fabricantes" name="fabricantes" onchange="this.form.submit()">';
            echo '<option value="elija">Elegir</option>';
            echo '<option value="0">Todas las marcas</option>';
            foreach ($listarFabricantes as $fila):
                echo '<option value="' . $fila->idfabricantes . '"'. set_select('fabricantes', $fila->idfabricantes).'>' . $fila->nombre . '</option>';
            endforeach;
            echo '</select>';
            echo form_hidden('idSubCategoria', $idSubCategoria);
            echo form_close();
            echo '</div>';
            
            echo '<div id="tabla_principal" class="grid_7">';
            
            echo '<table id="rounded-corner" summary="Lista de productos">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col" class="rounded-company">Vista Previa</th>';
            echo '<th scope="col" class="rounded-q1">';
            if ($ordenProducto == 'ASC' OR $ordenProducto == '') {
                echo anchor('productos/listar_productos_por_orden/' . $idSubCategoria . '/nombre/DESC/' . $idFabricante, 'Nombre Productos');
            }
            if ($ordenProducto == 'DESC') {
                echo anchor('productos/listar_productos_por_orden/' . $idSubCategoria . '/nombre/ASC/' . $idFabricante, 'Nombre Productos');
            }
            echo '</th>';
            echo '<th scope="col" class="rounded-q3">';
            if ($ordenProducto == 'ASC' OR $ordenProducto == '') {
                echo anchor('productos/listar_productos_por_orden/' . $idSubCategoria . '/precio/DESC/' . $idFabricante, 'Precio');
            }
            if ($ordenProducto == 'DESC') {
                echo anchor('productos/listar_productos_por_orden/' . $idSubCategoria . '/precio/ASC/' . $idFabricante, 'Precio');
            }
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
                echo '</div>';
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
                echo form_close();
                echo '</td>';
                echo '</tr>';
            endforeach;
            echo '</tbody>';
            echo '</table>';
            
            echo '</div>';
        }
        unset($listarProductos);
        ?>
        
<!--        <table id="rounded-corner" summary="Lista de productos">
            <thead>
                <tr>
                    <th scope="col" class="rounded-company">Imagen</th>
                    <th scope="col" class="rounded-q1">Nombre Producto</th>
                    <th scope="col" class="rounded-q3">Precio</th>
                    <th scope="col" class="rounded-q4">Comprar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="3" class="rounded-foot-left"><em></em></td>
                    <td class="rounded-foot-right">&nbsp;</td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>
                        <img border="0" src="PlantillaComfranklin/images/die_hard_3.gif" class="imagen_producto"/>
                    </td>
                    <td>
                        Die Hard With A Vengeance
                    </td>
                    <td>$39.99</td>
                    <td>
                        Comprar Ahora
                    </td>
                </tr>
            </tbody>
        </table>-->
        
    </div>
</div>