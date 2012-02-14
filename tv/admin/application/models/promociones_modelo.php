<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Promociones_modelo extends CI_Model{
    
    function obtenerProductosPromocion() {
        $query = $this->db->query('SELECT *
            FROM productos 
            where precioPromocion != 0.00');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalProductosPromocion() {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM productos 
            where precioPromocion != 0.00');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarPromocionesPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM productos
            WHERE precioPromocion != 0.00 AND nombre like "%'.$nombre.'%" order by idproductos');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalPromocionesBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM productos
            WHERE precioPromocion != 0.00 AND nombre like "%'.$nombre.'%" order by idproductos');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total;
             return $totalBusqueda;
        }
    }
    
    function obtenerProductos() {
        $query = $this->db->query('SELECT *
            FROM productos');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function crearPromocion($producto, $precio){
        $data = array(
            'precioPromocion' => $precio
        );
        $this->db->where('idproductos', $producto);
        return $this->db->update('productos', $data);
    }
    
    function obtenerPromocionSeleccionada($idproducto) {
        $query = $this->db->query('SELECT *
            FROM productos
            WHERE idproductos = '.$idproducto);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarPromocion($id_producto_seleccionado, $precio){
        $data = array(
            'precioPromocion' => $precio
        );
        $this->db->where('idproductos', $id_producto_seleccionado);
        return $this->db->update('productos', $data);
    }
    
    function eliminarPromocion($idproducto){
        $data = array(
            'precioPromocion' => 0.00
        );
        $this->db->where('idproductos', $idproducto);
        return $this->db->update('productos', $data);
    }
}