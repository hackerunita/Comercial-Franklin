<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fabricantes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->_si_esta_logueado();
        $this->load->helper('form');
        $this->load->model('Fabricantes_modelo');
        $this->load->library('form_validation');
    }
    
    function _si_esta_logueado() {
        $si_esta_logueado = $this->session->userdata('esta_logueado');
        $idAdministradores = $this->session->userdata('idAdministrador');
        if ($si_esta_logueado != TRUE OR $idAdministradores == '') {
            redirect('administracion/loguearse');
        }
    }
    
    function mantenimiento_fabricantes(){
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        //obtener fabricantes existentes
        $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
        $data['obtenerFabricantes'] = $obtenerFabricantes;
        //obtener total de registros en tabla fabricantes
        $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
        $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
        $data ["titulo"] = "Administración de Fabricantes";
        $this->load->view("includes/template_catalogo", $data);
    }
    
    function buscar_fabricantes() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        $this->form_validation->set_rules('nombre_fabricante', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->mantenimiento_fabricantes();
        } else {
            $nombre = $this->input->post('nombre_fabricante');
            $buscarFabricantes = $this->Fabricantes_modelo->buscarFabricantesPorNombre($nombre);
            if ($buscarFabricantes) {
                $data['obtenerFabricantesPorNombre'] = $buscarFabricantes;
                //si existen resultados de la busqueda se cuentan cuantos registros hay
                $obtenerTotalFabricantesBusqueda = $this->Fabricantes_modelo->obtenerTotalFabricantesBuscarPorNombre($nombre);
                $data['obtenerTotalFabricantesBusqueda'] = $obtenerTotalFabricantesBusqueda;
            } else {
                $data['obtenerFabricantesPorNombre'] = '';
            }
            //cargando la vista y enviando datos del resultado de la busqueda
            $data['parametroFabricanteBusqueda'] = $nombre;
            $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
            $data ["titulo"] = "Administración de Fabricantes";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function crear_fabricante() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        //obtener fabricantes existentes
        $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
        $data['obtenerFabricantes'] = $obtenerFabricantes;
        //obtener total de registros en tabla fabricantes
        $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
        $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "fabricantes/crear_fabricantes";
        $data ["titulo"] = "Creación de Fabricantes";
        $this->load->view("includes/template_catalogo", $data);
    }

    function crearFabricante() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        $this->form_validation->set_rules('nombre_fabricante_crear', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->crear_fabricante();
        } else {
            $nombre = $this->input->post('nombre_fabricante_crear');
            $crearFabricante = $this->Fabricantes_modelo->crearFabricante($nombre);
            if ($crearFabricante) {
                $data ["Mensaje_Fabricante_Creado"] = 'Fabricante Creado';
            } else {
                $data ["Mensaje_Fabricante_Creado"] = '';
            }
            //obtener fabricantes existentes
            $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
            $data['obtenerFabricantes'] = $obtenerFabricantes;
            //obtener total de registros en tabla fabricantes
            $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
            $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
            $data ["titulo"] = "Creación de Fabricantes";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function actualizar_fabricantes($idfabricante) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        //obtener el fabricante seleccionado segun idfabricantes
        $obtenerFabricanteSeleccionado = $this->Fabricantes_modelo->obtenerFabricanteSeleccionado($idfabricante);
        $data['obtenerFabricanteSeleccionado'] = $obtenerFabricanteSeleccionado;
        $data ["contenido_principal"] = "fabricantes/actualizar_fabricantes";
        $data ["titulo"] = "Actualización de Fabricantess";
        $this->load->view("includes/template_catalogo", $data);
    }

    function actualizarFabricantes() {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        $id_fabricante_seleccionada = $this->input->post('id_fabricante_seleccionada');
        $this->form_validation->set_rules('nombre_fabricante_actualizar', 'Nombre', 'trim|required');
        $this->form_validation->set_message('required', 'El campo %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->actualizar_fabricantes($id_fabricante_seleccionada);
        } else {
            $nombre = $this->input->post('nombre_fabricante_actualizar');
            $actualizarFabricante = $this->Fabricantes_modelo->actualizarFabricante($id_fabricante_seleccionada, $nombre);
            if ($actualizarFabricante) {
                $data ["Mensaje_Fabricante_Actualizado"] = 'Fabricante Actualizado';
            } else {
                $data ["Mensaje_Fabricante_Actualizado"] = '';
            }
            //obtener fabricantes existentes
            $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
            $data['obtenerFabricantes'] = $obtenerFabricantes;
            //obtener total de registros en tabla fabricantes
            $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
            $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
            //cargando la vista y enviando datos
            $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
            $data ["titulo"] = "Creación de Fabricantes";
            $this->load->view("includes/template_catalogo", $data);
        }
    }
    
    function actualizar_estado($idfabricante, $estado) {
        //mandando el estilo del menu activo
        $menu_activo = 'active'; $data['menu_activo_catalogo'] = $menu_activo;
        //mandando el estilo del item activo
        $item_activo = 'enlace_activo'; $data['item_activo_inicio_fabricantes'] = $item_activo;
        if ($estado == 0) {
            $actualizarEstado = $this->Fabricantes_modelo->actualizarEstado($idfabricante, 1);
            if ($actualizarEstado) {
                $data ["Mensaje_Fabricante_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Fabricante_Estado"] = '';
            }
        }
        if ($estado == 1) {
            $actualizarEstado = $this->Fabricantes_modelo->actualizarEstado($idfabricante, 0);
            if ($actualizarEstado) {
                $data ["Mensaje_Fabricante_Estado"] = 'Estado Actualizado';
            } else {
                $data ["Mensaje_Fabricante_Estado"] = '';
            }
        }
        //obtener fabricantes existentes
        $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
        $data['obtenerFabricantes'] = $obtenerFabricantes;
        //obtener total de registros en tabla fabricantes
        $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
        $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
        //cargando la vista y enviando datos
        $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
        $data ["titulo"] = "Creación de Fabricantes";
        $this->load->view("includes/template_catalogo", $data);
    }
    
//    function eliminar_fabricantes($idfabricante){
//        //obtener el fabricante seleccionado segun idfabricantes
//        $obtenerFabricanteSeleccionado = $this->Fabricantes_modelo->obtenerFabricanteSeleccionado($idfabricante);
//        $data['obtenerFabricanteSeleccionado'] = $obtenerFabricanteSeleccionado;
//        $data['idFabricanteSeleccionado'] = $idfabricante;
//        $data ["contenido_principal"] = "fabricantes/eliminar_fabricantes";
//        $data ["titulo"] = "Eliminación de Fabricantes";
//        $this->load->view("includes/template", $data);
//    }
//
//    function eliminarFabricantes($idfabricante) {
//        $eliminarFabricante = $this->Fabricantes_modelo->eliminarFabricante($idfabricante);
//        if ($eliminarFabricante) {
//            $data ["Mensaje_Fabricante_Eliminado"] = 'Fabricante Eliminado';
//        } else {
//            $data ["Mensaje_Fabricante_Eliminado"] = '';
//        }
//        //obtener fabricantes existentes
//        $obtenerFabricantes = $this->Fabricantes_modelo->obtenerFabricantes();
//        $data['obtenerFabricantes'] = $obtenerFabricantes;
//        //obtener total de registros en tabla fabricantes
//        $obtenerTotalFabricantes = $this->Fabricantes_modelo->obtenerTotalFabricantes();
//        $data['obtenerTotalFabricantes'] = $obtenerTotalFabricantes;
//        //cargando la vista y enviando datos
//        $data ["contenido_principal"] = "fabricantes/mantenimiento_fabricantes";
//        $data ["titulo"] = "Administración de Fabricantes";
//        $this->load->view("includes/template", $data);
//    }
}