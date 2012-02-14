<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Localización</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>ciudades/mantenimiento_ciudades" 
               <?php
               if (isset($item_activo_localizacion_ciudades)) {
                   echo 'id="'.$item_activo_localizacion_ciudades.'"';
                   unset($item_activo_localizacion_ciudades);
               }
               ?>
               >
                Ciudades
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>parroquias/mantenimiento_parroquias" 
               <?php
               if (isset($item_activo_localizacion_parroquias)) {
                   echo 'id="'.$item_activo_localizacion_parroquias.'"';
                   unset($item_activo_localizacion_parroquias);
               }
               ?>
               >
                Parroquias
            </a>
        </li>
    </ul>