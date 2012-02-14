<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subcategorias_modelo extends CI_Model{
    
    function obtenerCategorias() {
        $query = $this->db->query('select * from categorias where estado = 1 order by idcategorias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerSubCategorias() {
        $query = $this->db->query('SELECT sub.idsubcategorias, sub.nombre, sub.estado, cat.nombre AS NombreCategoria
            FROM categorias cat, subcategorias sub
            WHERE cat.idcategorias = sub.categorias_idcategorias order by sub.idsubcategorias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalSubCategorias() {
        $query = $this->db->query('select count(*) "total" from subcategorias');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarSubCategoriasPorNombre($nombre) {
        $query = $this->db->query('SELECT sub.idsubcategorias, sub.nombre, sub.estado, cat.nombre AS NombreCategoria
            FROM categorias cat, subcategorias sub
            WHERE cat.idcategorias = sub.categorias_idcategorias and
            sub.nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalSubCategoriasBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM subcategorias
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function crearSubCategoria($nombre, $categoria){
        $data = array (
            'nombre' => $nombre,
            'categorias_idcategorias' => $categoria
        );
        return $this->db->insert('subcategorias',$data);
    }
    
    function obtenerSubCategoriaSeleccionada($idsubcategoria) {
        $query = $this->db->query('SELECT sub.idsubcategorias, sub.nombre, sub.estado, cat.nombre AS NombreCategoria
            FROM categorias cat, subcategorias sub
            WHERE cat.idcategorias = sub.categorias_idcategorias and sub.idsubcategorias = '.$idsubcategoria);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarSubCategoria($id_subcategoria_seleccionada, $nombre, $categoria) {
        $data = array(
            'nombre' => $nombre,
            'categorias_idcategorias' => $categoria
        );
        $this->db->where('idsubcategorias', $id_subcategoria_seleccionada);
        return $this->db->update('subcategorias', $data);
    }
    
    function actualizarEstado($idsubcategoria, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idsubcategorias', $idsubcategoria);
        return $this->db->update('subcategorias', $data);
    }
    
//    function eliminarSubCategoria($idsubcategoria) {
//        $this->db->where('idsubcategorias', $idsubcategoria);
//        return $this->db->delete('subcategorias');
//    }
}