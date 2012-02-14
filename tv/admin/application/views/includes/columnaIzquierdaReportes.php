<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Reportes</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>reportes/reporte_productos_mas_vendidos" 
               <?php
               if (isset($item_activo_reporte_producto_mas_vendido)) {
                   echo 'id="'.$item_activo_reporte_producto_mas_vendido.'"';
                   unset($item_activo_reporte_producto_mas_vendido);
               }
               ?>
               >
                Más Vendidos
            </a>
        </li>
    </ul>