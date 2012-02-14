    <!-- comienzo de columna derecha -->
    <div id="right-column">
<!--        <strong class="h">Información</strong>
        <div class="box">
            Esta zona le da acceso a la administración de la aplicación donde le facilita la operación del Sitio de Comercial Franklin.
        </div>-->
            <?php
            if(isset($titulo_aviso) && isset($aviso_contenido)){
                echo '<strong class="h">'.$titulo_aviso.'</strong>';
                echo '<div class="box">';
                echo $aviso_contenido;
                echo '</div>';
                unset($titulo_aviso, $aviso_contenido);
            }else{
                echo '<strong class="h">Información</strong>';
                echo '<div class="box">';
                echo 'Esta zona le da acceso a la administración de la aplicación donde le facilita la operación del Sitio de Comercial Franklin.';
                echo '</div>';
            }
            ?>
    </div>
    <!-- fin de columna derecha -->
</div>
<!-- fin del contenido columnas izquierda, central y derecha -->