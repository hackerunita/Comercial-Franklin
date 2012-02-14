<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Parroquias_modelo extends CI_Model{
    
    function obtenerCiudades() {
        $query = $this->db->query('select * from ciudades where estado = 1 order by idciudades');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerParroquias() {
        $query = $this->db->query('SELECT p.idparroquias, p.nombre, p.estado, c.nombre AS NombreCiudad
            FROM ciudades c, parroquias p
            WHERE c.idciudades = p.ciudades_idciudades order by p.idparroquias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalParroquias() {
        $query = $this->db->query('select count(*) "total" from parroquias');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarParroquiasPorNombre($nombre) {
        $query = $this->db->query('SELECT p.idparroquias, p.nombre, p.estado, c.nombre AS NombreCiudad
            FROM ciudades c, parroquias p
            WHERE c.idciudades = p.ciudades_idciudades and
            p.nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalParroquiasBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM parroquias
            WHERE nombre like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function crearParroquia($nombre, $ciudad){
        $data = array (
            'nombre' => $nombre,
            'ciudades_idciudades' => $ciudad
        );
        return $this->db->insert('parroquias',$data);
    }
    
    function obtenerParroquiaSeleccionada($idparroquia) {
        $query = $this->db->query('SELECT p.idparroquias, p.nombre, p.estado, c.nombre AS NombreCiudad
            FROM ciudades c, parroquias p
            WHERE c.idciudades = p.ciudades_idciudades and p.idparroquias = '.$idparroquia);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarParroquia($id_parroquia_seleccionada, $nombre, $ciudad) {
        $data = array(
            'nombre' => $nombre,
            'ciudades_idciudades' => $ciudad
        );
        $this->db->where('idparroquias', $id_parroquia_seleccionada);
        return $this->db->update('parroquias', $data);
    }
    
    function actualizarEstado($idparroquia, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idparroquias', $idparroquia);
        return $this->db->update('parroquias', $data);
    }
    
    //metodos para paginacion
    
    function obtenerParroquiasPaginacion($per_page, $segment) {
        $this->db->select('p.idparroquias, p.nombre, p.estado, c.nombre AS NombreCiudad', FALSE);
        $where = "c.idciudades = p.ciudades_idciudades"; $this->db->where($where);
        $this->db->order_by('idparroquias ASC');
        $query = $this->db->get('ciudades c, parroquias p', $per_page, $segment);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function totalParroquias() {
        $q = $this->db->get('parroquias');
        return $q->num_rows();
    }
    
    
    
//    function getAllPaginated($per_page, $segment) {
//        $this->db->order_by('idparroquias ASC');
//        $q = $this->db->get('parroquias', $per_page, $segment);
//        $data["parroquias"] = array();
//        if ($q->num_rows() > 0) {
//            foreach ($q->result() as $row) {
//                $data["parroquias"][$row->idparroquias]["idparroquias"] = $row->idparroquias;
//                $data["parroquias"][$row->idparroquias]["nombre"] = $row->nombre;
//            }
//        }
//        return $data["parroquias"];
//    }

}