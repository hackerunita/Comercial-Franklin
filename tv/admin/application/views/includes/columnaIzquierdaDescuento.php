<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Descuentos</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>promociones/mantenimiento_promociones" 
               <?php
               if (isset($item_activo_descuento_promocion)) {
                   echo 'id="'.$item_activo_descuento_promocion.'"';
                   unset($item_activo_descuento_promocion);
               }
               ?>
               >
                Promociones
            </a>
        </li>
    </ul>
    <h3>Productos</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>productos/mantenimiento_stock" 
               <?php
               if (isset($item_activo_descuento_stock)) {
                   echo 'id="'.$item_activo_descuento_stock.'"';
                   unset($item_activo_descuento_stock);
               }
               ?>
               >
                Stock de Productos
            </a>
        </li>
    </ul>