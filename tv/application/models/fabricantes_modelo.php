<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fabricantes_modelo extends CI_Model {

    function listarFrabricantesPorProducto($idSubcategoria) {
        $query = $this->db->query('SELECT DISTINCT f.idfabricantes, f.nombre
            FROM fabricantes f, productos p
            WHERE f.idfabricantes = p.fabricantes_idfabricantes
            AND p.estado =1
            AND p.subcategorias_idsubcategorias ='.$idSubcategoria.' order by nombre asc');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

}
