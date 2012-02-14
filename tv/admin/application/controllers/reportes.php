<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Reportes_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function reporte_productos_mas_vendidos() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_reportes'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_reporte_producto_mas_vendido'] = $item_activo;
        //obtener top 5 de los productos mas vendidos
        $obtenerProductosMasVendidos = $this->Reportes_modelo->obtenerProductosMasVendidos();
        $data['obtenerProductosMasVendidos'] = $obtenerProductosMasVendidos;
        //cargando vista asociada
        $data ["contenido_principal"] = "reportes/productos_mas_vendidos";
        $data ["titulo"] = "Reporte de Productos más Vendidos";
        $this->load->view("includes/template_reportes", $data);
    }
    
}