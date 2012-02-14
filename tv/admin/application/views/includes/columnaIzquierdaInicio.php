<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Mi Cuenta</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>administracion/actualizar_mi_password" 
               <?php
               if (isset($item_activo_inicio_mi_password)) {
                   echo 'id="'.$item_activo_inicio_mi_password.'"';
                   unset($item_activo_inicio_mi_password);
               }
               ?>
               >
                Cambiar Contraseña
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>administracion/actualizar_mis_datos" 
               <?php
               if (isset($item_activo_inicio_mis_datos)) {
                   echo 'id="'.$item_activo_inicio_mis_datos.'"';
                   unset($item_activo_inicio_mis_datos);
               }
               ?>
               >
                Cambiar Mis Datos
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>administracion/cerrar_sesion" 
               <?php
               if (isset($item_activo_inicio_cerrar_sesion)) {
                   echo 'id="'.$item_activo_inicio_cerrar_sesion.'"';
                   unset($item_activo_inicio_cerrar_sesion);
               }
               ?>
               >
                Cerrar Sesión
            </a>
        </li>
    </ul>