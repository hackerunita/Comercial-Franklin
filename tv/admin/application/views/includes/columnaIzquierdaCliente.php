<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Clientes</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>clientes/mantenimiento_clientes" 
               <?php
               if (isset($item_activo_clientes_clientes)) {
                   echo 'id="'.$item_activo_clientes_clientes.'"';
                   unset($item_activo_clientes_clientes);
               }
               ?>
               >
                Clientes
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pedidos/mantenimiento_pedidos" 
               <?php
               if (isset($item_activo_clientes_pedidos)) {
                   echo 'id="'.$item_activo_clientes_pedidos.'"';
                   unset($item_activo_clientes_pedidos);
               }
               ?>
               >
                Pedidos
            </a>
        </li>
    </ul>
<!--    <a href="<?php echo base_url(); ?>pedidos/mantenimiento_pedidos_pendientes" class="activo">Pedidos Pendientes</a>-->
    <a href="<?php echo base_url(); ?>pedidos/mantenimiento_pedidos_pendientes" 
        <?php
            if (isset($item_activo_clientes_pedidos_pendientes)) {
                echo 'class="' . $item_activo_clientes_pedidos_pendientes . '"';
                unset($item_activo_clientes_pedidos_pendientes);
            }else{
                echo 'class="link"';
            }
        ?>
       >
        Pedidos Pendientes
    </a>