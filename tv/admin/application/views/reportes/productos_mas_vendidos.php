</div>
<!-- fin de columna izquierda -->
    <!-- comienzo de columna central -->
    <div id="center-column">
        <div class="top-bar">
            <h1>Reportes</h1>
            <div><a href="">Productos Más Vendidos</a></div>
        </div>
        <div class="container_12">
            <div class="grid_8">
                <div class="grid_8 alpha" id="titulo_general_contenido">
                    Top 10 Productos Más Vendidos:
                </div>
                <?php
                if (isset($obtenerProductosMasVendidos)) {
                    echo '<div class="table">';
                    echo '<table class="listing" cellpadding="0" cellspacing="0">';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Total</th>';
                    echo '</tr>';
                    foreach ($obtenerProductosMasVendidos as $filaObtenerProducto):
                        echo '<tr>';
                        echo '<td class="id_tabla">' . $filaObtenerProducto->productos_idproductos . '</td>';
                        echo '<td width="400px">' . $filaObtenerProducto->descripcion . '</td>';
                        echo '<td>' . $filaObtenerProducto->Total . '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</table>';
                    echo '<div class="select">';
                    echo '<strong>Total: 10 Registros</strong>';
                    echo '</div>';
                    echo '</div>';
                    unset($obtenerProductosMasVendidos);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- fin de columna central -->