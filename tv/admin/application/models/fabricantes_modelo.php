<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fabricantes_modelo extends CI_Model{
    
    function obtenerFabricantes() {
        $query = $this->db->query('select * from fabricantes order by idfabricantes');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalFabricantes() {
        $query = $this->db->query('select count(*) "total" from fabricantes');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarFabricantesPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM fabricantes
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalFabricantesBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM fabricantes
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function crearFabricante($nombre){
        $data = array (
            'nombre' => $nombre
        );
        return $this->db->insert('fabricantes',$data);
    }
    
    function obtenerFabricanteSeleccionado($idfabricante) {
        $query = $this->db->query('select * from fabricantes where idfabricantes='.$idfabricante);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarFabricante($id_fabricante_seleccionada, $nombre) {
        $data = array(
            'nombre' => $nombre
        );
        $this->db->where('idfabricantes', $id_fabricante_seleccionada);
        return $this->db->update('fabricantes', $data);
    }
    
    function actualizarEstado($idfabricante, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idfabricantes', $idfabricante);
        return $this->db->update('fabricantes', $data);
    }
    
//    function eliminarFabricante($idfabricante) {
//        $this->db->where('idfabricantes', $idfabricante);
//        return $this->db->delete('fabricantes');
//    }
}