<?php
$is_logged_in = $this->session->userdata('is_logged_in');
$id_cliente = $this->session->userdata('id_cliente');
$id_CarritoCompras = $this->session->userdata('idCarrito');
$ip_maquina_actual = getenv('REMOTE_ADDR');
?>
<!-- contenido columna derecha -->
<div id="columna_derecha" class="grid_2 alpha">

    <div id="tituloPromocion" class="grid_1 alpha">
        Mis Datos
    </div>
    <div id="acceso_sistema" class="grid_1 alpha">
        <?php
        $imagen_usuario = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/User.png',
            'class' => 'imagen_miniatura',
        );
        $imagen_usuariosinsesion = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Lock.png',
            'class' => 'imagen_miniatura',
        );
        $imagen_carrito = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Shopping_Cart.png',
            'class' => 'imagen_miniatura',
        );
        $imagen_cerrar = array(
            'src' => base_url() . '/PlantillaComfranklin/iconos/Delete.png',
            'class' => 'imagen_miniatura',
        );
        if ($is_logged_in == TRUE OR $id_cliente != '') {
            echo img($imagen_usuario);?>&nbsp;&nbsp;<?php
            echo anchor('index', 'Mi Cuenta');
            echo "<br>";
        } else {
            echo img($imagen_usuariosinsesion);?>&nbsp;&nbsp;<?php
            echo anchor('clientes/login', 'Entrar');
            echo "<br>";
        }
        ?>
        <?php
        if ($is_logged_in == TRUE OR $id_cliente != '') {
            $query = $this->db->query('SELECT DISTINCT c.idcarrito_de_compras
            FROM detalle_carrito_de_compras dc, carrito_de_compras c, cliente_carrito cc, clientes cli
            WHERE c.terminado =0
            AND c.idcarrito_de_compras = carrito_de_compras_idcarrito_de_compras
            AND c.idcarrito_de_compras = cc.carrito_de_compras_idcarrito
            AND clientes_idclientes =' . $id_cliente . '
            AND cli.idclientes = cc.clientes_idclientes');
            if ($query->num_rows() > 0) {
                $idCarrito = $query->row()->idcarrito_de_compras;
                echo img($imagen_carrito);?>&nbsp;&nbsp;<?php
                echo '<a href="" id="">' . anchor('carrito_de_compras/verificarCarrito/' . $idCarrito, 'Carrito de Compras') . '</a><br>';
                echo img($imagen_cerrar);?>&nbsp;&nbsp;<?php
                echo '<a href="" id="">' . anchor('clientes/cerrar_sesion/' . $id_CarritoCompras, 'Cerrar Sesión') . '</a><br>';
            } else {
                $idCarrito = 'vacio';
                echo img($imagen_carrito);?>&nbsp;&nbsp;<?php
                echo '<a href="" id="">' . anchor('carrito_de_compras/verificarCarrito/' . $idCarrito, 'Carrito de Compras') . '</a><br>';
                echo img($imagen_cerrar);?>&nbsp;&nbsp;<?php
                echo '<a href="" id="">' . anchor('clientes/cerrar_sesion/' . $id_CarritoCompras, 'Cerrar Sesión') . '</a><br>';
            }
        } else {
            $query = $this->db->query('SELECT idcarrito_de_compras
                    FROM carrito_de_compras
                    LEFT JOIN cliente_carrito ON carrito_de_compras.idcarrito_de_compras = cliente_carrito.carrito_de_compras_idcarrito
                    WHERE carrito_de_compras_idcarrito IS NULL 
                    AND terminado =0
                    AND descripcion =  "' . $ip_maquina_actual . '"');
            if ($query->num_rows() > 0) {
                $idCarritoSinSesion = $query->row()->idcarrito_de_compras;
                $existenProductosSinSesion = $this->db->query('SELECT dc.iddetalle_carrito_de_compras
                        FROM detalle_carrito_de_compras dc, carrito_de_compras c
                        WHERE c.terminado =0
                        AND c.idcarrito_de_compras = dc.carrito_de_compras_idcarrito_de_compras
                        AND c.descripcion =  "' . $ip_maquina_actual . '"
                        AND c.idcarrito_de_compras =' . $idCarritoSinSesion);
                if ($existenProductosSinSesion->num_rows() > 0) {
                    echo img($imagen_carrito);?>&nbsp;&nbsp;<?php
                    echo '<a href="" id="">' . anchor('carrito_de_compras/verificarCarrito/' . $idCarritoSinSesion, 'Carrito de Compras') . '</a><br>';
                } else {
                    $idCarritoSinSesion = 'vacio';
                    echo img($imagen_carrito);?>&nbsp;&nbsp;<?php
                    echo '<a href="" id="">' . anchor('carrito_de_compras/verificarCarrito/' . $idCarritoSinSesion, 'Carrito de Compras') . '</a><br>';
                }
            }
        }
        ?>
    </div>
    <div id="modulo_carrito" class="grid_1 alpha">
        <div id="titulo_carrito" class="grid_1 alpha">
            Mi Carrito
        </div>
        <div id="datos_carrito" class="grid_1 alpha">
            <?php
            if ($id_CarritoCompras != '') {
                $productos = $this->db->query('SELECT p.idproductos, p.nombre, p.imagenMuestra, p.precio, p.precioPromocion, dc.cantidad, dc.subtotal
            FROM productos p, detalle_carrito_de_compras dc 
            WHERE dc.carrito_de_compras_idcarrito_de_compras=' . $id_CarritoCompras . ' and 
            p.idproductos=dc.productos_idproductos');
                if ($productos->num_rows() > 0) {
                    echo '<table frame="below" border="0">';
                    foreach ($productos->result() as $fila):
                        echo '<tr>';
                        echo '<td align="right" valign="top">&nbsp;' . $fila->cantidad . '&nbsp;x&nbsp;</td>';
                        echo '<td>' . $fila->nombre . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    $total = $this->db->query('SELECT total
                        FROM carrito_de_compras WHERE idcarrito_de_compras =' . $id_CarritoCompras);
                    if ($total->num_rows() > 0) {
                        echo '<div id="totalCarrito" class="grid_1 alpha">';
                        echo '$' . $total->row()->total;
                        echo '</div>';
                    }
                } else {
                    echo '<table frame="below" border="0">';
                    echo '<tr>';
                    echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sin Artículos</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            } else {
                $query = $this->db->query('SELECT idcarrito_de_compras
                    FROM carrito_de_compras
                    LEFT JOIN cliente_carrito ON carrito_de_compras.idcarrito_de_compras = cliente_carrito.carrito_de_compras_idcarrito
                    WHERE carrito_de_compras_idcarrito IS NULL 
                    AND terminado =0
                    AND descripcion =  "' . $ip_maquina_actual . '"');
                if ($query->num_rows() > 0) {
                    $idCarritoSinSesion = $query->row()->idcarrito_de_compras;
                    $productosSinSesion = $this->db->query('SELECT p.idproductos, p.nombre, p.imagenMuestra, p.precio, p.precioPromocion, dc.cantidad, dc.subtotal
                        FROM productos p, detalle_carrito_de_compras dc 
                        WHERE dc.carrito_de_compras_idcarrito_de_compras=' . $idCarritoSinSesion . ' and 
                        p.idproductos=dc.productos_idproductos');
                    if ($productosSinSesion->num_rows() > 0) {
                        echo '<table frame="below" border="0">';
                        foreach ($productosSinSesion->result() as $fila):
                            echo '<tr>';
                            echo '<td align="right" valign="top">&nbsp;' . $fila->cantidad . '&nbsp;x&nbsp;</td>';
                            echo '<td>' . $fila->nombre . '</td>';
                            echo '</tr>';
                        endforeach;
                        echo '</table>';
                        $totalSinSesion = $this->db->query('SELECT total
                        FROM carrito_de_compras WHERE idcarrito_de_compras =' . $idCarritoSinSesion);
                        if ($totalSinSesion->num_rows() > 0) {
                            echo '<div id="totalCarrito" class="grid_1 alpha">';
                            echo '$' . $totalSinSesion->row()->total;
                            echo '</div>';
                        }
                    } else {
                        echo '<table frame="below" border="0">';
                        echo '<tr>';
                        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sin Artículos</td>';
                        echo '</tr>';
                        echo '</table>';
                    }
                } else {
                    echo '<table border="0">';
                    echo '<tr>';
                    echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sin Artículos</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            }
            ?>
        </div>
    </div>
    <!--
    <div id="modulo_carrito" class="grid_1 alpha">
        <div id="titulo_carrito" class="grid_1 alpha">
            Carrito de Compras
        </div>
        <div id="datos_carrito" class="grid_1 alpha">
            <table frame="below" border="2">
                <tr>
                    <td>1x&nbsp;</td>
                    <td>Lavadora LG con premio sorpresa</td>
                </tr>
                <tr>
                    <td>1x&nbsp;</td>
                    <td>Televisor Sony</td>
                </tr>
                <tr>
                    <td>1x&nbsp;</td>
                    <td>Cocina Indurama</td>
                </tr>
                <tr>
                    <td>1x&nbsp;</td>
                    <td>Plancha oster</td>
                </tr>
                <tr>
                    <td>2x&nbsp;</td>
                    <td>iPod touch 8GB</td>
                </tr>
            </table>
            <div id="totalCarrito" class="grid_1 alpha">
                $ 2530,00
            </div>
        </div>
    </div>
    -->
    <!--
    <div id="tituloPromocion" class="grid_1 alpha">
        Promociones
    </div>
    <div id="articuloPromocionImagen" class="grid_1 alpha">
        <img border="0" src="<?php echo base_url(); ?>PlantillaComfranklin/images/swat_3.gif" vspace="5">
        <div id="articuloPromocionDatos" class="grid_1 alpha">
            Swat3: Close Quartes
            <div id="articuloPromocionDatosTachados" class="grid_1 alpha">
                $79.99
            </div>
            <div id="articuloPromocionDatos" class="grid_1 alpha">
                <font color="red">$50,99</font>
            </div>
        </div>
    </div>
    -->
    <div id="tituloPromocion" class="grid_1 alpha">
        Siguenos en:
    </div>
    <div id="articuloPromocionImagen" class="grid_1 alpha">
        <!--
        <div class="fb-like-box" data-href="http://www.facebook.com/pages/HackerUnita/144026619021436" data-width="150" data-height="330" data-show-faces="true" data-border-color="white" data-stream="false" data-header="false"></div>
        -->
        <div class="fb-like-box" data-href="http://www.facebook.com/pages/Comercial-Franklin/242398539162081" data-width="150" data-height="330" data-show-faces="true" data-border-color="white" data-stream="false" data-header="false"></div>
    </div>
</div>