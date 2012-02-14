<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ciudades_modelo extends CI_Model{
    
    function obtenerCiudades() {
        $query = $this->db->query('select * from ciudades order by idciudades');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalCiudades() {
        $query = $this->db->query('select count(*) "total" from ciudades');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarCiudadesPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM ciudades
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalCiudadesBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM ciudades
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function crearCiudad($nombre){
        $data = array (
            'nombre' => $nombre
        );
        return $this->db->insert('ciudades',$data);
    }
    
    function obtenerCiudadSeleccionada($idciudad) {
        $query = $this->db->query('select * from ciudades where idciudades='.$idciudad);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarCiudad($idciudad,$nombre) {
        $data = array(
            'nombre' => $nombre
        );
        $this->db->where('idciudades', $idciudad);
        return $this->db->update('ciudades', $data);
    }
    
    function actualizarEstado($idciudad, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idciudades', $idciudad);
        return $this->db->update('ciudades', $data);
    }
    
}