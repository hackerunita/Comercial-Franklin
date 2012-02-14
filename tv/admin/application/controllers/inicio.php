<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
    }
    
    function index(){
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_inicio'] = $menu_activo;
        $data ["contenido_principal"] = "Principal";
        $data ["titulo"] = "Administración Sistema Tienda Virtual";
        $this->load->view("includes/template", $data);

    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
}