<!-- comienzo de columna izquierda -->
<div id="left-column">
    <h3>Administración</h3>
    <ul class="nav">
        <li>
            <a href="<?php echo base_url(); ?>administracion/mantenimiento_administracion" 
               <?php
               if (isset($item_activo_administracion_usuarios)) {
                   echo 'id="'.$item_activo_administracion_usuarios.'"';
                   unset($item_activo_administracion_usuarios);
               }
               ?>
               >
                Usuarios
            </a>
        </li>
    </ul>
<!--    <a href="<?php echo base_url(); ?>administracion/mantenimiento_administracion" 
        <?php
            if (isset($item_activo_administracion_usuarios)) {
                echo 'class="' . $item_activo_administracion_usuarios . '"';
                unset($item_activo_administracion_usuarios);
            }else{
                echo 'class="link"';
            }
        ?>
       >
        Administradores
    </a>-->