<!-- contenido columna central -->
<div id="columna_central" class="grid_8 alpha">
    <div id="barra_navegacion" class="grid_1 alpha">
        <?php
        $imagen_mapa = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Digg.png',
                    'class' => 'imagen_miniatura',
            );
        ?>
        <div id="principal" class="grid_1 alpha">
            <?= img($imagen_mapa).'';?>&nbsp;&nbsp;&nbsp;<?php echo $titulo; ?>
        </div>
    </div>
    <div id="datosColumnaCentral" class="grid_7">
        <?php
            $imagen_inicio = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Home.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_mision = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Document.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_donde = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Contact.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_tiendas = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/shopping-basket.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_contactenos = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Headphones.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_mapas = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Digg.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_acerca = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Favorite.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_aviso = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Edit_Yes.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_ayuda = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Help.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_usuario = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/User.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_crear = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/User_add.png',
                    'class' => 'imagen_miniatura',
            );
            $imagen_olvidar = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Unlock.png',
                    'class' => 'imagen_miniatura',
            );
            ?>
        <?php
        $imagen_mapa = array(
            'src' => base_url().'/PlantillaComfranklin/iconos/Digg.png',
            'class' => 'imagen_mediana_icono',
        );
        ?>
        <h1><?php echo $titulo; ?>&nbsp;&nbsp;&nbsp;<?= img($imagen_mapa);?></h1>
        <div class="grid_7" id="bloque_mapa_sitio">
        <div class="grid_2">
            <div class="titulo_mapa_sitio">
            Información: <br>
            </div>
            <div class="items_mapa_sitio">
            <?php
            echo img($imagen_inicio);?>&nbsp;&nbsp;<?php
            echo anchor(base_url(),'Inicio<br>', 'class="enlaces_generales"');
            echo img($imagen_contactenos);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/contactenos','Contactenos<br>', 'class="enlaces_generales"');
            echo img($imagen_aviso);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/aviso_legal','Aviso Legal<br>', 'class="enlaces_generales"');
            echo img($imagen_donde);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/donde_estamos','Donde Estamos<br>', 'class="enlaces_generales"');
            echo img($imagen_tiendas);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/nuestras_tiendas','Nuestras Tiendas<br>', 'class="enlaces_generales"');
            ?>
            </div>
        </div>
        <div class="grid_2">
            <div class="titulo_mapa_sitio">
            Acerca de: <br>
            </div>
            <div class="items_mapa_sitio">
            <?php
            echo img($imagen_ayuda);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/ayuda','Ayuda<br>', 'class="enlaces_generales"');
            echo img($imagen_acerca);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/acerca_de','Acerca de<br>', 'class="enlaces_generales"');
            echo img($imagen_mapas);?>&nbsp;&nbsp;<?php
            echo anchor('informacion_corporativa/mapa_sitio','Mapa del Sitio<br>', 'class="enlaces_generales"');
            ?>
            </div>
        </div>
        <div class="grid_2">
            <div class="titulo_mapa_sitio">
            Mi Cuenta: <br>
            </div>
            <div class="items_mapa_sitio">
            <?php
            echo img($imagen_usuario);?>&nbsp;&nbsp;<?php
            echo anchor('clientes/login','Entrar<br>', 'class="enlaces_generales"');
            echo img($imagen_crear);?>&nbsp;&nbsp;<?php
            echo anchor('clientes/registrarse','Crear Usuario<br>', 'class="enlaces_generales"');
            echo img($imagen_olvidar);?>&nbsp;&nbsp;<?php
            echo anchor('clientes/recuperar_password','Olvidó Password<br>', 'class="enlaces_generales"');
            ?>
            </div>
        </div>
         </div>
        <div class="grid_7">
            
        <div class="grid_3">
            <div class="titulo_mapa_sitio">
            Catálogo:
            </div>
            <?php
            $imagen_propiedades = array(
                'src' => base_url() . '/PlantillaComfranklin/iconos/Folder.png',
                'class' => 'imagen_miniatura',
            );
            $conCat = $this->db->query('SELECT idcategorias, nombre FROM categorias where estado = 1');
            foreach ($conCat->result() as $row) {
                echo '<div id="division_entre_categoria">';
                echo '<div id="nombre_categoria">' . img($imagen_propiedades) . ' ' . $row->nombre . '</div>';
                $conSubCat = $this->db->query("SELECT idsubcategorias, nombre " .
                                "FROM subcategorias " .
                                "where estado = 1 and subcategorias.categorias_idcategorias = $row->idcategorias");
                foreach ($conSubCat->result() as $r) {
                    echo '<div id="nombre_subcategoria">' . anchor('productos/listar_productos/' . $r->idsubcategorias, $r->nombre) . '</div>';
                    //echo '<li><span>' . anchor('productos/listar_productos', $r->nombre) . '</span></li>';
                }
                echo "</div>";
            }
            ?>
        </div>
        </div>
    </div>
</div>
