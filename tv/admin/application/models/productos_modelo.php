<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productos_modelo extends CI_Model{
    
    function obtenerProductos() {
        $query = $this->db->query('SELECT *
            FROM productos order by idproductos');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalProductos() {
        $query = $this->db->query('select count(*) "total" from productos');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarProductosPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM productos
            WHERE nombre like "%'.$nombre.'%" order by idproductos');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalProductosBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM productos
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function obtenerFabricantes() {
        $query = $this->db->query('select * from fabricantes where estado = 1 order by idfabricantes');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerSubCategorias() {
        $query = $this->db->query('select * from subcategorias where estado = 1 order by idsubcategorias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function crearProducto($nombre, $descripcion, $caracteristicas, $precio, $stock, $nombre_imagen, $subcategoria, $fabricante){
        $data = array (
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'caracteristicas' => $caracteristicas,
            'precio' => $precio,
            'stock' => $stock,
            'imagenMuestra' => $nombre_imagen,
            'fabricantes_idfabricantes' => $fabricante,
            'subcategorias_idsubcategorias' => $subcategoria 
            
        );
        return $this->db->insert('productos',$data);
    }
    
    function obtenerProductoSeleccionado($idproducto) {
        $query = $this->db->query('SELECT *
            FROM productos
            WHERE idproductos = '.$idproducto);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarProducto($id_producto_seleccionado, $nombre, $descripcion, $caracteristicas, $precio, $stock, $nombre_imagen) {
        $data = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'caracteristicas' => $caracteristicas,
            'precio' => $precio,
            'stock' => $stock,
            'imagenMuestra' => $nombre_imagen,
        );
        $this->db->where('idproductos', $id_producto_seleccionado);
        return $this->db->update('productos', $data);
    }
    
    function actualizarEstado($idproducto, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idproductos', $idproducto);
        return $this->db->update('productos', $data);
    }
    
    function actualizarProductoStock($id_producto_seleccionado, $stock) {
        $data = array(
            'stock' => $stock
        );
        $this->db->where('idproductos', $id_producto_seleccionado);
        return $this->db->update('productos', $data);
    }
    
}