<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Catálogo</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>categorias/mantenimiento_categorias" 
               <?php
               if (isset($item_activo_inicio_categorias)) {
                   echo 'id="'.$item_activo_inicio_categorias.'"';
                   unset($item_activo_inicio_categorias);
               }
               ?>
               >
                Categorias
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>subcategorias/mantenimiento_subcategorias"
               <?php
               if (isset($item_activo_inicio_subcategorias)) {
                   echo 'id="'.$item_activo_inicio_subcategorias.'"';
                   unset($item_activo_inicio_subcategorias);
               }
               ?>
               > 
               Subcategorias
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>fabricantes/mantenimiento_fabricantes"
               <?php
               if (isset($item_activo_inicio_fabricantes)) {
                   echo 'id="'.$item_activo_inicio_fabricantes.'"';
                   unset($item_activo_inicio_fabricantes);
               }
               ?>
               >  
               Fabricantes
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>productos/mantenimiento_productos"
               <?php
               if (isset($item_activo_inicio_productos)) {
                   echo 'id="'.$item_activo_inicio_productos.'"';
                   unset($item_activo_inicio_productos);
               }
               ?> 
               >
               Productos
            </a>
        </li>
    </ul>