<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administracion_modelo extends CI_Model{
    
    function verificarLogin($email,$password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('estado', 1);
        $query = $this->db->get('administracion');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }
    
    function verificarUsuario($email){
        $this->db->where('email', $email);
        $this->db->where('estado', 1);
        $query = $this->db->get('administracion');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function actualizarCodigo($email, $codigoVerificacion) {
        $data = array(
            'codigoVerificacion' => $codigoVerificacion
        );
        $this->db->where('email', $email);
        $this->db->update('administracion', $data);
    }
    
    function verificarDatos($email, $codigo) {
        $query = $this->db->query('select * from administracion where email = "'.$email.'" and codigoVerificacion = "'.$codigo.'"');
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    
    function actualizarPassword($email, $codigoVerificacion, $password) {
        $data = array(
            'codigoVerificacion' => $codigoVerificacion,
            'password' => $password
        );
        $this->db->where('email', $email);
        return $this->db->update('administracion', $data);
    }
    
    //metodos para controlar el mantenimiento de usuarios administradores
    
    function obtenerAdministradores() {
        $query = $this->db->query('select * from administracion order by idadministradores');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function obtenerTotalAdministradores() {
        $query = $this->db->query('select count(*) "total" from administracion');
        if ($query->num_rows() > 0) {
             $total = $query->row()->total;
             return $total;
        }
    }
    
    function buscarUsuariosPorNombre($apelllido) {
        $query = $this->db->query('SELECT *
            FROM administracion
            WHERE apellidos like "%'.$apelllido.'%"');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function obtenerTotalUsuariosBuscarPorNombre($apelllido) {
        $query = $this->db->query('SELECT count(*) "total_busqueda"
            FROM administracion
            WHERE apellidos like "%'.$apelllido.'%"');
        if ($query->num_rows() > 0) {
            $totalBusqueda = $query->row()->total_busqueda;
             return $totalBusqueda;
        }
    }
    
    function verificarEmail($email){
        $this->db->where('email', $email);
        $query = $this->db->get('administracion');
        if($query->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }
    
    function crearUsuario($nombre, $apellido, $email, $passwordConMd5, $codigoVerificacion){
        $data = array (
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'email' => $email,
            'password' => $passwordConMd5,
            'estado' => 1,
            'codigoVerificacion' => $codigoVerificacion,
        );
        return $this->db->insert('administracion',$data);
    }
    
    function obtenerUsuarioSeleccionado($idusuario) {
        $query = $this->db->query('select * from administracion where idadministradores ='.$idusuario);
        if ($query->num_rows() > 0) {
             return $query->result();
        }
    }
    
    function actualizarUsuario($id_usuario_seleccionado, $nombre, $apellido, $email) {
        $data = array(
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'email' => $email
        );
        $this->db->where('idadministradores', $id_usuario_seleccionado);
        return $this->db->update('administracion', $data);
    }
    
    function eliminarUsuario($idusuario) {
        $this->db->where('idadministradores', $idusuario);
        return $this->db->delete('administracion');
    }
    
    function actualizarPasswordUsuario($idusuario, $password) {
        $data = array(
            'password' => $password
        );
        $this->db->where('idadministradores', $idusuario);
        return $this->db->update('administracion', $data);
    }
    
}