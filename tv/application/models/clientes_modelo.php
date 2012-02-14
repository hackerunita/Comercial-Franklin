<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes_modelo extends CI_Model{
    
    function verificarEmail($email){
        $this->db->where('email', $email);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }
    
    function verificarEmailRecuperarPassword($email){
        $this->db->where('email', $email);
        $this->db->where('estado', 1);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function insertarClientes(
                    $nombres,$apellidos,$fechaNacimiento,$direccion,
                    $email,$telefonoFijo,$telefonoMovil,$password,
                    $codigoActivacion,$estado,$recibirPromociones,
                    $nombrePersonaRecibePedido,$parroquia, $ciudad
                    ){
        $data = array (
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'fechaNacimiento' => $fechaNacimiento,
            'direccion' => $direccion,
            'email' => $email,
            'telefonoFijo' => $telefonoFijo,
            'telefonoMovil' => $telefonoMovil,
            'password' => $password,
            'codigoActivacion' => $codigoActivacion,
            'estado' => $estado,
            'recibirPromociones' => $recibirPromociones,
            'nombrePersonaRecibePedido' => $nombrePersonaRecibePedido,
            'ciudad' => $ciudad,
            'parroquia' => $parroquia
        );
        return $this->db->insert('clientes',$data);
    }
    
    function confirmarRegistro($codigo_activacion){
        $this->db->select('idclientes');
        $this->db->where('codigoActivacion', $codigo_activacion);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            $data = array(
                'estado' => 1
            );
            $this->db->where('codigoActivacion', $codigo_activacion);
            $this->db->update('clientes', $data);
            return true;
        }else{
            return false;
        }
    }
    
    function verificarLogin($email,$password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('estado', 1);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }
    
    function actualizarPassword($email, $nuevoPasswordConMd5){
        $this->db->select('idclientes');
        $this->db->where('email', $email);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            $data = array(
                'password' => $nuevoPasswordConMd5
            );
            $this->db->where('email', $email);
            $this->db->update('clientes', $data);
            return true;
        }else{
            return false;
        }
    }
    
    function cambiarPassword($emailCambiar, $passwordActual, $passwordNuevo){
        $this->db->select('idclientes');
        $this->db->where('email', $emailCambiar);
        $this->db->where('password', $passwordActual);
        $query = $this->db->get('clientes');
        if($query->num_rows()>0){
            $data = array(
                'password' => $passwordNuevo
            );
            $this->db->where('email', $emailCambiar);
            $this->db->update('clientes', $data);
            return true;
        }else{
            return false;
        }
    }
    
    function listarCiudades() {
        $query = $this->db->query('select idciudades, nombre from ciudades where estado = 1 order by nombre');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function listarParroquias() {
        $query = $this->db->query('select idparroquias, nombre from parroquias where estado = 1 order by nombre');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function datosActualesCliente($id_clientes) {
        $query = $this->db->query('select * from clientes where idclientes='.$id_clientes);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function actualizarDatosEnvioCliente($id_cliente, $nombreApellido, $direccion, $telefono, $ciudad, $parroquia) {
        $data = array(
            'nombrePersonaRecibePedido' => $nombreApellido,
            'direccion' => $direccion,
            'telefonoFijo' => $telefono,
            'ciudad' => $ciudad,
            'parroquia' => $parroquia
        );
        $this->db->where('idclientes', $id_cliente);
        return $this->db->update('clientes', $data);
    }
}
