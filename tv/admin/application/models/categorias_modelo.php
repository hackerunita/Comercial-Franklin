<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categorias_modelo extends CI_Model{
    
    function obtenerCategorias() {
        $query = $this->db->query('select * from categorias order by idcategorias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalCategorias() {
        $query = $this->db->query('select count(*) "total" from categorias');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarCategoriasPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM categorias
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalCategoriasBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM categorias
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function crearCategoria($nombre){
        $data = array (
            'nombre' => $nombre
        );
        return $this->db->insert('categorias',$data);
    }
    
    function obtenerCategoriaSeleccionada($idcategoria) {
        $query = $this->db->query('select * from categorias where idcategorias='.$idcategoria);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarCategoria($idcategoria,$nombre) {
        $data = array(
            'nombre' => $nombre
        );
        $this->db->where('idcategorias', $idcategoria);
        return $this->db->update('categorias', $data);
    }
    
    function actualizarEstado($idcategoria, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idcategorias', $idcategoria);
        return $this->db->update('categorias', $data);
    }
    
    /*function eliminarCategoria($idcategoria) {
        $this->db->where('idcategorias', $idcategoria);
        return $this->db->delete('categorias');
    }*/
    
}