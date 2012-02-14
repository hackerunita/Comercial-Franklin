<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes_modelo extends CI_Model{
    
    function obtenerClientes() {
        $query = $this->db->query('SELECT *
            FROM clientes order by idclientes');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalClientes() {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarClientesPorNombre($nombre) {
        $query = $this->db->query('SELECT *
            FROM clientes
            WHERE apellidos like "%'.$nombre.'%" order by idclientes');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalClientesBuscarPorNombre($nombre) {
        $query = $this->db->query('SELECT COUNT( * )  "total"
            FROM clientes
            WHERE apellidos like "%'.$nombre.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total;
             return $totalBusqueda;
        }
    }
    
    function obtenerClienteSeleccionado($idcliente) {
        $query = $this->db->query('SELECT *
            FROM clientes
            WHERE idclientes = '.$idcliente);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarCliente($id_cliente_seleccionado, $nombre, $apellido, $direccion, $email, $telefono, $celular){
        $data = array(
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'direccion' => $direccion,
            'email' => $email,
            'telefonoFijo' => $telefono,
            'telefonoMovil' =>$celular
        );
        $this->db->where('idclientes', $id_cliente_seleccionado);
        return $this->db->update('clientes', $data);
    }
    
    function actualizarEstado($idcliente, $estado) {
        $data = array(
            'estado' => $estado
        );
        $this->db->where('idclientes', $idcliente);
        return $this->db->update('clientes', $data);
    }
    
    function obtenerEmailCliente($idcliente) {
        $query = $this->db->query('SELECT email
            FROM clientes where idclientes = '.$idcliente);
        if ($query->num_rows() > 0) {
             $email = $query->row()->email;
             return $email;
        }
    }
}