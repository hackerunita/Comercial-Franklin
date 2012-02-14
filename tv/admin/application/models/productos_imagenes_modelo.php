<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productos_imagenes_modelo extends CI_Model{
    
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
    
    function obtenerProductoSeleccionado($idproducto) {
        $query = $this->db->query('SELECT *
            FROM productos
            WHERE idproductos = '.$idproducto);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function obtenerImagenesProductoSeleccionado($idproducto) {
        $query = $this->db->query('SELECT *
            FROM productos_imagenes
            WHERE productos_idproductos = '.$idproducto);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function agregarImagenProducto($id_producto_seleccionado, $nombre_imagen){
        $data = array (
            'productos_idproductos' => $id_producto_seleccionado,
            'imagenNormal' => $nombre_imagen
        );
        return $this->db->insert('productos_imagenes',$data);
    }
    
    function obtenerImagenProductoSeleccionado($idproducto_imagen) {
        $query = $this->db->query('SELECT *
            FROM productos_imagenes
            WHERE idproductos_imagenes = '.$idproducto_imagen);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function eliminarImagenProducto($idproducto) {
        $this->db->where('idproductos_imagenes', $idproducto);
        return $this->db->delete('productos_imagenes');
    }
    
}