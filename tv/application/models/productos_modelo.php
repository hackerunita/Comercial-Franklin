<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_modelo extends CI_Model {

    function listarSubcategoria($idSubcategoria) {
        $this->db->select('nombre');
        $this->db->where('idsubcategorias', $idSubcategoria);
        $query = $this->db->get('subcategorias');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function listarProductos($idSubcategoria) {
        $this->db->select('idproductos');
        $this->db->select('imagenMuestra');
        $this->db->select('nombre');
        $this->db->select('precio');
        $this->db->select('precioPromocion');
        $this->db->where('subcategorias_idsubcategorias', $idSubcategoria);
        $this->db->where('estado', 1);
        $query = $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
//    function listarProductosPaginacion($idSubcategoria, $per_page, $segment) {
//        $this->db->where('subcategorias_idsubcategorias', $idSubcategoria);
//        $this->db->where('estado', 1);
//        $this->db->order_by('nombre ASC');
//        $query = $this->db->get('productos', $per_page, $segment);
//        if ($query->num_rows() > 0) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }

    function listarProductosPorOrden($idSubcategoria, $campo, $recibirOrden, $idFabricante) {
        if ($idFabricante != '') {
            if($idFabricante == 0){
                $query = $this->db->query('SELECT idproductos, imagenMuestra, nombre, precio, precioPromocion
                FROM productos WHERE subcategorias_idsubcategorias =' . $idSubcategoria . ' and estado=1 
                order by '.$campo.' '.$recibirOrden);
            }else{
            $query = $this->db->query('SELECT idproductos, imagenMuestra, nombre, precio, precioPromocion
            FROM productos WHERE subcategorias_idsubcategorias =' . $idSubcategoria . ' and estado=1 
            AND fabricantes_idfabricantes = ' . $idFabricante . ' order by '.$campo.' '.$recibirOrden);
            }
        } else {
            $query = $this->db->query('SELECT idproductos, imagenMuestra, nombre, precio, precioPromocion
            FROM productos WHERE subcategorias_idsubcategorias =' . $idSubcategoria . ' and estado=1 
            order by '.$campo.' '.$recibirOrden);
        }
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function listarProductosPorFabricante($idFabricante, $idSubCategoria) {
        if ($idFabricante != 0) {
            $query = $this->db->query('SELECT idproductos, imagenMuestra, nombre, precio, precioPromocion
            FROM productos WHERE subcategorias_idsubcategorias =' . $idSubCategoria . ' and estado=1 
            AND fabricantes_idfabricantes = ' . $idFabricante . ' order by nombre desc');
        } else {
            $query = $this->db->query('SELECT idproductos, imagenMuestra, nombre, precio, precioPromocion
            FROM productos WHERE subcategorias_idsubcategorias =' . $idSubCategoria.' and estado=1 order by nombre');
        }
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function MostrarProducto($idproductos) {
        $this->db->select('idproductos');
        $this->db->select('nombre');
        $this->db->select('descripcion');
        $this->db->select('caracteristicas');
        $this->db->select('imagenMuestra');
        $this->db->select('precio');
        $this->db->select('precioPromocion');
        $this->db->where('idproductos', $idproductos);
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function imagenesProductos($idproductos){
        $query = $this->db->query('SELECT idproductos_imagenes, imagenNormal
            FROM productos_imagenes
            WHERE productos_idproductos ='.$idproductos);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function buscarProductosPorNombre($nombre) {
        $query = $this->db->query('SELECT p.idproductos, p.nombre, p.descripcion, p.caracteristicas, p.precio, p.precioPromocion, p.stock, p.imagenMuestra, p.estado, p.fabricantes_idfabricantes, p.subcategorias_idsubcategorias
            FROM productos p, fabricantes f, subcategorias s
            WHERE p.nombre like "%'.$nombre.'%" and p.estado = 1 and 
            f.estado = 1 and s.estado = 1 and 
            f.idfabricantes = p.fabricantes_idfabricantes and s.idsubcategorias = p.subcategorias_idsubcategorias
            ');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    //metodos para paginacion
    
//    function totalProductos($idSubcategoria) {
//        $query = $this->db->query('SELECT *
//            FROM productos
//            WHERE subcategorias_idsubcategorias = '.$idSubcategoria);
//        return $query->num_rows();
//    }

}