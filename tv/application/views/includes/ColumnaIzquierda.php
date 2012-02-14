<!-- contenido de columna izquierda -->
<div id="columna_izquierda" class="grid_2">
    <div id="modulo" class="grid_1 alpha">
        <div id="titulo1" class="grid_1 alpha">
            Catálogo
        </div>
        <div id="datos" class="grid_1 alpha">
            <!--
            <div id="treecontrol">
                <a title="Expand the entire tree below" href="#">Contraer</a> /
                <a title="Collapse the entire tree below" href="#">Expandir</a>  
            </div>
            -->
            <div id="nombre_subcategoria">
                
            </div>
                <?php
                $imagen_propiedades = array(
                    'src' => base_url().'/PlantillaComfranklin/iconos/Folder.png',
                    'class' => 'imagen_miniatura',
                    );
                $conCat = $this->db->query('SELECT idcategorias, nombre FROM categorias where estado = 1');
                foreach ($conCat->result() as $row) {
                    echo '<div id="division_entre_categoria">';
                    echo '<div id="nombre_categoria">'.img($imagen_propiedades).' '. $row->nombre . '</div>';
                    $conSubCat = $this->db->query("SELECT idsubcategorias, nombre " .
                                    "FROM subcategorias " .
                                    "where estado = 1 and subcategorias.categorias_idcategorias = $row->idcategorias");
                    foreach ($conSubCat->result() as $r) {
                        echo '<div id="nombre_subcategoria">' . anchor('productos/listar_productos/' . $r->idsubcategorias, $r->nombre) .'</div>';
                        

//listo para paginacion
//                        $agregarProductoCarrito = array('id' => 'idsubcategoria');
//                        echo form_open('productos/listar_productos', $agregarProductoCarrito);
//                        $datos = array(
//                            'idSubCategoria' => $r->idsubcategorias,
//                        );
//                        echo form_hidden($datos);
//                        echo form_submit('submit', $r->nombre);
//                        echo form_close();
                        
                    }
                    echo "</div>";
                }
                ?>
        </div>
        <!--
        <div id="titulo1" class="grid_1 alpha">
            Fabricantes
        </div>
        <div id="datos" class="grid_1 alpha">
            <select name="selCombo" size="1" onChange="javascript:alert('prueba');"> 
                <option value="link pagina 1">Sony</option>
                <option value="link pagina 2">Samsung</option>
                <option value="link pagina 3">LG</option>
                <option value="link pagina 4">Indurama</option> 
            </select> 
        </div>
        -->
        <!--
        <div id="titulo2" class="grid_1 alpha">
            Busqueda Rapida
        </div>
        <div id="datos" class="grid_1 alpha">
            <input type="text" name="nombre" value="sony" size="10">
            <img border="0" src="<?php echo base_url(); ?>PlantillaComfranklin/images/button_quick_find.gif">
            Use palabras claves para encontrar el producto que busca
        </div>
        -->
        
        <div id="titulo3" class="grid_1 alpha">
            Promociones
        </div>
        <div id="articulo_nuevo" class="grid_1 alpha">
            <?php
            $query = $this->db->query("SELECT * 
                FROM productos
                WHERE precioPromocion != 0.00
                ORDER BY RAND( ) 
                LIMIT 1");
            foreach ($query->result() as $r) {
                $imagen_propiedades = array(
                    'src' => base_url() . '/' . $r->imagenMuestra,
                    'class' => 'imagen_muestra_promocion',
                    'vspace' => '10',
                );
                echo anchor('productos/presentar_producto/' . $r->idproductos, img($imagen_propiedades));
                echo '<br>' . anchor('productos/presentar_producto/'. $r->idproductos, $r->nombre, 'class="enlaceProductoPromocion"') . '<br><span style="text-decoration: line-through">$' . $r->precio . '</span><br><font color="red"><b>$' . $r->precioPromocion . '</b></font>';
            }
            ?>
        </div>
        <div id="titulo2" class="grid_1 alpha">
            Informaciones
        </div>
        <div id="informacion" class="grid_1 alpha">
            <?= anchor('informacion_corporativa/donde_estamos','Donde Estamos'); ?><br>
            <?= anchor('informacion_corporativa/nuestras_tiendas','Nuestras Tiendas'); ?><br>
            <?= anchor('informacion_corporativa/mision_vision','Misión y Visión'); ?><br>
            <?= anchor('informacion_corporativa/aviso_legal','Aviso Legal'); ?>
        </div>	
    </div>	
</div>