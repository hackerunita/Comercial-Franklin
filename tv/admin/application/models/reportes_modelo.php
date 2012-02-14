<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reportes_modelo extends CI_Model{
    
    function obtenerProductosMasVendidos() {
        $query = $this->db->query
          ('SELECT p.productos_idproductos, p.descripcion, SUM( p.cantidad ) AS Total
            FROM detalle_pedidos p
            GROUP BY p.descripcion
            ORDER BY Total DESC 
            LIMIT 10');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
}